<?php

namespace Tests;


use App\Entities\Salary;
use App\Entities\Survey;
use App\Models\User;
use App\Services\AuthLoggerInterface;
use Doctrine\DBAL\Exception\TableNotFoundException;
use Faker\Factory;
use Faker\Generator as Faker;
use Tymon\JWTAuth\Facades\JWTAuth;

class BackendRequirementsTest extends TestCase
{
    /** @var Faker */
    protected $faker;

    protected function setUp()
    {
        parent::setUp();

        //Add common fixtures and setup DB from all added Fixtures
        $this->setupFixtures();

        $this->faker = Factory::create();
    }

    public function testDatabaseQueriesGetCached()
    {
        // The second query should be at least 2x faster than the first
        self::assertTrue(
            ($this->getSalariesFetchDuration() / 2) >= $this->getSalariesFetchDuration()
        );
    }

    public function testAppAuthenticateByUserGroups()
    {
        $user = (new User())->setUserGroups([33]);
        $token = JWTAuth::fromUser($user);

        $response = $this->json(
            'GET',
            '/api/surveys?token=' . (string) $token
        );

        $response->assertStatus(200);
    }

    public function testApplicationServicesAreDistributed()
    {
        $user = (new User())->setUserGroups([33]);
        $token = JWTAuth::fromUser($user);

        // First fetch Survey entities
        $response = $this->json(
            'GET',
            '/api/surveys?token=' . (string) $token
        );
        $response
            ->assertStatus(200)
            ->assertJsonCount(count($this->em->getRepository(Survey::class)->findAll()));

        /*
         * Next fetch salary data for given survey, this will prove
         * the application data is fetched using distributed strategy
         */
        $response = $this->json(
            'GET',
            '/api/survey/' . $response->json()[0]['id'] .'/salaries?token=' . (string) $token
        );

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['salariesAverage']);
    }

    public function testApplicationPerformsDatabaseMigrations()
    {
        $dbConnection = $this->em->getConnection();
        // Reset database
        $this->artisan('doctrine:migrations:reset');

        // Should give error, because no tables exist
        try {
            $dbConnection->createQueryBuilder()
                ->select('1')
                ->from('survey')
                ->execute()
                ->fetchColumn();
        } catch (TableNotFoundException $e) {
            $this->assertInstanceOf(TableNotFoundException::class, $e);
        }

        // Run migrations
        $this->artisan('doctrine:migrations:migrate');

        // Verify
        $res = $dbConnection->createQueryBuilder()
            ->select('1')
            ->from('survey')
            ->execute()
            ->fetchColumn();

        // Empty table will return false, but does not throw error like it did before
        $this->assertEquals($res, false);
    }

    public function testGeneratesSalariesPdfReport()
    {
        $user = (new User())->setUserGroups([33]);
        $token = JWTAuth::fromUser($user);

        $response = $this->postJson(
            '/api/export?token=' . (string) $token,
            ['exampleData' => 'random data']
        );

        $response
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/pdf');
    }

    public function testApplicationLogsUserInteractions()
    {
        $loggerMock = $this->getMockBuilder(AuthLoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $loggerMock->expects($this->once())
            ->method('warning');

        //Replace service in the service container with the mocked one
        app()->instance(AuthLoggerInterface::class, $loggerMock);

        // Try to login with user without correct user groups
        $user = (new User())->setUserGroups([44]);
        $token = JWTAuth::fromUser($user);

        $this->json(
            'GET',
            '/api/surveys?token=' . (string) $token
        );
    }

    protected function getSalariesFetchDuration(): float
    {
        $start = microtime(true);

        $this->em->getRepository(Salary::class)->findAll();

        return microtime(true) - $start;
    }
}
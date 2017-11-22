<?php

namespace Tests;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\App;
use Tests\Fixtures\SurveyFixture;

abstract class TestCase extends BaseTestCase
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var Loader
     */
    protected $loader;

    /**
     * @var ORMExecutor
     */
    protected $executor;

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        $this->em = App::make('Doctrine\ORM\EntityManagerInterface');
        $this->executor = new ORMExecutor($this->em, new ORMPurger());
        $this->loader = new Loader();

        return $app;
    }

    protected function setupFixtures()
    {
        $this->loader->addFixture(new SurveyFixture());

        $purger = new ORMPurger();
        $executor = new ORMExecutor($this->em, $purger);
        $executor->execute($this->loader->getFixtures());
    }
}

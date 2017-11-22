<?php

namespace Tests\Fixtures;


use App\Entities\Salary;
use App\Entities\Survey;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class SurveyFixture extends AbstractFixture
{
    /** @var Generator */
    protected $faker;

    /** @var Generator */
    protected $ruFaker;

    /** @var Generator */
    protected $ptFaker;

    /** @var ObjectManager */
    protected $manager;

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->faker = Factory::create();
        $this->ruFaker = Factory::create('ru_RU');
        $this->ptFaker = Factory::create('pt_PT');

        $this->generateSurveys();
        $manager->flush();
    }

    protected function generateSurveys()
    {
        for ($i = 0; $i < $this->faker->numberBetween($min = 4, $max = 8); $i++) {
            $year = $this->faker->year();

            $survey = (new Survey())
                ->setName($this->ptFaker->name . ' ' . $year)
                ->setNameEn($this->faker->name . ' ' . $year)
                ->setNameRu($this->ruFaker->name . ' ' . $year)
                ->setUpdatedAt($this->faker->dateTime)
                ->setCreatedAt($this->faker->dateTime);

            $this->manager->persist($survey);
            $this->generateSalaries($survey);
        }
    }

    protected function generateSalaries(Survey $survey)
    {
        for ($i = 0; $i < $this->faker->numberBetween($min = 50, $max = 500); $i++) {
            $this->manager->persist(
                (new Salary())
                    ->setSurvey($survey)
                    ->setAmount($this->faker->randomNumber(3))
                    ->setUpdatedAt($this->faker->dateTime)
                    ->setCreatedAt($this->faker->dateTime)
            );
        }
    }
}
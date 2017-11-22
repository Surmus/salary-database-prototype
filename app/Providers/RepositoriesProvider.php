<?php

namespace App\Providers;


use App\Entities\Salary;
use App\Entities\Survey;
use App\Repositories\SalaryRepository;
use App\Repositories\SalaryRepositoryInterface;
use App\Repositories\SurveyRepository;
use App\Repositories\SurveyRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesProvider extends ServiceProvider
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap any application services.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function boot(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SurveyRepositoryInterface::class, function () {
            return new SurveyRepository(
                $this->entityManager,
                $this->entityManager->getClassMetadata(Survey::class)
            );
        });

        $this->app->singleton(SalaryRepositoryInterface::class, function () {
            return new SalaryRepository(
                $this->entityManager,
                $this->entityManager->getClassMetadata(Salary::class)
            );
        });
    }

    public function provides()
    {
        return [
            SurveyRepositoryInterface::class,
            SalaryRepositoryInterface::class
        ];
    }
}

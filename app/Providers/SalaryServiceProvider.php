<?php

namespace App\Providers;


use App\Entities\Salary;
use App\Repositories\SalaryRepository;
use App\Repositories\SalaryRepositoryInterface;
use App\Services\SalaryService;
use App\Services\SalaryServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\ServiceProvider;

class SalaryServiceProvider extends ServiceProvider
{
    /**
     * @var SalaryRepositoryInterface
     */
    protected $repository;

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap any application services.
     *
     * @param SalaryRepositoryInterface $repository
     */
    public function boot(SalaryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SalaryServiceInterface::class, function () {
            return new SalaryService($this->repository);
        });
    }

    public function provides()
    {
        return [SalaryServiceInterface::class];
    }
}

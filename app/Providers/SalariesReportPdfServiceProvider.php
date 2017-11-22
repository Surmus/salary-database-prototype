<?php

namespace App\Providers;


use App\Entities\Salary;
use App\Repositories\SalaryRepository;
use App\Services\SalariesReportPdfService;
use App\Services\SalariesReportPdfServiceInterface;
use App\Services\SalaryService;
use App\Services\SalaryServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\ServiceProvider;

class SalariesReportPdfServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap any application services.
     */
    public function boot() {}

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SalariesReportPdfServiceInterface::class, function () {
            return new SalariesReportPdfService();
        });
    }

    public function provides()
    {
        return [SalariesReportPdfServiceInterface::class];
    }
}

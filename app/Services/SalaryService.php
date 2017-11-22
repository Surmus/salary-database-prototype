<?php

namespace App\Services;


use App\Entities\Survey;
use App\Repositories\SalaryRepository;
use App\Repositories\SalaryRepositoryInterface;

class SalaryService implements SalaryServiceInterface
{
    /** @var SalaryRepository */
    protected $repository;

    /**
     * SalaryService constructor.
     * @param SalaryRepositoryInterface $repository
     */
    public function __construct(SalaryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Fetch salaries average for given Survey
     *
     * @param Survey $survey
     * @return float
     */
    public function getSalariesAverageBySurvey(Survey $survey): float
    {
        return round($this->repository->getSurveySalariesAverageAmount($survey), 2);
    }
}
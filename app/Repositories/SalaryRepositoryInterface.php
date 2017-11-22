<?php

namespace App\Repositories;

use App\Entities\Salary;
use App\Entities\Survey;
use Doctrine\Common\Persistence\ObjectRepository;

interface SalaryRepositoryInterface extends ObjectRepository
{
    /**
     * get Survey salaries average
     *
     * @param Survey $survey
     * @return float
     */
    public function getSurveySalariesAverageAmount(Survey $survey);
}
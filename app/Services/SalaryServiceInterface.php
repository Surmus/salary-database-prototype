<?php

namespace App\Services;

use App\Entities\Survey;

interface SalaryServiceInterface
{
    /**
     * Fetch salaries average for given Survey
     *
     * @param Survey $survey
     * @return float
     */
    public function getSalariesAverageBySurvey(Survey $survey): float;
}
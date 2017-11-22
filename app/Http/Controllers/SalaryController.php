<?php

namespace App\Http\Controllers;


use App\Repositories\SurveyRepositoryInterface;
use App\Services\SalaryServiceInterface;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class SalaryController extends Controller
{
    public function __invoke(int $surveyId, SurveyRepositoryInterface $surveyRepository, SalaryServiceInterface $service)
    {
        if (! $survey = $surveyRepository->find($surveyId)) {
            return response('survey ' . $surveyId . ' does not exist', Response::HTTP_NOT_FOUND);
        }

        return [
            'salariesAverage' => $service->getSalariesAverageBySurvey($survey)
        ];
    }
}
<?php

namespace App\Http\Controllers;


use App\Entities\Survey;
use App\Repositories\SurveyRepositoryInterface;
use Illuminate\Routing\Controller;

class SurveyController extends Controller
{
    public function __invoke(SurveyRepositoryInterface $repository)
    {
        return array_map(
            function (Survey $survey) {
                return [
                    'id' => $survey->getId(),
                    'name' => $survey->getName(),
                    'nameRu' => $survey->getNameRu(),
                    'nameEn' => $survey->getNameEn()
                ];
            },
            $repository->findAll()
        );
    }
}
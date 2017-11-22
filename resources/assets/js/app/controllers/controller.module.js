import angular from 'angular';
import AngularTranslate from 'angular-translate';
import SurveyController from './survey.controller';
import MainController from './main.controller';
import ErrorController from './error.controller';
import SurveysAverageController from './surveys-average.controller';

const ControllerModule = angular.module('prototypeControllerModule', [AngularTranslate]);

ControllerModule.controller('SurveyCtrl', SurveyController);
ControllerModule.controller('MainCtrl', MainController);
ControllerModule.controller('ErrorCtrl', ErrorController);
ControllerModule.controller('SurveysAverageCtrl', SurveysAverageController);

ControllerModule.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider.when('/', {
            templateUrl: 'partials/main.html',
            controller: 'MainCtrl'
        });

        $routeProvider.when('/error', {
            templateUrl: 'partials/error.html',
            controller: 'ErrorCtrl'
        });

        $routeProvider.when('/survey', {
            templateUrl: 'partials/survey.html',
            controller: 'SurveyCtrl',
            resolve: {
                surveys: ['Survey', function (Survey) {
                    return Survey.query().$promise;
                }]
            }
        });

        $routeProvider.when('/surveys-average', {
            templateUrl: 'partials/surveys-average.html',
            controller: 'SurveysAverageCtrl',
            resolve: {
                surveysAverage: ['SurveysSalaries', function (SurveysSalaries) {
                    return SurveysSalaries.getSurveysSalaryAverages();
                }]
            }
        });
    }]
);

export default ControllerModule;
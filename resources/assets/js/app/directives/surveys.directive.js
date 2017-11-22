import langKeys from '../constants/lang-keys';

const SurveysDirective = [function () {
    return {
        restrict: "E",
        priority: 5000,
        templateUrl: "/partials/surveys.html",
        scope: {
            surveys: '<',
            selectedSurvey: '='
        },
        controller: ['$scope', '$translate', function ($scope, $translate) {
            switch ($translate.use()) {
                case langKeys.EN:
                    $scope.nameField = 'nameEn';
                    break;

                case langKeys.RU:
                    $scope.nameField = 'nameRu';
                    break;

                default:
                    $scope.nameField = 'name';
            }

            $scope.select = function (survey) {
                $scope.selectedSurvey = survey;
            };
        }]
    };
}];

export default SurveysDirective;
const SurveyController = ['$scope', 'surveys', 'Salary', 'Loader', function($scope, surveys, Salary, Loader) {
    $scope.selected = null;
    $scope.surveys = surveys;

    $scope.$watch('selected', function () {
        if (!$scope.selected) {
            return;
        }

        Loader.addLoader();
        Salary.get({ survey: $scope.selected.id }).$promise.then(function (response) {
           $scope.average = response.salariesAverage;
        }).finally(function () {
            Loader.removeLoader();
        });
    });
}];

export default SurveyController;
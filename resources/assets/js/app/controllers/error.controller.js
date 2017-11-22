const ErrorController = ['$scope', '$location', function($scope, $location) {
    $scope.error = $location.search()['error'];
}];

export default ErrorController;
const SalaryService = ['$resource',
    function($resource){
        return $resource('/api/survey/:survey/salaries');
    }];

export default SalaryService;
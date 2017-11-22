const SurveyService = ['$resource',
    function($resource){
        return $resource('/api/surveys');
    }];

export default SurveyService;
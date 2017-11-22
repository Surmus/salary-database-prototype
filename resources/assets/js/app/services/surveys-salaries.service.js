import langKeys from '../constants/lang-keys';

const SurveysSalariesService = ['Survey', 'Salary', '$q', '$translate',
    function(Survey, Salary, $q, $translate) {
        let salariesQueries = null;
        let results = null;

        function getData() {
            salariesQueries = [];
            results = [];

            return $q(function (resolve) {
                Survey.query().$promise.then(function (response) {
                    response.forEach(function (survey) {
                        salariesQueries.push(
                            Salary.get({ survey: survey.id }).$promise.then(function (response) {
                                switch ($translate.use()) {
                                    case langKeys.EN:
                                        results.push({
                                            name: survey['nameEn'],
                                            average: response['salariesAverage']
                                        });
                                        break;

                                    case langKeys.RU:
                                        results.push({
                                            name: survey['nameRu'],
                                            average: response['salariesAverage']
                                        });
                                        break;

                                    default:
                                        results.push({
                                            name: survey['name'],
                                            average: response['salariesAverage']
                                        });
                                        break;
                                }
                            })
                        )
                    });

                    resolve();
                })
            });
        }

        return {
            getSurveysSalaryAverages: function () {
                return $q(function (resolve) {
                    getData().then(function () {
                        $q.all(salariesQueries).finally(function () {
                            resolve(results);
                        })
                    })
                });
            }
        };
    }];

export default SurveysSalariesService;
const HttpInterceptor = ['$q', '$log', '$location',
    function($q, $log, $location) {
        return {
            /**
             * When an ajax request fails, divert the app to error page
             *
             * @param response
             * @returns {Promise}
             */
            'responseError': function (response) {
                $location.url('/error?error=' + response.data.error);

                return $q.reject(response);
            },

            'request': function(config) {
                //config.params contains query/request parameters
                if (config.params){
                    //Do something here...
                }
                return config;
            }
        }
    }];

export default HttpInterceptor;
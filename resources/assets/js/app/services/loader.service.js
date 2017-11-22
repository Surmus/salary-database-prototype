const LoaderService = ['$rootElement', '$rootScope', '$compile',
    function ($rootElement, $rootScope, $compile) {
        let loader = null;
        let loaderRequests = 0;

        return {
            addLoader: function () {
                loaderRequests++;

                //Already active, do not add new
                if (loaderRequests > 1) {
                    return;
                }

                loader = $compile('<loader></loader>')($rootScope);

                $rootElement.append(loader);
            },
            removeLoader: function () {
                loaderRequests--;

                //Remove local loader
                if (!loaderRequests) {
                    loader.remove();
                }
            }
        }
    }];

export default LoaderService;
import angular from 'angular';
import ngRoute from 'angular-route'
import ngAnimate from 'angular-animate'
import ngSanitize from 'angular-sanitize'

import AngularTranslate from 'angular-translate';
import AngularStaticFilesLoader from 'angular-translate-loader-static-files';

import ServiceModule from './services/service.module';
import ProviderModule from './providers/provider.module';
import ControllerModule from './controllers/controller.module';
import DirectiveModule from './directives/directive.module';

const App = angular.module('prototype', [
    ngRoute,
    ngAnimate,
    ngSanitize,
    ProviderModule.name,
    ControllerModule.name,
    DirectiveModule.name,
    ServiceModule.name,
    AngularTranslate,
    AngularStaticFilesLoader
])
    .config([
        '$routeProvider',
        '$locationProvider',
        '$httpProvider',
        '$translateProvider',
        '$animateProvider',
        function ($routeProvider, $locationProvider, $httpProvider, $translateProvider, $animateProvider) {
            //Disable animations for certain classes
            $animateProvider.classNameFilter(/^(?:(?!ng-animate-disabled).)*$/);

            //Configure translations service
            $translateProvider.useStaticFilesLoader({
                prefix: 'translations/locale-',
                suffix: '.json'
            });
            $translateProvider.useSanitizeValueStrategy('sanitizeParameters');

            //Add error handler to Ajax calls
            $httpProvider.interceptors.push('HttpInterceptor');

            // use the HTML5 History API
            $locationProvider.html5Mode(true);
        }])

    .run(['$log', '$rootScope', '$http', '$translate', '$location', 'Loader',
        function($log, $rootScope, $http, $translate, $location, Loader) {
            // Fetch params from entry URL for auth and current lang
            let userActiveLanguage = $location.search()['lang'];
            let userToken = $location.search()['token'];

            //Add remove loader when changing route
            $rootScope.$on('$routeChangeStart', function (e, next) {
                if (next.$$route) { //Add loader only when next route exists
                    Loader.addLoader();
                }
            });
            $rootScope.$on('$routeChangeSuccess', function () {
                Loader.removeLoader();
            });
            $rootScope.$on('$routeChangeError', function () {
                Loader.removeLoader();
            });

            //Set active locale, if provided
            if (userActiveLanguage) {
                $translate.use(userActiveLanguage);
            } else {
                //Default locale
                $translate.use('en');
            }

            // Token is required!
            if (!userToken) {
                return $location.url('/error?error=Missing token');
            }

            //Set custom http headers when doing request against the backend
            $http.defaults.headers.common['Authorization'] = 'Bearer ' + userToken;
        }
    ]);

export default App;
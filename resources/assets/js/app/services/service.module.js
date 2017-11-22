import angular from 'angular';
import ngResource from 'angular-resource';
import AngularTranslate from 'angular-translate';
import HttpInterceptor from './http-interceptor.service';
import SurveyService from './survey.service';
import SalaryService from './salary.service';
import SurveysSalariesService from  './surveys-salaries.service';
import LoaderService from './loader.service';

const ServiceModule = angular.module('prototypeServiceModule', [ngResource, AngularTranslate]);

ServiceModule.factory('HttpInterceptor', HttpInterceptor);
ServiceModule.factory('Survey', SurveyService);
ServiceModule.factory('Salary', SalaryService);
ServiceModule.factory('SurveysSalaries', SurveysSalariesService);
ServiceModule.factory('Loader', LoaderService);

export default ServiceModule;
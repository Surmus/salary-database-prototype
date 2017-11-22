import angular from 'angular';
import AngularTranslate from 'angular-translate';
import LoaderDirective from './loader.directive';

import SurveyDirective from './surveys.directive';
import ChartDirective from './chart.directive';

const DirectiveModule = angular.module('directiveModule', [AngularTranslate]);

DirectiveModule.directive('surveys', SurveyDirective);
DirectiveModule.directive('chart', ChartDirective);
DirectiveModule.directive('loader', LoaderDirective);

export default DirectiveModule;
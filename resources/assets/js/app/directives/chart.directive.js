import 'amcharts3/amcharts/amcharts';
import 'amcharts3/amcharts/serial';
import angular from 'angular';

const ChartDirective = ['$document', function ($document) {
    let windowWidth = angular.element($document).width();

    return {
        restrict: "E",
        template: '<div id="chart"></div>',
        scope: {
            data: '<'
        },
        controller: ['$scope', function ($scope) {
            AmCharts.makeChart("chart", {
                "type": "serial",
                "theme": "light",
                "dataProvider": $scope.data,
                "valueAxes": [{
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0
                }],
                "gridAboveGraphs": true,
                "startDuration": 1,
                "graphs": [{
                    "balloonText": "[[category]]: <b>[[value]]</b>",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "average"
                }],
                "chartCursor": {
                    "categoryBalloonEnabled": false,
                    "cursorAlpha": 0,
                    "zoomable": false
                },
                "categoryField": "name",
                "categoryAxis": {
                    "color": windowWidth <= 767 ? 'transparent' : '#000000', // Hide category labels when mobile device
                    "gridPosition": "start",
                    "gridAlpha": 0,
                    "tickPosition": "start",
                    "tickLength": 20
                },
                "export": {
                    "enabled": true
                }
            } );
        }]
    };
}];

export default ChartDirective;
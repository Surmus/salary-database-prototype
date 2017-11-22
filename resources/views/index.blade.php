<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <base href="/">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400&subset=latin,cyrillic" rel='stylesheet' type='text/css' />
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css"/>
        <script src="js/manifest.js"></script>
        <script src="js/vendor.js"></script>
    </head>
    <body ng-app="prototype">
    <div class="view-container">
        <div ng-view class="view-frame"></div>
    </div>
    <script src="js/app.js"></script>
    </body>
</html>

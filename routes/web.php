<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Return always angular app, when not requesting api urls
Route::any('{catchall}', function () {
    return view('index');
})->where('catchall', '(.*)');
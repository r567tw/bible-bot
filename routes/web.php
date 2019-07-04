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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/webhook','WebhookController@index');

Route::get('test',function(){
    $http = new \GuzzleHttp\Client;
    $url = 'https://www.taiwanbible.com/blog/dailyverse.jsp';
    $response = $http->get($url);
    $result = json_decode($response->getBody()->getContents(), true);
    // return $result;
    $text = (string) $response->getBody();
    var_dump($text);
    //throw new \Exception('a8');
});

<?php

// Web

$app->get('/', ['middleware' => 'auth', 'as' => 'home', function () use ($app) {
    return view('home');
}]);

// Auth

$app->get('/auth/login', ['middleware' => 'guest', 'as' => 'login', 'uses' => 'AuthController@getLogin']);
$app->post('/auth/login', 'AuthController@postLogin');

$app->get('/auth/logout', ['middleware' => 'auth', 'as' => 'logout', 'uses' => 'AuthController@getLogout']);
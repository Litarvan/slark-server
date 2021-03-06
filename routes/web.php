<?php

/*
 * Copyright 2014-2017 Adrien 'Litarvan' Navratil
 *
 * This file is part of Slark.

 * Slark is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Slark is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with Slark.  If not, see <http://www.gnu.org/licenses/>.
 */

// Redirect

$app->get('/', function () use ($app) {
    \Log::info(path('login'));
   return redirect(path('login'));
});

// Auth

$app->get('/auth/login', ['middleware' => 'guest', 'as' => 'login', 'uses' => 'AuthController@getLogin']);
$app->post('/auth/login', 'AuthController@postLogin');

$app->get('/auth/logout', ['middleware' => 'auth', 'as' => 'logout', 'uses' => 'AuthController@getLogout']);

// Admin

$app->group(['prefix' => 'admin', 'middleware' => 'auth'], function () use ($app) {
    $app->get('/', ['as' => 'home', function () use ($app) {
        return view('home');
    }]);

    $app->get('/whitelist', ['as' => 'whitelist', 'uses' => 'WhitelistController@getWhitelist']);
    $app->post('/whitelist', 'WhitelistController@postWhitelist');
    $app->delete('/whitelist', 'WhitelistController@deleteWhitelist');
});
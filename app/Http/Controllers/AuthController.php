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

namespace Slark\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    function getLogin()
    {
        return view('login');
    }

    function postLogin(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

        if ($password != null && $email == config('auth.email') && hash_equals(crypt($password, env('APP_KEY')), config('auth.password')))
        {
            $_SESSION['auth'] = true;
            return redirect(path('home'));
        }

        return view('login', [
           'error' => true
        ]);
    }

    function getLogout()
    {
        $_SESSION['auth'] = false;
        return redirect(path('login'));
    }
}
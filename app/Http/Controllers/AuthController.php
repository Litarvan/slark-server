<?php

namespace App\Http\Controllers;

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
            return redirect(route('home'));
        }

        return view('login', [
           'error' => true
        ]);
    }

    function getLogout()
    {
        $_SESSION['auth'] = false;
        return redirect(route('login'));
    }
}
{{--
    Copyright 2014-2017 Adrien 'Litarvan' Navratil

    This file is part of Slark.

    Slark is free software: you can redistribute it and/or modify
    it under the terms of the GNU Lesser General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Slark is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Lesser General Public License for more details.

    You should have received a copy of the GNU Lesser General Public License
    along with Slark.  If not, see <http://www.gnu.org/licenses/>.
--}}

@extends('layout')

@section('title', 'Se connecter')
@section('css', asset('assets/css/login.css'))

@section('body')

    <div class="row">
        <div id="left-block" class="col s12 m6">
            <div id="left-content">
                <img id="slark" src="{{ asset('/assets/images/logo-full.png') }}" />

                <h3>Bienvenue sur Slark !</h3>

                <p>
                    Ici se trouve le serveur de mise à jour de <b>{{ config('app.title') }}</b>. <br/><br/>

                    Cet espace est reservé aux administrateurs de {{ config('app.title') }}, merci donc de vous connecter en utilisant le formulaire ci dessous.<br/><br />

                    {{ config('app.title') }} utilise <a href="https://github.com/Litarvan/Slark">Slark</a>, un système de mise à jour libre, simple, et léger.
                </p>
            </div>
        </div>

        <div id="right-block" class="col s12 m6">
            <div id="right-container">
                <div id="right-content">
                    <h2>Se connecter</h2>

                    <form method="POST">
                        <input type="text" name="email" placeholder="E-Mail"/>
                        <input type="password" name="password" placeholder="Mot de passe" />

                        @if (isset($error) && $error)
                            <span id="error">Mauvais E-Mail et/ou Mot de passe</span><br />
                        @endif

                        <button id="login" class="btn">Se connecter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
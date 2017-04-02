@extends('layout')

@section('title', 'Se connecter')
@section('css', asset('assets/css/login.css'))

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
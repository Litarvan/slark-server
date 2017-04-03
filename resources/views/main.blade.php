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

@section('body')
    <div class="row">
        <div class="col s4 m3 l2" id="nav">
            <img id="logo" src="{{ asset('assets/images/logo-full.png') }}" />

            <nav>
                <ul>
                    <?php
                        $request = \Illuminate\Http\Request::capture();
                        $route = app()->getRoutes()[$request->getMethod() . $request->getPathInfo()]['action']['as'];
                    ?>

                    <li @if ($route == 'home') class="active" @endif><a class="waves-effect waves-light" href="{{ path('home') }}"><i class="fa fa-home"></i> Accueil</a></li>
                    <li @if ($route == 'files') class="active" @endif><a class="waves-effect waves-light"><i class="fa fa-files-o"></i> Fichiers</a></li>
                    <li @if ($route == 'whitelist') class="active" @endif><a class="waves-effect waves-light" href="{{ path('whitelist') }}"><i class="fa fa-list"></i> Whitelist</a></li>
                    <li @if ($route == 'stats') class="active" @endif><a class="waves-effect waves-light"><i class="fa fa-area-chart"></i> Statistiques</a></li>
                    <li @if ($route == 'settings') class="active" @endif><a class="waves-effect waves-light"><i class="fa fa-cogs"></i> Paramètres</a></li>
                    <li @if ($route == 'about') class="active" @endif><a class="waves-effect waves-light"><i class="fa fa-question-circle"></i> À propos</a></li>

                    <li id="logout" class="col s4 m3 l2"><a class="waves-effect waves-light" href="{{ path('logout') }}"><i class="fa fa-sign-out"></i> Se déconnecter</a></li>
                </ul>
            </nav>
        </div>

        <div class="col s8 offset-s4 offset-m3 m9 offset-l2 l10" id="content">
            @yield('content')
        </div>
    </div>
@endsection
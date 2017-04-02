@extends('layout')

@section('body')
    <div class="row">
        <div class="col s4 m3 l2" id="nav">
            <img id="logo" src="{{ asset('assets/images/logo-full.png') }}" />

            <nav>
                <ul>
                    <li><a class="waves-effect waves-light"><i class="fa fa-home"></i> Accueil</a></li>
                    <li><a class="waves-effect waves-light"><i class="fa fa-files-o"></i> Fichiers</a></li>
                    <li><a class="waves-effect waves-light"><i class="fa fa-list"></i> Whitelist</a></li>
                    <li><a class="waves-effect waves-light"><i class="fa fa-area-chart"></i> Statistiques</a></li>
                    <li><a class="waves-effect waves-light"><i class="fa fa-cogs"></i> Paramètres</a></li>

                    <li id="logout" class="col s4 m3 l2"><a class="waves-effect waves-light" href="{{ path('logout') }}"><i class="fa fa-sign-out"></i> Se déconnecter</a></li>
                </ul>
            </nav>
        </div>

        <div class="col s8 m9 l10" id="content">
            @yield('content')
        </div>
    </div>
@endsection
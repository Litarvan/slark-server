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

@extends('main')

@section('title', 'Whitelist')
@section('css', asset('assets/css/whitelist.css'))

@section('content')
    <script>
        window.nextId = {{ count($files) }};
    </script>

    <div id="container">
        <div id="whitelist" class="collection with-header">
            <div class="collection-header"><h4>Whitelist</h4></div>

            <div id="list">
                @foreach($files as $id => $entry)
                    <a class="waves-effect collection-item" id="file-{{ $id }}" onclick="deleteDialog({{ $id }}, '{{ $entry['value'] }}')"><i class="fa @if($entry['type'] == 'folder') fa-folder @elseif($entry['type'] == 'glob') fa-files-o @else fa-file @endif"></i> {{ $entry['value'] }}</a>
                @endforeach
            </div>

            <div id="addModal" class="modal bottom-sheet">
                <div class="modal-content">
                    <h4>Ajouter une entrée</h4>
                    <input id="value" type="text" placeholder="Valeur" />
                </div>
                <div class="modal-footer">
                    <a id="a-trigger" class="modal-action waves-effect btn-flat" onclick="addEntry()">Ajouter</a>
                    <a id="a-no" class="modal-action modal-close waves-effect btn-flat">Annuler</a>
                </div>
            </div>

            <div id="deleteModal" class="modal bottom-sheet">
                <div class="modal-content">
                    <h4>Supprimer cette entrée</h4>
                    <p>Voulez vous supprimer l'éntrée '<b id="file"></b>' de la Whitelist ?</p>
                </div>
                <div class="modal-footer">
                    <a id="d-no" class="modal-action modal-close waves-effect btn-flat">Non</a>
                    <a id="d-trigger" class="modal-action waves-effect btn-flat">Oui</a>
                </div>
            </div>
        </div>

        <a class="btn waves-effect waves-light" onclick="addDialog()">Ajouter une entrée</a>
    </div>

    <div id="buffer">
        <div class="preloader-wrapper active">
            <div class="spinner-layer">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/js/whitelist.js') }}"></script>
@endsection
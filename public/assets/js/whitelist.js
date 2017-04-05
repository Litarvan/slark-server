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

var storage = window.localStorage;

var dialog = false;

var elDTrigger = $('#d-trigger');
var elValue = $('#value');
var elAddModal = $('#addModal');
var elBuffer = $('#buffer');
var elFile = $('#file');
var elDeleteModal = $('#deleteModal');
var elANo = $('#a-no');
var elATrigger = $('#a-trigger');
var elList = $('#list');
var elDNo = $('#d-no');

$(document).ready(function()
{
    $('.modal').modal({
        complete: function()
        {
            dialog = false;
        }
    });

    if (!storage.getItem('slark.whitelist.help'))
    {
        openHelp();
    }
});

$('body').on('keydown', function(e)
{
   if (e.which === 13)
   {
       e.preventDefault();

       if (dialog)
       {
           eval(elDTrigger.attr('onclick'));
       }
       else
       {
           addDialog();
       }
   }
});

elValue.on('keydown', function(e)
{
    if (e.which === 13)
    {
        e.preventDefault();
        addEntry();
    }
});

function addDialog()
{
    elAddModal.modal('open');
    elValue.focus();
}

function deleteDialog(id, file)
{
    dialog = true;

    elFile.html(file);
    elDTrigger.attr('onclick', 'deleteEntry(' + id + ', "' + file + '")');

    elDeleteModal.modal('open');
}

function addEntry()
{
    var input = elValue;
    var value = input.val();

    if (value === '')
    {
        return;
    }

    elANo.css('display', 'none');
    $(elATrigger.html(elBuffer.html())).attr('onclick', '');
    input.attr('readonly', '');

    $.ajax(window.location.href, {
        method: 'POST',
        data: {
            value: value
        }
    }).done(function() {
        elANo.css('display', 'inherit');
        elATrigger.html('Valider').attr('onclick', 'addEntry()');
        elAddModal.modal('close');
        input.removeAttr('readonly');
        input.val('');

        var id = window.nextId;
        elList.append('<a class="waves-effect collection-item" id="file-' + id + '" onclick="deleteDialog(' + id + ', \'' + value + '\')"><i class="fa ' + (value.endsWith('/') ? 'fa-folder' : (value.match(/\*/g) || value.match(/\?/g) ? 'fa-files-o' : 'fa-file')) + '"></i> ' + value + '</a>');

        window.nextId++;
    });
}

function deleteEntry(id, file)
{
    elDNo.css('display', 'none');
    elDTrigger.html(elBuffer.html()).attr('onclick', '');

    $.ajax(window.location.href, {
        method: 'DELETE',
        data: {
            file: file
        }
    }).done(function() {
        elDNo.css('display', 'inherit');
        $("#file-" + id).remove();
        elDTrigger.html("Oui");

        elDeleteModal.modal('close');
    });
}

function openHelp()
{
    $('#helpModal').modal('open');
}

function helpClosed()
{
    storage.setItem('slark.whitelist.help', true);
}
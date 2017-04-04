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

var dialog = false;

$(document).ready(function()
{
    $('.modal').modal({
        complete: function()
        {
            dialog = false;
        }
    });
});

$('body').on('keydown', function(e)
{
   if (e.which === 13)
   {
       e.preventDefault();

       if (dialog)
       {
           eval($("#d-trigger").attr('onclick'));
       }
       else
       {
           addDialog();
       }
   }
});

$('#value').on('keydown', function(e)
{
    if (e.which === 13)
    {
        e.preventDefault();
        addEntry();
    }
});

function addDialog()
{
    $("#addModal").modal('open');
    $('#value').focus();
}

function deleteDialog(id, file)
{
    dialog = true;

    $("#file").html(file);
    $("#d-trigger").attr('onclick', 'deleteEntry(' + id + ', "' + file + '")');

    $('#deleteModal').modal('open');
}

function addEntry()
{
    var input = $("#value");
    var value = input.val();

    if (value === '')
    {
        return;
    }

    $("#a-no").css('display', 'none');
    $("#a-trigger").html($("#buffer").html()).attr('onclick', '');
    input.attr('readonly', '');

    $.ajax(window.location.href, {
        method: 'POST',
        data: {
            value: value
        }
    }).done(function() {
        $("#a-no").css('display', 'inherit');
        $("#a-trigger").html("Oui").attr('onclick', 'addEntry()');
        $("#addModal").modal('close');
        input.removeAttr('readonly');
        input.val('');

        var id = window.nextId;
        $("#list").append('<a class="waves-effect collection-item" id="file-' + id + '" onclick="deleteDialog(' + id + ', \'' + value + '\')"><i class="fa ' + (value.endsWith('/') ? 'fa-folder' : (value.match(/\*/g) || value.match(/\?/g) ? 'fa-files-o' : 'fa-file')) + '"></i> ' + value + '</a>');

        window.nextId++;
    });
}

function deleteEntry(id, file)
{
    $("#d-no").css('display', 'none');
    $("#d-trigger").html($("#buffer").html()).attr('onclick', '');

    $.ajax(window.location.href, {
        method: 'DELETE',
        data: {
            file: file
        }
    }).done(function() {
        $("#d-no").css('display', 'inherit');
        $("#file-" + id).remove();
        $("#d-trigger").html("Oui");

        $("#deleteModal").modal('close');
    });
}
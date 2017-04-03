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

class WhitelistController
{
    use APIController;

    private $file;

    public function __construct()
    {
        $this->file = app()->basePath() . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'whitelist.json';
    }

    public function getWhitelist()
    {
        $files = json_decode(file_get_contents($this->file));
        $fs = [];

        foreach ($files as $file)
        {
            $fs[] = [
                'value' => $file,
                'type' => ends_with($file, '/') ? 'folder' : (str_contains($file, '*') || str_contains($file, '?') ? 'glob' : 'file')
            ];
        }

        return view('whitelist', [
            'files' => $fs
        ]);
    }

    public function postWhitelist(Request $request)
    {
        if ($request->has('value'))
        {
            $files = json_decode(file_get_contents($this->file));
            $files[] = $request->get('value');

            sleep(1);

            file_put_contents($this->file, json_encode($files, JSON_PRETTY_PRINT));
        }
    }

    public function deleteWhitelist(Request $request)
    {
        if ($request->has('file'))
        {
            $files = json_decode(file_get_contents($this->file));
            $file = $request->get('file');

            foreach ($files as $id => $f)
            {
                if ($f == $file)
                {
                    array_splice($files, $id, 1);
                    break;
                }
            }

            sleep(1);

            file_put_contents($this->file, json_encode($files, JSON_PRETTY_PRINT));
        }
    }

    public function apiWhitelist()
    {
        return $this->json(file_get_contents($this->file));
    }
}
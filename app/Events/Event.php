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

namespace Slark\Events;

use Illuminate\Queue\SerializesModels;

/**
 * An Event
 *
 *
 * An Event is an object that can be triggered at any time
 * during runtime, that is caught by Listeners (see namespace
 * Slark\Listeners).
 *
 * @package Slark\Events
 * @author Litarvan
 * @version 4.0.0
 */
abstract class Event
{
    use SerializesModels;
}

<?php

return [
    'email' => 'test@test.test',
    'password' => crypt('test', env('APP_KEY'))
];
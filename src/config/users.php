<?php

/*
|--------------------------------------------------------------------------
| Users
|--------------------------------------------------------------------------
|
| Array of users keyed by identifier
|
*/

return array(
    'admin' => array(
        'username' => 'admin',
        'password' => Hash::make('very_secret'),
        'mail' => 'admin@example.com',
    ),
    'user' => array(
        'username' => 'user',
        'password' => Hash::make('secret'),
        'mail' => 'user@example.com',
    ),
);

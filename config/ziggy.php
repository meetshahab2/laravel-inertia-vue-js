<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Only Named Routes
    |--------------------------------------------------------------------------
    |
    | By default, Ziggy exports all of your application's named routes.
    | You can choose to only include certain routes by defining groups below.
    |
    */

    'only' => null,

    'except' => null,

    'groups' => [
        'web',
        'admin', // ✅ include admin prefixed routes
    ],

];

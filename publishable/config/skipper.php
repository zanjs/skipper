<?php

return [

    /*
    |--------------------------------------------------------------------------
    | User config
    |--------------------------------------------------------------------------
    |
    | Here you can specify skipper user configs
    |
    */

    'user' => [
        'add_default_role_on_register' => true,
        'default_role'                 => 'user',
        'namespace'                    => App\User::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Routes config
    |--------------------------------------------------------------------------
    |
    | Here you can specify skipper route settings
    |
    */

    'routes' => [
        'prefix' => 'admin',
    ],

    /*
    |--------------------------------------------------------------------------
    | Controllers config
    |--------------------------------------------------------------------------
    |
    | Here you can specify skipper controller settings
    |
    */
    'controllers' => [
        'namespace' => 'Anla\\Skipper\\Http\\Controllers',
    ],

    /*
    |--------------------------------------------------------------------------
    | Path to the Skipper Assets
    |--------------------------------------------------------------------------
    |
    | Here you can specify the location of the skipper assets path
    |
    */

    'assets_path' => '/vendor/anla/skipper/assets',

    /*
    |--------------------------------------------------------------------------
    | Storage Config
    |--------------------------------------------------------------------------
    |
    | Here you can specify attributes related to your application file system
    |
    */

    'storage' => [
        'subfolder' => 'public/', // include trailing slash, like 'my_folder/'
    ],

];

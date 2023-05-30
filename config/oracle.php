<?php

return [
    'oracle' => [
        'driver'         => 'oracle',
        'tns'            => env('DB_TNS', ''),
        'host'           => env('DB_HOST', ''),
        'port'           => env('DB_PORT', '1521'),
        'database'       => env('DB_DATABASE', ''),
        'service_name'   => env('DB_SERVICE_NAME', ''),
        'username'       => env('DB_USERNAME', ''),
        'password'       => env('DB_PASSWORD', ''),
        'charset'        => env('DB_CHARSET', 'AL32UTF8'),
        'prefix'         => env('DB_PREFIX', ''),
        'prefix_schema'  => env('DB_SCHEMA_PREFIX', ''),
        'edition'        => env('DB_EDITION', 'ora$base'),
        'server_version' => env('DB_SERVER_VERSION', '11g'),
        'load_balance'   => env('DB_LOAD_BALANCE', 'yes'),
        'dynamic'        => [],
    ],
    'oracleexterna' => [
        'driver'         => 'oracle',
        'tns'            => env('DB_TNS_EXTERNA', ''),
        'host'           => env('DB_HOST_EXTERNA', ''),
        'port'           => env('DB_PORT_EXTERNA', '1521'),
        'database'       => env('DB_DATABASE_EXTERNA', ''),
        'service_name'   => env('DB_SERVICE_NAME_EXTERNA', ''),
        'username'       => env('DB_USERNAME_EXTERNA', ''),
        'password'       => env('DB_PASSWORD_EXTERNA', ''),
        'charset'        => env('DB_CHARSET_EXTERNA', 'AL32UTF8'),
        'prefix'         => env('DB_PREFIX_EXTERNA', ''),
        'prefix_schema'  => env('DB_SCHEMA_PREFIX_EXTERNA', ''),
        'edition'        => env('DB_EDITION_EXTERNA', 'ora$base'),
        'server_version' => env('DB_SERVER_VERSION_EXTERNA', '11g'),
        'load_balance'   => env('DB_LOAD_BALANCE_EXTERNA', 'yes'),
        'dynamic'        => [],
    ],
];

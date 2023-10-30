<?php
$env = [
    'APP_NAME' => 'Lumi Laravel Boilerplate',
    'APP_ENV' => 'local',
    'APP_KEY' => '',
    'APP_DEBUG' => true,

    'LOG_CHANNEL' => 'stack',

    'DB_CONNECTION' => 'mysql',
    'DB_HOST' => '127.0.0.1',
    'DB_PORT' => '3306',
    'DB_DATABASE' => 'lumi-laravel-boilerplate',
    'DB_USERNAME' => 'root',
    'DB_PASSWORD' => '',

    'CACHE_DRIVER' => 'file',
    'QUEUE_CONNECTION' => 'sync',

    'JWT_INPUT' => 'jwt_token',
    'JWT_SECRET' => '',

    'FRONT_URL' => 'http://lumi-vue-boilerplate',
    'BACK_URL' => 'http://lumi-laravel-boilerplate',
    'UPLOADS_URL' => 'http://lumi-laravel-boilerplate/uploads',
    'UPLOADS_PATH' => '/public/uploads',

    'MAIL_DRIVER' => 'log',
    'MAIL_FROM_ADDRESS' => 'robert@radiantabyss.com',
    'MAIL_FROM_NAME' => 'Robert',

    'MAILGUN_DOMAIN' => '',
    'MAILGUN_SECRET' => '',
    'MAILGUN_ENDPOINT' => '',
];

foreach ( $env as $key => $value ) {
    $_ENV[$key] = $value;
    putenv($key.'='.$value);
}

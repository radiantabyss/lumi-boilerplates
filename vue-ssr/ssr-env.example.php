<?php
$env = [
    'APP_NAME' => 'Lumi Vue Boilerplate SSR',
    'APP_ENV' => 'local',
    'APP_URL' => 'http://lumi-vue-boilerplate',
    'APP_KEY' => 'base64:q7cSnJgjvzwsWajyaj5CDWiL0imb1iwkHbt94KhepBU=',
    'APP_DEBUG' => true,

    'LOG_CHANNEL' => 'stack',

    'APP_CSS' => '',
    'APP_JS' => '',
    'VENDORS_JS' => '',
    'BACK_URL' => '',
    'UPLOADS_URL' => '',

    'GTAG_ID' => '',
];

foreach ( $env as $key => $value ) {
    $_ENV[$key] = $value;
    putenv($key.'='.$value);
}

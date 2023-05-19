<?php


return [
    'manifest' => '',
    'name' => env('APP_NAME', 'PWA'),
    'short_name' => env('PWA_SHORT_NAME', null),
    'start_url' => '/',
    'background_color' => '#ffffff',
    'theme_color' => '#000000',
    'display' => 'standalone',
    'orientation' => 'portrait',
    'status_bar' => 'black',
    'theme_color' => '',
    'display' => 'standalone',
    'icons' => [
        '72x72' => [
            'path' => '/static/pwa/android-launchericon-72-72.png',
            'purpose' => 'any'
        ],
        '96x96' => [
            'path' => '/static/pwa/android-launchericon-96-96.png',
            'purpose' => 'any'
        ],
        '144x144' => [
            'path' => '/static/pwa/android-launchericon-144-144.png',
            'purpose' => 'any'
        ],
        '152x152' => [
            'path' => '/static/pwa/android-launchericon-152-152.png',
            'purpose' => 'any'
        ],
        '192x192' => [
            'path' => '/static/pwa/android-launchericon-192-192.png',
            'purpose' => 'any'
        ]
    ],
];
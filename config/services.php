<?php

return [
    'authors' => [
        'base_uri' => env('AUTHORS_SERVICE_BASE_URI'),
        'secret' => env('AUTHORS_SERVICE_SECRET')
    ],
    'books' => [
        'base_uri' => env('BOOKS_SERVICE_BASE_URI'),
        'secret' => env('BOOKS_SERVICE_SECRET')
    ],
    'facebook' => [
        'client_id' => env('FACEBOOK_APP_ID'),
        'client_secret' => env('FACEBOOK_APP_SECRET'),
        'redirect' => env('FACEBOOK_URI_REDIRECT'),
    ],
    'github' => [
        'client_id' => env('GITHUB_APP_ID'),
        'client_secret' => env('GITHUB_APP_SECRET'),
        'redirect' => env('GITHUB_URI_REDIRECT'),
    ]
];

<?php

return [
    'facebook' => [
        'client_id' => env('FACEBOOK_APP_ID'),
        'client_secret' => env('FACEBOOK_APP_SECRET'),
        'redirect' => env('FACEBOOK_URI_REDIRECT'),
    ],
    'google' => [
        'redirect' => env('GOOGLE_URI_REDIRECT')
    ]
];

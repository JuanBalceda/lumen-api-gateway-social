<?php

return [
    'authors' => [
        'baseUri' => env('AUTHORS_SERVICE_BASE_URI'),
        'secret' => env('AUTHORS_SERVICE_SECRET')
    ],
    'books' => [
        'baseUri' => env('BOOKS_SERVICE_BASE_URI'),
        'secret' => env('BOOKS_SERVICE_SECRET')
    ]
];

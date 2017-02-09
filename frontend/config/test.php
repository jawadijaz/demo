<?php
return [
    'id' => 'app-frontend-tests',
    'components' => [
        'assetManager' => [
            'basePath' =>__DIR__ . '/../assets',
        ],
        'db' => [
            'dsn' => 'mysql:host=localhost;port=3305;dbname=demo',
        ]
    ],
];

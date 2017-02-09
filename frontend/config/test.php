<?php
return [
    'id' => 'app-frontend-tests',
    'basePath' => dirname(__DIR__),
    'components' => [
        'assetManager' => [
            'basePath' =>__DIR__ . '/../assets',
        ],
        'db' => [
        	'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;port=3305;dbname=demo',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ]
    ],
];

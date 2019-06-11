<?php

return [
    'name' => 'Licencing APP',
    'defaultController' => 'index',
    'defaultAction' => 'index',
    'components' => [
        'db' => [
            'class' => 'app\components\PDOConnection',
            'dsn' => 'mysql:host=localhost;dbname=licence',
            'username' => 'root',
            'password' => '',
        ],
    ]
];

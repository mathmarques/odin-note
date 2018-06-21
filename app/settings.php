<?php
return [
    'settings' => [
        // Slim settings
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => true,
    ],

    // Doctrine
    'doctrine' => [
        'model' => __DIR__ . '/src/Model',
        'cache_proxy' => __DIR__ . '/../cache/doctrine',
    ],

    // DB Conection
    'db' => [
        'driver' => 'pdo_mysql',
        'user' => 'root',
        'password' => 'root',
        'dbname' => 'gameficacao',
        'host' => 'localhost:3306'
    ],
];

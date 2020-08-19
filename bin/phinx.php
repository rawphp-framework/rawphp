<?php

# Load composer
require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../bootstrap/app.php';

$config = $container['settings']['db'];

return [
    'paths' => [
        'migrations'    => __DIR__ . '/../database/migrations',
        'seeds'         => __DIR__ . '/../database/seeds',
    ],
    'templates' => [
        'file' => __DIR__ . '/../app/Database/Migrations/MigrationStub.php'
    ],
    'migration_base_class' => '\App\Database\Migrations\Migration',
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_database' => 'testing',
        'testing' => [
            'adapter' => $config['driver'],
            'host'    => $config['host'],
            'name'    => $config['database'],
            'user'    => $config['username'],
            'pass'    => $config['password'],
            'port'    => $config['port']
        ]
    ]
];

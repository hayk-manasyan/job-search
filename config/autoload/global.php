<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

use Zend\Db\Adapter\AdapterAbstractServiceFactory;

return [
    'db' => [
        'adapters' => [
            'dbAdapter' => [
                'driver' => 'Pdo_Mysql',
                'dsn' => "mysqli:host=127.0.0.1;dbname=jobs",
                'username' => 'root',
                'password' => 'root',
                'driver_options' => [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
                ],
            ]
        ],

    ],
    'service_manager' => [
        'factories' => [
        ],
        'abstract_factories' => [
            AdapterAbstractServiceFactory::class,
        ],
    ],
];

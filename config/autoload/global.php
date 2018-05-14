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

use Doctrine\DBAL\Driver\PDOMySql\Driver as PDOMySqlDriver;
use Zend\Session\Storage\SessionArrayStorage;
use Zend\Session\Validator\RemoteAddr;
use Zend\Session\Validator\HttpUserAgent;

use Doctrine\DBAL\Driver\PDOPgSql\Driver as PDOPgSqlDriver;

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => PDOMySqlDriver::class,
                'params' => [
                    'host'     => '127.0.0.1',
                    'user'     => 'root',
                    'password' => 'root',
                    'dbname'   => 'jobs',
                ]
            ],
            'orm_pg' => [
                'driverClass' => PDOPgSqlDriver::class,
                'params' => [
                    'host' => '127.0.0.1',
                    'user' => 'postgres',
                    'password' => 'postgres',
                    'dbname' => 'jobs',
                    'port' => '5432'
                ]
            ],
        ],
    ],
    // Entity Manager instantiation settings
    'entitymanager' => [
        'orm_default' => [
            'connection'    => 'orm_default',
//                'configuration' => 'orm_default',
        ],
        'orm_pg' => [
            'connection'    => 'orm_pg',
//                'configuration' => 'orm_pg',
        ],
    ],
    'migrations_configuration' => [
        'orm_default' => [
            'directory' => 'data/Migrations',
            'name'      => 'Doctrine Database Migrations',
            'namespace' => 'Migrations',
            'table'     => 'migrations',
        ],
    ],
    // Session configuration.
    'session_config' => [
        'cookie_lifetime'     => 60*60*1, // Session cookie will expire in 1 hour.
        'gc_maxlifetime'      => 60*60*24*30, // How long to store session data on server (for 1 month).
    ],
    // Session manager configuration.
    'session_manager' => [
        // Session validators (used for security).
        'validators' => [
            RemoteAddr::class,
            HttpUserAgent::class,
        ]
    ],
    // Session storage configuration.
    'session_storage' => [
        'type' => SessionArrayStorage::class
    ],
];

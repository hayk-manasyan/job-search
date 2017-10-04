<?php

namespace  Jobs;

use Jobs\Factory\JobManagerFactory;
use Jobs\Manager\JobsManager;


use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'service_manager' => [
        'factories' => [

            /**
             * Managers
             */

            JobsManager::class => JobManagerFactory::class,
        ],
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ]
];
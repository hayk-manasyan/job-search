<?php

namespace  Jobs;

use Jobs\Controller\JobSearchController;
use Jobs\Factory\JobManagerFactory;
use Jobs\Manager\JobsManager;
use Jobs\Factory\JobSearchControllerFactory;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'controllers' => [
        'factories' => [
            JobSearchController::class => JobSearchControllerFactory::class,
        ]
    ],
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
    ],

    'console' => [
        'router' => [
            'routes' => [
                'list-users' => [
                    'options' => [
//                        'route'    => 'show [all|disabled|deleted]:mode users [--verbose|-v]',
                        'route' => 'update jobs [--verbose|-v]',
                        'defaults' => [
                            'controller' => JobSearchController::class,
                            'action' => 'index',
                        ],
                    ],
                ],
            ],
        ],
    ],
];
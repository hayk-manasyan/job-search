<?php

namespace Github;

use Github\Controller\JobSearchController;
use Github\Factory\JobSearchControllerFactory;
use Github\Factory\SearchServiceFactory;
use Github\Service\SearchService;
use Zend\Router\Http\Literal;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'factories' => [
            JobSearchController::class => JobSearchControllerFactory::class,
        ]
    ],
    'service_manager' => [
        'factories' => [
            SearchService::class => SearchServiceFactory::class
        ]
    ],
    'console' => [
        'router' => [
            'routes' => [
                'list-users' => [
                    'options' => [
//                        'route'    => 'show [all|disabled|deleted]:mode users [--verbose|-v]',
                        'route'    => 'update jobs [--verbose|-v]',
                        'defaults' => [
                            'controller' => JobSearchController::class,
                            'action'     => 'index',
                        ],
                    ],
                ],
            ],
        ],
        ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],

];

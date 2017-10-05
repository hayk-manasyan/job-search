<?php

namespace Stack;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Stack\Factory\StackSearchServiceFactory;
use Stack\Service\StackSearchService;


return [

    'service_manager' => [
        'factories' => [
            StackSearchService::class => StackSearchServiceFactory::class,
        ]
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [ __DIR__ . '/../src/Entity' ]
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ],

];
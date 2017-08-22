<?php

namespace Github;

use Github\Service\SearchService;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'service_manager' => [
        'factories' => [
            SearchService::class => InvokableFactory::class
        ]
    ]
];

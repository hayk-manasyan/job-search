<?php

namespace Github;


use Github\Factory\SearchServiceFactory;
use Github\Service\GithubSearchService;

return [

    'service_manager' => [
        'factories' => [
            GithubSearchService::class => SearchServiceFactory::class
        ]
    ],

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],

];

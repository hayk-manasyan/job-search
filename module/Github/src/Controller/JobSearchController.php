<?php

namespace Github\Controller;


use Github\Service\SearchService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Console\Request as ConsoleRequest;

class JobSearchController extends AbstractActionController
{
    private $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function indexAction()
    {
        $list = [
            'php',
            'java',
            'javascript',
            '.net',
            'c#',
            'nodejs'
        ];

        foreach ($list as $item) {
            $this->searchService->searchByDescription($item);
        }

        return 'Done.';
    }
}
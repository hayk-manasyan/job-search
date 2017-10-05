<?php

namespace Jobs\Controller;


use Github\Service\GithubSearchService;
use Stack\Service\StackSearchService;
use Zend\Mvc\Controller\AbstractActionController;

class JobSearchController extends AbstractActionController
{
    private $githubSearchService;
    private $stackSearchService;

    public function __construct( GithubSearchService $githubSearchService, StackSearchService $stackSearchService)
    {
        $this->githubSearchService = $githubSearchService;
        $this->stackSearchService = $stackSearchService;
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
            $this->githubSearchService->searchByDescription($item);
            $this->stackSearchService->searchByDescription($item);
        }

        return 'Done.';
    }
}
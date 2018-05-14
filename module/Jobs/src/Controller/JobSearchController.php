<?php

namespace Jobs\Controller;


use Github\Service\GithubSearchService;
use Jobs\Manager\MigrationManager;
use Stack\Service\StackSearchService;
use Zend\Mvc\Controller\AbstractActionController;

class JobSearchController extends AbstractActionController
{
    private $githubSearchService;
    private $stackSearchService;
    private $migrationManager;

    public function __construct( GithubSearchService $githubSearchService, StackSearchService $stackSearchService, MigrationManager $migrationManager)
    {
        $this->githubSearchService = $githubSearchService;
        $this->stackSearchService = $stackSearchService;
        $this->migrationManager = $migrationManager;
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

    public function migrateAction()
    {
        echo 'Migration is started.' . PHP_EOL;
        $this->migrationManager->migrate();
    }
}
<?php

namespace Application\Controller;

use Application\Form\SearchForm;
use Jobs\Manager\JobsManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    private $jobsManager;
    private $searchForm;

    public function __construct( JobsManager $jobsManager, SearchForm $searchForm )
    {
        $this->jobsManager = $jobsManager;
        $this->searchForm = $searchForm;
    }

    public function dashboardAction()
    {
        $viewModel = new ViewModel();
        $list = [
            'php',
            'java',
            'javascript',
            '.net',
            'c#',
            'nodejs'
        ];

        $jobs = [];
        $totalCount = [];
        foreach ( $list as $key => $item ) {
            $jobs[ $item ] = $this->jobsManager->searchByTagName( $item, 5 );
            $totalCount[ $item ] = $this->jobsManager->searchByTagsCount( $item );
        }

        $viewModel->jobs = $jobs;
        $viewModel->totalCount = $totalCount;

        return $viewModel;
    }

    public function searchAction()
    {
        $queryParam = $this->params( 'query', null );
        if ( is_null( $queryParam ) ) {
            return $this->redirect()->toRoute( 'home' );
        }
        $viewModel = new ViewModel();
        $viewModel->result = [];
        try {
            $viewModel->result = $php = $this->jobsManager->searchByTagName( $queryParam );
        }catch (\Exception $ex) {
            var_dump($ex->getMessage()); die;
        }

        return $viewModel;
    }

    public function detailAction()
    {
        $jobId = $this->params( 'query', null );
        if ( is_null( $jobId ) ) {
            return $this->redirect()->toRoute( 'home' );
        }

        $viewModel = new ViewModel();
        $jobDetail = $this->jobsManager->searchById( $jobId );

        $viewModel->job = $jobDetail;
        return $viewModel;
    }

    public function manualSearchAction()
    {
        $viewModel = new ViewModel();
        $viewModel->form = $this->searchForm;

        $request = $this->getRequest();
        if ( !$request->isPost() ) {
            return $viewModel;
        }

        $postData = $request->getPost();
        $this->searchForm->setData( $postData );
        if ( !$this->searchForm->isValid() ) {
            return $viewModel;
        }

        $formData = $this->searchForm->getData();
        $position = $formData[ 'position' ];
        $location = $formData[ 'location' ];
        try {
            $viewModel->result = $this->jobsManager->searchByCombinedParams( $position, $location );
        } catch ( \Exception $ex ) {
            $viewModel->error = true;
            return $viewModel;
        }

        return $viewModel;
    }

    public function bookmarksAction()
    {
        return new ViewModel();
    }

    public function privacyAction()
    {
        return new ViewModel();
    }

    public function textSearchAction()
    {
        $queryParam = $this->params( 'query', null );
        if ( is_null( $queryParam ) ) {
            return $this->redirect()->toRoute( 'home' );
        }
        $viewModel = new ViewModel();
        $viewModel->setTemplate('application/index/search');
        $viewModel->result = [];
        $viewModel->searchParam = $queryParam;
        try {
            $viewModel->result = $this->jobsManager->searchByDescription( $queryParam );
        }catch (\Exception $ex) {
            $viewModel->error = true;
        }

        return $viewModel;
    }
}

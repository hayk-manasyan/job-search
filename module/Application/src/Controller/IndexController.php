<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\View\Helper\Sidebar;
use Github\Service\SearchService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\View;

class IndexController extends AbstractActionController
{
    private $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function dashboardAction()
    {

        $viewModel = new ViewModel();

        $viewModel->php = $php = $this->searchService->searchByDescription('php');
        $viewModel->java = $php = $this->searchService->searchByDescription('java');

        return $viewModel ;
    }

    public function searchAction()
    {
        $queryParam = $this->params('query', null);
        if(is_null($queryParam)) {
            return $this->redirect()->toRoute('home');

        }
        $viewModel = new ViewModel();

        $viewModel->result = $php =$this->searchService->searchByDescription($queryParam);

        return $viewModel ;
    }

    public function detailAction()
    {
        $jobId = $this->params('query', null);
        if(is_null($jobId)) {
            return $this->redirect()->toRoute('home');
        }

        $viewModel = new ViewModel();
        $jobDetail  = $this->searchService->searchById($jobId);
//        var_dump($jobDetail);
        $viewModel->job = $jobDetail;
        return $viewModel;
    }
}

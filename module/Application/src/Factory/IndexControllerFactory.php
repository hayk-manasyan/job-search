<?php

namespace Application\Factory;


use Application\Controller\IndexController;
use Application\Form\SearchForm;
use Github\Service\GithubSearchService;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Jobs\Manager\JobsManager;
use Stack\Service\StackSearchService;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class IndexControllerFactory implements FactoryInterface
{

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $searchForm = $container->get('FormElementManager')->get(SearchForm::class);

        return new IndexController($container->get(JobsManager::class), $searchForm, $container->get(StackSearchService::class));
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: hayk
 * Date: 9/17/17
 * Time: 10:42 PM
 */

namespace Jobs\Factory;

use Github\Service\GithubSearchService;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Jobs\Controller\JobSearchController;
use Stack\Service\StackSearchService;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class JobSearchControllerFactory implements FactoryInterface
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
        $githubSearch = $container->get(GithubSearchService::class);
        $stackSearch = $container->get(StackSearchService::class);

        return new JobSearchController($githubSearch, $stackSearch);
    }
}
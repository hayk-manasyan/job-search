<?php
/**
 * Created by PhpStorm.
 * User: haykma
 * Date: 04/10/2017
 * Time: 18:07
 */

namespace Stack\Factory;


use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Jobs\Manager\JobsManager;
use Stack\Service\StackSearchService;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class StackSearchServiceFactory implements FactoryInterface
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
    public function __invoke( ContainerInterface $container, $requestedName, array $options = null )
    {
        return new StackSearchService($container->get(JobsManager::class));
    }
}
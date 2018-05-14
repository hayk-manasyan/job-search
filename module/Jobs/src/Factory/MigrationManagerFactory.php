<?php

namespace Jobs\Factory;


use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Jobs\Manager\JobsManager;
use Jobs\Manager\MigrationManager;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class MigrationManagerFactory implements FactoryInterface
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
        // Get Doctrine entity manager
        $mysqlEntityManager = $container->get('doctrine.entitymanager.orm_default');
        $pgsqlEntityManager = $container->get('doctrine.entitymanager.orm_pg');

        return new MigrationManager($mysqlEntityManager, $pgsqlEntityManager);
    }
}
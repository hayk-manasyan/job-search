<?php

namespace Jobs\Manager;


use Jobs\Entity\Jobs;
use Doctrine\ORM\EntityManager;
use Zend\Hydrator\ClassMethods;


class MigrationManager
{

    /**
     * Doctrine entity manager.
     * @var \Doctrine\ORM\EntityManager
     */
    private $mysqlEntityManager;


    /**
     * Doctrine entity manager.
     * @var \Doctrine\ORM\EntityManager
     */
    private $pgsqlEntityManager;


    public function __construct( EntityManager $mysqlEntityManager, EntityManager $pgsqlEntityManager )
    {
        $this->mysqlEntityManager = $mysqlEntityManager;
        $this->pgsqlEntityManager = $pgsqlEntityManager;
    }

    public function migrate()
    {
        echo 'migrate function ' . PHP_EOL;
        try {
            $data = $this->mysqlEntityManager->getRepository( Jobs::class )->findBy( [], [ 'id' => "ASC" ] );
            foreach ( $data as $key => $job ) {
                $job->setId( null );
                // Add the entity to entity manager.
                $this->pgsqlEntityManager->persist( $job );

                // Apply changes to database.
                $this->pgsqlEntityManager->flush();
                echo $key + 1 . " is inserted." . PHP_EOL;
            }
        } catch ( \Exception $ex ) {
            error_log( var_export( "ERROR: " . $ex->getMessage(), true ) );
        }

        echo 'Migration ended ' . PHP_EOL;
    }


}
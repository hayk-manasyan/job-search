<?php

namespace Jobs\Manager;


use Jobs\Entity\Jobs;
use Doctrine\ORM\EntityManager;
use Zend\Hydrator\ClassMethods;

class JobsManager
{

    /**
     * Doctrine entity manager.
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    public function __construct( EntityManager $entityManager )
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param array $data
     * @param $source
     * @param $tag
     * @return boolean
     * @throws \Exception
     */
    public function saveNewJob( $data, $source = null, $tag = null )
    {
        $job = $this->entityManager->getRepository(Jobs::class)->findOneBy(
            [ 'externalId' => $data['id'] ]);

        if(!is_null($job)) {
            return false;
        }

        $hydrator = new ClassMethods();
        $job = $hydrator->hydrate($data, new Jobs());

        $job->setCreatedAt(date('Y-m-d H:i:s'));
        $job->setCreatedAtExternal(date('Y-m-d H:i:s', strtotime($data[ 'created_at' ])));
        $job->setJobUrl($data[ 'url' ]);
        $job->setTag($tag);
        $job->setSource($source);
        $job->setId(null);
        $job->setExternalId($data[ 'id' ]);

        // Add the entity to entity manager.
        $this->entityManager->persist($job);

        // Apply changes to database.
        $this->entityManager->flush();

        return true;
    }

    public function searchByDescription( $description, $count = null )
    {
        $jobList = $this->entityManager->getRepository(Jobs::class)->findBy(
            [ 'tag' => $description ],
            [ 'id' => 'DESC' ], $count);

        return $jobList;
    }

    public function searchByCombinedParams(
        $description = null,
        $location = null,
        $lat = null,
        $long = null,
        $fullTime = false
    )
    {
        $x = false;
        $queryBuilder = $this->entityManager->getRepository(Jobs::class)
            ->createQueryBuilder('j');

        $result = $queryBuilder->select();

        if ( trim($description) !== '' && !is_null($description) ) {
            $result->where('j.tag = :tag')
                ->setParameter('tag', $description);
            $x = true;
        }
        if ( trim($location) !== '' && !is_null($location) ) {
            $result->andWhere('LOWER(j.location) LIKE :location')
                ->setParameter('location', '%' . mb_strtolower($location) . '%');
            $x = true;
        }

        if ( !$x ) {
            throw new \Exception('There is no search params');
        }

        return $result->getQuery()->getResult();
    }

    public function searchById( $jobId )
    {
        $job = $this->entityManager->getRepository(Jobs::class)->find($jobId);

        return $job;
    }

    public function searchByDescriptionCount( $description )
    {
        $qb = $this->entityManager->getRepository(Jobs::class)->createQueryBuilder('j');
        $count =  $qb
            ->select('count(j.id)')
             ->where('j.tag = :tag')
                 ->setParameter('tag', $description)
            ->getQuery()
            ->getSingleScalarResult();

        return $count;
    }

}
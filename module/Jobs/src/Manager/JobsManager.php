<?php

namespace Jobs\Manager;

use Jobs\Entity\Jobs;
use Doctrine\ORM\EntityManager;
use Utils\Service\ObjectService;
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
        $patterns = [
            '<br>',
            '<br >',
            '<br/>',
            '<br />',
        ];
        $description = str_replace($patterns, '', $job->getDescription());
        $job->setDescription($description);

        $job->setCreatedAt(date('Y-m-d H:i:s'));
        $job->setCreatedAtExternal(date('Y-m-d H:i:s', strtotime($data[ 'created_at' ])));
        $job->setJobUrl($data[ 'url' ]);
        $job->setTag($tag);
        $job->setSource($source);
        $job->setId(null);
        $job->setExternalId($data[ 'id' ]);

        try {
            // Add the entity to entity manager.
            $this->entityManager->persist($job);

            // Apply changes to database.
            $this->entityManager->flush();
        } catch (\Exception $ex) {

        }


        return true;
    }

    public function searchByTagName($description, $count = null )
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

    public function searchByTagsCount($description )
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

    /**
     * @param $description
     * @return array
     * @throws \Doctrine\DBAL\DBALException|\Exception
     *
     */
    public function searchByDescription($description)
    {
        $db = $this->entityManager->getConnection();
        $sql = "SELECT * FROM jobs j 
        where to_tsvector('english', description) @@ plainto_tsquery('english', :description)
        ORDER BY created_at desc ";

        $stmt = $db->prepare($sql);
        $description .= ':*';
        $stmt->bindParam("description", $description);
        $stmt->execute();

        $result = $stmt->fetchAll();
        $converted = [];
        foreach ($result as $res) {
            $res['source'] = $res['job_source'];
            $converted[] = ObjectService::convertArrayToObj($res, new Jobs());
        }

        return $converted;
    }

    /**
     * @param $title
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getRelatedJobs($title, $tag)
    {
        $db = $this->entityManager->getConnection();
        $sql = "SELECT * FROM jobs j 
        where to_tsvector('english', description) @@ plainto_tsquery('english', :description)
        AND tag = :tag
        ORDER BY created_at desc
        LIMIT 15;";


        $stmt = $db->prepare($sql);
        $temp = explode(' ', $title);
        $searchTerm = $temp[0] . ':* ' . $temp[1] . ':*';

        $stmt->bindParam("description", $searchTerm);
        $stmt->bindParam("tag", $tag);
        $stmt->execute();

        $result = $stmt->fetchAll();
        $converted = [];
        foreach ($result as $res) {
            $res['source'] = $res['job_source'];
            $converted[] = ObjectService::convertArrayToObj($res, new Jobs());
        }

        return $converted;
    }

}

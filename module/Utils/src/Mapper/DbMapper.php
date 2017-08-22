<?php
namespace Utils\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Sql;
use Zend\Hydrator\HydratorInterface;
use Exception;

abstract class DbMapper
{

    const RETURN_TYPE_ARRAY = 'array';
    const RETURN_TYPE_OBJECT = 'object';

    /**
     * @var AdapterInterface
     */
    protected $dbAdapter;

    /**
     * @var HydratorInterface
     */
    protected $hydrator;

    /**
     * @var
     */
    protected $entityPrototype;

    private $SQL;

    public function __construct(AdapterInterface $dbAdapter, HydratorInterface $hydrator, $entityPrototype)
    {
        $this->dbAdapter = $dbAdapter;
        $this->hydrator = $hydrator;
        $this->entityPrototype = $entityPrototype;
    }

    private function getSQL()
    {
        if(is_null($this->SQL)) {
            $this->setSql();
        }

        return $this->SQL;
    }

    private function setSQL()
    {
        $this->SQL = new Sql($this->dbAdapter);

        return;
    }

    protected function makeSqlQuery($query, $returnType = self::RETURN_TYPE_OBJECT)
    {

        try {
            $stmt = $this->getSQL()->prepareStatementForSqlObject($query);

            $result = $stmt->execute();
        } catch (\Exception $ex) {
//var_dump($ex->getMessage()); die;
            throw new \Exception('There was an error while executing query.');
        }

        if ($result instanceof ResultInterface && $result->getAffectedRows()) {
            if($returnType === self::RETURN_TYPE_OBJECT) {
                $resultSet = new HydratingResultSet($this->hydrator, $this->entityPrototype);
                $resultSet->initialize($result);

                return $resultSet;
            } else {
                $resultSet = new ResultSet();
                $resultSet->initialize($result);

                return $resultSet->toArray();
            }
        }

        return null;
    }

    protected function makeSingleSqlQuery($query)
    {
        try {
            $stmt = $this->getSQL()->prepareStatementForSqlObject($query);
            $result = $stmt->execute();
        } catch (\Exception $ex) {
            throw new \Exception('There was an error while executing single query.');
        }

        if ($result instanceof ResultInterface && $result->getAffectedRows()) {
            return $this->hydrator->hydrate($result->current(), $this->entityPrototype);
        }

        return null;
    }

    protected function inertOrUpdateSqlQuery($query)
    {
        try {
            $sql = new Sql($this->dbAdapter);
            $stmt = $sql->prepareStatementForSqlObject($query);
            $result = $stmt->execute();
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
            throw new Exception('Faild save/update.');
        }

        if ($result instanceof ResultInterface) {
            return $result;
        }

         throw new \Exception("Database error");

    }
}
<?php
namespace Picamator\ObjectManager\Example\Legacy;

use Picamator\ObjectManager\Example\Legacy\Api\ConnectionInterface;
use Picamator\ObjectManager\Example\Legacy\Api\UserRepositoryInterface;
use Picamator\ObjectManager\ObjectManagerSingleton;

/**
 * Connection to some resource
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * @var ConnectionInterface
     */
    private $connection;

    public function __construct()
    {
        // before refactoring was $this->connection = new Connection();
        $this->connection = ObjectManagerSingleton::getInstance()->create('Picamator\ObjectManager\Example\Legacy\Connection');
    }

    /**
     * @inheritDoc
     */
    public function find(array $searchCriteria)
    {
        return $this->connection->execute($searchCriteria);
    }
}

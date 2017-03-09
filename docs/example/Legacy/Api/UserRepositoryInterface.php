<?php
namespace Picamator\ObjectManager\Example\Legacy\Api;

/**
 * User repository
 */
interface UserRepositoryInterface
{
    /**
     * Gets connection
     *
     * @param array $searchCriteria
     *
     * @return array
     */
    public function find(array $searchCriteria);
}

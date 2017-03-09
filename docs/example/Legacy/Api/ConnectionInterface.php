<?php
namespace Picamator\ObjectManager\Example\Legacy\Api;

/**
 * Connection to some resource
 */
interface ConnectionInterface
{
    /**
     * Gets connection
     *
     * @param array $data
     *
     * @return array
     */
    public function execute(array $data);
}

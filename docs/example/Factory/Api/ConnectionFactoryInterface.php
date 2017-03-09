<?php
namespace Picamator\ObjectManager\Example\Factory\Api;

use Picamator\ObjectManager\Exception\RuntimeException;

/**
 * Create connection instance
 */
interface ConnectionFactoryInterface
{
    /**
     * Create
     *
     * @param array $options
     *
     * @return ConnectionInterface
     *
     * @throws RuntimeException
     */
    public function create(array $options);
}

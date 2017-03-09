<?php
namespace Picamator\ObjectManager\Api;

use Picamator\ObjectManager\Exception\RuntimeException;

/**
 * Creates objects, the main usage is inside factories
 *
 * All objects are unshared, for shared objects please use DI service libraries
 */
interface ObjectManagerInterface
{
    /**
     * Create objects
     *
     * @param string $className
     * @param array  $arguments
     *
     * @return mixed
     *
     * @throws RuntimeException
     */
    public function create($className, array $arguments = []);
}

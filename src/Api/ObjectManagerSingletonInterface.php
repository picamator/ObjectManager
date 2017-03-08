<?php
namespace Picamator\ObjectManager\Api;

use Picamator\ObjectManager\Exception\RuntimeException;

/**
 * Creates objects, the main usage inside factories
 *
 * All objects are unshared, for shared objects please use DI service libraries
 * It implements singleton pattern
 */
interface ObjectManagerSingletonInterface
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

    /**
     * Gets instance
     *
     * @return ObjectManagerSingletonInterface
     */
    static public function getInstance();

    /**
     * Sets instance
     *
     * @param ObjectManagerSingletonInterface $instance
     */
    static public function setInstance(ObjectManagerSingletonInterface $instance);

    /**
     * Clean instance
     */
    static public function cleanInstance();
}

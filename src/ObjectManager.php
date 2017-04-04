<?php
namespace Picamator\ObjectManager;

use Picamator\ObjectManager\Api\ObjectManagerInterface;
use Picamator\ObjectManager\Exception\RuntimeException;

/**
 * Creates objects, the main usage is inside factories
 *
 * All objects are unshared, for shared objects please use DI service libraries
 */
class ObjectManager implements ObjectManagerInterface
{
    /**
     * @var array
     */
    private $reflectionContainer;

    /**
     * {@inheritdoc}
     */
    public function create($className, array $arguments = [])
    {
        if (empty($arguments)) {
            // for performance reason ``class_exists`` is not checked here
            return new $className();
        }

        return $this->getReflection($className)
            ->newInstanceArgs($arguments);
    }

    /**
     * Retrieve reflection
     *
     * @param string $className
     *
     * @return \ReflectionClass
     */
    private function getReflection($className)
    {
        if (isset($this->reflectionContainer[$className])) {
            return $this->reflectionContainer[$className];
        }

        if (!class_exists($className)) {
            throw new RuntimeException(sprintf('Class "%s" does not exist', $className));
        }

        if (!method_exists($className, '__construct')) {
            throw new RuntimeException(sprintf('Class "%s" does not have __construct', $className));
        }

        $this->reflectionContainer[$className] = new \ReflectionClass($className);

        return $this->reflectionContainer[$className];
    }
}

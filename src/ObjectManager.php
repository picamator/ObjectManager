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
            return new $className();
        }

        // construction does not available
        if (method_exists($className, '__construct') === false) {
            throw new RuntimeException(sprintf('Class "%s" does not have __construct', $className));
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
        if (empty($this->reflectionContainer[$className])) {
            $this->reflectionContainer[$className] = new \ReflectionClass($className);
        }

        return $this->reflectionContainer[$className];
    }
}

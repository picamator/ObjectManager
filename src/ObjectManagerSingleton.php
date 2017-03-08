<?php
namespace Picamator\ObjectManager;

use Picamator\ObjectManager\Api\ObjectManagerSingletonInterface;

/**
 * Creates objects, the main usage inside factories
 *
 * All objects are unshared, for shared objects please use DI service libraries
 * It implements singleton pattern
 */
class ObjectManagerSingleton implements ObjectManagerSingletonInterface
{
    /**
     * @var ObjectManagerInterface | null
     */
    private static $instance = null;

    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * Singleton implementation require private construct
     */
    private function __construct()
    {
        $this->objectManager = new ObjectManager();
    }

    /**
     * Singleton implementation require private clone
     */
    private function __clone()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function create($className, array $arguments = [])
    {
        return $this->objectManager->create($className, $arguments);
    }

    /**
     * {@inheritdoc}
     */
    static public function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * {@inheritdoc}
     */
    static public function setInstance(ObjectManagerSingletonInterface $instance)
    {
        self::$instance = $instance;
    }

    /**
     * {@inheritdoc}
     */
    static public function cleanInstance()
    {
        self::$instance = null;
    }
}

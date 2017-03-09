<?php
namespace Picamator\ObjectManager\Example\Factory;

use Picamator\ObjectManager\Api\ObjectManagerInterface;
use Picamator\ObjectManager\Example\Factory\Api\ConnectionFactoryInterface;

/**
 * Connection to some resource
 */
class ConnectionFactory implements ConnectionFactoryInterface
{
    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var string
     */
    private $className;

    /**
     * @param ObjectManagerInterface $objectManager
     * @param string $className
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        $className = 'Picamator\ObjectManager\Example\Factory\Connection'
    ) {
        $this->objectManager = $objectManager;
        $this->className = $className;
    }

    /**
     * @inheritDoc
     */
    public function create(array $options)
    {
        return $this->objectManager->create($this->className, [$options]);
    }
}

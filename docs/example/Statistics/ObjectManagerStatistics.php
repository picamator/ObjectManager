<?php
namespace Picamator\ObjectManager\Example\Statistics;

use Picamator\ObjectManager\Api\ObjectManagerInterface;
use Picamator\ObjectManager\Example\Statistics\Api\ObjectManagerStatisticsInterface;

/**
 * Creates objects, the main usage is inside factories with collecting statistics
 */
class ObjectManagerStatistics implements ObjectManagerStatisticsInterface
{
    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var array
     */
    private $statistics = [];

    /**
     * @param ObjectManagerInterface $objectManager
     */
    public function __construct(ObjectManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @inheritDoc
     */
    public function create($className, array $arguments = [])
    {
        $result =  $this->objectManager->create($className, $arguments);

        if (!isset($this->statistics[$className])) {
            $this->statistics[$className] = 0;
        }
        $this->statistics[$className] ++;

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function getStatistics()
    {
        return $this->statistics;
    }
}

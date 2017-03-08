<?php
namespace Picamator\ObjectManager\Example\Statistics\Api;

use Picamator\ObjectManager\Api\ObjectManagerInterface;

/**
 * Creates objects, the main usage is inside factories with collecting statistics
 */
interface ObjectManagerStatisticsInterface extends ObjectManagerInterface
{
    /**
     * Gets statistics
     *
     * @return array
     */
    public function getStatistics();
}

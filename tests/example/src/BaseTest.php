<?php
namespace Picamator\ObjectManager\Tests\Example;

use PHPUnit\Framework\TestCase;
use Picamator\ObjectManager\Tests\Helper\ObjectManagerHelper;

abstract class BaseTest extends TestCase
{
    /**
     * @var ObjectManagerHelper
     */
    private $objectManagerHelper;

    /**
     * Stub singleton object manager
     *
     * @param array $data
     *
     * @return \Picamator\ObjectManager\Api\ObjectManagerSingletonInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    protected function stubObjectManager(array $data)
    {
        if (empty($this->objectManagerHelper)) {
            $this->objectManagerHelper = new ObjectManagerHelper($this);
        }

        return $this->objectManagerHelper->stubObjectManager($data);
    }
}

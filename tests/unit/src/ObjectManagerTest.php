<?php
namespace Picamator\ObjectManager\Tests\Unit;

use Picamator\ObjectManager\ObjectManager;

class ObjectManagerTest extends BaseTest
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    protected function setUp()
    {
        parent::setUp();

        $this->objectManager = new ObjectManager();
    }

    /**
     * @dataProvider providerCreate
     *
     * @param array $arguments
     */
    public function testCreate(array $arguments)
    {
        $className = '\DateTime';

        $actual = $this->objectManager->create($className, $arguments);
        $this->assertInstanceOf($className, $actual);
    }

    /**
     * @expectedException \Picamator\ObjectManager\Exception\RuntimeException
     */
    public function testFailCreate()
    {
        $this->objectManager->create('Picamator\ObjectManager\ObjectManager', [1, 2]);
    }

    public function providerCreate()
    {
        return [
            [['now']],
            [[]]
        ];
    }
}

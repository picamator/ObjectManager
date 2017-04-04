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
        $this->objectManager->create($className, $arguments); // double run to test internal cache

        $this->assertInstanceOf($className, $actual);
    }

    /**
     * @expectedException \Picamator\ObjectManager\Exception\RuntimeException
     */
    public function testFailNoClassCreate()
    {
        $this->objectManager->create('NotExistingClass', [1, 2]);
    }

    /**
     * @expectedException \Picamator\ObjectManager\Exception\RuntimeException
     */
    public function testFailNoConstructCreate()
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

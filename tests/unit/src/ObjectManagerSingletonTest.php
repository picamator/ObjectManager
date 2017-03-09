<?php
namespace Picamator\ObjectManager\Tests\Unit;

use Picamator\ObjectManager\ObjectManagerSingleton;

class ObjectManagerSingletonTest extends BaseTest
{
    protected function setUp()
    {
        parent::setUp();

        ObjectManagerSingleton::cleanInstance();
    }

    public function testCreate()
    {
        $className = 'DateTime';

        $actual = ObjectManagerSingleton::getInstance()->create($className);
        $this->assertInstanceOf($className, $actual);
    }

    public function testCleanInstance()
    {
        $actual = ObjectManagerSingleton::getInstance();
        ObjectManagerSingleton::cleanInstance();
        $expected = ObjectManagerSingleton::getInstance();

        $this->assertNotSame($expected, $actual);
        $this->assertSame($expected, ObjectManagerSingleton::getInstance());
    }

    public function testSetInstance()
    {
        $className = 'DateTime';

        // object manager singleton mock
        $objectManagerSingletonMock = $this->getMockBuilder('Picamator\ObjectManager\Api\ObjectManagerSingletonInterface')
            ->getMock();

        $objectManagerSingletonMock->expects($this->once())
            ->method('create');

        ObjectManagerSingleton::setInstance($objectManagerSingletonMock);
        ObjectManagerSingleton::getInstance()->create($className);
    }
}

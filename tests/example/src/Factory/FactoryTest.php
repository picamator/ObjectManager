<?php
namespace Picamator\ObjectManager\Tests\Example\Factory;

use Picamator\ObjectManager\Example\Factory\ConnectionFactory;
use Picamator\ObjectManager\Tests\Example\BaseTest;

class FactoryTest extends BaseTest
{
    /**
     * @var ConnectionFactory
     */
    private $connectionFactory;

    /**
     * @var \Picamator\ObjectManager\Api\ObjectManagerInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $objectManagerMock;

    /**
     * @var \Picamator\ObjectManager\Example\Factory\Api\ConnectionInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $connectionMock;

    protected function setUp()
    {
        parent::setUp();

        $this->objectManagerMock = $this->getMockBuilder('Picamator\ObjectManager\Api\ObjectManagerInterface')
            ->getMock();

        $this->connectionMock =  $this->getMockBuilder('Picamator\ObjectManager\Example\Factory\Api\ConnectionInterface')
            ->getMock();

        $this->connectionFactory = new ConnectionFactory($this->objectManagerMock);
    }

    public function testCreate()
    {
        $options = [];

        // object manager mock
        $this->objectManagerMock->expects($this->once())
            ->method('create')
            ->with($this->equalTo('Picamator\ObjectManager\Example\Factory\Connection'), $this->equalTo([$options]))
            ->willReturn($this->connectionMock);

        $connection = $this->connectionFactory->create($options);
        $this->assertSame($connection, $this->connectionMock);
    }
}

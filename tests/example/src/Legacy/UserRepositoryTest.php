<?php
namespace Picamator\ObjectManager\Tests\Example\Legacy;

use Picamator\ObjectManager\Example\Legacy\UserRepository;
use Picamator\ObjectManager\Tests\Example\BaseTest;

class UserRepositoryTest extends BaseTest
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var \Picamator\ObjectManager\Example\Factory\Api\ConnectionInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $connectionMock;

    protected function setUp()
    {
        parent::setUp();

        $this->connectionMock =  $this->getMockBuilder('Picamator\ObjectManager\Example\Factory\Api\ConnectionInterface')
            ->getMock();

        // stub object manager
        $this->stubObjectManager([
            'Picamator\ObjectManager\Example\Legacy\Connection' => ['object' => $this->connectionMock],
        ]);

        $this->userRepository = new UserRepository();
    }

    public function testFind()
    {
        $searchCriteria = [];

        // connection mock
        $this->connectionMock->expects($this->once())
            ->method('execute')
            ->with($this->equalTo($searchCriteria))
            ->willReturn([]);

        $this->userRepository->find($searchCriteria);
    }
}

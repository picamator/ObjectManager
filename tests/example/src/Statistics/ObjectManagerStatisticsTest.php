<?php
namespace Picamator\ObjectManager\Tests\Example\Statistics;

use Picamator\ObjectManager\Example\Statistics\ObjectManagerStatistics;
use Picamator\ObjectManager\Tests\Example\BaseTest;

class ObjectManagerStatisticsTest extends BaseTest
{
    /**
     * @var ObjectManagerStatistics
     */
    private $statistics;

    /**
     * @var \Picamator\ObjectManager\Api\ObjectManagerInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $objectManagerMock;

    protected function setUp()
    {
        parent::setUp();

        $this->objectManagerMock = $this->getMockBuilder('Picamator\ObjectManager\Api\ObjectManagerInterface')
            ->getMock();

        $this->statistics = new ObjectManagerStatistics($this->objectManagerMock);
    }

    /**
     * @dataProvider providerGetStatistics
     *
     * @param array $data
     */
    public function testGetStatistics(array $data)
    {
        // object manager mock
        $count = array_sum($data);
        $this->objectManagerMock->expects($this->exactly($count))
            ->method('create');

        foreach ($data as $key => $value) {
            for($i = 0; $i < $value; $i++) {
                $this->statistics->create($key);
            }
        }

        $actual = $this->statistics->getStatistics();
        $this->assertEquals($data, $actual);
    }

    public function providerGetStatistics()
    {
        return [
            [
                ['DateTime' => 5, 'stdClass' => 2]
            ]
        ];
    }
}

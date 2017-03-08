<?php
namespace Picamator\ObjectManager\Tests\Helper;

use PHPUnit\Framework\TestCase;
use Picamator\ObjectManager\ObjectManagerSingleton;
use Picamator\ObjectManager\InvalidArgumentException;

/**
 * Stub singleton object manager
 */
class ObjectManagerHelper
{
    /**
     * @var TestCase
     */
    private $testCase;

    /**
     * @param TestCase $testCase
     */
    public function __construct(TestCase $testCase)
    {
        $this->testCase = $testCase;
    }

    /**
     * Stub singleton object manager
     *
     * @param array $data
     *
     * @return \Picamator\ObjectManager\Api\ObjectManagerSingletonInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    public function stubObjectManager(array $data)
    {
        $objectManager = $this->getMockBuilder('Picamator\ObjectManager\Api\ObjectManagerSingletonInterface')
            ->getMock();
        ObjectManagerSingleton::setInstance($objectManager);

        $objectManager->method('create')
            ->willReturnCallback(function($className) use ($data) {
                if (!isset($data[$className])) {
                    throw new InvalidArgumentException(
                        sprintf('Undefined class name "%s"', $className)
                    );
                }

                if (!isset($data[$className]['object'])) {
                    throw new InvalidArgumentException('Invalid data structure. Required parameter "object" was not set.');
                }

                $arguments = isset($data[$className]['arguments']) ? $data[$className]['arguments'] : [];
                $objectMock = is_string($data[$className]['object'])
                    ? $this->getMockBuilder($data[$className]['object'])
                        ->setConstructorArgs($arguments)
                        ->getMock()
                    : $data[$className]['object'];

                return $objectMock;
            });
    }

    /**
     * Gets mock builder
     *
     * @param string $className
     *
     * @return \PHPUnit_Framework_MockObject_MockBuilder
     */
    private function getMockBuilder($className)
    {
        return $this->testCase->getMockBuilder($className);
    }
}

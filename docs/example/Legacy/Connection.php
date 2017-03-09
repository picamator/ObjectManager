<?php
namespace Picamator\ObjectManager\Example\Legacy;

use Picamator\ObjectManager\Example\Factory\Api\ConnectionInterface;

/**
 * Connection to some resource
 *
 * @codeCoverageIgnore
 */
class Connection implements ConnectionInterface
{
    /**
     * @var array
     */
    private $options;

    /**
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->options = $options;
    }

    /**
     * @inheritDoc
     */
    public function execute(array $data)
    {
        return [];
    }
}

<?php

namespace Tasksuki\Component\Handler\Test;

use Tasksuki\Component\Handler\ClosureHandler;
use Tasksuki\Component\Handler\CollectionHandler;
use PHPUnit\Framework\TestCase;
use Tasksuki\Component\Handler\HandlerInterface;
use Tasksuki\Component\Message\Message;

class CollectionHandlerTest extends TestCase
{
    /**
     * @expectedException \TypeError
     */
    public function testInvalidArrayTypes()
    {
        $given = [new \stdClass()];

        $handler = new CollectionHandler($given);
    }

    public function testHandler()
    {
        $collection = new CollectionHandler();
        $message = new Message();

        $handler = $this->getMockBuilder(HandlerInterface::class)
            ->setMethods(['handle'])
            ->getMock();

        $handler->expects($this->once())
            ->method('handle')
            ->with($message);

        $collection->addHandler($handler);

        $collection->handle($message);
    }

    public function testPriorityHandler()
    {
        $collection = new CollectionHandler();
        $message = new Message();

        $invoked = [];

        $listener1 = function () use (&$invoked) {
            $invoked[] = '1';
        };
        $listener2 = function () use (&$invoked) {
            $invoked[] = '2';
        };
        $listener3 = function () use (&$invoked) {
            $invoked[] = '3';
        };

        $collection->addHandler(new ClosureHandler($listener1), -10);
        $collection->addHandler(new ClosureHandler($listener2));
        $collection->addHandler(new ClosureHandler($listener3), 10);

        $collection->handle($message);

        $this->assertEquals([3, 2, 1], $invoked);
    }
}

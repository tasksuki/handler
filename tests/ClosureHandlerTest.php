<?php

namespace Tasksuki\Component\Handler\Test;

use Tasksuki\Component\Handler\ClosureHandler;
use PHPUnit\Framework\TestCase;
use Tasksuki\Component\Message\Message;

class ClosureHandlerTest extends TestCase
{
    public function testClosureHandler()
    {
        $message = new Message();

        $closure = $this->getMockBuilder(\stdClass::class)
            ->setMethods(['call'])
            ->getMock();

        $closure->expects($this->once())
            ->method('call')
            ->with($message);

        $handler = new ClosureHandler([$closure, 'call']);
        $handler->handle($message);
    }
}

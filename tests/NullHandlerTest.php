<?php

namespace Tasksuki\Component\Handler\Test;

use Tasksuki\Component\Handler\NullHandler;
use PHPUnit\Framework\TestCase;
use Tasksuki\Component\Message\Message;

class NullHandlerTest extends TestCase
{
    public function testHandler()
    {
        $handler = new NullHandler();
        $message = new Message();

        $handler->handle($message);

        $this->assertEquals($message, $message);
    }
}

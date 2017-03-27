<?php

namespace Tasksuki\Component\Handler;

use Tasksuki\Component\Message\Message;

/**
 * Class NullHandler
 *
 * @package Tasksuki\Component\Handler
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class NullHandler implements HandlerInterface
{
    /**
     * @param Message $message
     */
    public function handle(Message $message)
    {
    }
}
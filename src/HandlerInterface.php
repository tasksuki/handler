<?php

namespace Tasksuki\Component\Handler;

use Tasksuki\Component\Message\Message;

/**
 * Interface HandlerInterface
 *
 * @package Tasksuki\Component\Handler
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
interface HandlerInterface
{
    public function handle(Message $message);
}
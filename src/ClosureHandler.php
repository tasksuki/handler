<?php

namespace Tasksuki\Component\Handler;

use Tasksuki\Component\Message\Message;

/**
 * Class ClosureHandler
 *
 * @package Tasksuki\Component\Handler
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class ClosureHandler implements HandlerInterface
{
    /**
     * @var callable
     */
    private $closure;

    public function __construct(callable $closure)
    {
        $this->closure = $closure;
    }

    /**
     * @param Message $message
     */
    public function handle(Message $message)
    {
        call_user_func($this->closure, $message);
    }
}
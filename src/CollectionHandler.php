<?php

namespace Tasksuki\Component\Handler;

use Tasksuki\Component\Message\Message;

/**
 * Class CollectionHandler
 *
 * @package Tasksuki\Component\Handler
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class CollectionHandler implements HandlerInterface
{
    /**
     * @var HandlerInterface[]
     */
    private $handlers;

    /**
     * @var HandlerInterface[]
     */
    private $sorted;

    public function __construct(array $handlers = [])
    {
        $this->handlers = (
            function (HandlerInterface ...$handlers) {
                return $handlers;
            }
        )(...$handlers);
    }

    /**
     * @param Message $message
     */
    public function handle(Message $message)
    {
        foreach ($this->getHandlers() as $handler) {
            $handler->handle($message);
        }
    }

    public function addHandler(HandlerInterface $handler, int $priority = 0)
    {
        $this->handlers[$priority][] = $handler;
        $this->sorted = null;
    }

    /**
     * @return HandlerInterface[]
     */
    public function getHandlers(): array
    {
        if (null === $this->sorted) {
            $this->sortHandlers();
        }

        return $this->sorted;
    }

    private function sortHandlers()
    {
        krsort($this->handlers);
        $this->sorted = call_user_func_array('array_merge', $this->handlers);
    }
}
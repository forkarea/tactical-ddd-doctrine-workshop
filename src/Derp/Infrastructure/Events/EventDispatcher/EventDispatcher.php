<?php
namespace Derp\Infrastructure\Events\EventDispatcher;

/**
 *
 */
interface EventDispatcher
{
    public function dispatch($event);

    public function dispatchAll($events);

    public function addListener($eventClassName, $callableListener);
}

<?php
namespace Derp\Infrastructure\Events\EventStore;

use Derp\ER\Event\Event;

/**
 *
 */
interface EventStore
{
    public function store($aggregateId, Event $event);

    // In real life, you'd want this!
    // public function find($aggregateId);
}

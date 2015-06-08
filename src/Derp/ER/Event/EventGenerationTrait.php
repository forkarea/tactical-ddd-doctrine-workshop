<?php
namespace Derp\ER\Event;

/**
 *
 */
trait EventGenerationTrait
{
    private $events = [];

    public function pullEvents()
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }

    protected function raiseEvent(Event $event)
    {
        $this->events[] = $event;
    }
}

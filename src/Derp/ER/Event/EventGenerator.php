<?php
namespace Derp\ER\Event;

/**
 *
 */
interface EventGenerator
{
    public function getId();

    /**
     * @return Event[]
     */
    public function pullEvents();
}

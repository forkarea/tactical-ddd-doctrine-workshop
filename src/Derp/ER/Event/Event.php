<?php
namespace Derp\ER\Event;

abstract class Event implements \JsonSerializable
{
    /**
     * @var \DateTimeImmutable
     */
    protected $occurredAt;

    public function getOccurredAt()
    {
        return $this->occurredAt;
    }

    protected function recordAsOccurringNow()
    {
        $this->occurredAt = new \DateTimeImmutable('now');
    }
}

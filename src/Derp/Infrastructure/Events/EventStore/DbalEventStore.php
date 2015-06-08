<?php
namespace Derp\Infrastructure\Events\EventStore;

use Derp\ER\Event\Event;
use Doctrine\DBAL\Connection;

/**
 *
 */
class DbalEventStore implements EventStore
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function store($aggregateId, Event $event)
    {
        $this->connection->insert(
            'Event',
            [
                'aggregate_id' => $aggregateId,
                'type' => get_class($event),
                'data' => json_encode($event),
                'occurred_at' => $event->getOccurredAt()->format('Y-m-d H:i:s')
            ]
        );
    }
}

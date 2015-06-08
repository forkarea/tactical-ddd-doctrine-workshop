<?php
namespace Derp\Infrastructure\Events\Doctrine;

use Derp\ER\Event\EventGenerator;
use Derp\Infrastructure\Events\EventDispatcher\EventDispatcher;
use Derp\Infrastructure\Events\EventStore\EventStore;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Events;

class DomainEventCollector implements EventSubscriber
{
    /**
     * @var EventDispatcher
     */
    private $eventDispatcher;

    /**
     * @var EventStore
     */
    private $eventStore;

    /**
     * @param EventDispatcher $eventDispatcher
     * @param EventStore $eventStore
     */
    public function __construct(EventDispatcher $eventDispatcher, EventStore $eventStore)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->eventStore = $eventStore;
    }

    /**
     * @param object $entity
     */
    protected function collectEventsFromEntity($entity)
    {
        if (!$entity instanceof EventGenerator) {
            return;
        }

        foreach ($entity->pullEvents() as $event) {
            //$this->eventDispatcher->dispatch($event);
            //$this->eventStore->store($entity->getId(), $event);
        }
    }

    /**
     * @param OnFlushEventArgs $event
     */
    public function onFlush(OnFlushEventArgs $event)
    {
        $event->getEntityManager()->getConnection()->beginTransaction();

        $doctrineUnitOfWork = $event
            ->getEntityManager()
            ->getUnitOfWork();

        foreach ($doctrineUnitOfWork->getIdentityMap() as $className => $entities) {
            foreach ($entities as $entity) {
                $this->collectEventsFromEntity($entity);
            }
        }

        foreach ($doctrineUnitOfWork->getScheduledEntityDeletions() as $entity) {
            $this->collectEventsFromEntity($entity);
        }
    }

    public function postFlush(PostFlushEventArgs $event)
    {
        $event->getEntityManager()->getConnection()->commit();
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [
            Events::onFlush,
            Events::postFlush
        ];
    }
}


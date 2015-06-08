<?php
require_once 'vendor/autoload.php';
/** @var \Doctrine\ORM\EntityManager $entityManager */
$entityManager = require_once __DIR__ . '/bootstrap.php';
use Pimple\Container;
$container = new Container();



$container['entity_manager'] = function (Container $container) use ($entityManager) {

    $entityManager->getEventManager()->addEventSubscriber(
        $container['event_collector_plugin']
    );

    return $entityManager;
};

$container['db_connection'] = function () use ($entityManager) {
    return $entityManager->getConnection();
};

$container['event_dispatcher'] = function () {
    return new Derp\Infrastructure\Events\EventDispatcher\SimpleEventDispatcher();
};

$container['event_store'] = function (Container $container) {
    return new Derp\Infrastructure\Events\EventStore\DbalEventStore(
        $container['db_connection']
    );
};

$container['event_collector_plugin'] = function (Container $container) {
    return new \Derp\Infrastructure\Events\Doctrine\DomainEventCollector(
        $container['event_dispatcher'],
        $container['event_store']
    );
};

return $container;

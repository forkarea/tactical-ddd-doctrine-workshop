<?php
$container = require_once __DIR__ . '/di.php';
/** @var \Doctrine\ORM\EntityManager $entityManager */
$entityManager = $container['entity_manager'];


$person1 = EmergencyRoom\Person::announce('Test announce');
$entityManager->persist($person1);

$person2 = EmergencyRoom\Person::walkIn('Test walk-in');
$entityManager->persist($person2);

$entityManager->flush();



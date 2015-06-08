<?php
use Derp\ER;

$container = require_once __DIR__ . '/di.php';
/** @var \Doctrine\ORM\EntityManager $entityManager */
$entityManager = $container['entity_manager'];


$fullName = ER\FullName::fromParts('Peter', 'Decuyper');
$dateOfBirth = ER\BirthDate::fromYearMonthDayFormat('1974-07-28');
$sex = new ER\Sex(ER\Sex::MALE);
$personalInformation = ER\PersonalInformation::fromDetails($fullName, $dateOfBirth, $sex);

$patient = ER\Patient::walkIn($personalInformation, 'Test full info');


$entityManager->persist($patient);
$entityManager->flush();

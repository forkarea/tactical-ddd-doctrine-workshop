<?php

namespace Derp\ER;

interface PatientRepository
{
    public function add(Patient $patient);

    public function remove(Patient $patient);

    public function findByLastName($lastname);

    public function findByBirthDate(BirthDate $birthDate);
}

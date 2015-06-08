<?php

namespace Derp\Infrastructure;

use Derp\ER;
use Derp\ER\BirthDate;
use Derp\ER\Patient;
use Doctrine\ORM\EntityRepository;

class PatientRepository
    extends EntityRepository
    implements ER\PatientRepository
{
    /**
     * @param Patient $patient
     */
    public function add(Patient $patient)
    {
        $this->getEntityManager()->persist($patient);
    }

    public function remove(Patient $patient)
    {
        $this->getEntityManager()->remove($patient);
    }

    public function findByLastName($lastname)
    {
        $patients = $this->findBy(
            array(
                'personalInformation.name.lastName' => $lastname,
            )
        );

        return $patients;
    }

    public function findByBirthDate(BirthDate $birthDate)
    {
        $findDate = $birthDate->toDateTime()->format('Y-m-d');
        $patients = $this->findBy(
            array(
                'personalInformation.name.birthDate' => $findDate,
            )
        );

        return $patients;
    }

}

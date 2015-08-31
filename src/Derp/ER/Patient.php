<?php

namespace Derp\ER;

use Doctrine\ORM\Mapping as ORM;
use Derp\Infrastructure\PatientRepository;

/**
 * Class patient
 *
 * @ORM\Entity(repositoryClass="Derp\Infrastructure\PatientRepository")
 */
class Patient
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @ORM\Embedded(class="PersonalInformation", columnPrefix=false)
     * @var PersonalInformation
     */
    private $personalInformation;

    /**
     * What are the patients symptoms.
     *
     * @ORM\Column(type="string", nullable=TRUE)
     *
     * @var string
     */
    private $indication = null;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    private $arrived = false;

    /**
     * No public constructor.
     */
    private function __construct()
    {
    }


    /**
     * Create a new announced person.
     *
     * @param PersonalInformation $personalInformation
     * @param string $indication
     * @return Patient
     */
    public static function announce(
        PersonalInformation $personalInformation, $indication
    )
    {
        $patient = new Patient();
        $patient->personalInformation = $personalInformation;
        $patient->indication = $indication;
        return $patient;
    }

    /**
     * Patient walked in himself.
     *
     * @param PersonalInformation $personalInformation
     * @param string $indication
     * @return Patient
     */
    public static function walkIn(
        PersonalInformation $personalInformation, $indication
    )
    {
        $patient = static::announce($personalInformation, $indication);
        $patient->arrived = true;
        return $patient;
    }

    /**
     * Get the personal information.
     *
     * @return PersonalInformation
     */
    public function getPersonalInformation()
    {
        return $this->personalInformation;
    }

    /**
     * Get the indication message.
     *
     * @return string
     */
    public function getIndication()
    {
        return $this->indication;
    }

    /**
     * Check if the patient is arrived.
     *
     * @return bool
     */
    public function isArrived()
    {
        return $this->arrived;
    }

}

<?php

namespace Derp\ER;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class patient
 *
 * @ORM\Entity
 * @package Derp\ER
 */
class Patient
{
    /**
     * @var int
     *
     * @ORM\Id() @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @ORM\Embedded(class="PersonalInformation", columnPrefix=false)
     * @var PersonalInformation
     */
    private $personalInformation;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=TRUE)
     */
    private $indication = null;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $arrived = false;


    /**
     * Create a new announced person.
     *
     * @param string $indication
     *
     * @return Person
     */
    public static function announce(PersonalInformation $personalInformation, $indication)
    {
        $patient = new Patient();
        $patient->personalInformation = $personalInformation;
        $patient->indication = $indication;
        return $patient;
    }

    /**
     *
     */
    public static function walkIn(PersonalInformation $personalInformation, $indication)
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

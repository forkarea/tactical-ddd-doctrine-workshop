<?php

namespace EmergencyRoom;

use Doctrine\ORM\Mapping as ORM;
use Derp\ER;

/**
 * Class patient
 *
 * @ORM\Entity
 * @package EmergencyRoom
 */
class Person
{
    /**
     * @var int
     *
     * @ORM\Id() @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @var ER\PersonalInformation
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
    public static function announce($indication)
    {
        $person = new Person();
        $person->changeIndication($indication);

        return $person;
    }

    /**
     *
     */
    public static function walkIn($indication)
    {
        $person = Person::announce($indication);
        $person->setArrived();

        return $person;
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
     * Set the indication.
     *
     * @param string
     */
    public function changeIndication($indication)
    {
        \Assert\that($indication)
            ->notEmpty()
            ->string()
            ->betweenLength(1, 1000);

        $this->indication = $indication;
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

    /**
     * Patient is arrived.
     *
     * @throws Exception
     */
    public function setArrived()
    {
        if ($this->arrived) {
            throw new Exception('Patient is already arrived.');
        }

        $this->arrived = true;
    }
}
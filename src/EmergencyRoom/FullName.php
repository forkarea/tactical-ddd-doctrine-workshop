<?php

namespace EmergencyRoom;

class FullName
{
    /**
     * The fullname firstname part.
     *
     * @var string
     */
    private $firstname;

    /**
     * The fullname lastname part.
     *
     * @var string
     */
    private $surname;

    /**
     * Constructor
     *
     * @param string $firstname
     *      The firstname.
     * @param string $surname
     *      The lastname.
     */
    public function __construct($firstname, $surname)
    {
        $this->firstname = $firstname;
        $this->surname = $surname;
    }

    /**
     * Get the value.
     *
     * @return string
     */
    public function value()
    {
        return $this->getFirstname() . ' ' . $this->getSurname();
    }

    /**
     * Get the firstname.
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Get the surname.
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Get the string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->value();
    }
}

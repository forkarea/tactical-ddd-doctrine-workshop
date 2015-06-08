<?php

namespace EmergencyRoom;

class BirthDate
{
    /**
     * The stored birth date.
     *
     * @var DateTime
     */
    private $birthDate;

    /**
     * Construct a new Birthdate.
     *
     * @param string $date
     *      Date as YYYY-MM-DD
     */
    public function __construct($date)
    {
        $this->birthDate = new \DateTimeImmutable($date);
    }

    /**
     * Create from iso date format.
     *
     * @param string $date
     *     Date as YYY-MM-DD
     *
     * @return BirthDate
     */
    public static function fromString($date)
    {
        return new BirthDate($date);
    }

    /**
     * Get the value.
     *
     * @return DateTimeImmutable
     */
    public function value()
    {
        return $this->birthDate;
    }

    /**
     * To string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->birthDate->format('Y-M-d');
    }
}

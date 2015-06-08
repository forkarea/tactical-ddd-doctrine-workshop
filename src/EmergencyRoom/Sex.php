<?php

namespace EmergencyRoom;

use Rhumsaa\Uuid\Console\Exception;

/**
 * The Sex (gender) of a person.
 */
class Sex
{
    /**
     * Possible values.
     *
     * @var string
     */
    const MALE = 'Male';
    const FEMALE = 'Female';
    const INTERSEX = 'Intersex';

    /**
     * The sex value.
     *
     * @var string
     */
    private $sex;

    /**
     * Constructor.
     *
     * @param string $sex
     */
    public function __construct($sex)
    {
        if ($sex !== $this::MALE
            && $sex !== $this::FEMALE
            && $sex !== $this::INTERSEX
        ) {
            throw new Exception('Sex value does not exists.');
        }

        $this->sex = $sex;
    }

    /**
     * Get the current value.
     *
     * @return string
     */
    public function value()
    {
        return $this->sex;
    }

    
}
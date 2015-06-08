<?php

namespace EmergencyRoom;

class BirthDate
{
    /**
     * The stored birth date.
     *
     * @ORM\Column(type="datetime", name="birthDate")
     * @var \DateTimeImmutable
     */
    private $birthDate;

    /**
     * Construct a new Birthdate.
     *
     * @param \DateTimeImmutable $date
     */
    public function __construct(\DateTimeImmutable $date)
    {
        $this->birthDate = $date;
    }

    public static function fromYearMonthDayFormat($yearMonthDay)
    {
        return new BirthDate(
            DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $yearMonthDay .' 00:00:00')
        );
    }

    /**
     * @param integer $age
     * @return DateTimeImmutable
     */
    public static function fromEstimatedAge($age)
    {
        return new static(
            (new DateTimeImmutable('now'))->sub(new \DateInterval("P{$age}Y"))
        );
    }

    public function getCurrentAge()
    {
        $diff = $this->date->diff(new DateTimeImmutable('now'));
        return $diff->format('Y');
    }

    public function toDateTime()
    {
        return $this->date;
    }
}

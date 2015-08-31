<?php
namespace Derp\ER;

use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;
use DateInterval;

/**
 * @ORM\Embeddable()
 */
class BirthDate
{
    /**
     * @ORM\Column(type="date", name="birthDate")
     * @var DateTimeImmutable
     */
    private $date;

    /**
     * Construct by providing a Immutable date-time object.
     *
     * @param DateTimeImmutable $date
     */
    private function __construct(DateTimeImmutable $date)
    {
        $this->date = $date;
    }

    /**
     * Birth dates don't have a hour-min-second value.
     *
     * Construct a new BirthDate object from yyyy-mm-dd format.
     *
     * @param string $yearMonthDay
     *
     * @return BirthDate
     */
    public static function fromYearMonthDayFormat($yearMonthDay)
    {
        return new BirthDate(
            DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $yearMonthDay .' 00:00:00')
        );
    }

    /**
     * Birth date by estimated age.
     *
     * Patients can be brought in unconscious.
     *
     * @param integer $age
     *
     * @return DateTimeImmutable
     */
    public static function fromEstimatedAge($age)
    {
        $now = new DateTimeImmutable('now');
        $date = $now->sub(new DateInterval('P' . $age . 'Y'));

        return new static($date);
    }

    /**
     * Calculate age based on the birthdate.
     *
     * @return string
     */
    public function getCurrentAge()
    {
        $diff = $this->date->diff(new DateTimeImmutable('now'));
        return $diff->format('Y');
    }

    /**
     * Get the bitrh date as DateTimeImmutable object.
     *
     * @return DateTimeImmutable
     */
    public function toDateTime()
    {
        return $this->date;
    }
}

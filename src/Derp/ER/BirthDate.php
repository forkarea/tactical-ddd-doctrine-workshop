<?php
namespace Derp\ER;

use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;
use DateTimeInterface;
use DateInterval;

/**
 * @ORM\Embeddable()
 */
class BirthDate
{
    /**
     * @ORM\Column(type="datetime_immutable", name="birthDate")
     * @var DateTimeImmutable
     */
    private $date;

    private function __construct(DateTimeImmutable $date)
    {
        $this->date = $date;
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

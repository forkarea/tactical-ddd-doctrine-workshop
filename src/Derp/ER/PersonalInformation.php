<?php
namespace Derp\ER;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class PersonalInformation
{
    /**
     * @ORM\Embedded(class="FullName", columnPrefix=false)
     * @var FullName
     */
    private $name;

    /**
     * @ORM\Embedded(class="BirthDate", columnPrefix=false)
     * @var BirthDate
     */
    private $dateOfBirth;

    /**
     * @ORM\Embedded(class="Sex", columnPrefix=false)
     * @var Sex
     */
    private $sex;

    /**
     * Constructor can not be called directly.
     *
     * @param FullName $name
     * @param BirthDate $dateOfBirth
     * @param Sex $sex
     */
    private function __construct(FullName $name, BirthDate $dateOfBirth, Sex $sex)
    {
        $this->name = $name;
        $this->dateOfBirth = $dateOfBirth;
        $this->sex = $sex;
    }

    /**
     * We know who the patient is.
     *
     * @param FullName $name
     * @param BirthDate $date
     * @param Sex $sex
     *
     * @return PersonalInformation
     */
    public static function fromDetails(FullName $name, BirthDate $date, Sex $sex)
    {
        return new static($name, $date, $sex);
    }

    /**
     * We don't know who the person is.
     *
     * @param Sex $sex
     * @param int $estimatedAge
     *
     * @return PersonalInformation
     */
    public static function anonymous(Sex $sex, $estimatedAge)
    {
        $fullName = ($sex->isFemale())
            ? new FullName('Jane', 'Doe')
            : new FullName('John', 'Doe');
        $birthDate = BirthDate::fromEstimatedAge($estimatedAge);

        return new static($fullName, $birthDate, $sex);
    }

    /**
     * @return FullName
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return BirthDate
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @return Sex
     */
    public function getSex()
    {
        return $this->sex;
    }
}

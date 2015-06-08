<?php
namespace Derp\ER;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class Sex
{
    const MALE = 'male';

    const FEMALE = 'female';

    const INTERSEX = 'intersex';

    /**
     * @ORM\Column(name="sex", type="string", length=10)
     * @var string
     */
    private $value;

    public function __construct($sex)
    {
        if ($sex !== static::MALE && $sex !== static::FEMALE && $sex !== static::INTERSEX) {
            throw new \InvalidArgumentException('Invalid sex provided');
        }

        $this->value = $sex;
    }

    public function equals(Sex $otherSex)
    {
        return $this->value === $otherSex->value;
    }



    public function isMale()
    {
        return $this->value === static::MALE;
    }

    public function isFemale()
    {
        return $this->value === static::FEMALE;
    }

    public function isIntersex()
    {
        return $this->value === static::INTERSEX;
    }
}

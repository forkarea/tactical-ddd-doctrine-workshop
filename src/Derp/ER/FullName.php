<?php
namespace Derp\ER;

// Needed for the annotations.
use Doctrine\ORM\Mapping as ORM;

/**
 * The FullName object will be embedded into other objects.
 *
 * Doctrine supports this:
 *
 * @ORM\Embeddable()
 */
class FullName
{
    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $firstName;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $lastName;

    /**
     * Create fullname based on its parts.
     *
     * @param $firstName
     * @param $lastName
     */
    public function __construct($firstName, $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    /**
     * Get the first name.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Get the last name.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Get the full name (usable for display).
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }
}

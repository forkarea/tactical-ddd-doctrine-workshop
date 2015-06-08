<?php
namespace Derp\ER\Pod;

class PodId
{
    private $id;

    private function __construct() {}

    public static function fromString($string)
    {
        $patientId = new static();
        $patientId->id = $string;

        return $patientId;
    }

    public function __toString()
    {
        return $this->id;
    }
}

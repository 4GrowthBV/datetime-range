<?php

namespace InThere\DateTimeRange;

class Boundary
{
    /**
     * Holds if this is a lower or upper boundary.
     * @var bool
     */
    private $lower = true;

    /**
     * Holds if this is a inclusive or exclusive boundary.
     * @var bool
     */
    private $inclusive = true;

    /**
     * Bound constructor.
     * @param bool $lower
     * @param bool $inclusive
     */
    public function __construct($lower = true, $inclusive = true)
    {
        $this->setLower($lower);
        $this->setInclusive($inclusive);
    }

    /**
     * Returns if the boundary is lower (or upper).
     * @return bool
     */
    public function isLower()
    {
        return $this->lower;
    }

    /**
     * Stores if the boundary is lower or upper.
     * @param bool $lower
     */
    private function setLower($lower)
    {
        $this->lower = $lower;
    }

    /**
     * Returns if the boundary is inclusive (or exclusive).
     * @return bool
     */
    public function isInclusive()
    {
        return $this->inclusive;
    }

    /**
     * Stores if the boundary is inclusive of exclusive.
     * @param bool $inclusive
     */
    private function setInclusive($inclusive)
    {
        $this->inclusive = $inclusive;
    }
}

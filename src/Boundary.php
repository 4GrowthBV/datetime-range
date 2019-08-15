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
    public function __construct(bool $lower = true, bool $inclusive = true)
    {
        $this->setLower($lower);
        $this->setInclusive($inclusive);
    }

    /**
     * Returns if the boundary is lower (or upper).
     * @return bool
     */
    public function isLower(): bool
    {
        return $this->lower;
    }

    /**
     * Stores if the boundary is lower or upper.
     * @param bool $lower
     */
    private function setLower(bool $lower): void
    {
        $this->lower = $lower;
    }

    /**
     * Returns if the boundary is inclusive (or exclusive).
     * @return bool
     */
    public function isInclusive(): bool
    {
        return $this->inclusive;
    }

    /**
     * Stores if the boundary is inclusive of exclusive.
     * @param bool $inclusive
     */
    private function setInclusive(bool $inclusive): void
    {
        $this->inclusive = $inclusive;
    }

    /**
     * Determines if the current boundary differs from the provided boundary. Returns true when differences are found.
     * @param Boundary $boundary
     * @return bool
     */
    public function diff(Boundary $boundary): bool
    {
        return (
            $this->isLower() !== $boundary->isLower() ||
            $this->isInclusive() !== $boundary->isInclusive()
        );
    }
}

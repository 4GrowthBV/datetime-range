<?php

namespace InThere\DateTimeRange;

use DateTimeInterface;

class Range
{
    /**
     * Holds the dateTime.
     * @var null|DateTimeInterface
     */
    private $dateTime = null;

    /**
     * Holds the boundary.
     * @var Boundary
     */
    private $boundary;

    /**
     * Holds if the range is infinity.
     * @var bool
     */
    private $infinity = false;

    /**
     * Range constructor.
     * @param DateTimeInterface|null $dateTime
     * @param Boundary $boundary
     * @param bool $infinity
     */
    public function __construct(?DateTimeInterface $dateTime = null, Boundary $boundary = null, bool $infinity = false)
    {
        $boundary = $boundary ?? new Boundary();
        $this->setDateTime($dateTime);
        $this->setBoundary($boundary);
        $this->setInfinity($infinity);
    }

    /**
     * Returns if the range is infinity.
     * @return bool
     */
    public function isInfinity(): bool
    {
        return $this->infinity;
    }

    /**
     * Stores if the range is infinity.
     * @param bool $infinity
     */
    private function setInfinity(bool $infinity): void
    {
        $this->infinity = $infinity;
    }

    /**
     * Returns the boundary.
     * @return Boundary
     */
    public function getBoundary(): Boundary
    {
        return $this->boundary;
    }

    /**
     * Stores the boundary.
     * @param Boundary $boundary
     */
    private function setBoundary(Boundary $boundary): void
    {
        $this->boundary = $boundary;
    }

    /**
     * Returns the range value.
     * @return null|DateTimeInterface
     */
    public function getDateTime(): ?DateTimeInterface
    {
        return $this->dateTime;
    }

    /**
     * Stores the range value.
     * @param null|DateTimeInterface $dateTime
     */
    private function setDateTime(?DateTimeInterface $dateTime = null): void
    {
        $this->dateTime = $dateTime;
    }

    /**
     * Determines if the current range differs from the provided range. Returns true when differences are found.
     * @param Range $range
     * @return bool
     */
    public function diff(Range $range): bool
    {
        // Determine if both ranges are provided with a datetime
        if (
            (is_null($this->getDateTime()) && ! is_null($range->getDateTime())) ||
            (! is_null($this->getDateTime()) && is_null($range->getDateTime()))
        ) {
            return true;
        }

        // Both ranges have datetimes, check if they are the same
        if (! is_null($this->getDateTime()) && ! is_null($range->getDateTime()) && $this->getDateTime()->getTimestamp() !== $range->getDateTime()->getTimestamp()) {
            return true;
        }

        // Determine if the boundaries differ
        if ($this->getBoundary()->diff($range->getBoundary())) {
            return true;
        }

        // Determine if the infinity values differ
        return ($this->isInfinity() !== $range->isInfinity());
    }
}

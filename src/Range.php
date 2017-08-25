<?php

namespace InThere\DateTimeRange;

use DateTime;
use DateTimeZone;

class Range
{
    /**
     * Holds the dateTime.
     * @var null|DateTime
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
     * @param null $dateTime
     * @param Boundary $boundary
     * @param bool $infinity
     */
    public function __construct($dateTime = null, Boundary $boundary, $infinity = false)
    {
        $this->setDateTime($dateTime);
        $this->setBoundary($boundary);
        $this->setInfinity($infinity);
    }

    /**
     * Returns if the range is infinity.
     * @return bool
     */
    public function isInfinity()
    {
        return $this->infinity;
    }

    /**
     * Stores if the range is infinity.
     * @param bool $infinity
     */
    private function setInfinity($infinity)
    {
        $this->infinity = $infinity;
    }

    /**
     * Returns the boundary.
     * @return Boundary
     */
    public function getBoundary()
    {
        return $this->boundary;
    }

    /**
     * Stores the boundary.
     * @param Boundary $boundary
     */
    private function setBoundary(Boundary $boundary)
    {
        $this->boundary = $boundary;
    }

    /**
     * Returns the range value.
     * @return null|DateTime
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * Stores the range value.
     * @param null|DateTime $dateTime
     */
    private function setDateTime(DateTime $dateTime = null)
    {
        $this->dateTime = $dateTime;
    }
}

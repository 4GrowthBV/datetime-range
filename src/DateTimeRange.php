<?php

namespace InThere\DateTimeRange;

class DateTimeRange
{
    /**
     * Holds the lower range.
     * @var Range
     */
    private $lowerRange;

    /**
     * Holds the upper range.
     * @var Range
     */
    private $upperRange;

    /**
     * DateTimeRange constructor.
     * @param Range $lowerRange
     * @param Range $upperRange
     */
    public function __construct(Range $lowerRange, Range $upperRange)
    {
        $this->setLowerRange($lowerRange);
        $this->setUpperRange($upperRange);
    }

    /**
     * Returns the lower range.
     * @return Range
     */
    public function getLowerRange()
    {
        return $this->lowerRange;
    }

    /**
     * Stores the lower range.
     * @param Range $lowerRange
     */
    private function setLowerRange(Range $lowerRange)
    {
        $this->lowerRange = $lowerRange;
    }

    /**
     * Returns the upper range.
     * @return Range
     */
    public function getUpperRange()
    {
        return $this->upperRange;
    }

    /**
     * Stores the upper range.
     * @param Range $upperRange
     */
    private function setUpperRange(Range $upperRange)
    {
        $this->upperRange = $upperRange;
    }

    /**
     * Determines if the provided range differs from the current. Returns true when differences are found.
     * @param DateTimeRange $dateTimeRange
     * @return bool
     */
    public function diff(DateTimeRange $dateTimeRange)
    {
        return (
            $this->getLowerRange()->diff($dateTimeRange->getLowerRange()) ||
            $this->getUpperRange()->diff($dateTimeRange->getUpperRange())
        );
    }
}

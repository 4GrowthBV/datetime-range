<?php

namespace InThere\DateTimeRange;

use DateTime;
use DateTimeZone;

class Parser
{
    /**
     * Holds the value from the database.
     * @var string
     */
    private $value = '';

    /**
     * Holds the timezone.
     * @var DateTimeZone
     */
    private $dateTimeZone;

    /**
     * Holds the validation pattern.
     * @var string
     */
    private $pattern = '/^(\[|\()' .
            '("\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}(.\d+)?\+\d{2,4}"|\-infinity|null|),' .
            '("\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}(.\d+)?\+\d{2,4}"|infinity|null|)' .
        '(\]|\))$/i';

    /**
     * Parser constructor.
     * @param string $value
     * @param DateTimeZone $timeZone
     */
    public function __construct($value, DateTimeZone $timeZone)
    {
        $this->setValue($value);
        $this->setDateTimeZone($timeZone);
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    private function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Returns the timezone.
     * @return DateTimeZone
     */
    public function getDateTimeZone()
    {
        return $this->dateTimeZone;
    }

    /**
     * Stores the timezone.
     * @param DateTimeZone $timeZone
     */
    public function setDateTimeZone(DateTimeZone $timeZone)
    {
        $this->dateTimeZone = $timeZone;
    }

    /**
     * Parse the date time range value parts.
     * @return bool|array
     */
    private function parseParts()
    {
        $result = preg_match($this->pattern, $this->getValue(), $matches);
        if ($result == false) {
            return false;
        }

        return $matches;
    }

    /**
     * Parses the boundary.
     * @param string $boundarySymbol
     * @param bool $lower
     * @return Boundary
     */
    private function parseBoundary($boundarySymbol, $lower = true)
    {
        // Determine if the symbol is inclusive or exclusive (by default inclusive)
        $inclusive = ! in_array($boundarySymbol, ['(', ')']);

        return new Boundary($lower, $inclusive);
    }

    /**
     * Parse the range.
     * @param string $rangeString
     * @param Boundary $boundary
     * @return Range
     */
    private function parseRangePart($rangeString, Boundary $boundary)
    {
        // Determines if the range is infinity or null (which will be handled as infinity and is presented as '')
        if (preg_match('/(infinity|null)/i', $rangeString) != false || empty($rangeString)) {
            return new Range(null, $boundary, true);
        }

        // Strip the date string from quotes
        $formattedRangeString = str_replace('"', '', $rangeString);

        // Create the date
        $date = new DateTime($formattedRangeString, $this->getDateTimeZone());

        return new Range($date, $boundary, false);
    }

    /**
     * Parses the dateTimeRange
     * @return null|DateTimeRange
     */
    public function parse()
    {
        // Parse the parts
        $parts = $this->parseParts();

        // When the parts can't be parsed, the provided value is invalid
        if (! $parts) {
            return null;
        }

        // Determines the boundaries
        $lowerBoundary = $this->parseBoundary($parts[1]);
        $upperBoundary = $this->parseBoundary($parts[6], false);

        // Parse the time range
        return new DateTimeRange(
            $this->parseRangePart($parts[2], $lowerBoundary),
            $this->parseRangePart($parts[4], $upperBoundary)
        );
    }
}

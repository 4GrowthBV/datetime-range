<?php

namespace InThere\DateTimeRange;

class Transformer
{
    /**
     * Holds the DateTimeRange
     * @var DateTimeRange
     */
    private $dateTimeRange;

    /**
     * Transformer constructor.
     * @param DateTimeRange $dateTimeRange
     */
    public function __construct(DateTimeRange $dateTimeRange)
    {
        $this->setDateTimeRange($dateTimeRange);
    }

    /**
     * Stores the DateTimeRange.
     * @param DateTimeRange $dateTimeRange
     */
    private function setDateTimeRange(DateTimeRange $dateTimeRange): void
    {
        $this->dateTimeRange = $dateTimeRange;
    }

    /**
     * Returns the boundary as string presentation.
     * @param Boundary $boundary
     * @return string
     */
    private function getBoundarySymbol(Boundary $boundary): string
    {
        if ($boundary->isInclusive() && $boundary->isLower()) {
            return '[';
        }
        if ($boundary->isInclusive() && ! $boundary->isLower()) {
            return ']';
        }
        if (! $boundary->isInclusive() && $boundary->isLower()) {
            return '(';
        }

        return ')';
    }

    /**
     * Returns the range as string presentation.
     * @param Range $range
     * @param bool $lower
     * @return string
     */
    private function getRangeString(Range $range, bool $lower = true): string
    {
        if ($range->isInfinity()) {
            return sprintf('%sinfinity', $lower ? '-' : '');
        }

        return sprintf('"%s"', $range->getDateTime()->format('Y-m-d H:i:s.uO'));
    }

    /**
     * Returns the DateTimeRange as string presentation.
     * @return string
     */
    public function transform(): string
    {
        return sprintf(
            '%s%s,%s%s',
            $this->getBoundarySymbol($this->dateTimeRange->getLowerRange()->getBoundary()),
            $this->getRangeString($this->dateTimeRange->getLowerRange()),
            $this->getRangeString($this->dateTimeRange->getUpperRange(), false),
            $this->getBoundarySymbol($this->dateTimeRange->getUpperRange()->getBoundary())
        );
    }

    /**
     * Returns the DateTimeRange as string presentation.
     * @return string
     */
    public function __toString(): string
    {
        return $this->transform();
    }
}

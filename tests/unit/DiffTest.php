<?php

use InThere\DateTimeRange\Boundary;
use InThere\DateTimeRange\DateTimeRange;
use InThere\DateTimeRange\Range;
use PHPUnit\Framework\TestCase;

class DiffTest extends TestCase
{
    public function testSameBoundary()
    {
        $boundary1 = new Boundary(true, true);
        $boundary2 = new Boundary(true, true);
        $this->assertFalse($boundary1->diff($boundary2));
    }

    public function testDifferentBoundary()
    {
        $boundary1 = new Boundary(true, false);
        $boundary2 = new Boundary(true, true);
        $this->assertTrue($boundary1->diff($boundary2));

        $boundary1 = new Boundary(false, true);
        $boundary2 = new Boundary(true, true);
        $this->assertTrue($boundary1->diff($boundary2));

        $boundary1 = new Boundary(false, false);
        $boundary2 = new Boundary(true, true);
        $this->assertTrue($boundary1->diff($boundary2));
    }

    public function testSameRange()
    {
        $range1 = new Range(null, new Boundary(true, true));
        $range2 = new Range(null, new Boundary(true, true));
        $this->assertFalse($range1->diff($range2));

        $dateTime = new DateTime('now');
        $range1 = new Range($dateTime, new Boundary(true, true));
        $range2 = new Range($dateTime, new Boundary(true, true));
        $this->assertFalse($range1->diff($range2));
    }

    public function testDifferentRange()
    {
        $dateTime = new DateTime('now');

        $range1 = new Range($dateTime, new Boundary(true, true));
        $range2 = new Range(null, new Boundary(true, true));
        $this->assertTrue($range1->diff($range2));

        $range1 = new Range($dateTime, new Boundary(true, true), true);
        $range2 = new Range($dateTime, new Boundary(true, true));
        $this->assertTrue($range1->diff($range2));

        $range1 = new Range($dateTime, new Boundary(true, false));
        $range2 = new Range($dateTime, new Boundary(true, true));
        $this->assertTrue($range1->diff($range2));

        $dateTime2 = DateTime::createFromFormat('Y-m-d', '2016-01-01');
        $range1 = new Range($dateTime2, new Boundary(true, true), true);
        $range2 = new Range($dateTime, new Boundary(true, true));
        $this->assertTrue($range1->diff($range2));
    }

    public function testSame()
    {
        $dateTimeRange1 = new DateTimeRange(
            new Range(null, new Boundary(true, true)),
            new Range(null, new Boundary(true, true))
        );
        $dateTimeRange2 = new DateTimeRange(
            new Range(null, new Boundary(true, true)),
            new Range(null, new Boundary(true, true))
        );
        $this->assertFalse($dateTimeRange1->diff($dateTimeRange2));
    }

    public function testDifferent()
    {
        $dateTime = new DateTime('now');

        $dateTimeRange1 = new DateTimeRange(
            new Range($dateTime, new Boundary(true, true)),
            new Range($dateTime, new Boundary(false, true))
        );
        $dateTimeRange2 = new DateTimeRange(
            new Range($dateTime, new Boundary(true, true)),
            new Range($dateTime, new Boundary(true, true))
        );
        $this->assertTrue($dateTimeRange1->diff($dateTimeRange2));
    }
}

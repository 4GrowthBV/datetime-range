<?php

use InThere\DateTimeRange\Boundary;
use InThere\DateTimeRange\DateTimeRange;
use InThere\DateTimeRange\Parser;
use InThere\DateTimeRange\Range;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    public function testParserWithBothDatesInclusive()
    {
        $dateTimeZone = new DateTimeZone('UTC');

        $parser = new Parser('["2015-08-14 16:07:28.956968+02","2018-08-14 16:07:28.956968+02"]', $dateTimeZone);
        $dateTimeRange = $parser->parse();

        $this->assertNotNull($dateTimeRange);
        $this->assertInstanceOf(DateTimeRange::class, $dateTimeRange);

        $lowerRange = $dateTimeRange->getLowerRange();
        $this->assertInstanceOf(Range::class, $lowerRange);
        $this->assertFalse($lowerRange->isInfinity());
        $this->assertInstanceOf(DateTime::class, $lowerRange->getDateTime());
        $this->assertSame('2015-08-14 16:07:28', $lowerRange->getDateTime()->format('Y-m-d H:i:s'));

        $lowerBoundary = $lowerRange->getBoundary();
        $this->assertInstanceOf(Boundary::class, $lowerBoundary);
        $this->assertTrue($lowerBoundary->isInclusive());
        $this->assertTrue($lowerBoundary->isLower());

        $upperRange = $dateTimeRange->getUpperRange();
        $this->assertInstanceOf(Range::class, $upperRange);
        $this->assertFalse($upperRange->isInfinity());
        $this->assertInstanceOf(DateTime::class, $upperRange->getDateTime());
        $this->assertSame('2018-08-14 16:07:28', $upperRange->getDateTime()->format('Y-m-d H:i:s'));

        $upperBoundary = $upperRange->getBoundary();
        $this->assertInstanceOf(Boundary::class, $upperBoundary);
        $this->assertTrue($upperBoundary->isInclusive());
        $this->assertFalse($upperBoundary->isLower());
    }

    public function testParserWithBothDatesExclusive()
    {
        $dateTimeZone = new DateTimeZone('UTC');

        $parser = new Parser('("2015-08-14 16:07:28.956968+02","2018-08-14 16:07:28.956968+02")', $dateTimeZone);
        $dateTimeRange = $parser->parse();

        $this->assertNotNull($dateTimeRange);
        $this->assertInstanceOf(DateTimeRange::class, $dateTimeRange);

        $lowerRange = $dateTimeRange->getLowerRange();
        $lowerBoundary = $lowerRange->getBoundary();
        $this->assertInstanceOf(Boundary::class, $lowerBoundary);
        $this->assertFalse($lowerBoundary->isInclusive());
        $this->assertTrue($lowerBoundary->isLower());

        $upperRange = $dateTimeRange->getUpperRange();
        $upperBoundary = $upperRange->getBoundary();
        $this->assertInstanceOf(Boundary::class, $upperBoundary);
        $this->assertFalse($upperBoundary->isInclusive());
        $this->assertFalse($upperBoundary->isLower());
    }

    public function testParserWithInfiniteDates()
    {
        $dateTimeZone = new DateTimeZone('UTC');

        $parser = new Parser('[-infinity,"2018-08-14 16:07:28.956968+02"]', $dateTimeZone);
        $dateTimeRange = $parser->parse();

        $this->assertNotNull($dateTimeRange);
        $this->assertInstanceOf(DateTimeRange::class, $dateTimeRange);

        $lowerRange = $dateTimeRange->getLowerRange();
        $this->assertNull($lowerRange->getDateTime());
        $this->assertTrue($lowerRange->isInfinity());

        $lowerBoundary = $lowerRange->getBoundary();
        $this->assertInstanceOf(Boundary::class, $lowerBoundary);
        $this->assertTrue($lowerBoundary->isInclusive());
        $this->assertTrue($lowerBoundary->isLower());

        $upperRange = $dateTimeRange->getUpperRange();
        $this->assertInstanceOf(Range::class, $upperRange);
        $this->assertFalse($upperRange->isInfinity());
        $this->assertInstanceOf(DateTime::class, $upperRange->getDateTime());
        $this->assertSame('2018-08-14 16:07:28', $upperRange->getDateTime()->format('Y-m-d H:i:s'));

        $upperBoundary = $upperRange->getBoundary();
        $this->assertInstanceOf(Boundary::class, $upperBoundary);
        $this->assertTrue($upperBoundary->isInclusive());
        $this->assertFalse($upperBoundary->isLower());
    }

    public function testParserWithInvalidValues()
    {
        $dateTimeZone = new DateTimeZone('UTC');

        $parser = new Parser('Hello World!', $dateTimeZone);
        $dateTimeRange = $parser->parse();

        $this->assertNull($dateTimeRange);
    }

    public function testParserWithNullValues()
    {
        $dateTimeZone = new DateTimeZone('UTC');

        $parser = new Parser('("2015-08-14 16:07:28.956968+02",)', $dateTimeZone);
        $dateTimeRange = $parser->parse();

        $this->assertNotNull($dateTimeRange);
        $this->assertInstanceOf(DateTimeRange::class, $dateTimeRange);

        $lowerRange = $dateTimeRange->getLowerRange();
        $this->assertInstanceOf(Range::class, $lowerRange);
        $this->assertFalse($lowerRange->isInfinity());
        $this->assertInstanceOf(DateTime::class, $lowerRange->getDateTime());
        $this->assertSame('2015-08-14 16:07:28', $lowerRange->getDateTime()->format('Y-m-d H:i:s'));

        $lowerBoundary = $lowerRange->getBoundary();
        $this->assertInstanceOf(Boundary::class, $lowerBoundary);
        $this->assertFalse($lowerBoundary->isInclusive());
        $this->assertTrue($lowerBoundary->isLower());

        $upperRange = $dateTimeRange->getUpperRange();
        $this->assertInstanceOf(Range::class, $upperRange);
        $this->assertTrue($upperRange->isInfinity());
        $this->assertNull($upperRange->getDateTime());

        $upperBoundary = $upperRange->getBoundary();
        $this->assertInstanceOf(Boundary::class, $upperBoundary);
        $this->assertFalse($upperBoundary->isInclusive());
        $this->assertFalse($upperBoundary->isLower());
    }
}

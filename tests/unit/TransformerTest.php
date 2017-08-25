<?php

use InThere\DateTimeRange\Parser;
use InThere\DateTimeRange\Transformer;
use PHPUnit\Framework\TestCase;

class TransformerTest extends TestCase
{
    public function testTransformerWithBothDates()
    {
        $dateTimeZone = new DateTimeZone('UTC');

        $parser = new Parser('["2015-08-14 16:07:28.956968+02","2018-08-14 16:07:28.956968+02"]', $dateTimeZone);
        $dateTimeRange = $parser->parse();

        $transformer = new Transformer($dateTimeRange);

        $this->assertSame('["2015-08-14 16:07:28.956968+0200","2018-08-14 16:07:28.956968+0200"]', $transformer->transform());
    }

    public function testTransformerWithInfinityDates()
    {
        $dateTimeZone = new DateTimeZone('UTC');

        $parser = new Parser('(-infinity,"2018-08-14 16:07:28.956968+02")', $dateTimeZone);
        $dateTimeRange = $parser->parse();

        $transformer = new Transformer($dateTimeRange);

        $this->assertSame('(-infinity,"2018-08-14 16:07:28.956968+0200")', $transformer->transform());
    }

    public function testTransformerCasting()
    {
        $dateTimeZone = new DateTimeZone('UTC');

        $parser = new Parser('(-infinity,"2018-08-14 16:07:28.956968+02")', $dateTimeZone);
        $dateTimeRange = $parser->parse();

        $transformer = new Transformer($dateTimeRange);

        $this->assertSame('(-infinity,"2018-08-14 16:07:28.956968+0200")', (string)$transformer);
    }
}

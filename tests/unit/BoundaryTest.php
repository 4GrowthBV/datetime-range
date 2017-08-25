<?php

use InThere\DateTimeRange\Boundary;
use PHPUnit\Framework\TestCase;

class BoundaryTest extends TestCase
{
    public function testLowerInclusiveBoundary()
    {
        $boundary = new Boundary(true, true);
        $this->assertTrue($boundary->isLower());
        $this->assertTrue($boundary->isInclusive());
    }

    public function testLowerExclusiveBoundary()
    {
        $boundary = new Boundary(true, false);
        $this->assertTrue($boundary->isLower());
        $this->assertFalse($boundary->isInclusive());
    }

    public function testUpperInclusiveBoundary()
    {
        $boundary = new Boundary(false, true);
        $this->assertFalse($boundary->isLower());
        $this->assertTrue($boundary->isInclusive());
    }

    public function testUpperExclusiveBoundary()
    {
        $boundary = new Boundary(false, false);
        $this->assertFalse($boundary->isLower());
        $this->assertFalse($boundary->isInclusive());
    }
}

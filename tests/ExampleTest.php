<?php
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testSum()
    {
        function sum($a, $b) {
            return $a + $b;
        }

        $a = 2;
        $b = 3;
        $this->assertEquals(5, sum($a, $b));
    }
}
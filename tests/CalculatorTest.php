<?php
use \PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function testAdd()
    {
        $calculator = new App\Calculator;
        $calculator->setOperands([5,20]);
        $this->assertEquals(25, $calculator->add());
    }
}
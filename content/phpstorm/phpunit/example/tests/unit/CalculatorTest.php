<?php
/**
 * @copyright Copyright (c) 2017, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Tests\Unit;


use OlegChulakovStudio\Calculator;

class CalculatorTest extends \PHPUnit_Framework_TestCase
{

    public function testSum()
    {
        $calculator = new Calculator();
        $this->assertEquals(7, $calculator->sum(5,2));
    }

    public function testSub()
    {
        $calculator = new Calculator();
        $this->assertEquals(7, $calculator->sub(9,2));
    }

    public function testJson()
    {
        $this->assertEquals('{
  "name" : "Андрей",
  "surname" : "Иванов"
}', '{
  "name" : "Андрей",
  "surname" : "Попов"
}');
    }
}

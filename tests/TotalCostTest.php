<?php

class TotalCostTest extends PHPUnit_Framework_TestCase
{
	protected $cost;
	public function setUp(){
		$this->cost = new TotalCost(new MonthlyPayment);
	}

	public function testEvaluateTotalCostFullAmortization(){
		$result = $this->cost->evaluate(100000, 10, 120, FALSE);
		$this->assertEquals(round($result), 158581);
	}

	public function testEvaluateTotalCostInterestOnlyAmortization(){
		$result = $this->cost->evaluate(100000, 10, 120, TRUE);
		$this->assertEquals(200000, round($result));
	}

}
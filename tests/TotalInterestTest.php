<?php 

class TotalInterestTest extends PHPUnit_Framework_TestCase{

	protected $ti;
	public function setUp(){
		$this->ti = new TotalInterest(new TotalCost(new MonthlyPayment));
	}

	public function testEvaluateTotalInterest(){
		$result = $this->ti->evaluate(100000, 10, 120, FALSE);
		$this->assertEquals(58581, round($result));
	}
}
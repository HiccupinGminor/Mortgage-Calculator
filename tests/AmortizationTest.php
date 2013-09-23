<?php 

class AmortizationTest extends PHPUnit_Framework_TestCase{

	protected $am;
	public function setUp(){
		$this->am = new Amortization(new MonthlyPayment);
	}

	public function testAmortizationReturnsArray(){
		$result = $this->am->evaluate(100000, .10, 120, FALSE);
		$this->assertTrue(is_array($result), 'Check that amortization result is an array');
	}

	public function testEvaluateAmortizationInterestOnly(){
		$result = $this->am->evaluate(100000, .10, 120, TRUE);
		$this->assertEquals(8.33, $result[0][0], 'Check the payment amount', .01);
		$this->assertEquals(8.33, $result[0][1], 'Check the interest paid down amount', .01);
		$this->assertEquals(100000, $result[0][3], 'Check the principal paid down amount');
	}
}
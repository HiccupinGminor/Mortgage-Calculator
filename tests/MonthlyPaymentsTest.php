<?php

class MonthlyPaymentTest extends PHPUnit_Framework_TestCase{

	protected $payment;
	public function setUp(){
		$this->payment = new MonthlyPayment;
	}

	public function testEvaluateMonthlyPaymentWithRegularAmortization(){
		$result = $this->payment->evaluate(100000, 10, 120, FALSE);
		$this->assertEquals(round($result), 1322);
	}

	public function testEvaluateMonthlyPaymentWithInterestOnlyAmortization(){
		$result = $this->payment->evaluate(100000, 10, 120, TRUE);
		$this->assertEquals(round($result), 833);
	}
}
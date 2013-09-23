<?php 

class MortgageCalculatorTest extends PHPUnit_Framework_TestCase{

	protected $calc;

	public function setUp(){
		$this->calc = new MortgageCalculator;
	}

	public function testSetParams(){
		$params = array('principal' => 1000, 'rate' => 10, 'months' => 120, 'io' => FALSE);
		$this->calc->setParams($params);

		$this->assertEquals(1000, $this->calc->principal);
		$this->assertEquals(0.0083, $this->calc->rate, '', .0001);
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testThrowsExceptionIfTryToCalculateBeforeParamsAreSet(){
		$this->calc->calculate(new MonthlyPayment);
	}

	/**
	 * @expectedException InvalidArgumentException
	 */	
	public function testThrowExceptionIfParamsArgumentIsntArray(){
		$this->calc->setParams('foo');
	}

}
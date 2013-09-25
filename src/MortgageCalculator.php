<?php

/**
 * A mortgage-specific calculator library
 *
 * PHP Version 5.4.3
 * @author Chris Chung
 * @license http://opensource.org/licenses/MIT
 * 
 */
class MortgageCalculator{

	public $principal;
	public $rate;
	public $months;
	public $io = FALSE;

	protected $function;

	/**
	 * Calculates a result based on a predefined function.
	 * @param  object instance of a calculator function class
	 * @return void
	 */
	public function calculate($function){
		if( !isset($this->principal) || !isset($this->rate) || !isset($this->months) || !isset($this->io))
			throw new InvalidArgumentException;

		$this->$function->evaluate($this->principal, $this->rate, $this->months, $this->io);
	}

	/**
	 * Changes an annual rate to a monthly rate (float)
	 * @return void
	 */
	protected function adjustAnnualRate(){
		$this->rate = $this->rate/12/100;
	}

	/**
	 * Setter method
	 * @param $params array of parameters
	 */
	public function setParams($params){
		if(!is_array($params))
			throw new InvalidArgumentException;

		foreach($params as $key => $value){
			$this->$key = $value;
		}
		$this->adjustAnnualRate();
	}

}
<?php


class MortgageCalculator{

	public $principal;
	public $rate;
	public $months;
	public $io = FALSE;

	protected $function;

	public function calculate($function){
		if( !isset($this->principal) || !isset($this->rate) || !isset($this->months) || !isset($this->io))
			throw new InvalidArgumentException;

		$this->$function->evaluate($this->principal, $this->rate, $this->months, $this->io);
	}

	protected function adjustAnnualRate(){
		$this->rate = $this->rate/12/100;
	}

	public function setParams($params){
		if(!is_array($params))
			throw new InvalidArgumentException;

		foreach($params as $key => $value){
			$this->$key = $value;
		}
		$this->adjustAnnualRate();
	}

}
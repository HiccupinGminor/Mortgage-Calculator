<?php namespace calculator;

/**
 * A mortgage calculator class
 * @author Chris Chung hiccupingminor@gmail.com
 */
class Calculator{
	
	/**
	 * The beginning loan balance, the amount initally owed
	 * @var int
	 */
	private $principal;

	/**
	 * Interest rate
	 * @var int
	 */
	private $ir;

	/**
	 * Length of payback period in months
	 * @var int
	 */
	private $months;

	/**
	 * Interest only - is this loan interest only (with principal returned as a balloon payment at maturity)
	 * @var boolean
	 */
	private $io = false;

	public function __construct($principal, $ir, $years, $io = false){
		$this->principal = $principal;
		$this->ir = $ir / 100 / 12;
		$this->years = $years;
		$this->months = $years * 12;
		$this->io = $io;
	}
	
	/**
	 * Calculates the amount of a monthly payment
	 * @return float
	 */
	public function monthlyPayment(){
		if($this->io){
			return $this->principal * $this->ir;
		}
		return ($this->principal * $this->ir) / (1 - (pow( 1 + $this->ir, -1 * $this->months )));
	}

	/**
	 * Calculates the total cost of a mortgage (principal and interest) over the lifetime of the loan.
	 * @return float
	 */
	public function totalCost(){
		if($this->io){
			return ($this->monthlyPayment() * ($this->months - 1)) + $this->principal;
		}
		return $this->monthlyPayment() * $this->months;
	}
	
	/**
	 * Calculates the total interest cost of a mortgage over the lifetime of the loan.
	 * @return float
	 */
	public function totalInterest(){
		return $this->totalCost() - $this->principal;
	}
	
	/**
	 * Generates an amortization table listing all payments of a mortgage.
	 * @return array [array[ payment amount, interest amount, principal amount, remaining principal balance]]
	 */
	public function amortization(){
		$amortizationArray = array();
		if($this->io){
			$i = 1;
			while($i < 360){
				array_push($amortizationArray, array($this->monthlyPayment(), $this->monthlyPayment(), 0, $this->principal));
				$i++;
			}
			array_push($amortizationArray, array($this->principal + $this->monthlyPayment(), $this->monthlyPayment(), $this->principal, 0));
			return $amortizationArray;
		}
		$balance = $this->principal;
		while($balance > 0){
			$interest = $balance * $this->ir;
			$principal = $this->monthlyPayment() - $interest;
			$balance -= $principal;
			array_push($amortizationArray, array($this->monthlyPayment(), $interest, $principal, $balance));
		}
		return $amortizationArray;
	}
	
	/**
	 * Return payment information from a single month
	 * @param  int $number The payment month
	 * @return array[ payment amount, interest amount, principal amount, remaining principal balance ]
	 */
	public function payment($number){
		return $this->amortization()[$number - 1];
	}
}

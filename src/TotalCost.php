<?php

/**
 * Calculates the total cost of a mortgage (interest and principal)
 * over its entire duration
 */
class TotalCost implements CalculatorOperationsInterface {
	
	protected $payment;
	public function __construct(MonthlyPayment $payment){
		$this->payment = $payment;
	}

	public function evaluate($principal, $rate, $months, $io){
		$payment = $this->payment->evaluate($principal, $rate, $months, $io);
		if($io){
			return ($payment * ($months)) + $principal;
		}
		return $payment * $months;
	}
}
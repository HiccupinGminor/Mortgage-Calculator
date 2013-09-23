<?php

class MonthlyPayment implements CalculatorOperationsInterface{

	public function evaluate($principal, $rate, $months, $io){
		$rate = $rate/100/12;
		if($io){
			return $principal * $rate;
		}
		return ($principal * $rate) / (1 - (pow( 1 + $rate, -1 * $months )));
	}
}
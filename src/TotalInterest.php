<?php

class TotalInterest implements CalculatorOperationsInterface {
	protected $totalCost;
	public function __construct(TotalCost $totalCost){
		$this->totalCost = $totalCost;
	}
	public function evaluate($principal, $rate, $months, $io){
		return $this->totalCost->evaluate($principal, $rate, $months, $io) - $principal;	
	}
}
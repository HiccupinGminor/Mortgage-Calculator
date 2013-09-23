<?php

class Amortization implements CalculatorOperationsInterface{

	protected $payment;
	function __construct(MonthlyPayment $payment){
		$this->payment = $payment;
	}

	public function evaluate($principal, $rate, $months, $io){
		$amortizationArray = array();

		$monthlyPayment = $this->payment->evaluate($principal, $rate, $months, $io);

		if($io){
			$i = 1;
			while($i < 360){
				array_push($amortizationArray, array($monthlyPayment, $monthlyPayment, 0, $principal));
				$i++;
			}
			array_push($amortizationArray, array($principal + $monthlyPayment, $monthlyPayment, $principal, 0));
			return $amortizationArray;
		}
		
		for($i = 1; $i <= $months; $i++){
			$interestPayOff = $principal * $rate;
			$principalPayOff = $monthlyPayment - $interestPayOff;
			$principal -= $principalPayOff;
			array_push($amortizationArray, array($monthlyPayment, $interestPayOff, $principalPayOff, $principal));
		}
		return $amortizationArray;
	}
}

<?php

/**
 * Generates an amortization schedule for a mortgage detailing each of the payments needed
 */
class Amortization implements CalculatorOperationsInterface{

	protected $payment;
	function __construct(MonthlyPayment $payment){
		$this->payment = $payment;
	}

	public function evaluate($principal, $rate, $months, $io){
		$amortizationArray = array();

		$monthlyPayment = $this->payment->evaluate($principal, $rate, $months, $io);

		//If the loan is interest-only
		if($io){
			$i = 1;

			//Generate payments array
			while($i < $months){
				array_push($amortizationArray, array($monthlyPayment, $monthlyPayment, 0, $principal));
				$i++;
			}

			//Last month's payment
			array_push($amortizationArray, array($principal + $monthlyPayment, $monthlyPayment, $principal, 0));
			return $amortizationArray;
		}
		
		//If the loan is fully amortized
		for($i = 1; $i <= $months; $i++){
			$interestPayOff = $principal * $rate;
			$principalPayOff = $monthlyPayment - $interestPayOff;
			$principal -= $principalPayOff;
			array_push($amortizationArray, array($monthlyPayment, $interestPayOff, $principalPayOff, $principal));
		}
		return $amortizationArray;
	}
}

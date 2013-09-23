<?php

interface CalculatorOperationsInterface{
	public function evaluate($principal, $rate, $months, $io);
}
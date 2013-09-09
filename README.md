Mortgage-Calculator
===================

A mortgage calculator class for PHP 5

Mortgage Terminology
--------------------


Usage
-----

The calculator class can be used like any ordinary php class. Simply instantiate a new calculator object like so:

	$calculator = new Calculator( 100000, 6, 30, true );

The constructor function takes 4 arguments ( Loan amount, interest rate, loan maturity (in years), interest only payments (set to false by default))

You can then call the calculator's methods like so:
	
	$calculator->totalCost();


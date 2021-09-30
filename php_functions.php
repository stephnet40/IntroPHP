<?php

$currDate = date_create();

$sampleString = "Welcome to DMACC";

$testPhoneNum = "1234567890";

$testCurrency = "123456";

function dateAmericanFormat($inDate) {
	return date_format($inDate, "m/d/Y");
}

function dateEuropeanFormat($inDate) {
	return date_format($inDate,"d/m/Y");
}

function displayStringInfo($inString) {
	echo "Number of Characters: " . strlen($inString) . "<br>";
	trim($inString);
	echo strtolower($inString) . "<br>";
		
	echo "Contains 'DMACC'?: ";
		if (stristr($inString, "DMACC") != false) {
			echo "TRUE";
		} else {
			echo "FALSE";
		}
}

function formatPhoneNum($inPhoneNum) {
	if (strlen($inPhoneNum) == 10) {
		echo "(" . substr($inPhoneNum, 0, 3) . ") " . substr($inPhoneNum, 3, 3) . "-" . substr($inPhoneNum, 6);
	}
}

function formatUSCurrency($inCurrency) {
	return "$" . number_format($inCurrency, 2, ".", ",");
}

?>

<!doctype html>
<html>
	<head>
	
		<title>PHP Functions</title>
		
	</head>

	<body>
		
		<p>Current Date (mm/dd/yyyy): <?php echo dateAmericanFormat($currDate); ?></p>
		
		
		<p>Current Date (dd/mm/yyyy): <?php echo dateEuropeanFormat($currDate); ?></p>
		
		<p><?php displayStringInfo($sampleString); ?></p>
		
		<p><?php formatPhoneNum($testPhoneNum); ?></p>
		
		<p><?php echo formatUSCurrency($testCurrency); ?></p>
		
		
	</body>
</html>

<?php

// Get the id of the record we just entered. We are going to a GET parameter
// Access the database to get the record we just entered
// Use that information on this page to personalize the confirmation message

$eventId = $_GET["eventId"]; // get the parameter from the URL Get name value pair

echo "<h3>You entered a new record with an id of $eventId. We will look that information up from the database and display it to you.</h3>";

// connect to the database
// create the SQL statement. SELECT with WHERE clause
// prepare the statement
// bind parameters
// execute the statement
// fetch the row from the statement object into a PHP associative array
// display the fields on the page as needed

try {
		require "dbConnect.php";
		
		$sql = "SELECT events_name, events_description, events_presenter, events_date, events_time, events_date_inserted, events_date_updated FROM wdv341_events WHERE events_id=:eventId;";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(":eventId",$eventId);
	
		$stmt->execute();
	
		$eventRecord = $stmt->fetch(PDO::FETCH_ASSOC);
	
		
	}
	catch(PDOException $e){
		$message = "There has been a problem. The system administrator has been contacted. Please try again later.";
	
		error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
		
		error_log(var_dump(debug_backtrace()));
			
		//Clean up any variables or connections that have been left hanging by this error.		
			
		//header('Location: files/505_error_response_page.php');	//sends control to a User friendly page	
	}
	// create the SQL statement
	// prepare the SQL statement
	// bind parameters into the prepared statement
	// execute the prepared statement
	// display a confirmation message

?>

<!doctype html>
<html>
	<head>
	
		<title>Event Response Page</title>
		
	</head>

	<body>

		<h1>WDV341 Events Input Response Page</h1>
		
		<h3>Your Event has been submitted</h3>
		
		<p>Event Name: <?php echo $eventRecord["events_name"]; ?></p>
		
		<p>Event Description: <?php echo $eventRecord["events_description"]; ?></p>
		
		<p>Event Presenter: <?php echo $eventRecord["events_presenter"]; ?></p>
		
		<p>Event Date: <?php echo $eventRecord["events_date"]; ?></p>
		
		<p>Event Time: <?php echo $eventRecord["events_time"]; ?></p>
		
		<p>Date Added: <?php echo $eventRecord["events_date_inserted"]; ?></p>
		
		<p>Date Updated: <?php echo $eventRecord["events_date_updated"]; ?></p>

	</body>
</html>
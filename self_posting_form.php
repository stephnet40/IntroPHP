<?php
/*
	if(form is submitted){
		process form data
		do database stuf
	}
	else {
		display form
	}
*/

if(isset($_POST['submit']) && empty($_POST['first_name'])) {
	echo "FORM HAS BEEN SUBMITTED";
	
	$eventName = $_POST['events_name'];
	$eventDesc = $_POST['events_description'];
	$eventPresenter = $_POST['events_presenter'];
	
	// connect to database
	try {
		require "dbConnect.php";
		
		$sql = "INSERT INTO wdv341_events (events_name,events_description,events_presenter) VALUES (:eventName,:eventDesc,:eventPresenter)";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':eventName',$eventName);
		$stmt->bindParam(':eventDesc',$eventDesc);
		$stmt->bindParam(':eventPresenter',$eventPresenter);
		
		$stmt->execute();
		
		$newEventId = $conn->lastInsertId();
		
		// send to a 'response page' to display to customer the everything worked
		header("Location: eventResponsePage.php?eventId=" . $newEventId);
		
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
}
else {
	if(!empty($_POST['first_name'])) {
		echo "FORM NOT SUBMITTED";
	}
?>

<!doctype html>
<html>
	<head>
	
		<title>Self Posting Input Event Form</title>
		
		<style>
			
			p.honey {
				opacity: 0;
				position: absolute;
				top: 0;
				left: 0;
				z-index: -1;
			}
			
		</style>
		
	</head>

	<body>
		
		<h1>WDV341 Intro PHP</h1>
		
		<h2>11-1 Input Event Form</h2>
		
		<form method="post" action="self_posting_form.php">
			
			<p>
				<label for="events_name">Event Name: </label>
				<input type="text" name="events_name" id="events_name">
			</p>
			
			<p>
				<label for="events_description">Event Description: </label>
				<input type="text" name="events_description" id="events_description">
			</p>
			
			<p>
				<label for="events_presenter">Event Presenter: </label>
				<input type="text" name="events_presenter" id="events_presenter">
			</p>
			
			<p>
				<input type="submit" value="Submit" name="submit">
				<input type="reset" value="Try Again">
			</p>
			
			<p class="honey">
				<label for="first_name"></label>
				<input type="text" name="first_name" id="first_name">
			</p>
			
		</form>
		
	</body>
</html>

<?php
}
?>
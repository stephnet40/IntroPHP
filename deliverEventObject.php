<?php

/*
	Create a SELECT statement that will pull one row/event from your wdv341_events table. 
		Use SQL WHERE clause to limit the result set to one, and prepare your statement before execution.
	Format the result into a PHP associative array by setting the PDO fetch style. This will turn the result object row into an associative array using the column names as the indexes.
	Create a Class called Event and give it a property for every column in your wpdv341_events table (excluding the date_inserted/update columns). There are a couple of ways to make the properties editable by your code. Both have their place and will work. Please understand why you would use either of them.
	You can make the properties public so they can be mutated on the fly
	You can make the properties private and create public getters and setters to let users modify their values
	Create a PHP object called $outputObj and assign it to be an instance of the Event class.
	Assign a value to each property of your $outputObj instance based on the row you pulled from yoru DataBase (DB). There are a few of ways to do this
	You can manually set each property value (if the properties are public)
	You can set them in the constructor as long as your Class constructor is set up for this
	You can use your setters if you set them up
	Encode the $outputObj into a JSON object using json_encode
	Echo the JSON object
	Test you page and view the response in your localhost browser.
*/

require "dbConnect.php";

try 
{
	$stmt = $conn->prepare("SELECT events_name, events_description, events_presenter, events_date, events_time FROM wdv341_events WHERE events_id=1");
	$stmt->execute();
	
	$eventArray = $stmt->fetch(PDO::FETCH_ASSOC);
	
}
catch(PDOException $e)
{
	echo "Error: " . $e->getMessage();
}

class Event {
	
	// Class Properties
	public $eventName;
	public $eventDescription;
	public $eventPresenter;
	public $eventDate;
	public $eventTime;
	
	// Class Setters
	function setName($eventName) {
		$this->eventName = $eventName;
	}
	
	function setDescrip($eventDescription) {
		$this->eventDescription = $eventDescription;
	}
	
	function setPresenter($eventPresenter) {
		$this->eventPresenter = $eventPresenter;
	}
	
	function setDate($eventDate) {
		$this->eventDate = $eventDate;
	}
	
	function setTime($eventTime) {
		$this->eventTime = $eventTime;
	}
	
	// Class Getters
	function getName() {
		return $this->eventName;
	}
	
	function getDescrip() {
		return $this->eventDescription;
	} 
	
	function getPresenter() {
		return $this->eventPresenter;
	}
	
	function getDate() {
		return $this->eventDate;
	}
	
	function getTime() {
		return $this->eventTime;
	}
}

$outputObj = new Event();
$outputObj->setName($eventArray["events_name"]);
$outputObj->setDescrip($eventArray["events_description"]);
$outputObj->setPresenter($eventArray["events_presenter"]);
$outputObj->setDate($eventArray["events_date"]);
$outputObj->setTime($eventArray["events_time"]);

$jsonObj = json_encode($outputObj);

?>

<!doctype html>
<html>
	<head>
		
		<title>PHP-JSON Event Object</title>
		
	</head>

	<body>
		
		<h1>PHP-JSON Event Object</h1>
		
		<?php
		
		echo $jsonObj;
		
		?>
		
	</body>
</html>
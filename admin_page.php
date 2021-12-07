<?php

include "dbConnect.php";

session_start();

$userName = $_GET["userName"];

try 
{
	$sql = "SELECT events_id, events_name, events_description, events_presenter, events_date, events_time, events_date_inserted, events_date_updated FROM wdv341_events";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	
	$arrayOfRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "Error: " . $e->getMessage();
}

?>

<!doctype html>
<html>
	<head>
		<title>Admin Page</title>
		
		<style>
			li {
				display: flex;
				width: 50%;
				justify-content: space-between;
			}
			
			li button {
				margin-left: 5px;
			}
		</style>
	</head>

	<body>
		
		<h1>Welcome <?php echo $userName ?></h1>
		
		<p><a href="self_posting_form.php">Add New Event</a></p>
		
		<ol>
		<?php
			foreach($arrayOfRows as $oneEvent) {
				echo "<li>".$oneEvent["events_name"];
				echo "<span><button class='update'>Update</button>";
				echo "<button class='delete'>Delete</button></span>";
				echo "</li>";
			}
		?>
		</ol>
		
		<p><a href="logout.php">Logout</a></p>
		
	</body>
</html>
<?php

require "dbConnect.php";

class TableFormatting extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

  function current() {
    return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
  }

  function beginChildren() {
    echo "<tr>";
  }

  function endChildren() {
    echo "</tr>" . "\n";
  }
}

try
{
	$stmt = $conn->prepare("SELECT events_id, events_name, events_description, events_presenter, events_date, events_time, events_date_inserted, events_date_updated FROM wdv341_events WHERE events_id=1");
	$stmt->execute();
}
catch(PDOException $e)
{
	echo "Error: " . $e->getMessage();
}

?>

<!doctype html>
<html>
	<head>
	
		<title>Select One Event</title>
		
		<link rel="stylesheet" href="../../css/styles.css">
		
		<style>
			
			table {
				background-color: rgb(212, 188, 246);
			}
			
		</style>
		
	</head>

	<body>
		
		<div id="container">
			
			<header>
				
				<nav>
					<a href="http://stephrt.com/">Home</a>
					<a href="../homework.html">Homework</a>
					<a href="../../contact/contact.html">Contact</a>
				</nav>
				
				<div>
					<h1>Stephanie</h1>
					<h1>Thompson</h1>
				
					<h2>Web Development</h2>
				</div>
				
			</header>
			
			<main>
				<table style='border: solid 1px black;'>
				<tr><th>Events Id</th><th>Event Name</th><th>Description</th><th>Presenter</th><th>Date</th><th>Time</th><th>Date Inserted</th><th>Date Updated</th></tr>

				<?php

				try 
				{
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
					foreach(new TableFormatting(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
						echo $v;
					}
				}
				catch (PDOException $e)
				{
					echo "Error: " . $e->getMessage();
				}

				?>

				</table>
			</main>
			
			<footer>
				
				<p>&copy;2020 Stephanie Thompson All Rights Reserved</p>
				
			</footer>
			
		</div>
		
	</body>
</html>
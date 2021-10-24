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
	$stmt = $conn->prepare("SELECT events_id, events_name, events_description, events_presenter, events_date, events_time, events_date_inserted, events_date_updated FROM wdv341_events");
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
	
		<title>Select Events</title>
		
	</head>

	<body>

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

	</body>
</html>
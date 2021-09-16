<?php

	$yourName = "Stephanie Thompson";
		
	$number1 = 7;
	$number2 = 3;
	$total = $number1 + $number2;

	$languages = array( "PHP", "HTML", "JavaScript" );
?>

<!doctype html>
<html>
	<head>
	
		<title>PHP Basics</title>
		
		<script>
			let languagesJS = [];
			
			<?php
				
				foreach ($languages as $val){
					echo "languagesJS.push('" . $val . "');";
				}
			?>
			console.log(languagesJS);
		</script>
		
	</head>

	<body>
		
		<?php
		
			echo "<h1>PHP Basics</h1>";
		
		?>
		
		<h2><?php echo $yourName; ?></h2>
		
		<p>
			First Number: <?php echo $number1; ?><br>
			Second Number: <?php echo $number2; ?><br>
			Total: <?php echo $total; ?>
		</p>
		
		<script>document.write(languagesJS);</script>
		<!--PHP Array to JavaScript-->
		
		
	</body>
</html>
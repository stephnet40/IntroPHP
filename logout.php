<?php

session_start();

session_unset();
session_destroy();

?>


<!doctype html>
<html>
	<head>
		<title>Logout</title>
	</head>

	<body>
		
		<h3>Logout Successful!</h3>
		
		<p><a href="login.php">Return to Login</a></p>
		
	</body>
</html>
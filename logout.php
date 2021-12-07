<?php

session_start();

session_unset();
session_destroy();

header("Location: login.php");

?>


<!doctype html>
<html>
	<head>
		<title>Logout</title>
	</head>

	<body>
		
	</body>
</html>
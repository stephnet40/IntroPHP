<?php

session_start();

session_unset();

session_destroy();

header("Location: login.php");

?>


<!doctype html>
<html>
	<head>
	<title>Untitled Document</title>
	</head>

	<body>
	</body>
</html>
<?php

session_start();

session_unset();

session_destroy();

header("Location: login.php?logout=true");

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Logout</title>
</head>

<body>
</body>
</html>
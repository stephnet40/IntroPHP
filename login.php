<?php

/*

	if(form is submitted) {
		process form data
		do database stuff
	}
	else {
		display form
	}
	
	isset(_POST)

*/

include "dbConnect.php";

session_start();

if(isset($_SESSION['user_name'])){
	header("Location: admin_page.php?userName=" . $_SESSION['user_name']);
}

if(isset($_POST['submit'])) {
	
	// Process the login information against the database
	$loginName = $_POST['loginName'];
	$loginPW = $_POST['loginPassword'];
	
	try {
		require "dbConnect.php";
		
		$sql = "SELECT event_user_name, event_user_password FROM event_user WHERE event_user_name=:userName AND event_user_password=:userPW";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':userName',$loginName);
		$stmt->bindParam(':userPW',$loginPW);
		
		$stmt->execute();
		
		$user = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($user === false) {
	
			echo "Incorrect username/password combination";

		}
		else {	
			$_SESSION['user_name'] = $user['event_user_name'];

			header("Location: admin_page.php?userName=" . $loginName);
		}
		
	}
	catch(PDOException $e){
		
	}
	
}

?>

<!doctype html>
<html>
	<head>
	
		<title>Login Example</title>
		
	</head>

	<body>
		
		<h1>My Company Sign On Page</h1>
		
		<form method="post" action="login.php">
			
			<div>
				<label for="loginName">Username:</label>
				<input type="text" name="loginName" id="loginName">
			</div>
			
			<div>
				<label for="loginPassword">Password: </label>
				<input type="password" name="loginPassword" id="loginPassword">
			</div>
			
			<div>
				<input type="submit" value="Sign On" name="submit" id="submit">
				<input type="reset">
			</div>
			
		</form>
		
	</body>
</html>
<?php

include "../dbConnect.php";
$copyrightDate = date('Y');

session_start();

if(isset($_SESSION['user_name'])){
	header("Location: account.php?userName=" . $_SESSION['user_name']);
}

if(isset($_POST['submit'])) {
	if(empty($_POST['middle_name'])) {

		$userName = $_POST['username'];
		$userPassword = $_POST['password'];

		try {
			require "../dbConnect.php";

			$sql = "SELECT user_name, user_password FROM limecove_members WHERE user_name=:userName AND user_password=:userPassword";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':userName', $userName);
			$stmt->bindParam(':userPassword', $userPassword);

			$stmt->execute();

			$user = $stmt->fetch(PDO::FETCH_ASSOC);

			if($user == false) {
				echo "<script>alert('Incorrect username/password combination')</script>";
			}
			else {
				$_SESSION['user_name'] = $user['user_name'];

				header("Location: account.php?userName=" . $userName);
			}

		}
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
	
}

?>

<!doctype html>
<html>
	<head>
		
		<title>Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Hamburger menu icon -->
		
		<style>
  			<?php include "../css/main.css"; ?>
			<?php include "../css/header.css"; ?>
			<?php include "../css/login.css";?>
			<?php include "../css/footer.css"; ?>
		</style>
		
	</head>

	<body>
		
		<header>
				
			<div class="sign_up_login">
					
					<p><a class="sign_up" href="create_account.php">Sign Up</a> <a class="login" href="login.php">Login</a></p>
					
				</div>
				
				<nav>
					
					<ul id="desktop_nav">
						<li><a href="../index.php">HOME</a></li>
						<li><a href="../recipes.php">RECIPES</a></li>
						<img src="../images/limecove_scroll_LOGO_transparent.png" src="Lime Cove Logo">
						<li><a href="../contact.php">CONTACT</a></li>
						<li><a href="../about.php">ABOUT</a></li>
					</ul>
					
					<div id="mobile_nav">
						<img src="../images/limecove_scroll_LOGO_transparent.png">
						<ul>
							<input type="checkbox" id="checkbox_toggle">
							<label for="checkbox_toggle" class="hamburger"><i class="fa fa-bars"></i></label>

							<div class="menu">
								<li><a href="index.php">HOME</a></li>
								<li><a href="recipes.php">RECIPES</a></li>

								<li><a href="contact.php">CONTACT</a></li>
								<li><a href="about.php">ABOUT</a></li>
								<li><a href="create_account.php">SIGN UP</a></li>
								<li><a href="login.php">LOGIN</a></li>
							</div>
						</ul>
					</div>
					
				</nav>
				
		</header>
		
		<main>
			
			<h1>WELCOME BACK!</h1>
			
			<h3 id="logout_message"></h3>
			
			<form method="post" action="login.php">
					
				<h3>PLEASE SIGN IN</h3>
				
				<div class="user_info">
					<label for="username">Username</label>
					<input type="text" name="username" id="username">	
				</div>
				
				<div class="user_info">
					<label for="password">Password</label>
					<input type="password" name="password" id="password">
				</div>
				
				<div class="honey">
					<label for="middle_name"></label>
					<input type="text" name="middle_name" id="middle_name">
				</div>
				
				<p>New here? Click <a href="create_account.php">HERE</a> to sign up!</p>
						
				<div class="buttons">
					<input type="submit" name="submit" id="submit">
					<input type="reset" name="reset" id="reset">
				</div>
					
			</form>
					
		</main>
		
		<footer>
			<div class="social_media">
					<!-- Social Media -->
					<h3>Follow Us</h3>
					
					<div class="social_media">
						<!-- Icons -->
						<img src="../images/ez_facebook_logo.jpg" href="https://www.facebook.com/" alt="Facebook Logo">
						<img src="../images/ex_instagram_logo.jpg" href="https://www.instagram.com/" alt="Instagram Logo">
						<img src="../images/ex_twitter_logo.jpg" href="https://twitter.com/" alt="Twitter Logo">
						
					</div>
					
					<div class="social_media mobile_copyright">
						<p><a href="../admin/admin_login.php">Staff Login</a></p>
						&copy;<?php echo $copyrightDate; ?> Lime Cove All Rights Reserved
					</div>
					
				</div>
				
		</footer>
		
	</body>
</html>
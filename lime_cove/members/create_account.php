<?php

include "../dbConnect.php";
$copyrightDate = date('Y');

session_start();

if(isset($_SESSION['user_name'])){
	header("Location: account.php?userName=" . $_SESSION['user_name']);
}

if(isset($_POST['submit'])) {
	
	$userName = $_POST['create_username'];
	$userPassword = $_POST['create_password'];
	$checkPassword = $_POST['check_password'];
	
	if(empty($_POST['middle_name'])) {
		if($userPassword === $checkPassword) {
			try {
				$sql = "SELECT user_name FROM limecove_members WHERE user_name=:userName;";
				$userNameStmt = $conn->prepare($sql);
				$userNameStmt->bindParam(':userName', $userName);

				$userNameStmt->execute();

				if($userNameStmt->rowCount() == 0) {
					try {

						$sql = "INSERT INTO limecove_members (user_name,user_password) VALUES (:userName,:userPassword)";
						$stmt = $conn->prepare($sql);
						$stmt->bindParam(':userName', $userName);
						$stmt->bindParam(':userPassword', $userPassword);

						$stmt->execute();

						$_SESSION['user_name'] = $user['user_name'];
						$_SESSION['account_creation'] = "true";
						header("Location: account_creation_success.php?userName=" . $userName);

					}
					catch(PDOException $e) {
						echo "Error: " . $e->getMessage();
					}
				}
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}

		}
	}
}

?>

<!doctype html>
<html>
	<head>
		
		<title>Create Account</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Hamburger menu icon -->
		
		<style>
  			<?php include "../css/main.css"; ?>
			<?php include "../css/header.css"; ?>
			<?php include "../css/login.css";?>
			<?php include "../css/sign_up.css"; ?>
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
			
			<section>
				
				<div>
						
					<h1>SIGN UP FREE TODAY!</h1>
					<p class="desktop_text">Sign up to get meal ideas, save recipes, make private recipes, and more!</p>
						
				</div>
				
				<form method="post" action="create_account.php">
					
					<p class="mobile_text">Sign up to get meal ideas, save recipes, make private recipes, and more!</p>
					
					<div class="user_info">
						<label for="create_username">Username</label>
						<input type="text" name="create_username" id="create_username">
						<div id="user_name_taken"></div>
					</div>
					
					<div class="user_info">
						<label for="create_password">Password</label>
						<input type="password" name="create_password" id="create_password">
					</div>
					
					<div class="user_info">
						<label for="check_password">Re-enter Password</label>
						<input type="password" name="check_password" id="check_password">
						<div id="password_error_msg"></div>
					</div>
					
					<div class="honey">
						<label for="middle_name"></label>
						<input type="text" name="middle_name" id="middle_name">
					</div>
					
					<div>
						<p>Already a member?</p>
						<p><a href="login.php">Click Here</a></p>
					</div>
					
					<div class="buttons">
						<input type="submit" name="submit" id="submit">
						<input type="reset">
					</div>
					
				</form>
				
			</section>
			
			<section>
				
				<img src="../images/flamingo_signup_rainbow_img.jpg">
				
			<section>
			
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
		
		<?php
			if(isset($_POST['submit'])) {
				if($userNameStmt->rowCount() > 0) {
					echo "<script>document.querySelector('#user_name_taken').innerHTML='Username already exists. Try again.'</script>";
					echo "<script>document.querySelector('#user_name_taken').style.color='red'</script>";
					echo "<script>document.querySelector('#create_user_name').style.borderColor='red'</script>";
				}
				
				if($userPassword != $checkPassword) {
					echo "<script>document.querySelector('#password_error_msg').innerHTML='Passwords do not match. Please re-enter password.'</script>";
					echo "<script>document.querySelector('#password_error_msg').style.color='red'</script>";
					echo "<script>document.querySelector('#check_password').style.borderColor='red'</script>";
				}
			}	
		?>
		
	</body>
</html>
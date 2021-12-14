<?php

include "../dbConnect.php";
$copyrightDate = date('Y');

session_start();

if(isset($_SESSION['admin_name'])){
	header("Location: admin_home.php?adminName=" . $_SESSION['admin_name']);
}

if(isset($_POST['submit'])) {
	if(empty($_POST['middle_name'])) {
		$adminName = $_POST['admin_username'];
		$adminPassword = $_POST['admin_password'];

		try {
			require "../dbConnect.php";

			$sql = "SELECT admin_name, admin_password FROM limecove_admin WHERE admin_name=:adminName AND admin_password=:adminPassword";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':adminName', $adminName);
			$stmt->bindParam(':adminPassword', $adminPassword);

			$stmt->execute();

			$user = $stmt->fetch(PDO::FETCH_ASSOC);

			if($user == false) {
				echo "<script>alert('Incorrect username/password combination')</script>";
			}
			else {
				$_SESSION['admin_name'] = $user['admin_name'];

				header("Location: admin_home.php?adminName=" . $adminName);
			}

		}
		catch(PDOException $e) {
			echo "Errors: " . $e->getMessage();
		}
	}
	
}

?>

<!doctype html>
<html>
	<head>
		
		<title>Staff Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Hamburger menu icon -->
		
		<style>
  			<?php include "../css/main.css"; ?>
			<?php include "../css/header.css"; ?>
			<?php include "../css/admin.css";?>
			<?php include "../css/footer.css"; ?>
		</style>
		
	</head>

	<body>
		
		<header>
				
			<div class="sign_up_login">
					
					<p><a class="sign_up" href="../members/create_account.php">Sign Up</a> <a class="login" href="../members/login.php">Login</a></p>
					
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
								<li><a href="../index.php">HOME</a></li>
								<li><a href="../recipes.php">RECIPES</a></li>

								<li><a href="../contact.php">CONTACT</a></li>
								<li><a href="../about.php">ABOUT</a></li>
								<li><a href="../members/create_account.php">SIGN UP</a></li>
								<li><a href="../members/login.php">LOGIN</a></li>
							</div>
						</ul>
					</div>
					
				</nav>
				
		</header>
		
		<main id="admin_login">
			
			<div class="login_header">
				
				<img class="desktop" src="../images/lime_cove_lock.png">
				<img class="mobile" src="../images/lime_cove_lock_MOBILE.png">
				<h1>STAFF LOGIN</h1>
				
				<div class="error_message"></div>
				
			</div>
			
			<form method="post" action="admin_login.php">
				
				<div class="login_info">
					<label for="admin_username">Username</label>
					<input type="text" name="admin_username" id="admin_username">
				</div>
				
				<div class="login_info">
					<label for="admin_password">Password</label>
					<input type="password" name="admin_password" id="admin_password">
				</div>
				
				<div class="honey">
					<label for="middle_name"></label>
					<input type="text" name="middle_name" id="middle_name">
				</div>
				
				<div class="submit_buttons">
					<input type="submit" name="submit" id="submit">
					<input type="reset">
				</div>
				
			</form>
			
			<footer id="admin_login_footer">
				
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
			
		</main>
		
		<script>
			function getErrorMsg() {
				document.querySelector("div.error_message").innerHTML = "Incorrect username/password combination";
			}
		</script>
		
	</body>
</html>
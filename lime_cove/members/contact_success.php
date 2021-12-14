<?php

$copyrightDate = date('Y');

session_start();

if(!(isset($_SESSION['user_name']))) {
	header("Location: ../contact_success.php");
}

?>

<!doctype html>
<html>
	<head>
		
		<title>Message Sent!</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Hamburger menu icon -->
		
		<style>
  			<?php include "../css/main.css"; ?>
			<?php include "../css/header.css"; ?>
			<?php include "../css/contact.css"; ?>
			<?php include "../css/url_paths.css"; ?>
			<?php include "../css/footer.css"; ?>
		</style>
		
	</head>

	<body>
		
		<header>
			
				
				<div class="sign_up_login">
					
					<p><a class="logout" href="logout.php">Logout</a></p>
					
				</div>
				
				<nav>
					
					<ul id="desktop_nav">
						<li><a href="index.php">HOME</a></li>
						<li><a href="recipes.php">RECIPES</a></li>
						<img src="../images/limecove_scroll_LOGO_transparent.png" src="Lime Cove Logo">
						<li><a href="contact.php">CONTACT</a></li>
						<li><a href="about.php">ABOUT</a></li>
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
								<li><a href="add_recipe.php">ADD RECIPE</a></li>
								<li><a href="account.php?userName=<?php echo $_SESSION['user_name'] ?>">MY RECIPES</a></li>
								<li><a href="logout.php">LOGOUT</a></li>
							</div>
						</ul>
					</div>
					
				</nav>
				
			</header>
		
			<div id="account_toolbar">
				
				<div>
					<img src="../images/limecove_userpic.jpg">
					<h3>HELLO <?php echo $_SESSION['user_name'] ?>!</h3>
				</div>
				
				<div>
					<p><a href="add_recipe.php?userName=<?php echo $_SESSION['user_name'] ?>">ADD RECIPE</a></p>
					<p><a href="account.php?userName=<?php echo $_SESSION['user_name'] ?>">MY RECIPES</a></p>
				</div>
				
			</div>
		
		<div id="container">
			
			<main>
				
				<section>
					
					<img src="../images/contact_page_beachchair.jpg">
					
				</section>
				
				<section>
					
					<p>
						Thank you for your message. A confirmation email has been sent to the email address provided and should arrive within 15 minutes.
					</p>
					
				</section>
				
			</main>
			
		</div>
		
		<footer>
				
				<div>
					<!-- Secondary Nav -->
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="recipes.php">Recipes</a></li>
						<li><a href="contact.php">Contact</a></li>
						<li><a href="about.php">About</a></li>
						<li><a href="../admin/admin_login.php">Staff Login</a></li>
					</ul>
				</div>
				
				<div>
					<!-- Logo -->
					<img src="../images/limecove_tricolor_LOGO.png">
					
					<p>
					<!-- Copyright -->
						&copy;<?php echo $copyrightDate; ?> Lime Cove All Rights Reserved
					</p>
					
				</div>
				
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
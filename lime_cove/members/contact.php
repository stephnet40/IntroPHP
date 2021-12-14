<?php

include "../dbConnect.php";
$copyrightDate = date('Y');

session_start();

if(!(isset($_SESSION['user_name']))) {
	header("Location: ../contact.php");
}

if(isset($_POST['submit'])) {
	if(empty($_POST['middle_name'])) {
		$firstName = $_POST['first_name'];
		$lastName = $_POST['last_name'];
		$contactEmail = $_POST['email'];
		$confirmSubject = "Confirmation Message";
		$confirmMessage = "
			<html>
				<head>
					<title>Confirmation Email</title>
				</head>
				<body>
					<p>$contactFirstName,</p>
					<p>Thank you for you message. A response should arrive in your inbox within 48 hours.</p>
					<p>Lime Cove</p>
				</body>
			</html>
		";

		$headers = "From: contact@stephrt.com" . "\r\n";
		$headers .= "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		mail($contactEmail, $confirmSubject, $confirmMessage, $headers);

		$phoneNumber = $_POST['phone'];
		$contactMessage = $_POST['message'];

		$messageSent = date('m/d/Y');
		$receiveEmail = "contact@stephrt.com";
		$receiveSubject = "Lime Cove Message";
		$receiveMessage = "
			<html>
				<head>
					<title>Message Received</title>
				</head>
				<body>
					<p>From $contactFirstName $contactSecondName</p>
					<p>Email: $confirmEmail</p>
					<p>Phone: $contactPhone</p>
					<p style='margin-bottom:10px;'>Message sent $messageSent</p>
					<p>$contactMessage</p>
				</body>
			</html>
		";

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		mail($receiveEmail, $receiveSubject, $receiveMessage, $headers);

		header("Location: contact_success.php");
		
	}
	
}

?>

<!doctype html>
<html>
	<head>
		
		<title>Contact Us</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Hamburger menu icon -->
		
		<style>
  			<?php include "../css/main.css"; ?>
			<?php include "../css/header.css"; ?>
			<?php include "../css/contact.css"; ?>
			<?php include "../css/url_paths.css"; ?>
			<?php include "../css/footer.css"; ?>
			
			main form {
				background-image: url("../images/contact_form_phonebg.jpg");
			}
			
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
					<img src="../images/contact_page_beachchair_MOBILE.jpg">
					
				</section>
				
				<section>
					
					<div class="contact_text">
						<h2>TALK TO US</h2>
						<div>
							<p>We want to hear from you!</p>
							<p>Fill out the form below:</p>
						</div>
					</div>
					
					<form method="post" action="contact.php">
						
						<div>
							<input type="text" name="first_name" id="first_name" placeholder="First Name" required>
						</div>
							
						<div>
							<input type="text" name="last_name" id="last_name" placeholder="Last Name" required>
						</div>
						
						<div>
							<input type="text" name="phone" id="phone" placeholder="Phone Number">
						</div>
						
						<div>
							<input type="text" name="email" id="email" placeholder="Email Address" required>
						</div>
						
						<div>
							<textarea name="message" id="message" placeholder="Comments" required></textarea>
						</div>
						
						<div class="honey">
							<label for="middle_name"></label>
							<input type="text" name="middle_name" id="middle_name">
						</div>
						
						<div class="buttons">
							<input type="submit" name="submit" id="submit" value="Submit">
							<input type="reset" name="reset" id="reset" value="Reset">				
						</div>
						
					</form>
					
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
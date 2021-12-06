<?php

$contactFirstName = $_POST["first_name"];
$contactLastName = $_POST["last_name"];
$contactPhone = $_POST["phone"];
$contactMessage = $_POST["message"];
$confirmEmail = $_POST["email"];
$confirmSubject = "Contact Confirmation";
$confirmMessage = "
	<html>
		<head>
			<title>Confirmation Email</title>
		</head>
		<body>
			<p>$contactFirstName $contactLastName,</p>
			<p>Thank you for you message. A response should arrive in your inbox within 48 hours.</p>
			<p>Beyond Baking</p>
		</body>
	</html>
";

$headers = "From: contact@stephrt.com" . "\r\n";
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

mail($confirmEmail, $confirmSubject, $confirmMessage, $headers);

$messageSent = date('m/d/Y');
$receiveEmail = "contact@stephrt.com";
$receiveSubject = $_POST["message_topic"];
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

?>

<!doctype html>
<html>
	<head>
		
		<title>Message Sent</title>
		
		<meta name="author" content="Stephanie Thompson">
		<meta name="description" content="Beyond Baking contact form handler. Website intended for web dev educational purposes only.">
		<meta name="keywords" content="DMACC web development, web development, web dev, wdv351, website application components, bakery, gluten free, gluten free bakery, beyond baking">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<script src="../javascript/copyright.js"></script>
		<script src="https://www.google.com/recaptcha/api.js" async defer></script> <!-- reCaptcha v2.0 -->
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Hamburger menu icon -->
		<link rel="stylesheet" href="https://use.typekit.net/bma2hgu.css"> <!-- Adobe fonts -->
		<link rel="stylesheet" href="../css/main.css">
		<link rel="stylesheet" href="../css/header.css">
		<link rel="stylesheet" href="../css/footer.css">
		<link rel="stylesheet" href="../css/fonts.css">
		<link rel="stylesheet" href="../css/contact.css">
		
		<style>
			
			main {
				background-color: #F599B7;
				text-align: center;
				padding-top: 50px;
				padding-bottom: 50px;
			}
			
			main div {
				background-color: #e3d1c7;
				width: 95%;
				border-radius: 35px;
				padding-top: 30px;
				padding-right: 8%;
				padding-bottom: 30px;
				padding-left: 8%;
				margin-right: auto;
				margin-left: auto;
			}
			
			main h2 {
				margin-top: 0;
			}
			
			main p:last-of-type {
				margin-bottom: 0;
			}
			
			main a, main a:visited {
				color: #21110c;
			}
			
		</style>
		
	</head>

	<body>
		
		<header>
			
			<a href="../index.html"><div>
				<!-- Logo / Name -->
				
				<img src="../images/logo_name.png" alt="Cupcake logo with cherry and bow">
				
			</div></a>
			
			<nav>
				
				<ul>
					<input type="checkbox" id="checkbox_toggle">
					<label for="checkbox_toggle" class="hamburger"><i class="fa fa-bars"></i></label>
					
					<div class="menu">
						<li><a href="../about.html">Our Story</a></li>
						<li><a href="../bakery/cakes_cupcakes.html">The Bakery</a></li>
						<li><a href="../contact.html">Contact Us</a></li>
					</div>
				</ul>
				
			</nav>
			
			<div class="cart">
					
					<form target="paypal" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" >
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="shopping_url" value="https://stephrt.com/portfolio/beyond_baking/bakery/cakes_cupcakes.html">
						<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
						<input type="image" src="../images/cart.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
						<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form>
				
			</div>
			
			<div class="cart_mobile">
				
				<form target="paypal" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" >
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="shopping_url" value="https://stephrt.com/portfolio/beyond_baking/bakery/cakes_cupcakes.html">
						<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
						<input type="image" src="../images/cart_mobile.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
						<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form>
				
			</div>
			
		</header>
		
		<main>
			
			<div>
			
				<h2>Your message has been sent!</h2>

				<p>A confirmation email has been sent to the email provided.</p>

				<p><a href="../index.html">Return to Beyond Baking</a></p>
				
			</div>
			
		</main>
		
		<footer>
			
			<div class="hours_location">
				<!-- Hours / Location -->
				
				<div>
					<p>Mon to Fri</p> <p>10 AM - 5 PM</p>
					<p>Sat</p> <p>10 AM - 2 PM</p>
					<p>Sun</p> <p>Closed</p>
				</div>
				
				<div>
					<p>2977 Jenna Lane</p>
					<p>West Des Moines, IA 50266</p>
					<p>(515) 221 - 4251</p>
				</div>
				
			</div>
			
			<div class="logo_social_icons">
				<!-- Logo / Social Media -->
				
				<div>
					
					<img src="../images/logo_name.png" alt="Cupcake logo with cherry and bow">
					
				</div>
				
				<div>
					<a href="https://www.facebook.com/"><img src="../images/social media/facebook.png" alt="Facebook"></a>
					<a href="https://twitter.com/"><img src="../images/social media/twitter.png" alt="Twitter"></a>
					<a href="https://www.instagram.com/"><img src="../images/social media/instagram.png" alt="Instagram"></a>
				</div>
				
			</div>
			
			<div>
				<!-- Footer Navigation / Login -->
				
				<div>
					
					<ul>
						<li><a href="../index.html">Home</a></li>
						<li><a href="../about.html">Our Story</a></li>
						<li><a href="../bakery/cakes_cupcakes.html">The Bakery</a></li>
						<li><a href="../contact.html">Contact Us</a></li>
					</ul>
					
				</div>
				
				<div>
					<form target="paypal" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" >
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="shopping_url" value="https://stephrt.com/portfolio/beyond_baking/bakery/cakes_cupcakes.html">
						<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
						<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_viewcart_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
						<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form>

					<p>Login | Sign Up</p>
				</div>
				
			</div>
			
			<p id="copyright"><script>copyrightStatement();</script></p>
			
		</footer>
		
	</body>
</html>
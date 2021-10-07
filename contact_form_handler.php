<?php

$contactName = $_POST["formName"];
$confirmEmail = $_POST["formEmail"];
$confirmSubject = "Contact Confirmation";
$confirmMessage = "
	<html> 
		<head>
			<title>Confirmation Email</title>
		</head>
		<body style='background-color:#ffec99; padding: 10px; box-sizing:border-box;'>
			<div style='background-color:white; border: 6px solid #82263a; padding:10px; margin:10px;'>
				<p>$contactName,</p> 
				<p>Thank you for your comments. You should receive a response within 24 hours.</p> 
				<p>Mosaic Salon and Spa</p>
				<div style='font-style:italic; font-size: 0.9em'>
					<p>
						2977 Jenna Lane<br>
						West Des Moines, IA 50266<br>
						(515)221-4251
					</p>
					<p>
						Hours:<br>
						Mon - Thurs: 9am - 7pm<br>
						Fri - Sat: 9am - 8pm<br>
						Sun: Closed
					</p>
				</div>
			</div>
		</body>
	</html>
	";
$headers = "From: contact@stephrt.com" . "\r\n";
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

mail($confirmEmail, $confirmSubject, $confirmMessage, $headers);

$receiveEmail = "contact@stephrt.com";
$receiveSubject = $_POST["contactSubject"];
$receiveMessage = "From " . $contactName . "\n" . "Sent ". date('m/d/Y') . "\n" . $_POST["formComments"] ;

mail($receiveEmail, $receiveSubject, $receiveMessage);

?>


<!doctype html>
<html>
	<head>
	
		<title>Mosaic Salon and Spa | Contact Us</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Bootstrap link -->
		<link rel="stylesheet" href="../css/body.css"> <!-- Background/Body/Container CSS Stylesheet -->
		<link rel="stylesheet" href="../css/header.css"> <!-- Header/Nav CSS stylesheet -->
		<link rel="stylesheet" href="../css/main.css"> <!-- Main CSS stylesheet -->
		<link rel="stylesheet" href="../css/footer.css"> <!-- Footer CSS stylesheet -->
		<link rel="stylesheet" media="screen and (max-width: 768px)" href="../css/media.css"> <!-- Media queries -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> <!-- Bootstrap jQuery Library -->
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> <!-- Bootstrap Popper JS -->
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> <!-- Bootstrap Latest Compiled Javascript -->
		
		<script src="../javascript/responsive_navbar.js"></script> <!-- jQuery for responsive navbar -->
		
		<style>
			
			/* Shadows */
			
			header h1, section:last-of-type {
				box-shadow: 2px 2px 10px 6px rgba(0, 0, 0, 0.5);
			}
			
			/* book online */
			
			header h1 {
				background-image: url("../images/blue_texture.png");
				text-align: center;
				width: 48%;
				position: relative;
				padding-top: 15px;
				margin-top: -150px;
				margin-left: 53.5%;
			}
			
			main div {
				font-size: 0.90em;
				border: 3px solid black;
				padding: 10%;
				margin-top: 75px;
				margin-right: 10%;
				margin-left: 10%;
			}
			
			
		</style>
		
	</head>

	<body>
		
			<nav>
				
				<a href="../index.html"><img src="../images/Name.png"></a>
				
				<img src="../images/logo2.jpg">
				
				<img src="../images/name_mobile.svg">
				
				<div>
					     
					<ul class="topnav">
						<button class="icon"> <i class="fa fa-bars"></i> </button>
						<li class="main"><a href="../index.html">Home</a></li>
						<li class="main"><a href="../about.html">About</a></li>          
						<li class="servicesDropdown main"><a href="../services/hair.html"><span>Services</span></a>
							<div>
								<a href="../services/hair.html">Hair</a>
								<a href="../services/men.html">Men</a>
								<a href="../services/nails.html">Nails</a>
								<a href="../services/spa.html">Spa</a>
								<a href="../services/policies.html">Policies</a>
							</div>
						</li>
						<li class="main"><a href="../team.html">Team</a></li>
						<li class="main"><a href="../contact.html">Contact Us</a></li>
					</ul>
					
				</div>
				
			</nav>
		
		<div id="container">
		
			<header>
				
				<img src="../images/contact/banner_purple_edit.jpg">
				
				<a href="#"><h1>Book Online</h1></a>
				
			</header>

			<main>
				
				<div>
					<p>Thank you for your comments. You will receive a confirmation email at the following address:</p>
					<p><?php echo $_POST["formEmail"] ?></p>
				</div>
				
			</main>
			
		</div>

			<footer>
				
				<div>
					<img src="../images/social_media/facebook.png">
					<img src="../images/social_media/instagram.png">
					<img src="../images/social_media/twitter.png">
				</div>
				
				<div>
					
					<p>
						2977 Jenna Lane<br>
						West Des Moines, IA 50266<br>
						(515)221-4251
					</p>

					<img src="../images/logo2.jpg">

					<p>
						Hours:<br>
						Mon - Thurs: 9am - 7pm<br>
						Fri - Sat: 9am - 8pm<br>
						Sun: Closed
					</p>
					
				</div>
				
				<p>&copy;2021 Mosaic Salon and Spa All Rights Reserved
				<br>This is a website created for academic purposes only.
				<br>Not a real business.</p>
				
			</footer>
		
	</body>
	
</html>
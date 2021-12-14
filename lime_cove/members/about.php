<?php

include "../dbConnect.php";
$copyrightDate = date('Y');

session_start();

if(!(isset($_SESSION['user_name']))) {
	header("Location: ../about.php");
}

?>

<!doctype html>
<html>
	<head>
		
		<title>About Us</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Hamburger menu icon -->
		
		<style>
  			<?php include "../css/main.css"; ?>
			<?php include "../css/header.css"; ?>
			<?php include "../css/about.css"; ?>
			<?php include "../css/url_paths.css"; ?>
			<?php include "../css/footer.css"; ?>
			
			#container {
				background-image: url("../images/ourstory_beach_top.jpg"), url("../images/ourstory_beach_lower.jpg");
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
			<div id="container-inner">
			<main>
				
				<h1>OUR STORY</h1>
				
				<img src="../images/our_story_heroimg.jpg">
				
				<div>
					
					<h3>WHO IS LIME COVE?</h3>
					
					<p>
						Lime Cove is an online recipe community for Florida Snowbirds and Web Development Professors. We welcome new recipes from our members and celebrate all things lime. We are a part of the Boardwalk Group and associated with the DAL (Dodo Airlines.)
					</p>
					
				</div>
				
				<div>
					
					<h3>WHAT WE BELIEVE.</h3>
					
					<p>
						No Shoes. No Rules. Good Food.
					</p>
					
					<p>
						That’s our motto. Here in Florida, we have people from all over the country kicking back and making great food. They bring their childhoods, neighborhoods, and palettes with them from all over and it has created this explosion of food and culture that encapsulates the Florida Snowbird Lifestyle. We figured, why not make a website that is catered to the Key West aesthetic, care-free Florida attitude, and beautiful variety of recipes we share every year? The answer: Lime Cove.
					</p>
						
				</div>
				
				<div>
					
					<h3>WHY IS LIME COVE?</h3>

					<p>
						Founded in 2021 by Courtney Morgan and Stephanie Thompson.
					</p> 
			
					<p>
						We were divinely inspired by our Professor’s insatiable love of the color LimeGreen. Professor Jeff always has lime green, the best color on earth, in every coding example in his classes. In fact, when asked about why he always uses lime green, he emphatically defended the choice and insisted it was the most beautiful, glow in the dark, eye gouging color in the whole universe.
					</p>

					<p>
						Enter the idea seed that would become Lime Cove. Over several debates on whether the color lime green could be used in a design, and used effectively, was a point of contention. Long had we discussed how anyone deciding to incorporate lime green into a design would fall into ruin and mocked for their buffoonery.
					</p>

					<p>
						As it happens, that was to be our fate. One doomed afternoon the words were said:
					</p>

					<p>
						“Bet you that a design could be made that centered around lime green and it could be done well!”
					</p>

					<p>
						Best of all? You shouldn’t mix unattractive, or off putting, colors with food and food subject matters. Guess where lime green tends to fall? Yes, lime is a food, but as a central part of a recipe website AND the star of the show? Can’t be done! Ye can’t be mixin’ cool colors with food! Warm tones only!
					</p>

					<p>
						After research, marketing, testing, yelling at color, and several hours of design trial and error - a theme was born. Not only was lime incorporated into the design, but all the recipes would feature lime, the colors were centered around lime green, all decisions hinged on whether they were worshipping the lime, all the lime is the lime lime lime for lime the lime. Sorry. Fell right back into it for a bit there.
					</p>

					<p>
						What you have before you is a labor of love and the satisfaction of several courses in the DMACC Web Development program. Welcome to Lime Cove.
					</p>
					
				</div>
				
				<div>
					
					<h3>WHO DID WHAT</h3>

					<p>
						Marketing Research, Testing, and Interviews: Courtney Morgan and Stephanie Thompson
					</p>	

					<p>
						Design, UX/UI, Wireframes, Prototype, Content Creation, Copy Writing: Courtney Morgan
					</p>
					
					<p>	
						Design Approval, CSS, SCSS, HTML, Javascript, PHP, Code implementation, Troubleshooting, and FullStack MVP: Stephanie Thompson
					</p>
					
					<p>
						Leia: Emotional Support Doggo Extraordinaire
					</p>
					
				</div>
				
			</main>
			</div>
			
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
<?php

include "../dbConnect.php";
$copyrightDate = date('Y');

session_start();

$userName = $_GET['userName'];

if(!(isset($_SESSION['user_name']))) {
	header("Location: ../login.php");
}

if(isset($_SESSION['user_name'])) {
	if($_SESSION['user_name'] != $userName) {
		header("Location: account.php?userName=" . $_SESSION['user_name']);
	}
}
?>

<!doctype html>
<html><head>
		
		<title>My Recipes</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Hamburger menu icon -->
		
		<style>
  			<?php include "../css/main.css"; ?>
			<?php include "../css/header.css"; ?>
			<?php include "../css/account.css";?>
			<?php include "../css/footer.css"; ?>
		</style>
		
		<script>
			
			let recipeJSONItem;
			let recipeItem;
			let recipes = [];
			
			for(let i=0; i<localStorage.length; i++) {
				recipeJSONItem = localStorage.getItem(localStorage.key(i));
				recipeItem = JSON.parse(recipeJSONItem);
				console.log("recipe: " + recipeItem);
				recipes[i] = recipeItem;
			}
			
		</script>
		
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
		
		<main>
			
			<div id="container">
			
				<h1>MY RECIPE BOOK</h1>

				<script>
					for(i=0; i<recipes.length; i++) {
						document.write("<div class='recipe_card'>");
							document.write("<button class='recipe_title'>" + recipes[i].name + "</button>");
							document.write("<div class='panel'>");
								document.write("<img class='recipe_image' src='" + recipes[i].image + "'>");
								document.write("<div class='recipe_header'>");
									document.write("<p> Author: " + recipes[i].author + "</p>");
									document.write("<p> Difficulty: <img src='../images/difficulty/lime_rating" + recipes[i].difficulty + ".jpg'></p>");
									document.write("<p> Description: " + recipes[i].description + "</p>");
									document.write("<p> Cook Time: " + recipes[i].cookTime + "</p>");
									document.write("<p> Servings: " + recipes[i].servings + "</p>");
								document.write("</div>");
								document.write("<div class='ingredients'>");
									document.write("<h3>INGREDIENTS</h3>");
									for(j=0; j<recipes[i].amounts.length; j++) {
										let c = j + 1;
										document.write("<p>" + c + ". " + recipes[i].amounts[j] + " " + recipes[i].ingredients[j] + "</p>");
									}
								document.write("</div>");
								document.write("<div class='directions'>");
									document.write("<h3>DIRECTIONS</h3>")
									for(k=0; k<recipes[i].directions.length; k++) {
										let d = k + 1;
										document.write("<p>" + d + ". "+ recipes[i].directions[k] + "</p>");					
									}
								document.write("</div>");
							document.write("</div>");
						document.write("</div>");
					}
				</script>
			</div>
					
		</main>
		
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
		
		<script>
			
			let accordion = document.getElementsByClassName("recipe_title");
			
			for(let i=0; i<accordion.length; i++) {
				accordion[i].addEventListener("click", function() {
					this.classList.toggle("active");
					let panel = this.nextElementSibling;
					if(panel.style.maxHeight) {
						panel.style.maxHeight = null;
					} else {
						panel.style.maxHeight = panel.scrollHeight + "px";
					}
				})
			}
			
		</script>
		
	</body>
</html>
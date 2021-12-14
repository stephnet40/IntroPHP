<?php

include "dbConnect.php";
$copyrightDate = date('Y');

session_start();

if(isset($_SESSION['user_name'])) {
	header("members/index.php");
}

try {
	
	$sql = "SELECT recipe_ID, recipe_image, recipe_name FROM limecove_header ORDER BY recipe_ID DESC LIMIT 4;";
	
	$stmt = $conn->prepare($sql);       
    $stmt->execute(); 
	
	$mostRecent = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
}
catch(PDOException $e){
	echo "Errors: " . $e->getMessage();
}

try {
	
	$sql = "SELECT recipe_ID, recipe_image, recipe_name FROM limecove_header ORDER BY recipe_ID LIMIT 4;";
	
	$stmt = $conn->prepare($sql);       
    $stmt->execute(); 
	
	$mostPopular = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
}
catch(PDOException $e){
	echo "Errors: " . $e->getMessage();
}

try {
	
	$sql = "SELECT recipe_ID, recipe_image, recipe_name, recipe_description FROM limecove_header;";
	
	$stmt = $conn->prepare($sql);       
    $stmt->execute();
        
    $recipeArray = $stmt->fetchAll(PDO::FETCH_ASSOC); 
	
}
catch(PDOException $e){
	echo "Errors: " . $e->getMessage();
}

?>

<!doctype html>
<html>
	<head>
		
		<title>Lime Cove</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Hamburger menu icon -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
		
		<style>
  			<?php include "css/main.css"; ?>
			<?php include "css/header.css"; ?>
			<?php include "css/index.css"; ?>
			<?php include "css/footer.css"; ?>
		</style>
		
	</head>

	<body>
		
		<header>
			
				
				<div class="sign_up_login">
					
					<p><a class="sign_up" href="members/create_account.php">Sign Up</a> <a class="login" href="members/login.php">Login</a></p>
					
				</div>
				
				<nav>
					
					<ul id="desktop_nav">
	
							<li><a href="index.php">HOME</a></li>
							<li><a href="recipes.php">RECIPES</a></li>
							<img src="images/limecove_scroll_LOGO_transparent.png" src="Lime Cove Logo">
							<li><a href="contact.php">CONTACT</a></li>
							<li><a href="about.php">ABOUT</a></li>
						
					</ul>
					
					<div id="mobile_nav">
						<img src="images/limecove_scroll_LOGO_transparent.png">
						<ul>
							<input type="checkbox" id="checkbox_toggle">
							<label for="checkbox_toggle" class="hamburger"><i class="fa fa-bars"></i></label>

							<div class="menu">
								<li><a href="index.php">HOME</a></li>
								<li><a href="recipes.php">RECIPES</a></li>

								<li><a href="contact.php">CONTACT</a></li>
								<li><a href="about.php">ABOUT</a></li>
								<li><a href="members/create_account.php">SIGN UP</a></li>
								<li><a href="members/login.php">LOGIN</a></li>
							</div>
						</ul>
					</div>
					
				</nav>
				
			</header>
		
		<div id="container">
		
			<main>
				
				<section id="featured_recipe">
					
					<!-- Featured Recipe -->
					
					<?php
						foreach($recipeArray as $recipe) {
							if($recipe['recipe_name'] == "Havana Dreamin Pie") {
					?>
								<div class="section_container">
					
									<h2 class="mobile_name"><a href="full_recipe.php?recipeID=<?php echo $recipe['recipe_ID'] ?>"><?php echo strtoupper($recipe['recipe_name']) ?></a></h2>
									<img src="images/recipe_images/<?php echo $recipe['recipe_image'] ?>">

									<div>
										<h2 class="recipe_name"><a href="full_recipe.php?recipeID=<?php echo $recipe['recipe_ID'] ?>"><?php echo strtoupper($recipe['recipe_name']) ?></a></h2>
										<p><?php echo $recipe['recipe_description'] ?></p>
									</div>
									
								</div>
					
					<?php
							}
						}
					?>
				</section>
				
				<section id="newest_recipes">
					
					<!-- Newest Recipes -->
					<div class="section_container">
						<h1>NEWEST RECIPES</h1>

						<div class="newest_thumbnails">
						<?php
								foreach($mostRecent as $recipe) {

						?>
										<div>
											<a href="full_recipe.php?recipeID=<?php echo $recipe['recipe_ID'] ?>"><img src="images/recipe_images/<?php echo $recipe['recipe_image'] ?>"></a>
											<a href="full_recipe.php?recipeID=<?php echo $recipe['recipe_ID'] ?>"><h3><?php echo strtoupper($recipe['recipe_name']) ?></h3></a>					
										</div>
						<?php

							}
						?>
						</div>
						
						<div id="mobile_carousel_new" class="carousel slide" data-ride="carousel">
						
							<div class="carousel-inner">
								
								<?php
								$i = 0;
								foreach($mostRecent as $recipe) {
									if($i == 0) {
										$activeClass = "active";
									} else {
										$activeClass = "";
									}
								?>
										<div class="carousel-item <?php echo $activeClass ?>">
											<a href="full_recipe.php?recipeID=<?php echo $recipe['recipe_ID'] ?>"><img src="images/recipe_images/<?php echo $recipe['recipe_image'] ?>"></a>
											<a href="full_recipe.php?recipeID=<?php echo $recipe['recipe_ID'] ?>"><h3><?php echo strtoupper($recipe['recipe_name']) ?></h3></a>					
										</div>
						<?php
								$i++;
							}
						?>
								
							</div>
							<a class="carousel-control-prev" href="#mobile_carousel_new" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#mobile_carousel_new" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
					</div>
					
				</section>
				
				<section id="recipe_categories">
					
					<h1>RECIPE CATEGORIES</h1>
					<!-- Recipe Categories -->
					<div class="section_container">

						<div>

							<div>
								<a href="recipes.php"><p>MEALS</p></a>
								<a href="recipes.php"><img src="images/Category Images/meals.jpg" alt="Meal category"></a>
							</div>

							<div>
								<a href="recipes.php"><p>DRINKS</p></a>
								<a href="recipes.php"><img src="images/Category Images/drinks.jpg" alt="Drinks category"></a>
							</div>

							<div>
								<a href="recipes.php"><p>SOUP</p></a>
								<a href="recipes.php"><img src="images/Category Images/soup.jpg" alt="Soup category"></a>
							</div>

							<div>
								<a href="recipes.php"><p>SWEETS</p></a>
								<a href="recipes.php"><img src="images/Category Images/sweets.jpg" alt="Sweets category"></a>
							</div>

							<div>
								<a href="recipes.php"><p>GRILL</p></a>
								<a href="recipes.php"><img src="images/Category Images/grill.jpg" alt="Grill category"></a>
							</div>

						</div>
					</div>
					
					<div id="category_carousel" class="carousel" data-ride="carousel">
						
						<div class="carousel-inner">
							
							<div class="carousel-item active">
								<a href="recipes.php"><p>MEALS</p></a>
								<a href="recipes.php"><img src="images/Category Images/meals.jpg" alt="Meal category"></a>
							</div>

							<div class="carousel-item">
								<a href="recipes.php"><p>DRINKS</p></a>
								<a href="recipes.php"><img src="images/Category Images/drinks.jpg" alt="Drinks category"></a>
							</div>

							<div class="carousel-item">
								<a href="recipes.php"><p>SOUP</p></a>
								<a href="recipes.php"><img src="images/Category Images/soup.jpg" alt="Soup category"></a>
							</div>

							<div class="carousel-item">
								<a href="recipes.php"><p>SWEETS</p></a>
								<a href="recipes.php"><img src="images/Category Images/sweets.jpg" alt="Sweets category"></a>
							</div>

							<div class="carousel-item">
								<a href="recipes.php"><p>GRILL</p></a>
								<a href="recipes.php"><img src="images/Category Images/grill.jpg" alt="Grill category"></a>
							</div>
							
						</div>
						
						<a class="carousel-control-prev" href="#category_carousel" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#category_carousel" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
						
					</div>
					
				</section>
			
				<section id="popular_recipes">
					
					<!-- Fast Recipes -->
					<div class="section_container">
						<h1>POPULAR RECIPES</h1>

						<div class="newest_thumbnails">
						<?php
								foreach($mostPopular as $recipe) {

						?>
										<div>
											<a href="full_recipe.php?recipeID=<?php echo $recipe['recipe_ID'] ?>"><img src="images/recipe_images/<?php echo $recipe['recipe_image'] ?>"></a>
											<a href="full_recipe.php?recipeID=<?php echo $recipe['recipe_ID'] ?>"><h3><?php echo strtoupper($recipe['recipe_name']) ?></h3></a>					
										</div>
						<?php

							}
						?>
						</div>
						
						<div id="mobile_carousel_popular" class="carousel slide" data-ride="carousel">
						
							<div class="carousel-inner">
								
								<?php
								$i = 0;
								foreach($mostPopular as $recipe) {
									if($i == 0) {
										$activeClass = "active";
									} else {
										$activeClass = "";
									}
								?>
										<div class="carousel-item <?php echo $activeClass ?>">
											<a href="full_recipe.php?recipeID=<?php echo $recipe['recipe_ID'] ?>"><img src="images/recipe_images/<?php echo $recipe['recipe_image'] ?>"></a>
											<a href="full_recipe.php?recipeID=<?php echo $recipe['recipe_ID'] ?>"><h3><?php echo strtoupper($recipe['recipe_name']) ?></h3></a>					
										</div>
						<?php
								$i++;
							}
						?>
								
							</div>
							<a class="carousel-control-prev" href="#mobile_carousel_popular" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#mobile_carousel_popular" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
						
					</div>
					
				</section>
				
				<section id="chicken_recipes">
					
					<!-- Chicken Recipes -->
					<div class="section_container">
						<h1>CHICKEN RECIPES</h1>

						<div class="newest_thumbnails">
						<?php
								foreach($mostRecent as $recipe) {

						?>
										<div>
											<a href="full_recipe.php?recipeID=<?php echo $recipe['recipe_ID'] ?>"><img src="images/recipe_images/<?php echo $recipe['recipe_image'] ?>"></a>
											<a href="full_recipe.php?recipeID=<?php echo $recipe['recipe_ID'] ?>"><h3><?php echo strtoupper($recipe['recipe_name']) ?></h3></a>					
										</div>
						<?php

							}
						?>
						</div>
						
						<div id="mobile_carousel_chicken" class="carousel slide" data-ride="carousel">
						
							<div class="carousel-inner">
								
								<?php
								$i = 0;
								foreach($mostRecent as $recipe) {
									if($i == 0) {
										$activeClass = "active";
									} else {
										$activeClass = "";
									}
								?>
										<div class="carousel-item <?php echo $activeClass ?>">
											<a href="full_recipe.php?recipeID=<?php echo $recipe['recipe_ID'] ?>"><img src="images/recipe_images/<?php echo $recipe['recipe_image'] ?>"></a>
											<a href="full_recipe.php?recipeID=<?php echo $recipe['recipe_ID'] ?>"><h3><?php echo strtoupper($recipe['recipe_name']) ?></h3></a>					
										</div>
						<?php
								$i++;
							}
						?>
								
							</div>
							<a class="carousel-control-prev" href="#mobile_carousel_chicken" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#mobile_carousel_chicken" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
					</div>
					
				</section>
				
			</main>
			
			<footer>
				
				<div>
					<!-- Secondary Nav -->
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="recipes.php">Recipes</a></li>
						<li><a href="contact.php">Contact</a></li>
						<li><a href="about.php">About</a></li>
						<li><a href="admin/admin_login.php">Staff Login</a></li>
					</ul>
				</div>
				
				<div>
					<!-- Logo -->
					<img src="images/limecove_tricolor_LOGO.png">
					
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
						<img src="images/ez_facebook_logo.jpg" href="https://www.facebook.com/" alt="Facebook Logo">
						<img src="images/ex_instagram_logo.jpg" href="https://www.instagram.com/" alt="Instagram Logo">
						<img src="images/ex_twitter_logo.jpg" href="https://twitter.com/" alt="Twitter Logo">
						
					</div>
					
					<div class="social_media mobile_copyright">
						<p><a href="admin/admin_login.php">Staff Login</a></p>
						&copy;<?php echo $copyrightDate; ?> Lime Cove All Rights Reserved
					</div>
					
				</div>
				
			</footer>
			
		</div>
		
	</body>
</html>
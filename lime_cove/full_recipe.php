<?php

include "dbConnect.php";
$copyrightDate = date('Y');

$recipeID = $_GET['recipeID'];

if(isset($_SESSION['user_name'])) {
	header("Location: members/full_recipe.php?recipeID=" . $recipeID);
}

try {	// Connect to Recipe Header
	
	$sql = "SELECT recipe_image, recipe_name, recipe_author, recipe_difficulty, recipe_description, cook_time, recipe_servings FROM limecove_header WHERE recipe_ID=:recipeID;";	
	$stmt = $conn->prepare($sql);  
	$stmt->bindParam(":recipeID", $recipeID);
    $stmt->execute();
        
    $recipeHeader = $stmt->fetch(PDO::FETCH_ASSOC); 
	
}
catch(PDOException $e){
	echo "Error: " . $e->getMessage();
}

try {	// Connect to Ingredient Amounts
	
	$sql = "SELECT ingredient_1, ingredient_2, ingredient_3, ingredient_4, ingredient_5, ingredient_6, ingredient_7, ingredient_8, ingredient_9, ingredient_10, ingredient_11, ingredient_12, ingredient_13, ingredient_14, ingredient_15, ingredient_16, ingredient_17, ingredient_18, ingredient_19, ingredient_20 FROM limecove_ingredients WHERE recipe_ID=:recipeID;";	
	$stmt = $conn->prepare($sql);  
	$stmt->bindParam(":recipeID", $recipeID);
    $stmt->execute();
        
    $ingredientAmounts = $stmt->fetch(PDO::FETCH_ASSOC); 
	
}
catch(PDOException $e){
	echo "Error: " . $e->getMessage();
}

try {	// Connect to Ingredient Names
	
	$sql = "SELECT ingredient_1, ingredient_2, ingredient_3, ingredient_4, ingredient_5, ingredient_6, ingredient_7, ingredient_8, ingredient_9, ingredient_10, ingredient_11, ingredient_12, ingredient_13, ingredient_14, ingredient_15, ingredient_16, ingredient_17, ingredient_18, ingredient_19, ingredient_20 FROM limecove_ingredient_names WHERE recipe_ID=:recipeID;";	
	$stmt = $conn->prepare($sql);  
	$stmt->bindParam(":recipeID", $recipeID);
    $stmt->execute();
        
    $ingredientNames = $stmt->fetch(PDO::FETCH_ASSOC); 
	
}
catch(PDOException $e){
	echo "Error: " . $e->getMessage();
}

try {	// Connect to Recipe Directions
	
	$sql = "SELECT step_1, step_2, step_3, step_4, step_5, step_6, step_7, step_8, step_9, step_10 FROM limecove_directions WHERE recipe_ID=:recipeID;";	
	$stmt = $conn->prepare($sql);  
	$stmt->bindParam(":recipeID", $recipeID);
    $stmt->execute();
        
    $recipeDirections = $stmt->fetch(PDO::FETCH_ASSOC); 
	
}
catch(PDOException $e){
	echo "Error: " . $e->getMessage();
}

try { // Recommendations at bottom of page
	
	$sql = "SELECT recipe_ID, recipe_image FROM limecove_header WHERE recipe_ID!=:recipeID LIMIT 3;";	
	$stmt = $conn->prepare($sql);  
	$stmt->bindParam(":recipeID", $recipeID);
    $stmt->execute();
        
    $recipeRecs = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch(PDOException $e){
	echo "Error: " . $e->getMessage();
}

$totalIngredients = 0;
for($i=1; $i<20; $i++) {
	if(!empty($ingredientAmounts['ingredient_' . $i])) {
		$totalIngredients++;			
	}
}

$recipeName = $recipeHeader['recipe_name'];
$recipeAuthor = $recipeHeader['recipe_author'];
$recipeDifficulty = $recipeHeader['recipe_difficulty'];
$recipeDescription = $recipeHeader['recipe_description'];
$cookTime = $recipeHeader['cook_time'];
$recipeServings = $recipeHeader['recipe_servings'];
$recipeImage = $recipeHeader['recipe_image'];

?>

<!doctype html>
<html>
	<head>
		
		<title><?php echo $recipeName; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Hamburger menu icon -->
		
		<script>
			
			let recipeServings = <?php echo $recipeServings; ?>;
			let defaultServing = <?php echo $recipeServings; ?>;
			let changePercent = 1 / <?php echo $recipeServings; ?>;
			let totalIngredients = <?php echo $totalIngredients; ?>;
			let defaultAmount;
			let recipeSpanID;
			let ingredientAmount;
			let changeAmount;
			
			// Reduces the amount of ingredients based on serving size
			// Runs when the subtract_serving button is clicked
			function subtractIngredients() {
				<?php
					for($i=1; $i<$totalIngredients; $i++){
				?>
				console.log(recipeServings);
					if(recipeServings >= 1) {
						defaultAmount = <?php echo $ingredientAmounts['ingredient_' . $i]; ?>;
						defaultAmount = parseFloat(defaultAmount);
						ingredientAmount = document.getElementById("ingredientAmount<?php echo $i ?>").innerHTML;
						ingredientAmount = parseFloat(ingredientAmount);
							
							changeAmount = defaultAmount * changePercent;
							ingredientAmount -= changeAmount;
						
							document.getElementById("ingredientAmount<?php echo $i ?>").innerHTML = ingredientAmount.toFixed(2);
							if(recipeServings != defaultServing) {
								document.getElementById("ingredientAmount<?php echo $i ?>").innerHTML = ingredientAmount.toFixed(2);
							}
							else {
								document.getElementById("ingredientAmount<?php echo $i ?>").innerHTML = defaultAmount;
							}
					} 
				<?php
					}
				?>
				
				}
			
			// Adds to the amount of ingredients based on serving size
			// Runs when the add_serving button is clicked
			function addIngredients() {	
				<?php
					for($i=1; $i<$totalIngredients; $i++){
				?>
				console.log(recipeServings);
					if(recipeServings <= 15) {
						defaultAmount = <?php echo $ingredientAmounts['ingredient_' . $i]; ?>;
						defaultAmount = parseFloat(defaultAmount);
						ingredientAmount = document.getElementById("ingredientAmount<?php echo $i ?>").innerHTML;
						ingredientAmount = parseFloat(ingredientAmount);
				
							changeAmount = defaultAmount * changePercent;
							ingredientAmount += changeAmount;
						
							document.getElementById("ingredientAmount<?php echo $i ?>").innerHTML = ingredientAmount.toFixed(2);
							if(recipeServings != defaultServing) {
								document.getElementById("ingredientAmount<?php echo $i ?>").innerHTML = ingredientAmount.toFixed(2);
							}
							else {
								document.getElementById("ingredientAmount<?php echo $i ?>").innerHTML = defaultAmount;
							}
					}
				<?php
					}
				?>
				}
				
			
			function subtractServing() {
				if(recipeServings > 1) {
					recipeServings--;
					document.querySelector("span.num_servings").innerHTML = recipeServings;
					document.querySelector("button.subtract_ingredients").click(); // Clicks hidden button that will call subtractIngredients function
				} 
				if(recipeServings <= 1) {
					recipeServings = 1;
					document.querySelector("span.num_servings").innerHTML = 1; // Stops counter
				}
		
			}
			
			function addServing() {
				if(recipeServings < 15) {
					recipeServings++; 
					document.querySelector("span.num_servings").innerHTML = recipeServings;
					document.querySelector("button.add_ingredients").click(); // Clicks hidden button that will call addIngredients function
				} 
				if(recipeServings >= 15) {
					recipeServings = 15;
					document.querySelector("span.num_servings").innerHTML = 15; // Stops counter
				}
			
			}
			
		</script>
		
		<style>
  			<?php include "css/main.css"; ?>
			<?php include "css/header.css"; ?>
			<?php include "css/full_recipe.css"; ?>		
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
				
				<section class="recipe_header">
					<!-- Recipe Header -->
					
					<div>
						<h1><?php echo strtoupper($recipeName); ?></h1>
						<h2><?php echo strtoupper($recipeAuthor); ?></h2>
						<p class="difficulty">Difficulty:<br><img src="images/difficulty/lime_rating<?php echo $recipeDifficulty; ?>.jpg"></p>
						<p><?php echo $recipeDescription; ?></p>
						<p><?php echo "Cook Time: " . $cookTime; ?></p>
						<p>
							Servings:
							<button class="subtract_serving" onClick="subtractServing()">-</button>
							<span class="num_servings"><script>document.querySelector("span.num_servings").innerHTML=<?php echo $recipeServings; ?>;</script></span>
							<button class="add_serving" onClick="addServing()">+</button>
						</p>
					</div>
					
					<div>
						<img src="images/recipe_images/<?php echo $recipeImage; ?>">
					</div>
					
				</section>
				
				<section class="ingredients">	
					<!-- Recipe Ingredients -->
					
					<!-- Hidden buttons that activate the functions that adjust the ingredient amounts -->
					<!-- Runs when the add_serving or subtract_serving buttons are clicked -->
					<button class="subtract_ingredients change_ingredients" onClick="subtractIngredients()"></button>
					<button class="add_ingredients change_ingredients" onClick="addIngredients()"></button>
					
					<button class="accordion"><h2>INGREDIENTS</h2></button>
					
					<div class="panel">
					<?php
							for($i=1 ;$i<=20; $i++) {
								$ingredientAmount = $ingredientAmounts['ingredient_' . $i];
								$ingredientName = $ingredientNames['ingredient_' . $i];
								if (!empty($ingredientAmount)) {
					?>
									<script>
										ingredientAmount = <?php echo $ingredientAmount; ?>;
									</script>
									<div>
										<input type="checkbox" name="<?php echo  $ingredientName; ?>" id="<?php echo  $ingredientName; ?>">
										<label class="ingredients" for="<?php echo  $ingredientName; ?>"><span id="ingredientAmount<?php echo $i ?>"><?php echo $ingredientAmount; ?></span><span> <?php echo $ingredientName; ?></span></label>
									</div>
					
					<?php
								}
							}
					?>			
					</div>
						
				</section>
				
				<section class="recipe_directions">
					<!-- Recipe Directions -->
					<button class="accordion"><h2>DIRECTIONS</h2></button>
					<div class="panel">
						<?php
							for($i=1 ;$i<=10; $i++) {
								$recipeStep = $recipeDirections['step_' . $i];
								if (!empty($recipeStep)) {
						?>
									<div>
										<input type="checkbox" name="<?php echo $recipeStep; ?>" id="<?php echo $recipeStep; ?>">
										<label for="<?php echo $recipeStep; ?>"> <?php echo $i . ". " . $recipeStep ?> </label>
									</div>
						<?php
								}
							}
						?>
						</div>
				</section>
				
				<section class="recommendations">
					
					<h2>CHECK OUT THESE RECIPES</h2>
					
					<div>
						<?php
							foreach($recipeRecs as $recipe) {
						?>
							<div>
							<a href="full_recipe.php?recipeID=<?php echo $recipe['recipe_ID'] ?>"><img src="images/recipe_images/<?php echo $recipe['recipe_image'] ?>"></a>
							</div>
						<?php
							}
						?>
					</div>
					
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
		
		<script>
			
			let accordion = document.getElementsByClassName("accordion");
			
			for (let i=0; i<accordion.length; i++) {
				accordion[i].addEventListener("click", function() {
					this.classList.toggle("active");
					
					let panel = this.nextElementSibling;
					if (panel.style.display === "block") {
						panel.style.display = "none";
					} else {
						panel.style.display = "block";
					}
				})
			}
			
		</script>
		
	</body>
</html>
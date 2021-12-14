<?php

include "../dbConnect.php";
$copyrightDate = date('Y');

session_start();

if(isset($_POST['submit'])) {
	if(empty($_POST['middle_name'])) {
		$recipeName = $_POST['recipe_name'];
		$recipeAuthor = $_POST['author'];
		$recipeDifficulty = $_POST['difficulty'];
		$recipeDescription = $_POST['recipe_description'];
		$cookTime = $_POST['cook_time'];
		$recipeServings = $_POST['servings'];
		$recipeImage = $_POST['select_image'];

		// Insert to header table
		try {

			$sql = "INSERT INTO limecove_header (recipe_image,recipe_name,recipe_author,recipe_difficulty,recipe_description,cook_time,recipe_servings) VALUES (:recipeImage,:recipeName,:recipeAuthor,:recipeDifficulty,:recipeDescription,:cookTime,:recipeServings)";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':recipeImage', $recipeImage);
			$stmt->bindParam(':recipeName', $recipeName);
			$stmt->bindParam(':recipeAuthor', $recipeAuthor);
			$stmt->bindParam(':recipeDifficulty', $recipeDifficulty);
			$stmt->bindParam(':recipeDescription', $recipeDescription);
			$stmt->bindParam(':cookTime', $cookTime);
			$stmt->bindParam(':recipeServings', $recipeServings);

			$stmt->execute();	

		}
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}

		//Insert to ingredient amount table

		$ingredientAmount = array();

		for($i=0; $i<20; $i++) {

			$j = $i + 1;

			if(isset($_POST['add_amount_' . $j])) {
				$ingredientAmount[$i] = $_POST['add_amount_' . $j];
			}	
		}	

		try {

			$sql = "INSERT INTO limecove_ingredients (recipe_name,ingredient_1,ingredient_2,ingredient_3,ingredient_4,ingredient_5,ingredient_6,ingredient_7,ingredient_8,ingredient_9,ingredient_10,ingredient_11,ingredient_12,ingredient_13,ingredient_14,ingredient_15,ingredient_16,ingredient_17,ingredient_18,ingredient_19,ingredient_20) VALUES (:recipeName,:ingredient1,:ingredient2,:ingredient3,:ingredient4,:ingredient5,:ingredient6,:ingredient7,:ingredient8,:ingredient9,:ingredient10,:ingredient11,:ingredient12,:ingredient13,:ingredient14,:ingredient15,:ingredient16,:ingredient17,:ingredient18,:ingredient19,:ingredient20)";

			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':recipeName', $recipeName);

			for($i=0; $i<20; $i++) {

				$j = $i + 1;

				$stmt->bindParam(':ingredient' . $j, $ingredientAmount[$i]);

			}

			$stmt->execute();

		}
		catch(PDOException $e) {

		}

		// Insert to ingredient name table

		$ingredientName = array();

		for($i=0;$i<20;$i++) {

			$j = $i + 1;

			if(isset($_POST['add_ingredient_' . $j])) {
				$ingredientName[$i] = $_POST['add_ingredient_' . $j];
			}	
		}


		try {

			$sql = "INSERT INTO limecove_ingredient_names (recipe_name,ingredient_1,ingredient_2,ingredient_3,ingredient_4,ingredient_5,ingredient_6,ingredient_7,ingredient_8,ingredient_9,ingredient_10,ingredient_11,ingredient_12,ingredient_13,ingredient_14,ingredient_15,ingredient_16,ingredient_17,ingredient_18,ingredient_19,ingredient_20) VALUES (:recipeName,:ingredient1,:ingredient2,:ingredient3,:ingredient4,:ingredient5,:ingredient6,:ingredient7,:ingredient8,:ingredient9,:ingredient10,:ingredient11,:ingredient12,:ingredient13,:ingredient14,:ingredient15,:ingredient16,:ingredient17,:ingredient18,:ingredient19,:ingredient20)";

			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':recipeName', $recipeName);

			for($i=0; $i<20; $i++) {

				$j = $i + 1;

				$stmt->bindParam(':ingredient' . $j, $ingredientName[$i]);

			}

			$stmt->execute();
		}
		catch(PDOException $e) {

		}

		// Insert to directions table

		$newDirection = array();

		for($i=0;$i<10;$i++) {

			$j = $i + 1;

			if(isset($_POST['new_direction_' . $j])) {
				$newDirection[$i] = $_POST['new_direction_' . $j];
			}

		}

		try {

			$sql = "INSERT INTO limecove_directions (recipe_name,step_1,step_2,step_3,step_4,step_5,step_6,step_7,step_8,step_9,step_10) VALUES (:recipeName,:step1,:step2,:step3,:step4,:step5,:step6,:step7,:step8,:step9,:step10)";

			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':recipeName', $recipeName);

			for($i=0; $i<10; $i++) {

				echo $newDirection[$i];

				$j = $i + 1;

				$stmt->bindParam(':step' . $j, $newDirection[$i]);

			}

			$stmt->execute();

		}
		catch(PDOException $e) {

		}
		
		echo "<script>alert('Recipe successfully added to database!')</script>";
	}
}

?>

<!doctype html>
<html>
	<head>
		
		<title>Add a Recipe</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Hamburger menu icon -->
		
		<script>
			
			let numIngredients = 1;
			let numDirections = 1;
			
			function addNewIngredient() {
				numIngredients++;		
				let i = numIngredients;
				
				document.getElementById("add_amount_" + i).style.display = "block";
				document.getElementById("add_ingredient_" + i).style.display = "block";
			}
			
			function addNewDirection() {
				numDirections++;
				let i = numDirections;
				
				document.getElementById("new_direction_" + i).style.display = "block";
			}
			
			function showImage(select) {
				for(let i=1; i<=11; i++) {
					if(select.value == "recipe_filler_" + i + ".jpg") {
						document.querySelector(".filler_" + i).style.display = "block";
					} else {
						document.querySelector(".filler_" + i).style.display = "none";
						}
					}
			}
			
			function formValidation() {
				
				let reg = /^(?:\d*\.\d{1,2}|\d+)$/;			
				let validate = true;
				
				for(let i=1; i<20 ; i++) {
					
					let inValue = document.querySelector("#add_amount_" + i).value;
					if(inValue != "") {
						let validateValue = reg.test(inValue);

						console.log(validateValue);

						if(validateValue == false) {
							validate = false;
						}
					}
				}
				
				if(validate == false) {
					document.querySelector(".error_msg").innerHTML = "Amount must be a number or decimal";
					document.querySelector(".error_msg").style.color = "red";
				} else {
					document.getElementById("submit").click();
				}
				
			}
			
		</script>
		
		<style>
  			<?php include "../css/main.css"; ?>
			<?php include "../css/header.css"; ?>
			<?php include "../css/add_recipe.css";?>
			<?php include "../css/admin.css";?>
			<?php include "../css/footer.css"; ?>
		</style>
		
	</head>

	<body>
		
		<header>
				
			<div class="sign_up_login">
					
					<p><a class="logout" href="admin_logout.php">Logout</a></p>
					
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
								<li><a href="add_recipe.php">ADD RECIPE</a></li>
								<li><a href="view_all.php">ALL RECIPES</a></li>
								<li><a href="logout.php">LOGOUT</a></li>
							</div>
						</ul>
					</div>
					
				</nav>
				
		</header>
		
		<main id="add_recipe">
			
			<div class="admin_tool_bar">
				
				<!-- Admin Tool Bar -->
				
				<div>
					<img class="desktop" src="../images/lime_cove_lock.png">
					<img class="mobile" src="../images/lime_cove_lock_MOBILE.png">
					<p><a href="admin_home.php">ADMIN MODE</a></p>
				</div>
				
				<div class="admin_links">
					<p><a href="add_recipe.php">ADD RECIPE</a></p>
					
					<p><a href="view_all.php">VIEW ALL</a></p>
				</div>
				
			</div>
			
			<div id="container">
				
				<h1 class="admin">ADD A RECIPE</h1>
			
				<form method="post" action="add_recipe.php">
					
					<p>
						Use the form below to add a recipe to out database! 
						Use the + to add additional fields.
					</p>

					<div id="user_image">
							<img class="filler_1" src="../images/recipe_images/recipe_filler_1.jpg">
							<img class="filler_2" src="../images/recipe_images/recipe_filler_2.jpg">
							<img class="filler_3" src="../images/recipe_images/recipe_filler_3.jpg">
							<img class="filler_4" src="../images/recipe_images/recipe_filler_4.jpg">
							<img class="filler_5" src="../images/recipe_images/recipe_filler_5.jpg">
							<img class="filler_6" src="../images/recipe_images/recipe_filler_6.jpg">
							<img class="filler_7" src="../images/recipe_images/recipe_filler_7.jpg">
							<img class="filler_8" src="../images/recipe_images/recipe_filler_8.jpg">
							<img class="filler_9" src="../images/recipe_images/recipe_filler_9.jpg">
							<img class="filler_10" src="../images/recipe_images/recipe_filler_10.jpg">
							
							<label for="select_image">Select Image</label>
							<select name="select_image" id="select_image" onChange="showImage(this)">
								<option value="recipe_filler_1.jpg">Filler Image 1</option>
								<option value="recipe_filler_2.jpg">Filler Image 2</option>
								<option value="recipe_filler_3.jpg">Filler Image 3</option>
								<option value="recipe_filler_4.jpg">Filler Image 4</option>
								<option value="recipe_filler_5.jpg">Filler Image 5</option>
								<option value="recipe_filler_6.jpg">Filler Image 6</option>
								<option value="recipe_filler_7.jpg">Filler Image 7</option>
								<option value="recipe_filler_8.jpg">Filler Image 8</option>
								<option value="recipe_filler_9.jpg">Filler Image 9</option>
								<option value="recipe_filler_10.jpg">Filler Image 10</option>
							</select>
							
						</div>
					<div class="recipe_info">
						<div>
							<label for="recipe_name">Recipe Title</label>
							<input type="text" name="recipe_name" id="recipe_name">
						</div>

						<div>
							<label for="author">Author</label>
							<input type="text" name="author" id="author">
						</div>

						<div>
							<label for="recipe_description">Recipe Description</label>			
							<input type="text" name="recipe_description" id="recipe_description">
						</div>

						<div>
							<label for="difficulty">Difficulty</label>
							<select name="difficulty" id="difficulty">
								<option value="">Choose Difficulty</option>
								<option value="1">1 - easiest</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5 - hardest</option>
							</select>
						</div>

						<div>
							<label for="cook_time">Cook Time</label>
							<input type="text" name="cook_time" id="cook_time">

						</div>

						<div>
							<label for="servings">Servings</label>
							<input type="text" name="servings" id="servings">
						</div>
					</div>

					<h2>INGREDIENTS</h2>
					<div class="error_msg"></div>
					<div>
						<div class="ingredient_form">
							
							<div class="new_amount">
								<label for="add_amount">Amount</label>
								<div name="add_amount" id="add_amount">
									<input type="text" name="add_amount_1" id="add_amount_1" placeholder="ex. 1, 1.5, 2">
									<input type="text" name="add_amount_2" id="add_amount_2" placeholder="ex. 1, 1.5, 2">
									<input type="text" name="add_amount_3" id="add_amount_3" placeholder="ex. 1, 1.5, 2">
									<input type="text" name="add_amount_4" id="add_amount_4" placeholder="ex. 1, 1.5, 2">
									<input type="text" name="add_amount_5" id="add_amount_5" placeholder="ex. 1, 1.5, 2">
									<input type="text" name="add_amount_6" id="add_amount_6" placeholder="ex. 1, 1.5, 2">
									<input type="text" name="add_amount_7" id="add_amount_7" placeholder="ex. 1, 1.5, 2">
									<input type="text" name="add_amount_8" id="add_amount_8" placeholder="ex. 1, 1.5, 2">
									<input type="text" name="add_amount_9" id="add_amount_9" placeholder="ex. 1, 1.5, 2">
									<input type="text" name="add_amount_10" id="add_amount_10" placeholder="ex. 1, 1.5, 2">
									<input type="text" name="add_amount_11" id="add_amount_11" placeholder="ex. 1, 1.5, 2">
									<input type="text" name="add_amount_12" id="add_amount_12" placeholder="ex. 1, 1.5, 2">
									<input type="text" name="add_amount_13" id="add_amount_13" placeholder="ex. 1, 1.5, 2">
									<input type="text" name="add_amount_14" id="add_amount_14" placeholder="ex. 1, 1.5, 2">
									<input type="text" name="add_amount_15" id="add_amount_15" placeholder="ex. 1, 1.5, 2">
									<input type="text" name="add_amount_16" id="add_amount_16" placeholder="ex. 1, 1.5, 2">
									<input type="text" name="add_amount_17" id="add_amount_17" placeholder="ex. 1, 1.5, 2">
									<input type="text" name="add_amount_18" id="add_amount_18" placeholder="ex. 1, 1.5, 2">
									<input type="text" name="add_amount_19" id="add_amount_19" placeholder="ex. 1, 1.5, 2">
									<input type="text" name="add_amount_20" id="add_amount_20" placeholder="ex. 1, 1.5, 2">
								</div>
							</div>
							
							<div class="new_ingredient">
								<label for="add_ingredient">Ingredient</label>
								<div name="add_ingredient" id="add_ingredient">
									<input type="text" name="add_ingredient_1" id="add_ingredient_1" placeholder="ex. teaspoon of vanilla">
									<input type="text" name="add_ingredient_2" id="add_ingredient_2" placeholder="ex. teaspoon of vanilla">
									<input type="text" name="add_ingredient_3" id="add_ingredient_3" placeholder="ex. teaspoon of vanilla">
									<input type="text" name="add_ingredient_4" id="add_ingredient_4" placeholder="ex. teaspoon of vanilla">
									<input type="text" name="add_ingredient_5" id="add_ingredient_5" placeholder="ex. teaspoon of vanilla">
									<input type="text" name="add_ingredient_6" id="add_ingredient_6" placeholder="ex. teaspoon of vanilla">
									<input type="text" name="add_ingredient_7" id="add_ingredient_7" placeholder="ex. teaspoon of vanilla">
									<input type="text" name="add_ingredient_8" id="add_ingredient_8" placeholder="ex. teaspoon of vanilla">
									<input type="text" name="add_ingredient_9" id="add_ingredient_9" placeholder="ex. teaspoon of vanilla">
									<input type="text" name="add_ingredient_10" id="add_ingredient_10" placeholder="ex. teaspoon of vanilla">
									<input type="text" name="add_ingredient_11" id="add_ingredient_11" placeholder="ex. teaspoon of vanilla">
									<input type="text" name="add_ingredient_12" id="add_ingredient_12" placeholder="ex. teaspoon of vanilla">
									<input type="text" name="add_ingredient_13" id="add_ingredient_13" placeholder="ex. teaspoon of vanilla">
									<input type="text" name="add_ingredient_14" id="add_ingredient_14" placeholder="ex. teaspoon of vanilla">
									<input type="text" name="add_ingredient_15" id="add_ingredient_15" placeholder="ex. teaspoon of vanilla">
									<input type="text" name="add_ingredient_16" id="add_ingredient_16" placeholder="ex. teaspoon of vanilla">
									<input type="text" name="add_ingredient_17" id="add_ingredient_17" placeholder="ex. teaspoon of vanilla">
									<input type="text" name="add_ingredient_18" id="add_ingredient_18" placeholder="ex. teaspoon of vanilla">
									<input type="text" name="add_ingredient_19" id="add_ingredient_19" placeholder="ex. teaspoon of vanilla">
									<input type="text" name="add_ingredient_20" id="add_ingredient_20" placeholder="ex. teaspoon of vanilla">
								</div>
							</div>
							
						</div>
						
						<input type="button" onClick="addNewIngredient()" value="+">
					</div>

					<h2>DIRECTIONS</h2>
					<div>
						<div id=add_direction>
							<textarea name="new_direction_1" id="new_direction_1"></textarea>
							<textarea name="new_direction_2" id="new_direction_2"></textarea>
							<textarea name="new_direction_3" id="new_direction_3"></textarea>
							<textarea name="new_direction_4" id="new_direction_4"></textarea>
							<textarea name="new_direction_5" id="new_direction_5"></textarea>
							<textarea name="new_direction_6" id="new_direction_6"></textarea>
							<textarea name="new_direction_7" id="new_direction_7"></textarea>
							<textarea name="new_direction_8" id="new_direction_8"></textarea>
							<textarea name="new_direction_9" id="new_direction_9"></textarea>
							<textarea name="new_direction_10" id="new_direction_10"></textarea>
						</div>
						
						<input type="button" onClick="addNewDirection()" value="+">
					</div>
					
					<div class="honey">
						<label for="middle_name"></label>
						<input type="text" name="middle_name" id="middle_name">
					</div>

					<div class="submit_buttons admin">
						<input type="button" name="form_valid" id="form_valid" value="Submit" onClick="formValidation()">
						<input type="submit" name="submit" id="submit" value="Submit">
						<input type="reset" name="reset" id="reset" value="Reset">
					</div>

				</form>
				
			</div>
			
		</main>
		
		<footer>
			
			<div>
					<!-- Secondary Nav -->
					<ul>
						<li><a href="../index.php">Home</a></li>
						<li><a href="../recipes.php">Recipes</a></li>
						<li><a href="../contact.php">Contact</a></li>
						<li><a href="../about.php">About</a></li>
						<li><a href="admin_login.php">Staff Login</a></li>
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
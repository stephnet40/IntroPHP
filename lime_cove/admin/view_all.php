<?php

include "../dbConnect.php";
$copyrightDate = date('Y');

session_start();

try {	// Connect to Recipe Header
	
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
		
		<title>ADMIN: View All Recipes</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Hamburger menu icon -->
		
		<script>
			
			function deleteRecipe(recipeNum) {
				
				if(window.confirm("Are you sure you want to delete this recipe?")) {
					window.location.href = "delete_successful.php?recipeID=" + recipeNum;
					
				}
				
			}
			
		</script>
		
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
		
		<main>
			
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
			
			<div class="recipe_table">
				
				<h1>VIEW ALL RECIPES</h1>
				
				<table>
					<tr>
						<th class="image">Thumbnail</th>
						<th>Recipe #</th>
						<th>Recipe Name</th>
						<th class="description">Description</th>
						<!--<th>UPDATE</th>-->
						<th>DELETE</th>
					</tr>
					
					<?php
						foreach($recipeArray as $recipe) {
					?>
							<tr>
								<td class="image"><img src="../images/recipe_images/<?php echo $recipe['recipe_image']; ?>"></td>
								<td>#<?php echo $recipe['recipe_ID']; ?></td>
								<td class="name"><?php echo $recipe['recipe_name']; ?></td>
								<td class="description"><?php echo $recipe['recipe_description']; ?></td>
								<!--<td><input type="button"></td>-->
								<td><input type="button" onClick="deleteRecipe(<?php echo $recipe['recipe_ID'] ?>)"></td>
							</tr>
					<?php
						}
					?>
					
				</table>
				
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
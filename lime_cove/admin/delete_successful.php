<?php

include "../dbConnect.php";
$copyrightDate = date('Y');

session_start();

$recipeNum = $_GET['recipeID'];

if(isset($_SESSION['admin_name'])) {
		
		try {
			
			$sql = "DELETE FROM limecove_header WHERE recipe_ID=:recipeID";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':recipeID', $recipeNum);
			
			$stmt->execute();
			
		}
		catch(PDOException $e){
			echo "Errors: " . $e->getMessage();
		}
	
		try {
			
			$sql = "DELETE FROM limecove_ingredients WHERE recipe_ID=:recipeID";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':recipeID', $recipeNum);
			
			$stmt->execute();
			
		}
		catch(PDOException $e){
			echo "Errors: " . $e->getMessage();
		}
	
		try {
			
			$sql = "DELETE FROM limecove_ingredient_names WHERE recipe_ID=:recipeID";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':recipeID', $recipeNum);
			
			$stmt->execute();
			
		}
		catch(PDOException $e){
			echo "Errors: " . $e->getMessage();
		}
	
		try {
			
			$sql = "DELETE FROM limecove_directions WHERE recipe_ID=:recipeID";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':recipeID', $recipeNum);
			
			$stmt->execute();
			
		}
		catch(PDOException $e){
			echo "Errors: " . $e->getMessage();
		}
	
	header("Location: view_all.php");
	
}

?>

<!doctype html>
<html>
	<head>
	
		<title>Untitled Document</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<style>
  			<?php include "../css/main.css"; ?>
			<?php include "../css/header.css"; ?>
			<?php include "../css/admin.css";?>
			<?php include "..css/footer.css"; ?>
		</style>
		
	</head>

	<body>
		
		<header>
				
			<div>
					
					<p><a class="logout" href="admin_logout.php">Logout</a></p>
					
				</div>
				
				<nav>
					
					<ul>
						<li><a href="../index.php">HOME</a></li>
						<li><a href="../recipes.php">RECIPES</a></li>
						<img src="../images/limecove_scroll_LOGO_transparent.png" src="Lime Cove Logo">
						<li><a href="../contact.php">CONTACT</a></li>
						<li><a href="../about.php">ABOUT</a></li>
					</ul>
					
				</nav>
				
		</header>
		
		<main>
			
			<div class="admin_tool_bar">
				
				<!-- Admin Tool Bar -->
				
				<div>
					<img src="../images/lime_cove_lock.png">
					<p>ADMIN MODE</p>
				</div>
				
				<div>
					<p><a href="add_recipe.php">ADD RECIPE</a></p>
					
					<p><a href="view_all.php">VIEW ALL</a></p>
				</div>
				
			</div>
			
			<div class="recipe_table">
				
				
				
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
				
				<div>
					<!-- Social Media -->
					<h3>Follow Us</h3>
					
					<div>
						<!-- Icons -->
						<img src="../images/ez_facebook_logo.jpg" href="https://www.facebook.com/" alt="Facebook Logo">
						<img src="../images/ex_instagram_logo.jpg" href="https://www.instagram.com/" alt="Instagram Logo">
						<img src="../images/ex_twitter_logo.jpg" href="https://twitter.com/" alt="Twitter Logo">
						
					</div>
					
				</div>
			
		</footer>
		
	</body>
</html>
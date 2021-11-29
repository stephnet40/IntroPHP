<?php

/*
1. Create an HTML label with the text "Please select a subscription type." below the email field
	a. Add a set of two radio buttons to the HTML form. 
	b. One radio will be have the value "Normal" and the other will have the value "Expert"
2. Create an HTML label with the text "Recieve special offers and latest updates?" below the radio buttons
	a. Add a checkbox to the HTML form and give it a text label of "Yes"
3. Create a label with the text "How did you find us?"
	a. Add an HTML select drop-down list with the following selections to the HTML form.
		1. Word of mouth
		2. Internet
		3. Podcast
4. Add Honeypot security to the form
5. Add PHP in the Model/Controller area of the page that does the following
	a. Checks if the form was submitted via the POST method
	b. Validate the honeypot security
	c. If the form was submitted and the honeypot validation passes, do the following (replace everything in <brackets> with the actual submitted form value)
		1. Display a Success form instead of the default intake form
		2. The success form should say
			1. "Thank you <first name> <last name>"
			2. Subscription Type: <subscrition type>
			3. Recieve Special Offers: <special offers selection> (Will be either "Yes" or "No")
			4. How you found us: <how they found us selection>
			5. A signup confirmation has been sent to <email>. Thank you for your support!
*/

//Model-Controller Area.  The PHP processing code goes in this area.
require_once('functions.php');

// PHP form submission code goes here

if(isset($_POST['submit']) && empty($_POST['middle_name'])) {
	
	if(empty($_POST['receive_updates'])) {
		$specialOffers = "No";
	}
	else {
		$specialOffers = "Yes";
	}
	
	echo "Thank you " . $_POST['first_name'] . " " . $_POST['last_name'] . "<br>";
	echo "Subscription Type: " . $_POST['subscription_type'] . "<br>";
	echo "Receive Special Offers: $specialOffers <br>";
	echo "How you found us: " . $_POST['discovered_us'] . "<br>";
	echo "A sign up confirmation has been sent to " . $_POST['email'] . ". Thank you for your support!";
	
}
else {
	
	if(!empty($_POST['middle_name'])) {
		echo "An error has occurred. Unable to process form.";
	}
	
?>
<!DOCTYPE html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>WDV 341 Intro PHP - Code Example</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <style>
        *,:after,:before{-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box}body{font:normal 15px/25px 'Open Sans',Arial,Helvetica,sans-serif;color:#444;text-align:left}h1,h2,h3{font-weight:400}h1{font:normal 40px/120px 'Open Sans',Arial,Helvetica,sans-serif;text-align:center;color:#444;margin:0}h1 span{color:#484c9b}h2{font-size:25px;line-height:30px;color:#484c9b;margin:50px 0 10px}h3{font-size:18px;line-height:35px;margin:50px 0 0}a{color:#484c9b;text-decoration:none}a:focus,a:hover{text-decoration:underline}p{margin:0 0 2rem}p span{color:#aaa}header{width:98%;margin:40px auto 0;border-bottom:1px solid #ddd;padding-bottom:40px;text-align:center}header p{margin:0}section{width:95%;max-width:910px;margin:40px auto}pre{background:#f9f9f9;padding:10px;font-size:12px;border:1px solid #eee;white-space:pre-wrap;border-radius:10px}table{border:1px solid #eee;background:#f9f9f9;width:100%;border-collapse:collapse;border-spacing:0;margin-bottom:3rem}thead{background:#5965af;color:#fff}tbody tr td,thead td{padding:.5rem .75rem}tbody tr:nth-child(even){background:#efefef}tbody tr td:first-child{padding-left:1.25rem}tbody tr td:first-child,tbody tr td:nth-child(3),thead td:first-child,thead td:nth-child(3){width:15%}tbody tr td:nth-child(2),thead td:nth-child(2){width:20%}tbody tr td:last-child,thead td:last-child{width:50%}@media only screen and (min-width:768px){body{font-size:20px;line-height:30px}h2{font-size:30px;line-height:45px}h3{font-size:22px;line-height:45px;margin-top:50px}p{margin-bottom:2rem}h1{font-size:60px}pre{padding:20px;font-size:15px}}
		
		div {
			margin-top: 20px;
			margin-bottom: 20px;
		}
		
		div div {
			margin-top: 0;
			margin-bottom: 0;
			margin-left: 20px;
		}
		
		p.honey {
			opacity: 0;
			position: absolute;
			top: 0;
			left: 0;
			z-index: -1;
		}
		
    </style>
</head>

<body>
    <header>
        <h1>WDV341 Intro <span>PHP</span></h1>
        <p>Form Handler Result Page - Code Example</p>
    </header>

    <section>
        <h2>Newsletter Signup</h2>
        <p>Please enter your full name and email to recieve our super sweet newsletter!</p>

        <form id="newsletter-form" name="newsletter_form" method="post" action="form-handler-homework.php">
            <p>First Name: <input type="text" name="first_name" id="first-name" /></p>
            <p>Last Name: <input type="text" name="last_name" id="last-name" /></p>
            <p>Email: <input type="text" name="email" id="email" /></p>
			<div>
				<label>Please select a subscription type</label>
					<div>
						<input type="radio" name="subscription_type" id="normal" value="Normal">
						<label for="normal">Normal</label>
					</div>
					<div>
						<input type="radio" name="subscription_type" id="expert" value="Expert">
						<label for="expert">Expert</label>
					</div>
			</div>
		
			<div>
				<label>Receive special offers and latest updates?</label>
					<div>
						<input type="checkbox" name="receive_updates" id="receive_updates" value="receive_updates">
						<label for="receive_updates">Yes</label>
					</div>
			</div>
	
			<p>
				<label>How did you find us?</label>
				<select name="discovered_us" id="discovered_us" value="discovered_us">
					<option value="Word of Mouth">Word of Mouth</option>
					<option value="Internet">Internet</option>
					<option value="Podcast">Podcast</option>
				</select>
			</p>
			
			<p class="honey">
				<label for="name"></label>
				<input type="text" name="middle_name" id="middle_name">
			</p>
			
            <p>
                <input type="submit" name="submit" id="button" value="Submit" />
                <input type="reset" name="button2" id="button2" value="Clear Form" />
            </p>
        </form>
    </section>
</body>

</html>
<?php
}
?>
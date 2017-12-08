<?php
/*
 *  	registration.php
*/
require_once('./dbConnection.php');	// add PDO connection class
$page_title		= 'Registration';
$error_register	= '';				// Store Error Messages

if (isset($_POST['create_account'])) {
	// Get user information from form
	$account_ID		= uniqid();
	$contact_name	= stripslashes($_POST['contact_name']);
	$contact_email	= stripslashes($_POST['contact_email']);
	$user_name		= stripslashes($_POST['user_name']);
	$user_pass		= stripslashes($_POST['password1']);
	$hash_pass		= password_hash($user_pass, PASSWORD_DEFAULT);
	
	// Create a new mysql connection object
	$pdo = new dbConnection();
	
	// Build SQL Query
	$sql = "SELECT * FROM admin_information WHERE contact_email= ? LIMIT 1";
	$query = $pdo->prepare($sql);
	$query->bindParam(1, $contact_email);
	$query->execute();
	$found_email = $query->fetch(PDO::FETCH_ASSOC);
	
	$sql = "SELECT * FROM admin_credentials WHERE admin_name= ? LIMIT 1";
	$query = $pdo->prepare($sql);
	$query->bindParam(1, $user_name);
	$query->execute();
	$found_user = $query->fetch(PDO::FETCH_ASSOC);
	
	if ($found_email) {
		// Email already used
		$error_register = 'Email address is registered to an existing account. Have you created an account, <a href="./forgot_password.php">reset password</a>?';
	} else if ($found_user){
		// Username already selected
		$error_register = 'Username is registered to an existing account, please try another.';
	} else {
		// All good, add user to database
		$sql = "INSERT INTO admin_information VALUES (?, ?, ?)";
		$query = $pdo->prepare($sql);
		$query->bindParam(1, $account_ID);
		$query->bindParam(2, $contact_name);
		$query->bindParam(3, $contact_email);
		$result_info = $query->execute();
		
		$sql = "INSERT INTO admin_credentials VALUES (?, ?, ?)";
		$query = $pdo->prepare($sql);
		$query->bindParam(1, $account_ID);
		$query->bindParam(2, $user_name);
		$query->bindParam(3, $hash_pass);
		$result_cred = $query->execute();
		
		if ($result_info && $result_cred){
			$_SESSION['valid_user'] = $user_name;
			$_SESSION['account_ID'] = $account_ID;
			header("Location: ./profile.php");
		}
	}
	$query->closeCursor();
}
?>
<!DOCTYPE HTML PUBLIC>
<html>

<head>
	<title><?php echo $page_title; ?></title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<script src="./scripts/javascript.js"></script>
</head>

<body>
	<div id="main">
		<h1>Account Registration</h1>
		<div id="form">
			<h2>Enter User Information</h2>
			<form name="form_create_account" action="" method="post" onSubmit="return form_validation(this)">
				<input placeholder="Contact Name..."	id="contact_name" name="contact_name" type="text" autofocus>
				<input placeholder="Email Address..."	id="contact_email" name="contact_email" type="text">
				<input placeholder="Enter a UserID..."		id="user_name" name="user_name" type="text">
				<input placeholder="Select A Password..."	id="password1" name="password1" type="password">
				<input placeholder="Re-Enter Password..."		id="password2" name="password2" type="password">
				
				<input name="create_account" type="submit" value=" Create Account ">
				
				<label>Return to <a href="./index.php">login form</a>...</label>
				
				<div id="error_message"><?php echo $error_register; ?></div>
			</form>
		</div>
	</div>
</body>

</html>

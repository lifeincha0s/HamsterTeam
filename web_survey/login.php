<?php
/*
 * 		login.php
*/
session_start();					// Start Session Cookie
require_once('./dbConnection.php');	// add PDO connection class

$page_title		= 'Login';
$error_login	= '';

if (isset($_POST['login'])) {
	// Get username & password from login form
	$user_name = stripslashes($_POST['user_name']);
	$user_pass = stripslashes($_POST['user_pass']);
	
	// Create a new mysql connection object
	$pdo = new dbConnection();
	
	// Build SQL Query
	$sql = "SELECT * FROM admin_credentials WHERE admin_name= ? LIMIT 1";
	$query = $pdo->prepare($sql);
	$query->bindParam(1, $user_name);
	$query->execute();
	$getPassword = $query->fetch(PDO::FETCH_ASSOC);
	$query->closeCursor();
	
	if (!$getPassword) {
		echo "<script>alert('Error fetching user.');</script>";
	} else {
		$hash_pass = $getPassword['admin_password'];
		if (password_verify($user_pass, $hash_pass) == false) {
			$error_login = "Username or Password is invalid.";
		} else {
			// Initializing Session
			$_SESSION['valid_user']=$user_name;
			$_SESSION['account_ID']=$getPassword['account_ID'];
			// Redirecting To Other Page
			header("Location: ./profile.php");
		}
	}
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
		<h1>Welcome to Web-Based Survey</h1>
		<div id="form">
			<h2>Login Form</h2>
			<form name="form_login" action="" method="post" onSubmit="return form_validation(this)">
				<input id="user_name" name="user_name" placeholder="UserID..." type="text" autofocus>
				<input id="user_pass" name="user_pass" placeholder="Password..." type="password">
				
				<input name="login" type="submit" value=" Login ">
				
				<label>Forgot <a href="./reset_password.php">password</a>? Register for a <a href="./registration.php">new account</a>?</label>
				
				<div id="error_message"><?php echo $error_login; ?></div>
			</form>
		</div>
	</div>
</body>

</html>

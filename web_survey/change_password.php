<?php
/*
 *		change_password.php
*/
require_once('./dbConnection.php');
$error_password = '';

if (isset($_POST['update_password'])) {
	$admin_name		= stripslashes($_POST['user_name']);
	$admin_pass		= stripslashes($_POST['user_pass']);
	$new_password	= stripslashes($_POST['password1']);
	
	// create a new dbConnection
	$pdo = new dbConnection();
	
	// Check if current password matches the password in the database
	$sql = "SELECT * FROM admin_credentials WHERE admin_name= ? LIMIT 1";
	$query = $pdo->prepare($sql);
	$query->bindParam(1, $admin_name);
	$query->execute();
	$getPassword = $query->fetch(PDO::FETCH_ASSOC);
	$query->closeCursor();
	
	if (!$getPassword) {
		echo "<script>alert('Error fetching user.');<script>";
	} else if (password_verify($admin_pass, $getPassword['admin_password']) == false) {
		$error_password = "Username or Password is invalid.";
	} else {
		if (update_password($getPassword, password_hash($new_password, PASSWORD_DEFAULT)) == true) {
			echo "<script>alert('Password has been changed.');</script>";
			header("Location: ./profile.php");
		} else {
			$error_password = "Unable to update password.";
		}
	}
}

function update_password($admin_credentials, $hash_password) {
        // UPDATE PASSWORD IN DATABASE
        $pdo = new dbConnection();
        $sql = "UPDATE admin_credentials SET admin_password = ? WHERE admin_name = ?;";
        $query = $pdo->prepare($sql);
        $query->bindParam(1, $hash_password);
        $query->bindParam(2, $admin_credentials['admin_name']);
        $reset_results = $query->execute();
        $query->closeCursor();
        return $reset_results;
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
	<div id="form">
		<h2>Enter New Password</h2>
		<form name="form_change_password" action="" method="post" onSubmit="return form_validation(this)">
			<input placeholder="Enter UserID..." id="user_name" name="user_name" type="text" autofocus>
			<input placeholder="Enter Current Password..." id="user_pass" name="user_pass" type="password">
			<input placeholder="Select A New Password..." id="password1" name="password1" type="password">
			<input placeholder="Verify New Password..." id="password2" name="password2" type="password">
			<input name="update_password" type="submit" value=" Change Password ">
			
			<label>Return to <a href="./profile.php">user profile</a>...</label>
			<div id="error_message"><?php echo $error_password; ?></div>
		</form>
	</div>
</div>
</body>

</html>

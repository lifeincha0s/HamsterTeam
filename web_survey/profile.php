<?php
/*
 * 	profile.php
*/
include('./session.php');
$page_title = "Profile: " . $login_session;
?>
<!DOCTYPE HTML PUBLIC>
<html>

<head>
	<title><?php echo $page_title; ?></title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<script src="./scripts/javascript.js"></script>
</head>

<body>
<div id="profile">
	<b id="welcome">Welcome : <a href="./profile.php"><i><?php echo $login_session; ?></i></a></b>
	
	<b id="password"><a href="./change_password.php">Change Password</a></b>
	<b id="logout"><a href="./logout.php">Log Out</a></b>
</div>
</body>

</html>

<?php
/*
 * 	reset_password.php
 *	PHPMailer is required for script to work successfully.
 *	https://github.com/PHPMailer/PHPMailer
 *	Composer can be used to install PHP libraries locally
*/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require('vendor/autoload.php');
require_once('./dbConnection.php');
$webmaster		= "hamster.survey@gmail.com";
$cc_address		= "carpentej8@students.rowan.edu";
$error_reset	= "";
$page_title		= "Reset Password";

if (isset($_POST['reset_password'])) {
	// Get information from Form
	$user_name		= stripslashes($_POST['user_name']);
	$contact_email	= stripslashes($_POST['contact_email']);
	
	// Create a new db connection
	$pdo = new dbConnection();

	// Verify user_name exists
	$sql = "SELECT * FROM admin_credentials WHERE admin_name= ? LIMIT 1";
	$query = $pdo->prepare($sql);
	$query->bindParam(1, $user_name);
	$query->execute();
	$found_creds = $query->fetch(PDO::FETCH_ASSOC);

	// Verify email address exists
	$sql = "SELECT * FROM admin_information WHERE contact_email= ? LIMIT 1";
	$query = $pdo->prepare($sql);
	$query->bindParam(1, $contact_email);
	$query->execute();
	$found_email = $query->fetch(PDO::FETCH_ASSOC);
	
	if ($found_creds && $found_email) {
		// Verify user_ID from the tables match:
		// user_information & user_credentials (i.e. same account)
		$user_cred_ID = $found_creds['account_ID'];
		$user_info_ID = $found_email['account_ID'];
		if ($user_cred_ID != $user_info_ID) {
			$error_reset = "Account Not Found!";
		} else {
			if (reset_password($found_creds, $found_email)) {
				echo "<script>alert('Password has been reset. Check email to obtain new password.');</script>";
			} else {
				$error_reset = "Unable to reset password.";
			}
		}
	} elseif (!$found_creds) {
		$error_reset = "Username not found!";
	} elseif (!$found_email) {
		$error_reset = "Email address not found!";
	}
}

function update_password($admin_credentials, $hash_password) {
	// UPDATE PASSWORD IN DATABASE
	$pdo = new dbConnection();
	$sql = "UPDATE admin_credentials SET admin_password = ? WHERE admin_name = ? ";
	$query = $pdo->prepare($sql);
	$query->bindParam(1, $hash_password);
	$query->bindParam(2, $admin_credentials['admin_name']);
	$reset_results = $query->execute();
	$query->closeCursor();
	return $reset_results;
}

function reset_password($admin_credentials, $admin_information) {
	$eol			= "<br>\r\n";
	$tab			= "$emsp;";
	$new_password	= new_random_password();	// Generate a new random password
	$email_address	= $admin_information['contact_email'];
	$email_subject	= "Password Reset";
	$email_body		= "The account registered to this email has chosen to reset the password." . $eol
					. "If you are receiving this email in error, please contact us immediately hamster.survey@gmail.com." . $eol
					. $eol
					. "The password has been set to: <strong>$new_password</strong>" . $eol
					. "Please do the following to verify update:" . $eol
					. $tab . "1) Log in to your account using the following URL" . $eol
					. $tab . "   http://elvis.rowan.edu/~carpentej8" . $eol
					. $tab . "2) Change the password." . $eol
					. $eol
					. "Thank you for using Web-Based Survey for all your survey needs!" . $eol;
	$hash_password	= password_hash($new_password, PASSWORD_DEFAULT);
	
	// try updating password in database
	if (!update_password($admin_credentials, $hash_password)) {
		return false;		// if database cannot be updated, Do Not Send Email, return
	}
	
	// EMAIL THE NEW PASSWORD TO USER
	$mail = new PHPMailer(true);    // Passing `true` enables exceptions
	try {
		$smtp_config_file	= './smtp.ini';
		$smtp_config		= parse_ini_file($smtp_config_file);

		//Server settings
		//$mail->SMTPDebug	= 4;							// Enable verbose debug output
		$mail->isSMTP();									// Set mailer to use SMTP
		$mail->Host			= $smtp_config['smtp_host'];	// Specify SMTP servers
		$mail->SMTPAuth		= true;							// Enable authentication
		$mail->Username		= $smtp_config['smtp_user'];	// SMTP username
		$mail->Password		= $smtp_config['smtp_pass'];	// SMTP password
		$mail->SMTPSecure	= 'tls';						// Encryption type
		$mail->Port			= 587;							// TCP port
		
		//Recipients
		$mail->setFrom($GLOBALS['webmaster'], 'Surveys');
		$mail->addAddress($email_address);					// Add recipient
		$mail->addCC($GLOBALS['cc_address']);

		//Content
		$mail->isHTML(true);                    // Set email format to HTML
		$mail->Subject		= $email_subject;
		$mail->Body			= $email_body;
		$mail->AltBody		= "To view the message, please use an HTML compatible email viewer!";
		$mail->send();
		return true;
	} catch (Exception $e) {
		$error_reset		= "Message could not be sent." . $eol
							. "Mailer Error: " . $eol
							. $mail->ErrorInfo;
		return false;
	}
}

function new_random_password( $length = 12, $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789' ) {
	return substr( str_shuffle( $chars ), 0, $length );
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
		<h1 align="center" style="color:red">Password Reset</h1>
		<div id="form">
			<h2>Enter UserID & Email Address</h2>
			<form name="form_reset_password" action="" method="post" onSubmit="return form_validation(this)">
				<input id="user_name" name="user_name" placeholder="UserID..." type="text">
				<input id="contact_email" name="contact_email" placeholder="Email Address..." type="text">
				
				<input name="reset_password" type="submit" value=" Reset Password ">
				
				<label>Return to <a href="./index.php">login form</a>...</label>
				
				<div id="error_message"><?php echo $error_reset; ?></div>
			</form>
		</div>
	</div>
</body>

</html>

<?php
/*
 * 	mail_form.php				
 *		NOT A STANDALONE PAGE - MUST BE INCLUDED WITHIN HTML BODY
 * 	process to send email through external smtp server
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include('vendor/autoload.php');
include_once('./dbConnection.php');

define(SMTP_FILE, './configs/smtp.ini');

var $webmaster		= "hamster.survey@gmail.com";
//var $cc_address	= <send a copy to email address>;
var $error_mailer	= '';

/*	survey_ID
 *	GENERATED @TIME OF SURVEY CREATION:
 *		for access when adding users to the distribution_list
*/
$survey_ID		= uniqid();

if (isset($_POST['send_email'])) {
	$eol		= "<br>\r\n";
	$tab		= "&emsp;";
	$email_address	= $_POST['email_address'];
	$user_name	= $_POST['recipient'];
	$user_ID	= uniqid();
	$completed	= 0;			// FALSE: survey has not been completed
	
	// Check if user already exists in user_list
	$pdo	= new dbConnection();
	$sql	= "SELECT * FROM user_list WHERE user_email= ? LIMIT 1";
	$query	= $pdo->prepare($sql);
	$query->bindParam(1, $email_address);			// user_email
	$query->execute();
	$user_exists = $query->fetch(PDO::FETCH_ASSOC);
	if ($user_exists) {
		$user_ID = $user_exists['user_ID'];
	}
	
	// Update user_list with data
	$sql	= "REPLACE INTO user_list VALUES ( ?, ?, ? )";
	$query	= $pdo->prepare($sql);
	$query->bindParam(1, $user_ID);				// user_ID
	$query->bindParam(2, $email_address);			// user_email
	$query->bindParam(3, $user_name);			// user_name
	$results = $query->execute();
	$query->closeCursor();
	
	if (!$results) {
		$error_mailer = "Unable to add user to database.";
		// No reason to continue to send email if user_ID cannot be linked to user
		header("Location: ./profile.php");
		exit;
	}
	
	// add user_ID & survey_ID to distribution_list
	$distributionKEY	= uniqid();			// CREATE distributionKEY
	$sql = "INSERT INTO distribution_list VALUES( ?, ?, ?, ? )";
	$query = $pdo->prepare($sql);
	$query->bindParam(1, $distributionKEY);
	$query->bindParam(2, $survey_ID);
	$query->bindParam(3, $user_ID);
	$query->bindParam(4, $completed);			// Value changed to '1' once the user takes the survey
	$results = $query->execute();
	$query->closeCursor();
	if (!$results) {
		$error_mailer = "Unable to add user to distribution list.";
		exit;
	}
	
	// Get form data:
	$email_subject		= $_POST['email_subject'];
	$email_body		= $_POST['email_body'];
	$survey_access_url	= "http://elvis.rowan.edu/~shawt6/Survey.php?"
				. "distributionKEY="  . $distributionKEY;
	$mail			= new PHPMailer(true);		// TRUE enables exceptions
	try {
		$smtp_config = parse_ini_file(SMTP_FILE);
		
		//Server settings
		//$mail->SMTPDebug = 4;				// Enable verbose debug output
		$mail->isSMTP();				// Set mailer to use SMTP
		$mail->Host = $smtp_config['smtp_host'];	// Specify SMTP servers
		$mail->SMTPAuth = true;				// Enable authentication
		$mail->Username = $smtp_config['smtp_user'];	// SMTP username
		$mail->Password = $smtp_config['smtp_pass'];	// SMTP password
		$mail->SMTPSecure = 'tls';			// Encryption type
		$mail->Port = 587;				// TCP port
		
		//Recipients
		$mail->setFrom($webmaster, 'Surveys');
		$mail->addAddress($email_address);		// Add recipient
		if (isset($cc_address)) { $mail->addCC($cc_address); }
		
		//Attachments, name is optional
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');
		
		//Content
		$mail->isHTML(true);				// Set email format to HTML
		$mail->Subject	= $email_subject;
		$mail->Body	= $_POST['recipient'] . "," . $eol
				. $email_body . $eol
				. "Please take our survey." . $eol
				. "Your feedback is very important to us." . $eol
				. $survey_access_url . $eol;
		$mail->AltBody	= "To view this message, please use an HTML compatible email viewer!";
		$mail->send();
		
		// SUCCESS
		echo "<script>alert('Message has been sent');</script>";
	} catch (Exception $e) {
		$error_mailer	= "Message could not be sent."
				. "<br>"
				. "Mailer Error: " . $mail->ErrorInfo;
	} 
}
?>

<div id="mail">
        <div id="form">
                <h2>Mail Form</h2>
                <form name="form_send_email" action="" method="post" onSubmit="return form_validation(this)">
                        <input name="recipient" id="recipient" placeholder="Contact Name..." type="text" autofocus />
			<input name="email_address" id="email_address" placeholder="Email Address..." type="text" />
                        <input name="email_subject" id="email_subject" placeholder="Subject..." cols="45" type="text" />
                        <textarea name="email_body" id="email_body" placeholder="Text Body..." type="text"></textarea>
			<input name="send_email" type="submit" value=" Send Email " />
			<div id="error_message"><?php echo $error_mailer; ?></div>
                </form>
        </div>
</div>

<?php
/*
 * 	survey.php
 * 	sample landing page for direct link url's to take a specific survey
 */
require_once('./dbConnection.php');
if (isset($_SESSION['valid_user'])) {
	header("Location: ./profile.php");
}
$page_title = 'Survey';

// Get URL Encoding
$distribution_KEY = $_GET['distributionKEY'];

// Create a new database connection
$pdo = new dbConnection();

// Build query
$sql = "SELECT * FROM distribution_list WHERE distribution_KEY= ? LIMIT 1";
$query = $pdo->prepare($sql);
$query->bindParam(1, $distribution_KEY);
$query->execute();
$survey = $query->fetch(PDO::FETCH_ASSOC);
// $survey=>[
//            'distribution_KEY'  = <VARCHAR(13)>,
//            'survey_ID'         = <VARCHAR(13)>,
//            'user_ID'           = <VARCHAR(13)> ]
$greeting = "Hello, " . $survey['user_ID'];
$survey = "Survey: " . $survey['survey_ID'];
?>
<!DOCTYPE html>
<html>

<head>
	<title><?php echo $page_title; ?></title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<script src="scripts/javascript.js"></script>
</head>

<body>
<div id="main">
	<h1>Welcome to your survey!</h1>
	<div id="form">
		<h2><?php echo $greeting; ?></h2>
		<br>
		<h2><?php echo $survey; ?></h2>
	</div>
</div>
</body>

</html>

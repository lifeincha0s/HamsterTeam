<?php
/*
 *    session.php
 *    verifies and tracks valid-logged in users
*/
session_start();							// Start Session
require_once('./dbConnection.php');

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$pdo = new dbConnection();

// SQL Query To Fetch Complete Information Of User
$sql = "SELECT * FROM admin_credentials WHERE admin_name= ? LIMIT 1";
$query = $pdo->prepare($sql);
$query->bindParam(1, $_SESSION['valid_user']);
$query->execute();

// Get results
$row = $query->fetch(PDO::FETCH_ASSOC);
$query->closeCursor();					// Close dbConnection

$login_session = $row['admin_name'];

if (!isset($login_session)) {
	header('Location: ./index.php');		// Redirect To Home Page
}
?>

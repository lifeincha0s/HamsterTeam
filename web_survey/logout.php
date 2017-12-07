<?php
session_start();

// Destroy All Sessions
if(session_destroy()) {
	header("Location: ./index.php"); // Redirecting To Home Page
}
?>

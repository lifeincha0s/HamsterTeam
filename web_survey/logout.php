<?php
session_start();

// Destroy All Sessions
if(session_destroy()) {
	// Redirect To Home Page
	header("Location: ./index.php");
}
?>

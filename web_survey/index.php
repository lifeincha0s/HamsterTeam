<?php
/*
 *		index.php
 */
if (isset($_SESSION['valid_user'])) {
	header("Location: ./profile.php");
} else {
	header("Location: ./login.php");
}
?>

<?php 
	session_start();
	if (isset($_SESSION['u_id'])) {
		session_unset();
		session_destroy();
		header("Location: ../index.php");
		exit();
	}
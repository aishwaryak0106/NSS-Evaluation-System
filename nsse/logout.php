<?php

	session_start();

	unset($_SESSION['loginid']);
	unset($_SESSION['usertype']);
	
	header("location: login.php");
	
?>
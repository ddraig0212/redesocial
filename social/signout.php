<?php
	unset($_SESSION['id']);
	session_start();
	session_destroy();
	header("Location:index.html");
?>
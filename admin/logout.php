<?php
	include_once('includes/config_mod.php');
	include_once('includes/libraries_mod.php');
	unset($_SESSION[WEB_NAME]);
	session_destroy();
	header("Location: login_form.php");
?>
<?php
	include_once('includes/config_mod.php');
	include_once('includes/libraries_mod.php');
	//unset($_SESSION[WEB_NAME]);
	unset($_SESSION[WEB_NAME]['login_id']);
	session_destroy();
	header("Location: index.php");
?>
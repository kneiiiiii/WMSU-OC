<?php

	require ("class_mod.php");
	require ("sqlhelper_mod.php");
	
	$DB_Helper = new  DB_Helper(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$SQL_Helper = new SQL_Helper(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
?>

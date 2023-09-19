<?php
	@session_start();
	include_once('includes/config_mod.php');
	include_once('includes/libraries_mod.php');
	$is_valid = 'no';	
	if(isset($_POST['email_add'])) 
	{		
		$email_add 	= $_POST['email_add'];
		$pass_word 	= $_POST['pass_word'];
		$tablename 	= TABLE_PREFIX.'customer'; 
		
	
			$row = $DB_Helper->get_row("SELECT * FROM $tablename WHERE email_add='$email_add' AND pass_word='$pass_word'");
			
			if( $row->id > 0 ) 
			{
				if(strcmp($email_add,$row->email_add)==0 && strcmp($pass_word,$row->pass_word)==0){
					$_SESSION[WEB_NAME]['login_id']   				= $row->id;
					$_SESSION[WEB_NAME]['login_name']  				= $row->firstname . ' ' . $row->mi . '.  ' . $row->lastname;
					$_SESSION[WEB_NAME]['email_add'] 				= $row->email_add;
					
					
					$is_valid = 'yes';
					
				}else{
					$is_valid = 'no';
				}
			}
			
		
			
	}
	echo $is_valid;	
?>
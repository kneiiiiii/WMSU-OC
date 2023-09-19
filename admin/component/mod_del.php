<?php 
include_once('../includes/config_mod.php');
include_once('../includes/libraries_mod.php');

	if( $_POST['ope'] == 1){ 
	
		$result		 ='false';
		$tablename   = TABLE_PREFIX.'vendor';
		$vendor_id	 = $_POST['vendor_id'];
		

		$id = $SQL_Helper->DELETE($tablename ,"id='$vendor_id'");
		$is_added = $id > 0 ? true : false;		
		$result =  $is_added==true ? $result='true' : $result='false';
		echo $result ;
	
	}elseif( $_POST['ope'] == 2){ 
	
		$result		='false';
		$tablename	= TABLE_PREFIX.'vendor';
		$staff_id 	= $_POST['staff_id'];
		

		$id = $SQL_Helper->DELETE($tablename ,"id='$staff_id'");
		$is_added = $id > 0 ? true : false;		
		$result =  $is_added==true ? $result='true' : $result='false';
		echo $result ;
	
	}elseif( $_POST['ope'] == 3){ 
	
		$result		='false';
		$tablename	= TABLE_PREFIX.'errand';
		$errand_id 	= $_POST['errand_id'];
		

		$id = $SQL_Helper->DELETE($tablename ,"id='$errand_id'");
		$is_added = $id > 0 ? true : false;		
		$result =  $is_added==true ? $result='true' : $result='false';
		echo $result ;
	
	}
	
?>
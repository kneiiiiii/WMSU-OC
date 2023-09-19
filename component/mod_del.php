<?php 
include_once('../includes/config_mod.php');
include_once('../includes/libraries_mod.php');

	if( $_POST['ope'] == 1){ 
	
		$result		 ='false';
		$tablename   = TABLE_PREFIX.'foodlist';
		$food_id	 = $_POST['food_id'];
		

		$id = $SQL_Helper->DELETE($tablename ,"id='$food_id'");
		$is_added = $id > 0 ? true : false;		
		$result =  $is_added==true ? $result='true' : $result='false';
		echo $result ;
	
	}elseif( $_POST['ope'] == 2){ 
	
		$result		 ='false';
		$tablename	= TABLE_PREFIX.'cart';
		$cart_id	 = $_POST['cart_id'];
		

		$id = $SQL_Helper->DELETE($tablename ,"id='$cart_id'");
		$is_added = $id > 0 ? true : false;		
		$result =  $is_added==true ? $result='true' : $result='false';
		echo $result ;
	
	}
	
?>
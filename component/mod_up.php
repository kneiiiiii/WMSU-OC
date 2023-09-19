<?php 
include_once('../includes/config_mod.php');
include_once('../includes/libraries_mod.php');
	
	if( $_POST['ope'] == 1){ 
		/*Accept food order by vendor*/
		$result		 				='false';
		$tablename  				= TABLE_PREFIX.'orderlist';
		$cart_id	 				= $_POST['cart_id'];
		$post_data['vendor_status'] = 1;
		$post_data['food_status']	= 1;
		
		$id = $SQL_Helper->UPDATE_ALL($tablename ,"cart_id=$cart_id" ,$post_data);
		$is_added = $id > 0 ? true : false;		
		$result =  $is_added==true ? $result='true' : $result='false';
		
		echo $result ;
		
	}elseif( $_POST['ope'] == 2){ 
		/*Canceled food order by vendor*/
		$result		 				='false';
		$tablename  				= TABLE_PREFIX.'orderlist';
		$cart_id	 				= $_POST['cart_id'];
		$post_data['vendor_status'] = 2;
		$post_data['food_status']	= 4;
		
		
		$id = $SQL_Helper->UPDATE_ALL($tablename ,"cart_id=$cart_id" ,$post_data);
		$is_added = $id > 0 ? true : false;		
		$result =  $is_added==true ? $result='true' : $result='false';
		
		echo $result ;
		
	}elseif( $_POST['ope'] == 3){ 
	
		$result		 						='false';
		$tablename  						= TABLE_PREFIX.'delivery';
		$track_no	 						= $_POST['track_no'];
		$admin_id	 						= $_POST['admin_id'];
		
		$post_data['del_status'] 			= 1;
		$post_data['errand_id']				= $admin_id;
		$post_data['delivery_process']		= 1;
		
		$id = $SQL_Helper->UPDATE_ALL($tablename ,"track_no='$track_no'" ,$post_data);
		$is_added = $id > 0 ? true : false;		
		$result =  $is_added==true ? $result='true' : $result='false';
		
		echo $result ;
		
	}elseif( $_POST['ope'] == 4){ 
	
		$result		 						='false';
		$tablename  						= TABLE_PREFIX.'delivery';
		$errand_id	 						= $_POST['errand_id'];
		$trackno	 						= $_POST['trackno'];
		$count	 							= $_POST['count'];
		
		$post_data1['delivery_process'] 		=   $count + 1;
		
		$id = $SQL_Helper->UPDATE_ALL("tbl_delivery" ,"track_no= '$trackno'" ,$post_data1);
		$is_added = $id > 0 ? true : false;		
		$result =  $is_added==true ? $result='true' : $result='false';
				
		echo $result ;
		
	}elseif( $_POST['ope'] == 5){ 
	
		$result		 						='false';
		$tablename  						= TABLE_PREFIX.'errand_delivery_info';
		$tablename1  						= TABLE_PREFIX.'delivery';
		$tablename2  						= TABLE_PREFIX.'orderlist';
		$trackno	 						= $_POST['trackno'];
		$cash_amount	 						= $_POST['cash_amount'];
		
		
		$post_data['payment_status'] 		=  1;
		$post_data['payment_met'] 			=  1;
		$post_data['reference_no'] 			=  0;
		$post_data['amount_pay'] 			=  $cash_amount;
		$post_data['time_deliver'] 			=  date("h:i:s m/d/Y");
		$id = $SQL_Helper->UPDATE_ALL($tablename ,"track_no= '$trackno'" ,$post_data);
		
		$post_data1['payment_status'] 		=  1;
		$id1 = $SQL_Helper->UPDATE_ALL($tablename1 ,"track_no= '$trackno'" ,$post_data1);
		
		$post_data2['trans_status'] 		=  1;
		$id1 = $SQL_Helper->UPDATE_ALL($tablename2 ,"track_no= '$trackno'" ,$post_data2);
		
		$is_added = $id > 0 ? true : false;		
		$result =  $is_added==true ? $result='true' : $result='false';
				
		echo $result ;
		
	}elseif( $_POST['ope'] == 6){ 
	
		$result		 						='false';
		$tablename  						= TABLE_PREFIX.'errand_delivery_info';
		$tablename1  						= TABLE_PREFIX.'remittance';
		$trackno	 						= $_POST['trackno'];
		$total_amt	 						= $_POST['tots_price'];
		$errand_id	 						= $_POST['errand_id'];
		$cust_ID	 						= $_POST['cust_ID'];
		
		$post_data['remit_status'] 			=  1;
		$post_data['time_remit'] 			=  date("h:i:s m/d/Y");
		
		$id = $SQL_Helper->UPDATE_ALL($tablename ,"track_no='$trackno'" ,$post_data);
		$is_added = $id > 0 ? true : false;		
		$result =  $is_added==true ? $result='true' : $result='false';
		
		$post_data1['total_amt'] 				=  $total_amt;
		$post_data1['track_no'] 				=  $trackno;
		$post_data1['errand_id'] 				=  $errand_id;
		$post_data1['cust_ID'] 					=  $cust_ID;
		$post_data1['remit_status'] 			=  1;
		$id1 = $SQL_Helper->INSERT_ALL($tablename1,$post_data1);
				
		echo $result ;
		
	}elseif( $_POST['ope'] == 7){ 
	
		$result		 						='false';
		$tablename  						= TABLE_PREFIX.'errand_delivery_info';
		$tablename1  						= TABLE_PREFIX.'remittance';
		$trackno	 						= $_POST['trackno'];
		$vendor_id	 						= $_POST['vendor_id'];
		
		$post_data['remit_status'] 			=  2;
		$post_data['time_remit'] 			=  date("h:i:s m/d/Y");
		
		$id = $SQL_Helper->UPDATE_ALL($tablename ,"track_no='$trackno'" ,$post_data);
		$is_added = $id > 0 ? true : false;		
		$result =  $is_added==true ? $result='true' : $result='false';
		
		$post_data1['date_remit'] 				=  date("m/d/Y");
		$post_data1['remit_status'] 			=  2;
		$post_data1['vendor_id'] 				=  $vendor_id;
		$post_data1['pay_method'] 				=  2;
		$id1 = $SQL_Helper->UPDATE_ALL($tablename1 ,"track_no='$trackno'" ,$post_data1);
		
		
		echo $result ;
		
	}elseif( $_POST['ope'] == 8){ 
	
		$result		 						='false';
		$tablename  						= TABLE_PREFIX.'errand_delivery_info';
		$tablename1  						= TABLE_PREFIX.'delivery';
		$tablename2  						= TABLE_PREFIX.'orderlist';
		$trackno	 						= $_POST['trackno'];
		$gcash_amount	 					= $_POST['gcash_amount'];
		$reference_no	 					= $_POST['reference_no'];
		
		
		$post_data['payment_status'] 		=  1;
		$post_data['payment_met'] 			=  2;
		$post_data['reference_no'] 			=  $reference_no;
		$post_data['amount_pay'] 			=  $gcash_amount;
		$post_data['time_deliver'] 			=  date("h:i:s m/d/Y");
		$id = $SQL_Helper->UPDATE_ALL($tablename ,"track_no= '$trackno'" ,$post_data);
		
		$post_data1['payment_status'] 		=  1;
		$id1 = $SQL_Helper->UPDATE_ALL($tablename1 ,"track_no= '$trackno'" ,$post_data1);
		
		$post_data2['trans_status'] 		=  1;
		$id1 = $SQL_Helper->UPDATE_ALL($tablename2 ,"track_no= '$trackno'" ,$post_data2);
		
		$is_added = $id > 0 ? true : false;		
		$result =  $is_added==true ? $result='true' : $result='false';
				
		echo $result ;
		
	}
	
?>
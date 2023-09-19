<?php 
include_once('../includes/config_mod.php');
include_once('../includes/libraries_mod.php');

	if( $_POST['ope'] == 0){ 
	
		$result		 	='false';
		$tablename   	= TABLE_PREFIX.'delivery';
		$tablename1		= TABLE_PREFIX.'orderlist';
		$cart_id 		=   $_POST['cart_id'];
		$track_no		=   $_POST['track_no'];
		$vendor_id		=   $_POST['vendor_id'];
		$pay_method		=   $_POST['pay_method'];
		
		$post_data['cart_id'] 		=   $cart_id;
		$post_data['track_no'] 		=   $track_no;
		$post_data['vendor_id'] 	=   $vendor_id;
		$post_data['pay_method'] 	=   $pay_method;
		$post_data['food_status'] 	=   2;
		$post_data['del_status'] 	=   0;
		$post_data['date_process'] 	=   date("h:i:s m/d/Y");
		
		
		$id = $SQL_Helper->INSERT_ALL($tablename,$post_data);
		$is_added = $id > 0 ? true : false;		
		$result =  $is_added==true ? $result='true' : $result='false';
		
		$post_data1['food_status'] 		=   2;
		$id1 = $SQL_Helper->UPDATE_ALL($tablename1 ,"cart_id=$cart_id" ,$post_data1);
		
		echo $result ;
		
	}elseif( $_POST['ope'] == 1){ 
	
		$track_no		=   $_POST['track_no'];
		$vendor_id		=   $_POST['vendor_id'];
		$tablename		= 	TABLE_PREFIX.'delivery';
		$tablename1		= 	TABLE_PREFIX.'errand_delivery_info';
		$tablename2		= 	TABLE_PREFIX.'delivery';
			
		$get_order_list = $DB_Helper->get_sql_results("
			SELECT * FROM $tablename
			WHERE vendor_id ='$vendor_id' AND track_no='$track_no'");	
		
		if($get_order_list){
			foreach($get_order_list as $row){
				$post_data['cart_id']		 = $row->cart_id;
				$post_data['track_no']		 = $row->track_no;
				$post_data['vendor_id']	 	 = $row->vendor_id;
				$post_data['time_pickup']	 = date("h:i:s m/d/Y");
				
				$id = $SQL_Helper->INSERT_ALL($tablename1,$post_data);
				
				
				$post_data1['delivery_process'] 		=   2;
				$id1 = $SQL_Helper->UPDATE_ALL($tablename2 ,"cart_id= $row->cart_id" ,$post_data1);
			}
		}
		$is_added = $id > 0 ? true : false;		
		$result =  $is_added==true ? $result='true' : $result='false';
	
	echo $result ;
	
	}elseif( $_POST['ope'] == 2){ 
	
		$track_no		=   $_POST['track_no'];
		$vendor_id		=   $_POST['vendor_id'];
		$cust_ID		=   $_POST['cust_ID'];
		$total_p		=   $_POST['total_p'];
		$tablename		= 	TABLE_PREFIX.'remittance';
		$tablename1		= 	TABLE_PREFIX.'orderlist';
		$tablename2		= 	TABLE_PREFIX.'delivery';
		
		$post_data['errand_id']		 = 0;
		$post_data['vendor_id']		 = $vendor_id;
		$post_data['cust_ID']		 = $cust_ID;
		$post_data['track_no']		 = $track_no;
		$post_data['total_amt']		 = $total_p;	
		$post_data['remit_status']	 = 2;	
		$post_data['pay_method']	 = 1;	
		$post_data['date_remit']	 = date("m/d/Y");	
		
		$id = $SQL_Helper->INSERT_ALL($tablename,$post_data);
		
		$post_data1['trans_status'] 		=  1;
		$id1 = $SQL_Helper->UPDATE_ALL($tablename1 ,"track_no= '$track_no'" ,$post_data1);
		
		$post_data2['payment_status'] 		=  1;
		$post_data2['errand_id'] 			=  0;
		$post_data2['delivery_process'] 	=  0;
		$id2 = $SQL_Helper->UPDATE_ALL($tablename2 ,"track_no= '$track_no'" ,$post_data2);
		
		$is_added = $id > 0 ? true : false;		
		$result =  $is_added==true ? $result='true' : $result='false';
	
	echo $result ;
	}
	
	
?>
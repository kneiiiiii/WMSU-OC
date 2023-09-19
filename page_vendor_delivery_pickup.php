<!-- [INCLUDE - TOP] -->

<?php 
include_once 'template/top.php';

$self = $_SERVER['PHP_SELF'];
$self = str_replace('/wmsucanteen/', '', $self);
$self = trim(strtolower(str_replace('.php', '', $self)));
//echo $self;

if(isset($_SESSION[WEB_NAME]['login_id'])){
	$admin_id 		 = $_SESSION[WEB_NAME]['login_id'];
	$admin_name 	 = $_SESSION[WEB_NAME]['login_name'];
	$admin_email_add = $_SESSION[WEB_NAME]['email_add'];
}else{
	header("Location:login_form.php");
	exit();
}

if($self == 'page_vendor' || 'page_vendor_profile'){
	$tablename	= TABLE_PREFIX.'vendor';
	
$get_user_info 	= $DB_Helper->get_row(" SELECT A.* , B.image, C.usetype
										FROM $tablename AS A
										INNER JOIN tbl_avatar AS B ON (A.avatar_id = B.id)
										INNER JOIN tbl_usertype AS C ON (A.`usertype` = C.id)
										WHERE A.id='$admin_id'");
$usertype		= $get_user_info->usertype;
$usetype		= $get_user_info->usetype;
$image			= $get_user_info->image;
$vendor_id		= $get_user_info->vendor_id;


}
	
?>
<script>
	function get_staff_avatar(id){
		//alert(id);
		$("#avatar_id").val(id);
		document.getElementById("span1").textContent="You Choose Avatar: " + id;
	}

		
	function pickup_pay_order(vendor_id,track_no,cust_ID,total_p){
		/*alert(vendor_id);
		alert(track_no);
		alert(cust_ID);
		alert(total_p);*/
		let confirmAction = confirm("Do you wish to Continue?");
		if (confirmAction) {
			var action = 2 ;
			$.ajax({
					url:'component/vendor_order_process.php',
					type:'post',
					data:{
						ope:action,
						track_no:track_no,
						vendor_id:vendor_id,
						cust_ID:cust_ID,
						total_p:total_p
					},
					success:function(data,status){
						if(data == 'true'){
							
							alert(" Successfully PAID! ");
							location.reload();
						}else{
							alert("bobo MALI");
						}
					}
				});
			
		} else {
		 return false;
		}
	}
	
	function pickup_order(vendor_id,track_no){
		let confirmAction = confirm("Do you wish to Continue?");
		if (confirmAction) {
			var action = 1 ;
			$.ajax({
					url:'component/vendor_order_process.php',
					type:'post',
					data:{
						ope:action,
						track_no:track_no,
						vendor_id:vendor_id
					},
					success:function(data,status){
						if(data == 'true'){
							
							alert(" Food has been Pick-up by Errand");
							location.reload();
						}else{
							alert("bobo MALI");
						}
					}
				});
			
		} else {
		 return false;
		}
	}
	
	/*
									vendor_status = 0(Pending),1(Accept),2(Canceled)
									food_status	  = 0(pending), 1(preparing), 2(ready for pick-up), 3(ready for deliver), 4(canceled)
									pay_method	  = 1(over the counter),2(cash on delivery)
	*/
	
</script>

	<body class="  ">
	
		<!-- loader Start -->
		<div id="loading">
			<div id="loading-center"></div>
		</div>
		<!-- loader END -->
		
		<!-- Wrapper Start -->
		<div class="wrapper">
		
			<!-- [INCLUDE - SIDEBAR MENU] -->
			<?php include_once 'template/sidebar_menu.php';?>
			    
			<!-- [INCLUDE - TOPBAR MENU] -->
			<?php include_once 'template/topbar_menu.php';?>
			
			<div class="content-page">
				<div class="container-fluid">
					<div class="row">
					
						<div class="col-sm-12">
							<div class="card shadow-bottom shadow-showcase">
								<div class="card-header d-flex justify-content-between" style="color: #FFF; background-color: #DC143C !important;border-top-left-radius: 10px;border-top-right-radius: 10px;">
									<div class="header-title">
										<h4 class="card-title">Summary Order for Delivery / Pick-up</h4>
									</div>
									<h3><i class="ri-settings-5-fill"></i></h3>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-sm-4 col-lg-4 col-md-4">
											<div class="card shadow-bottom shadow-showcase">
												<div class="card-header d-flex justify-content-between" style="color: #FFF; background-color: #DC143C !important;border-top-left-radius: 10px;border-top-right-radius: 10px;">
													<div class="header-title">
														<h4 class="card-title">Customer Invoice</h4>
													</div>
													<h3><i class="ri-settings-5-fill"></i></h3>
												</div>
												<div class="card-body">
													<div class="list-group">
														<?php 
																
															$tablename	= TABLE_PREFIX.'delivery';
															
															if($vendor_id == 0){
																$v_id = $admin_id;
															}elseif($vendor_id == $vendor_id){
																$v_id = $vendor_id;
															}
															
															$sql = "
																	SELECT A.* , B.* , C.`food_name`,D.trans_status
																	FROM $tablename AS A
																	INNER JOIN tbl_cart AS B ON (A.`cart_id` = B.`id`)
																	INNER JOIN tbl_orderlist AS D ON (A.`cart_id` = D.`cart_id`)
																	INNER JOIN tbl_foodlist AS C ON (B.`food_id` = C.`id`)
																	WHERE A.vendor_id='$v_id'
																	GROUP BY A.track_no
																	ORDER BY A.`id` DESC
																	";
																	//echo $sql;
															$result = mysqli_query($DB_Helper->db_con,$sql) or die(mysqli_error($DB_Helper->db_con));
																
															if(mysqli_num_rows($result) > 0){
															$get_order_list = $DB_Helper->get_sql_results($sql);	
															
																if($get_order_list){
																	foreach($get_order_list as $row){
																		$track_no 	 	 = $row->track_no;
																		$pay_method 	 = $row->pay_method;
																		$trans_status 	 = $row->trans_status;
														?>
														<a href="page_vendor_delivery_pickup.php?track_no=<?= $track_no;?>" class="list-group-item list-group-item-action 
																<?php if($_GET['track_no'] == $track_no){echo 'active';}else{echo'';}?>">
															<div class="d-flex w-100 justify-content-between">
																<h5 class="mb-1"><?= $track_no; ?></h5>
																	<?php 
																	
																	if($trans_status != 1){
																		if($pay_method == 1){ 
																			$msg = "Pick-up"; 
																			$msgcolor = "Danger";
																		}else{ 
																			$msg = "Delivery"; 
																			$msgcolor = "primary";
																		} 
																	}else{
																		$msg = "Completed";
																		$msgcolor = "success";
																	}
																	
																	?>
																<span class="mb-1 badge badge-<?= $msgcolor; ?>"><?= $msg; ?></span>
															</div>
														</a>
														<?php 		}
																}
															}else{
																	echo "<p class='text-danger mt-1'><em>No Record Found!</em></p>";
																}?>
													</div>
												</div>
											</div>
										</div>
										
										<div class="col-sm-8 col-lg-8 col-md-8" id="vendor_delivery_pickup">
											<div class="row">
												<?php 
													/*display if track# is not empty or hide right side*/
													if( $_GET['track_no'] != 0){
												?>
												<div class="col-lg-12">
													<div class="d-block align-items mb-2"> 
														<div>
															<?php 
															$track_no = $_GET['track_no'];
															$tablename	= TABLE_PREFIX.'delivery';
															
																if($vendor_id == 0){
																	$v_id = $admin_id;
																}elseif($vendor_id == $vendor_id){
																	$v_id = $vendor_id;
																}
																
																$sql = "SELECT A.* , B.*, C.`food_name` , CONCAT(E.firstname ,' ', E.mi,'.', ' ', E.lastname) AS customer_name,A.track_no, C.price,
																		(SELECT SUM(B.total_price)
																			FROM tbl_delivery AS A
																			INNER JOIN tbl_cart AS B ON (A.cart_id = B.id)
																			INNER JOIN tbl_foodlist AS C ON (B.food_id = C.id)
																			WHERE  A.track_no='$track_no') AS total_p
																		FROM $tablename AS A
																		INNER JOIN tbl_cart AS B ON (A.cart_id = B.id)
																		INNER JOIN tbl_foodlist AS C ON (B.food_id = C.id)
																		INNER JOIN tbl_vendor AS D ON (C.vendor_id = D.id)
																		INNER JOIN tbl_customer AS E ON (B.cust_ID = E.id)
																		WHERE D.id ='$v_id' AND A.track_no='$track_no'";
																
															
																$get_user_info 	= $DB_Helper->get_row($sql);
																
																$payment_status		= $get_user_info->payment_status;
																$pay_method			= $get_user_info->pay_method;
																$cust_ID			= $get_user_info->cust_ID;
																$total_p			= $get_user_info->total_p;
																
																if($pay_method  == 1){
																	
																	if($payment_status == 1){?>
																	
																		<div class="alert text-white bg-success" role="alert">
																			<div class="iq-alert-icon">
																			   <i class="ri-check-fill"></i>
																			</div>
																			<div class="iq-alert-text"><strong>Order has been Successfully PAID</strong></div>
																		</div>	
																	<?php }else{ ?>
																		
																		<button type="button" class="btn btn-danger btn-block text-uppercase mt-2" style="font-size: 90%;font-weight: 700;"
																			onclick="pickup_pay_order(<?= $v_id; ?>,<?= "'".$_GET['track_no']."'";?>,<?= $cust_ID; ?>,<?= $total_p; ?>)">
																		
																			<em>PAY ORDER</em> &nbsp; . &nbsp; . &nbsp; . &nbsp; . &nbsp; . &nbsp; 
																			<i class="ri-currency-fill"></i>
																		</button>
																		
															<?php 
																	}
																
																}else {
																	
																
																
																$sql = "SELECT A.* , CONCAT(B.firstname ,' ', B.mi,'.', ' ', B.lastname) AS errand_name
																		FROM tbl_delivery AS A
																		INNER JOIN tbl_errand AS B ON (A.`errand_id` = B.`id`)
																		WHERE A.`track_no` = '$track_no'";
																		//echo $sql;
																$result = mysqli_query($DB_Helper->db_con,$sql) or die(mysqli_error($DB_Helper->db_con));
																
																$checkdata = mysqli_num_rows($result);
																if($checkdata > 0)
																	{ 
																
																		$get_errand_info 	= $DB_Helper->get_row($sql);
																		$errand_name		= $get_errand_info->errand_name;
																		
																?>
																		<h5 class="mt-2">
																			<span class="badge badge-success text-uppercase" style="width: 100%;height: 42px;padding: 10px 0 0 0;">
																				<em>Order Accepted</em> &nbsp; 
																				<i class="ri-check-fill"></i>
																			</span>
																		</h5>
																		<p class="mb-0" style="padding-top: 0px !important;"><small><em>Errand Name :&nbsp;<b><?php if($errand_name != null){ echo $errand_name;}else{echo "";} ?></b> </em></small></p>
															
															<?php 	}else { ?>
															
																			<h5 class="mt-2">
																				<span class="badge badge-secondary" style="width: 100%;height: 42px;padding: 10px 0 0 0;">
																					<em> Waiting for Errand Responce &nbsp;. &nbsp;. &nbsp;. &nbsp;.</em>
																					<i class="ri-timer-line"></i>
																				</span>
																			</h5>
																			<p class="mb-0" style="padding-top: 0px !important;"><small><em> Errand Name : NONE</em></small></p>
															<?php 
																	}
															
																}
															?>
														</div>
													</div>
												</div>
												
												<div class="col-lg-12 col-md-12">
													<div class="table-responsive-sm bottom-left shadow-showcase" style="border-radius: 10px !important;">
														<table class="table" id="reload_counter_orderlist">
															<thead  class="text-uppercase" style="background-color: #DC143C;color: #FFF;">
																<tr>
																	<th class="text-center" scope="col">Food Name</th>
																	<th class="text-center" scope="col">QTY</th>
																	<th class="text-center" scope="col">Price</th>
																	<th class="text-center" scope="col">Total Price</th>
																</tr>
															</thead>
															<tbody>
																	
																<?php 
																$track_no = $_GET['track_no'];
																$tablename	= TABLE_PREFIX.'delivery';
																if($vendor_id == 0){
																	$v_id = $admin_id;
																}elseif($vendor_id == $vendor_id){
																	$v_id = $vendor_id;
																}
																
																$sql = "SELECT A.* , B.*, C.`food_name` , CONCAT(E.firstname ,' ', E.mi,'.', ' ', E.lastname) AS customer_name,A.track_no, C.price,
																(SELECT SUM(B.total_price)
																	FROM tbl_delivery AS A
																	INNER JOIN tbl_cart AS B ON (A.cart_id = B.id)
																	INNER JOIN tbl_foodlist AS C ON (B.food_id = C.id)
																	WHERE  A.track_no='$track_no') AS total_p
																FROM $tablename AS A
																INNER JOIN tbl_cart AS B ON (A.cart_id = B.id)
																INNER JOIN tbl_foodlist AS C ON (B.food_id = C.id)
																INNER JOIN tbl_vendor AS D ON (C.vendor_id = D.id)
																INNER JOIN tbl_customer AS E ON (B.cust_ID = E.id)
																WHERE D.id ='$v_id' AND A.track_no='$track_no'";
																
																	
																//echo $sql;
																$get_order_list = $DB_Helper->get_sql_results($sql);	
																
																if($get_order_list){
																	foreach($get_order_list as $row){
																		$cart_id 		 = $row->cart_id;
																		$food_name 	 	 = $row->food_name;
																		$qty	 	 	 = $row->qty;
																		$price	 	 	 = $row->price;
																		$total_price 	 = $row->total_price;
																		$customer_name 	 = $row->customer_name;
																		$total_p 	 	 = $row->total_p;
																?>
																
																
																	<tr>
																		<td>
																			<h6 class="mb-0"><i class="ri-price-tag-3-fill"></i> &nbsp; <?= $food_name;?></h6>
																			<p class="mb-0"><i class="ri-user-2-fill"></i> &nbsp; <small><mark><?= $customer_name;?></mark></small></p>
																		</td>
																		<td class="text-center">
																			<h6 class="mb-0"><?= $qty;?></h6>
																		</td>
																		<td class="text-center">
																			<h6 class="mb-0"><?= $price;?></h6>
																		</td>
																		<td class="text-center">
																			<h6 class="mb-0"><?= "&#8369;".number_format( $total_price, 2 );?></h6>
																		</td>
																	</tr>
																	
																	
																<?php 	}}  ?>
																<tr  style="background-color: antiquewhite;">
																	<td colspan='3' class="text-right"><h6 class="mb-0"><strong>TOTAL AMOUNT <strong></h6></td>
																	<td class="text-center"> 
																		<h4 class="mb-0 text-danger font-weight-500"><strong><?= "&#8369;".number_format( $total_p, 2 );?><stron></h4>
																	</td>
																</tr>
																
															</tbody>
														</table>
													</div>
												</div>
												<div class="col-lg-12 col-md-12">
													<?php 
														$track_no = $_GET['track_no'];
														
														if($vendor_id == 0){
															$v_id = $admin_id;
														}elseif($vendor_id == $vendor_id){
															$v_id = $vendor_id;
														}
														$sql ="SELECT * FROM tbl_delivery
															  WHERE vendor_id ='$v_id' AND track_no='$track_no'";
															  //echo $sql;
														$get_delivery_info 	= $DB_Helper->get_row($sql);
															if($get_delivery_info){
																$delivery_process		= $get_delivery_info->delivery_process;
																$del_status				= $get_delivery_info->del_status;
															}else{
																$delivery_process = "";
																$del_status = "";
															}
														if($del_status == 1){	
													?>
													<button onclick="pickup_order(<?= $v_id; ?>,<?= "'".$_GET['track_no']."'";?>)" type="button" class="btn btn-danger btn-block text-uppercase mt-2 
													<?php 
													if($delivery_process != 1){
														echo "disabled";
														}else{ 
														echo "";}
													?>"  style="font-size: 90%;font-weight: 700;">
														<em>Pick - up Order's</em> &nbsp; . &nbsp; . &nbsp; . &nbsp; . &nbsp; . &nbsp; 
														<i class="ri-e-bike-2-fill"></i>
													</button>
														<?php }?>
												</div>
												
												<?php } /*end of display*/?>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
					<!-- Page end  -->
				</div>
			</div>
		</div>
		
		<!-- [INCLUDE - FOOTER] -->
		<?php include_once 'template/footer.php';?>
	</body>
</html>
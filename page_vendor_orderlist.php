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

	function accept_orderlist(cart_id){
		let confirmAction = confirm("Are you sure you want to ACCEPT the order?");
		if (confirmAction) {
			var action = 1 ;
			
				$.ajax({
					url:'component/mod_up.php',
					type:'post',
					data:{
						ope:action,
						cart_id:cart_id
					},
					success:function(data,status){
						if(data == 'true'){
							
							alert("Successfully ACCEPT!.");
							location.reload();
						}
					}
				});
			
		} else {
		 return false;
		}
	}
	
	function denied_orderlist(cart_id){
		let confirmAction = confirm("Are you sure you want to CANCELED the order?");
		if (confirmAction) {
			var action = 2 ;
			
				$.ajax({
					url:'component/mod_up.php',
					type:'post',
					data:{
						ope:action,
						cart_id:cart_id
					},
					success:function(data,status){
						if(data == 'true'){
							
							alert("Successfully CANCELED!.");
							location.reload();
						}
					}
				});
			
		} else {
		 return false;
		}
	}
	
	function ready_orderlist(cart_id,track_no,vendor_id,pay_method){
		let confirmAction = confirm("Do you wish to Continue?");
		if (confirmAction) {
			var action = 0 ;
			$.ajax({
					url:'component/vendor_order_process.php',
					type:'post',
					data:{
						ope:action,
						cart_id:cart_id,
						track_no:track_no,
						vendor_id:vendor_id,
						pay_method:pay_method
					},
					success:function(data,status){
						if(data == 'true'){
							
							alert(" Food is READY!,\n Waiting for an Errand to Accept the Order");
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
										<h4 class="card-title">Customer's Order</h4>
									</div>
									<h3><i class="ri-settings-5-fill"></i></h3>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-sm-3">
											<div class="card shadow-bottom shadow-showcase">
												<div class="card-header d-flex justify-content-between" style="color: #FFF; background-color: #DC143C !important;border-top-left-radius: 10px;border-top-right-radius: 10px;">
													<div class="header-title">
														<h4 class="card-title">Customer's List</h4>
													</div>
													<h3><i class="ri-settings-5-fill"></i></h3>
												</div>
												<div class="card-body">
													<div class="list-group">
													<?php 
																
																$tablename	= TABLE_PREFIX.'orderlist';
																if($vendor_id == 0){
																	$v_id = $admin_id;
																}elseif($vendor_id == $vendor_id){
																	$v_id = $vendor_id;
																}
																$sql = "
																		SELECT CONCAT(E.firstname ,' ', E.mi,'.', ' ', E.lastname) AS customer_name,E.id AS cust_id
																		FROM $tablename AS A
																		INNER JOIN tbl_cart AS B ON (A.cart_id = B.id)
																		INNER JOIN tbl_foodlist AS C ON (B.food_id = C.id)
																		INNER JOIN tbl_vendor AS D ON (C.vendor_id = D.id)
																		INNER JOIN tbl_customer AS E ON (B.cust_ID = E.id)
																		WHERE D.id='$v_id' AND A.trans_status != '1'
																		GROUP BY E.id 
																		";
																		//echo $sql;
																$result = mysqli_query($DB_Helper->db_con,$sql) or die(mysqli_error($DB_Helper->db_con));
																
																if(mysqli_num_rows($result) > 0){
																
																
																$get_order_list = $DB_Helper->get_sql_results($sql);	
																
																if($get_order_list){
																	foreach($get_order_list as $row){
																		$customer_name 	 = $row->customer_name;
																		$cust_id 	 	 = $row->cust_id;
																		
													?>
																<a href="page_vendor_orderlist.php?cust_id=<?= $cust_id; ?>" class="list-group-item list-group-item-action <?php if($_GET['cust_id'] == $cust_id){echo 'active';}else{echo'';}?>">
																	<div class="d-flex w-100 justify-content-between">
																		<h6 class="mb-1"><i class='fas fa-arrow-circle-right' style='font-size:20px;color: crimson;'></i> &nbsp;&nbsp; <?= $customer_name; ?></h6>
																	</div>
																</a>
													<?php			}
														
																}
																
																}else{
																	echo "<p class='text-danger mt-1'><em>No Record Found!</em></p>";
																}?>
													</div>
												</div>
											</div>
										</div>
										
										<div class="col-sm-9">
										<?php 
											/*display if customer ID is not empty or hide right side*/
											if( $_GET['cust_id'] != 0){
										?>
											<div class="table-responsive-sm bottom-left shadow-showcase" style="border-radius: 10px !important;">
												<table class="table" id="reload_counter_orderlist">
													<thead class="text-uppercase" style="background-color: #DC143C;color: #FFF;">
														<tr>
															<th class="text-center" scope="col">Food Order</th>
															<th class="text-center" scope="col">Vendor Responce</th>
															<th class="text-center" scope="col">Payment Method</th>
															<th class="text-center" scope="col">Foods Status</th>
															<th class="text-center" scope="col">Action</th>
														</tr>
													</thead>
													<?php 
														$custid = $_GET['cust_id'];
														$tablename	= TABLE_PREFIX.'orderlist';
														if($vendor_id == 0){
															$v_id = $admin_id;
														}elseif($vendor_id == $vendor_id){
															$v_id = $vendor_id;
														}
														
														$get_order_list = $DB_Helper->get_sql_results("
														SELECT A.* , B.*, C.`food_name` , CONCAT(E.firstname ,' ', E.mi,'.', ' ', E.lastname) AS customer_name,A.track_no
														FROM $tablename AS A
														INNER JOIN tbl_cart AS B ON (A.cart_id = B.id)
														INNER JOIN tbl_foodlist AS C ON (B.food_id = C.id)
														INNER JOIN tbl_vendor AS D ON (C.vendor_id = D.id)
														INNER JOIN tbl_customer AS E ON (B.cust_ID = E.id)
														WHERE D.id ='$v_id' AND E.id='$custid' AND A.trans_status = '0'");	
														
															if($get_order_list){
																foreach($get_order_list as $row){
																$cart_id 		 = $row->cart_id;
																$food_name 	 	 = $row->food_name;
																$customer_name 	 = $row->customer_name;
																$vendor_status 	 = $row->vendor_status;
																$food_status 	 = $row->food_status;
																$pay_method 	 = $row->pay_method;
																$track_no 	 	 = $row->track_no;
													?>
														
														<tbody>
															<tr>
																<td>
																   <h6 class="mb-0"><i class="ri-price-tag-3-fill"></i> &nbsp; <?= $food_name;?></h6>
																   <p class="mb-0"><i class="ri-user-2-fill"></i> &nbsp; <small><?= $customer_name;?> - <mark>Customer</mark></small></p>
																   <p class="mb-0"><i class="ri-price-tag-2-fill"></i> &nbsp; <small>Invoice # - <mark><?= $track_no;?></mark></small></p>
																</td>
																<td class="text-center">
																	<button onclick="accept_orderlist(<?= $cart_id;?>)" type="button" id="bttn_accept" name="bttn_accept" 
																		class="btn btn-outline-success mt-2 btn-sm <?php if($vendor_status == 1){ echo 'active'; }else{ echo ''; } ?>" 
																		<?php if($food_status == 2 || $food_status == 3){echo"disabled";}else{echo"";} ?>>Accept</button>
																	<button onclick="denied_orderlist(<?= $cart_id;?>)" type="button" id="bttn_denied" name="bttn_denied" 
																		class="btn btn-outline-danger mt-2 btn-sm <?php if($vendor_status == 2){ echo 'active'; }else{ echo ''; } ?>"
																		<?php if($food_status == 2 || $food_status == 3){echo"disabled";}else{echo"";} ?>>Canceled</button>
																</td>
																<td class="text-center">
																	<?php 
																		if($pay_method == 1){
																			$pay_msg	 = "Over The Counter";
																			$color_badge = "primary";
																		}elseif($pay_method == 2){
																			$pay_msg 	 = "Cash-On Delivery";
																			$color_badge = "success";
																		}
																	?>
																	<span class="mt-2 badge badge-pill border border-<?= $color_badge;?> text-<?= $color_badge;?>">
																		<?= $pay_msg;?>
																	</span>
																</td>
																<td class="text-center">
																	<?php 
																	if($food_status == 0){ 
																		$food_stat =  "PENDING"; 
																		$food_stat_color = "warning";
																	}elseif($food_status == 1){ 
																		$food_stat = "Preparing..."; 
																		$food_stat_color = "primary";
																	}elseif($food_status == 2){ 
																		$food_stat =  "Ready for Pick-up"; 
																		$food_stat_color = "success";
																	}elseif($food_status == 3){ 
																		$food_stat =  "Ready for Deliver"; 
																		$food_stat_color = "success";
																	}elseif($food_status == 4){ 
																		$food_stat =  "CANCELED"; 
																		$food_stat_color = "danger";
																	}
																	?>
																	<span class="mt-2 badge badge-pill border border-<?= $food_stat_color;?> text-<?= $food_stat_color;?>">
																		<?= $food_stat;?>
																	</span>
																	
																</td>
																<td class="text-center">
																	<button onclick="ready_orderlist(<?= $cart_id;?>,<?= "'".$track_no."'";?>,<?= $v_id;?>,<?= $pay_method;?>)" type="button" id="bttn_done" name="bttn_done" 
																		class="btn btn-success btn-sm" <?php if($food_status == 0 || $food_status == 2 || $food_status == 3 || $food_status == 4){echo"disabled";}else{echo"";} ?>><b>Food Ready</b></button>
																</td>
															</tr>
														</tbody>
												<?php 
																} 
													
															} 
												?>
												</table>
											</div>
											<?php } /*end of display*/?>
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
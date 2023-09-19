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

if($self == 'page_errand' || 'page_errand_orderlist'){
	$tablename	= TABLE_PREFIX.'errand';
	
$get_user_info 	= $DB_Helper->get_row(" SELECT A.* , B.image, C.usetype
										FROM $tablename AS A
										INNER JOIN tbl_avatar AS B ON (A.avatar_id = B.id)
										INNER JOIN tbl_usertype AS C ON (A.`usertype` = C.id)
										WHERE A.id='$admin_id'");
$usertype		= $get_user_info->usertype;
$usetype		= $get_user_info->usetype;
$image			= $get_user_info->image;
}
	
?>
<script>
	function get_staff_avatar(id){
		//alert(id);
		$("#avatar_id").val(id);
		document.getElementById("span1").textContent="You Choose Avatar: " + id;
	}

	function update_delivery_status(errand_id,trackno,count){
		let confirmAction = confirm("Continue update Status?");
		if (confirmAction) {
			var action = 4 ;
			
				$.ajax({
					url:'component/mod_up.php',
					type:'post',
					data:{
						ope:action,
						errand_id:errand_id,
						trackno:trackno,
						count:count
					},
					success:function(data,status){
						if(data == 'true'){
							//alert(data);
							alert("Successfully Updated!.");
							location.reload();
						}else{
							alert("bobo MALI");
							//alert(data);
						}
					}
				});
			
		} else {
		 return false;
		}
	}
	
	function payment_status_cash(trackno){
		
		let confirmAction = confirm("Do you want to continue?");
		if (confirmAction) {
			var cash_amount = $("#cash_amount").val();
			var action = 5 ;
			
				$.ajax({
					url:'component/mod_up.php',
					type:'post',
					data:{
						ope:action,
						trackno:trackno,
						cash_amount:cash_amount
					},
					success:function(data,status){
						if(data == 'true'){
							//alert(data);
							alert("Successfully Payed!.");
							location.reload();
						}else{
							alert("bobo MALI");
							//alert(data);
						}
					}
				});
			
		} else {
		 return false;
		}
	}
	
	function payment_status_gcash(trackno){
		
		let confirmAction = confirm("Do you want to continue?");
		if (confirmAction) {
			var gcash_amount = $("#gcash_amount").val();
			var reference_no = $("#ref_no").val();
			var action = 8 ;
			
				$.ajax({
					url:'component/mod_up.php',
					type:'post',
					data:{
						ope:action,
						trackno:trackno,
						gcash_amount:gcash_amount,
						reference_no:reference_no
					},
					success:function(data,status){
						if(data == 'true'){
							//alert(data);
							alert("Successfully Payed!.");
							location.reload();
						}else{
							alert("bobo MALI");
							//alert(data);
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
<script type="text/javascript">
	$(document).ready(function() {
		
		$("#cash_execute").on('click',function(){
			 
			$("#cash_payment").removeAttr("style").show();
			$("#gcash_payment").attr("style", "display:none");
			
		});
		
		$("#gcash_execute").on('click',function(){
			 
			$("#gcash_payment").removeAttr("style").show();
			$("#cash_payment").attr("style", "display:none");
			
		});
	});
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
			<?php include_once 'template/sidebar_menu_errand.php';?>
			    
			<!-- [INCLUDE - TOPBAR MENU] -->
			<?php include_once 'template/topbar_menu.php';?>
			
			<div class="content-page">
				<div class="container-fluid">
					<div class="row">
					
						<div class="col-sm-12">
							<div class="card shadow-bottom shadow-showcase">
								<div class="card-header d-flex justify-content-between" style="color: #FFF; background-color: #DC143C !important;border-top-left-radius: 10px;border-top-right-radius: 10px;">
									<div class="header-title">
										<h4 class="card-title">Delivery Order</h4>
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
															$sql = "
																	SELECT A.*
																	FROM $tablename AS A
																	INNER JOIN tbl_errand AS B ON (A.`errand_id` = B.`id`)
																	INNER JOIN tbl_cart AS C ON (A.`cart_id` = C.`id`)
																	INNER JOIN tbl_customer AS D ON (C.`cust_ID` = D.`id`)
																	INNER JOIN tbl_foodlist AS E ON (C.`food_id` = E.`id`)
																	WHERE A.`errand_id`='$admin_id' 
																	GROUP BY A.`track_no`
																	ORDER BY A.`id` DESC
																	";
															$result = mysqli_query($DB_Helper->db_con,$sql) or die(mysqli_error($DB_Helper->db_con));
																
																if(mysqli_num_rows($result) > 0){
																	
																	$get_order_list = $DB_Helper->get_sql_results($sql);	
																	
																	if($get_order_list){
																		foreach($get_order_list as $row){
																			$track_no 			 = $row->track_no;
																			$delivery_process 	 = $row->delivery_process;
																			
																	
														?>
														<a href="page_errand_order_deliver.php?trackno=<?= $track_no;?>" class="list-group-item list-group-item-action 
																<?php if($_GET['trackno'] == $track_no){echo 'active';}else{echo'';}?>">
															<div class="d-flex w-100 justify-content-between">
																<h6 class="mb-1"><i class='fas fa-arrow-circle-right' style='font-size:20px;color: crimson;'></i> &nbsp;&nbsp; <?= $track_no; ?></h6>
																<?php 
																if($delivery_process == 5){
																	$delivery_process_msg = "Delivered";
																	$delivery_process_color = "success";
																}else{
																	$delivery_process_msg = "On-going";
																	$delivery_process_color = "danger";
																}
																?>
																<span class="pt-1 badge badge-pill badge-<?= $delivery_process_color;?>"><?= $delivery_process_msg;?></span>
															</div>
														</a>
														<?php 			}
																	}
																}else{
																	echo "<p class='text-danger mt-1'><em>No Record Found!</em></p>";
																}
														?>
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-8 col-lg-8 col-md-8">
											<div class="row">
												<?php 
													if($_GET['trackno'] != 0){
												?>
												<div class="col-lg-12">
													<div class="table-responsive-sm bottom-left shadow-showcase" style="border-radius: 10px !important;">
														<table class="table" id="reload_counter_orderlist">
															<thead class="text-uppercase" style="background-color: #DC143C;color: #FFF;">
																<tr>
																	<th scope="col">Order List</th>
																	<th class="text-center" scope="col">Totals</th>
																</tr>
															</thead>
															<tbody>
															<?php 
																$track_no = $_GET['trackno'];
																$tablename	= TABLE_PREFIX.'delivery';
																
																$get_subtotal_info 	= $DB_Helper->get_row("
																			SELECT SUM(C.`total_price`) AS subtotal
																			FROM tbl_delivery AS A
																			INNER JOIN tbl_errand AS B ON (A.`errand_id` = B.`id`)
																			INNER JOIN tbl_cart AS C ON (A.`cart_id` = C.`id`)
																			INNER JOIN tbl_customer AS D ON (C.`cust_ID` = D.`id`)
																			INNER JOIN tbl_foodlist AS E ON (C.`food_id` = E.`id`)
																			WHERE A.`errand_id`='$admin_id' AND A.`track_no`='$track_no'");
																$subtotal		= $get_subtotal_info->subtotal;
																
																$get_vendor_list = $DB_Helper->get_sql_results("
																SELECT A.*, CONCAT(D.firstname ,' ', D.mi,'. ', ' ', D.lastname) AS customer_name,
																E.`food_name`, E.`price` , C.`qty`, C.`total_price`
																FROM $tablename AS A
																INNER JOIN tbl_errand AS B ON (A.`errand_id` = B.`id`)
																INNER JOIN tbl_cart AS C ON (A.`cart_id` = C.`id`)
																INNER JOIN tbl_customer AS D ON (C.`cust_ID` = D.`id`)
																INNER JOIN tbl_foodlist AS E ON (C.`food_id` = E.`id`)
																WHERE A.`errand_id`='$admin_id' AND A.`track_no`='$track_no'");
																
																if($get_vendor_list){
																	foreach($get_vendor_list as $row){
																		$food_name 		= $row->food_name;
																		$price 			= $row->price;
																		$qty 	 	 	= $row->qty;
																		$total_price 	= $row->total_price;
																		$customer_name  = $row->customer_name;
																		
															?>
															
																<tr>
																	<td>
																		<h6 class="mb-0"><i class="ri-price-tag-3-fill"></i> &nbsp; <?= $food_name;?></h6>
																		<p class="mb-0"><i class="ri-user-2-fill"></i> &nbsp; <small><?= $customer_name;?> - <mark>Customer</mark></small></p>
																		<p class="mb-0"><i class="ri-wallet-2-fill"></i> &nbsp; <small><?= $qty.'pc * '.$price.' <mark>(&#8369;'.$total_price.'.<em>00</em>)</mark>';?></small></p>
																	</td>
																	<td class="text-center"><b><?= "&#8369;".number_format( $total_price, 2 );?></b></td>
																</tr>
															
														<?php 		} 
																}	?>
																<tr>
																	<td class="text-right"><b>Total Payment : </b></td>
																	<td class="text-center"><h3 class="text-danger font-weight-700"><?= "&#8369;".number_format( $subtotal, 2 );?></h3></td>
																</tr>
															</tbody>	
														</table>
													</div>
												</div>
												<div class="col-lg-12 mt-3">
													<div class="table-responsive-sm bottom-left shadow-showcase" style="border-radius: 10px !important;">
														<table class="table" id="reload_counter_orderlist ">
																<thead class="text-uppercase text-center" style="background-color: #DC143C;color: #FFF;">
																	<tr>
																		<th scope="col">Delivery Status</th>
																		<th scope="col">Payment Status</th>
																	</tr>
																</thead>
																
																<tbody>
																
																<?php 
																			$track_no = $_GET['trackno'];
																			
																			$get_delivery_info 	= $DB_Helper->get_row(" 
																			SELECT A.* , (B.`delivery_process`) AS del_process , B.`percentage` , C.`payment_status`
																			FROM tbl_delivery AS A
																			INNER JOIN tbl_delivery_process AS B ON (A.`delivery_process` = B.`id`)
																			LEFT JOIN tbl_errand_delivery_info AS C ON (A.`cart_id` = C.`cart_id`) AND (A.`track_no` = C.`track_no`)
																			WHERE A.errand_id='$admin_id' AND A.track_no='$track_no'");
																		
																			if($get_delivery_info){
																				$del_process		= $get_delivery_info->del_process;
																				$delivery_process	= $get_delivery_info->delivery_process;
																				$cart_id			= $get_delivery_info->cart_id;
																				$id					= $get_delivery_info->id;
																				$payment_status		= $get_delivery_info->payment_status;
																			}else{
																				$del_process 	  	= "";
																				$delivery_process 	= "";
																				$cart_id		  	= "";
																				$payment_status		= "";
																			}
																		?>
																	<tr>
																		<td>
																		
																			<button onclick="update_delivery_status(<?= $admin_id;?>,<?= "'".$_GET['trackno']."'";?>,<?= $delivery_process;?>)" 
																				type="button" 
																				class="btn btn-outline-primary rounded-pill mt-2 btn-block text-uppercase <?php  if($delivery_process > 4 || $delivery_process == 1){echo "disabled";}else{echo "";}?>" 
																				style="font-size: 90%;font-weight: 700;">
																				<em><?= $del_process;?></em> &nbsp; <i class="ri-check-fill"></i>
																			</button>
																		</td>
																		<td>
																			<button data-toggle="modal" data-target="#exampleModal"
																				type="button" style="font-size: 90%;font-weight: 700;"
																				class="btn btn-outline-danger rounded-pill mt-2 btn-block text-uppercase 
																				<?php  
																				if($delivery_process == 5){
																					if($payment_status == 1){
																						echo 'disabled';
																					}else{
																						echo '';
																					}
																				}else{
																					echo 'disabled';
																				}
																				?> ">
																				<em>PAYMENT METHOD</em> &nbsp; <i class="ri-bank-card-line"></i>
																			</button>
																		</td>
																	</tr>
																	
																</tbody>
														</table>
													</div>
												</div>
												<?php }?>
											</div>
										</div>
									</div>
									
										<!-- Modal -->
										<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered " role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Payment Method</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<div class="row">
															<div class="col-lg-12 mb-2">
																<ul class="list-unstyled p-0 m-0 row">
																	<li class="col-lg-4 col-md-6 col-sm-6 mt-2"><img id="cash_execute" src="<?php echo PATH_IMAGES."cash.png"?>" class="ml-3 avatar-70 img-fluid rounded" alt="Responsive image" width="40" height="40" style="cursor: pointer;"></li>
																	<li class="col-lg-4 col-md-6 col-sm-6 mt-2"><img id="gcash_execute" src="<?php echo PATH_IMAGES."gcash.png"?>" class="ml-3 avatar-70 img-fluid rounded" alt="Responsive image" width="40" height="40" style="cursor: pointer;"></li>
																</ul>
															</div>
															
															<div class="col-lg-12" id="cash_payment">
																<div class="card shadow-bottom shadow-showcase">
																	<div class="card-header d-flex justify-content-between" style="color: #FFF; background-color: #DC143C !important;border-top-left-radius: 10px;border-top-right-radius: 10px;">
																		<div class="header-title">
																			<h4 class="card-title">CASH</h4>
																		</div>
																		<h3><i class="ri-settings-5-fill"></i></h3>
																	</div>
																	<div class="card-body">
																		<form id="frm_cash_payment" name="frm_cash_payment" method="post" enctype="multipart/form-data" data-toggle="validator">
																			<div class="col-md-8">                      
																				<div class="form-group">
																					<label>CASH Amount *</label>
																					<input id="cash_amount" name="cash_amount" type="number" class="form-control" placeholder="Enter CASH Amount" 
																					autocomplete="off" data-errors="Please Enter CASH Amount." required>
																					<div class="help-block with-errors"></div>
																				</div>
																			</div>
																			<hr>	
																			<button onclick="payment_status_cash(<?= "'".$_GET['trackno']."'";?>)" 
																				data-toggle="modal" data-target="#exampleModal"
																				type="submit" style="font-size: 90%;font-weight: 700;"
																				class="btn btn-outline-danger rounded-pill mt-2 btn-block text-uppercase">
																				<em>PAY ORDERS</em> &nbsp; <i class="ri-bank-card-line"></i>
																			</button>																			
																		</form>
																	</div>
																</div>
															</div>
															<div class="col-lg-12" id="gcash_payment" style="display: none";>
																<div class="card shadow-bottom shadow-showcase">
																	<div class="card-header d-flex justify-content-between" style="color: #FFF; background-color: #DC143C !important;border-top-left-radius: 10px;border-top-right-radius: 10px;">
																		<div class="header-title">
																			<h4 class="card-title">GCASH</h4>
																		</div>
																		<h3><i class="ri-settings-5-fill"></i></h3>
																	</div>
																	<div class="card-body">
																		<form id="frm_cash_payment" name="frm_cash_payment" method="post" enctype="multipart/form-data" data-toggle="validator">
																			<div class="col-md-8">                      
																				<div class="form-group">
																					<label>Refereance No. *</label>
																					<input id="ref_no" name="ref_no" type="text" class="form-control" placeholder="Enter Refereance Number" 
																					autocomplete="off" data-errors="Please Enter Refereance Number." required>
																					<div class="help-block with-errors"></div>
																				</div>
																			</div>
																			<div class="col-md-8">                      
																				<div class="form-group">
																					<label>G-CASH Amount *</label>
																					<input id="gcash_amount" name="gcash_amount" type="number" class="form-control" placeholder="Enter G-CASH Amount" 
																					autocomplete="off" data-errors="Please Enter G-CASH Amount." required>
																					<div class="help-block with-errors"></div>
																				</div>
																			</div>
																			<hr>	
																			<button onclick="payment_status_gcash(<?= "'".$_GET['trackno']."'";?>)"
																				data-toggle="modal" data-target="#exampleModal"
																				type="button" style="font-size: 90%;font-weight: 700;"
																				class="btn btn-outline-danger rounded-pill mt-2 btn-block text-uppercase">
																				<em>PAY ORDERS</em> &nbsp; <i class="ri-bank-card-line"></i>
																			</button>																			
																		</form>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
													</div>
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
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

if($self == 'page_customer_complete_order'){
	$tablename	= TABLE_PREFIX.'customer';
}
	
$get_user_info 	= $DB_Helper->get_row(" SELECT A.* , B.image, C.usetype
										FROM $tablename AS A
										INNER JOIN tbl_avatar AS B ON (A.avatar_id = B.id)
										INNER JOIN tbl_usertype AS C ON (A.`usertype` = C.id)
										WHERE A.id='$admin_id'");
$usertype		= $get_user_info->usertype;
$usetype		= $get_user_info->usetype;
$image			= $get_user_info->image;
?>

	<body class="  ">
	
		<!-- loader Start -->
		<div id="loading">
			<div id="loading-center"></div>
		</div>
		<!-- loader END -->
		
		<!-- Wrapper Start -->
		<div class="wrapper">
		
			<!-- [INCLUDE - SIDEBAR MENU] -->
			<?php include_once 'template/sidebar_menu_customer.php';?>
			    
			<!-- [INCLUDE - TOPBAR MENU] -->
			<?php include_once 'template/topbar_menu.php';?>
			
			<div class="content-page">
				<div class="container-fluid">
					<div class="row">
						<?php
						$getmsg = $_GET['msg'];
						
						if($getmsg == 'suc'){
							echo "
								<div class='col-md-12'> 
									<div class='alert text-white bg-success' role='alert'>
										<div class='iq-alert-icon'>
											<i class='fas fa-check' style='font-size:24px;color: green;'></i>
										</div>
									<div class='iq-alert-text'>" . $messages['fg']['Payment_Success'] . "</div>
										<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
											<i class='ri-close-line'></i>
										</button>
									</div>
								</div>
							";	
						}elseif($getmsg == 'no'){
							echo "
								<div class='col-md-12'> 
									
								</div>
							";	
						}
							
						?>
						<!-- Left Content-->
						<div class="col-lg-3">
							<div class="row">
								<div class="col-lg-12">
									<div class="card bottom-left shadow-showcase">
										<div class="card-header d-flex justify-content-between" style="color: #FFF; background-color: #DC143C !important;border-top-left-radius: 10px;border-top-right-radius: 10px;">
											<div class="header-title">
												<h4 class="card-title">Order Track #</h4>
											</div>
											<h3><i class="ri-settings-5-fill"></i></h3>
										</div>
										<div class="card-body">
											<b class="text-danger"><i class="ri-bookmark-fill"></i><small>Notes:</small></b>
											<p class="mb-2"><em><i class="ri-arrow-drop-right-fill"></i>
												<small>Your Track number serves as your invoice or receipt number.</small></em>
											</p>
											<div class="list-group">
												<?php 
													$tablename	= TABLE_PREFIX.'vendor';
													$sql = "
														SELECT DISTINCT(A.track_no) AS t_no, C.payment_status,
														( SELECT COUNT(*) FROM tbl_orderlist WHERE track_no=t_no) AS order_no, B.cust_ID  
														FROM tbl_orderlist AS A
														INNER JOIN tbl_cart AS B ON (A.`cart_id` = B.`id`)
														INNER JOIN tbl_delivery AS C ON (A.`track_no` = C.`track_no`)
														WHERE B.cust_ID = '$admin_id' AND  C.payment_status = '1'
														ORDER BY A.`id` DESC";
													$result = mysqli_query($DB_Helper->db_con,$sql) or die(mysqli_error($DB_Helper->db_con));
																	
													if(mysqli_num_rows($result) > 0){
													
														$get_vendor_list = $DB_Helper->get_sql_results($sql);	
														if($get_vendor_list){
															foreach($get_vendor_list as $row){
																$t_no 	 	 = $row->t_no;
																$order_no 	 = $row->order_no;
												?>
												<a href="page_customer_complete_order.php?trackno=<?= $t_no; ?>&msg=no" class="list-group-item list-group-item-action 
														<?php if($_GET['trackno'] == $t_no){echo "active";}else{echo "";}?>">
													<div class="d-flex w-100 justify-content-between">
														<h5 class="mb-1"><?= $t_no; ?></h5>
														<span class="mb-1 badge badge-danger"><?= $order_no; ?></span>
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
							</div>
						</div>
						
						<!-- Right Content-->
						<div class="col-lg-9">
							<div class="row">
								<div class="col-lg-12">
									<?php 
										/*display if TRack # is not empty or hide right side*/
										if( $_GET['trackno'] != 0){
									?>
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12">
											<div class="card bottom-left shadow-showcase">
												<div class="card-header d-flex justify-content-between" style="color: #FFF; background-color: #DC143C !important;border-top-left-radius: 10px;border-top-right-radius: 10px;">
													<div class="header-title">
														<h4 class="card-title">Delivery Process</h4>
													</div>
													<h3><i class="ri-settings-5-fill"></i></h3>
												</div>
												<div class="card-body">
													<div class="card-header d-flex justify-content-between">
														<div class="header-title">
															<b class="text-danger"><i class="ri-bookmark-fill"></i><small>Notes:</small></b>
															<p class="mb-2"><em><i class="ri-arrow-drop-right-fill"></i><small>Just wait for the Errand to accept your food for delivery.</small></em></p>
														</div>
														<?php 
														$track_no = $_GET['trackno'];
														
														$sql = "SELECT A.* , CONCAT(B.firstname ,' ', B.mi,'.', ' ', B.lastname) AS errand_name
																FROM tbl_delivery AS A
																INNER JOIN tbl_errand AS B ON (A.`errand_id` = B.`id`)
																WHERE A.`track_no` = '$track_no'";
														$result = mysqli_query($DB_Helper->db_con,$sql) or die(mysqli_error($DB_Helper->db_con));
														
														$checkdata = mysqli_num_rows($result);
														if($checkdata > 0){ 
														
															$get_errand_info 	= $DB_Helper->get_row($sql);
															$errand_name		= $get_errand_info->errand_name;
														?>
															<div class="alert alert-success bottom-left shadow-showcase" role="alert">
																<div class="iq-alert-text">
																	<small>Accepted By </small>: &nbsp; &nbsp; <b><i class="ri-check-double-line"></i><?= $errand_name; ?></b>
																</div>
															</div>
														<?php }else{ ?>
															<div class="alert alert-warning bottom-left shadow-showcase" role="alert">
																<div class="iq-alert-text"><i class="ri-loader-2-line"></i>
																	<small>Waiting for Errand to accept the food for delivery. . .</small>
																</div>
															</div>
														<?php }?>
														
													</div>
													<ul class="list-inline p-0 m-0">
														<li class="mb-4">
															<div class="d-flex align-items-center pt-2">
																<div class="ml-3 w-100">
																	<?php 
																	$track_no = $_GET['trackno'];
																	
																		$sql = "SELECT A.* , B.`delivery_process` , B.`percentage`
																				FROM tbl_delivery AS A
																				INNER JOIN tbl_delivery_process AS B ON (A.`delivery_process` = B.`id`)
																				WHERE  A.`track_no`='$track_no'
																				GROUP BY A.`track_no`";
																					
																		$result = mysqli_query($DB_Helper->db_con,$sql) or die(mysqli_error($DB_Helper->db_con));
																	
																	$checkdata = mysqli_num_rows($result);
																	if($checkdata > 0){ 
																	
																			$get_delivery_process	= $DB_Helper->get_row($sql);
																			$delivery_process		= $get_delivery_process->delivery_process;
																			$percentage				= $get_delivery_process->percentage;
																	?>
																		<div class="media align-items-center justify-content-between">
																			<p class="mb-0"><em><i class="ri-arrow-drop-right-fill"></i><small>Track your Delivery here!.</small></em></p>
																			<h6><mark><?= $delivery_process;?></mark> . . . (<span class="text-danger"> <?= $percentage;?>%</span>)</h6>
																		</div>
																		<div class="iq-progress-bar mt-3 progress-bar-striped progress-bar-animated" style="height: 15px !important;">
																			<span class="bg-danger progress-bar-striped iq-progress progress-1" data-percent="<?= $percentage;?>"></span>
																		</div>
																	<?php }?>
																</div>
															</div>
														</li>
													</ul>
													
												</div>
											</div>
										</div>
									</div>
									<?php } /*end of display*/?>
								</div>
								<div class="col-lg-12">
									<?php 
										/*display if TRack # is not empty or hide right side*/
										if( $_GET['trackno'] != 0){
									?>
									<div class="card bottom-left shadow-showcase">
										<div class="card-header d-flex justify-content-between" style="color: #FFF; background-color: #DC143C !important;border-top-left-radius: 10px;border-top-right-radius: 10px;">
											<div class="header-title">
												<?php 
												if($_GET['trackno'] != 0){
													$track_no = $_GET['trackno'];
													echo 
													'
													<h4 class="card-title">Order Details  <small><em>(' .$track_no. ')</em></small></h4>
													';
												}else{
													$track_no = "";
												}
												?>
												
													
											</div>
									
											<h3><i class="ri-settings-5-fill"></i></h3>
										</div>
										<div class="card-body">
											
											<div class="table-responsive-sm bottom-left shadow-showcase mb-2" style="border-radius: 10px !important;">
												<table class="table" id="reload_counter_orderlist">
													<thead class="text-uppercase" style="background-color: #DC143C;color: #FFF;">
														<tr>
															<th class="text-center" scope="col">Food Order</th>
															<th class="text-center" scope="col">Vendor Responce</th>
															<th class="text-center" scope="col">Foods Status</th>
															<th class="text-center" scope="col">Payment Method</th>
														</tr>
													</thead>
													<?php 
														if($_GET['trackno'] != ''){
															
															$get_trackno = $_GET['trackno'] ;
															$tablename	= TABLE_PREFIX.'orderlist';
															
															$sql = "
																SELECT A.* , B.*, C.`food_name` , CONCAT(D.firstname ,' ', D.mi,'.', ' ', D.lastname) AS vendors_name,
																C.price AS food_price, B.total_price
																FROM tbl_orderlist AS A
																INNER JOIN tbl_cart AS B ON (A.cart_id = B.id)
																INNER JOIN tbl_foodlist AS C ON (B.food_id = C.id)
																INNER JOIN tbl_vendor AS D ON (C.vendor_id = D.id)
																WHERE A.track_no ='$get_trackno'
															";
															
															$get_order_list = $DB_Helper->get_sql_results($sql);	
															
															if($get_order_list){
																foreach($get_order_list as $row){
																	$cart_id 	 = $row->cart_id;
																	$food_name 	 	 = $row->food_name;
																	$vendors_name 	 = $row->vendors_name;
																	$vendor_status 	 = $row->vendor_status;
																	$food_status 	 = $row->food_status;
																	$pay_method 	 = $row->pay_method;
																	
																	$qty 	 		 = $row->qty;
																	$total_price 	 = $row->total_price;
																	$food_price 	 = $row->food_price;
													?>
														
														<tbody>
															<tr>
																<td>
																   <h6 class="mb-0"><i class="ri-price-tag-3-fill"></i> &nbsp; <?= $food_name;?></h6>
																   <p class="mb-0"><i class="ri-user-2-fill"></i> &nbsp; <small><?= $vendors_name;?> - <mark>Vendor</mark></small></p>
																   <p class="mb-0"><i class="ri-wallet-2-fill"></i> &nbsp; <small><?= $qty.'pc * '.$food_price.' <mark>(&#8369;'.$total_price.')</mark>';?></small></p>
																</td>
																<td class="text-center">
																	<?php 
																	if($vendor_status == 0){ 
																		$vendor_msg 	= "PENDING";
																		$v_status_color = "warning";
																	}elseif($vendor_status == 1){ 
																		$vendor_msg 	= "ACCEPT";
																		$v_status_color = "success";																		
																	}elseif($vendor_status == 2){ 
																		$vendor_msg		= "CANCELED"; 
																		$v_status_color = "danger ";
																	}?>
																	<span class="mt-2 badge badge-pill border border-<?= $v_status_color;?> text-<?= $v_status_color;?>">
																		<?= $vendor_msg;?>
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
																
																		<?php 
																		if($food_status == 4){
																			$canceled_cod = "<del>Cash-On Delivery</del>";
																			$canceled_otc = "<del>Over The Counter</del>";
																			$canceled_color = "danger";
																		}else{
																			$canceled_cod = "Cash-On Delivery";
																			$canceled_otc = "Over The Counter";
																			$canceled_color = "primary";
																		}	?>
																	<span class="mt-2 badge badge-pill border border-<?= $canceled_color;?> text-<?= $canceled_color;?>">
																		<?php
																			if($pay_method == 2){ 
																				echo $canceled_cod; 
																			}elseif($pay_method == 1){ 
																				echo $canceled_otc; 
																			}?>
																		
																		
																	</span>
																</td>
															</tr>
														</tbody>
													<?php } }

													}elseif($_GET['trackno'] == 0){?>
														<tbody>
															<tr>
																<td colspan='3'>
																   <h6 class="mb-0">No Record Found</h6>
																</td>
															</tr>
														</tbody>
														
													<?php }?>
												</table>
											</div>
											<div class="row mt-4 mb-3">
												<div class="offset-lg-8 col-lg-4">
													<div class="or-detail rounded bottom-left shadow-showcase" id="reload_counter_orderdetails">
														<?php 
															$tracks_no = $_GET['trackno'];
															$tablename	= TABLE_PREFIX.'orderlist';
															if($tracks_no != 0){
																
																$get_total 	= $DB_Helper->get_row(" 
																	SELECT A.* , B.* , C.del_fee, 
																		(SELECT SUM(B.`total_price`) 
																		FROM $tablename AS A
																		INNER JOIN tbl_cart AS B ON (A.cart_id = B.id)
																		INNER JOIN tbl_delfee AS C ON (A.pay_method = C.id)
																		WHERE A.track_no= '$tracks_no')  AS ttl_price
																	FROM tbl_orderlist AS A
																	INNER JOIN tbl_cart AS B ON (A.cart_id = B.id)
																	INNER JOIN tbl_delfee AS C ON (A.pay_method = C.id)
																	WHERE A.track_no= '$tracks_no'");
																if($get_total){
																	$ttl_price		= $get_total->ttl_price;
																	$del_fee		= $get_total->del_fee;
																}
															}else{
																$ttl_price		= 0;
																$del_fee		= 0;
															}
														?>
														<div class="p-3">
															<h5 class="mb-3"><i class="ri-coins-fill"></i> &nbsp; Ready your Payment</h5>
															<div class="mb-2">
																<h6><i class="ri-arrow-right-s-fill"></i> &nbsp; Total Order</h6>
																<p><i class="ri-arrow-drop-right-line"></i> &nbsp; <b><mark><?= "&#8369;".number_format( $ttl_price, 2 );?></mark></b></p>
															</div>
															<div class="mb-2">
																<h6><i class="ri-arrow-right-s-fill"></i> &nbsp; Delivery Fee </h6>
																<p><i class="ri-arrow-drop-right-line"></i> &nbsp; <b><mark><?= "&#8369;".number_format( $del_fee, 2 );?></mark></b></p>
															</div>
															<hr>
															<div class="mb-2">
																<h5 class="mb-3"><i class="ri-secure-payment-fill"></i> &nbsp; Payment Status</h5>
																<?php 
																	$track_no = $_GET['trackno'];
																	
																	$sql ="SELECT A.* , B.`payment_status`
																											FROM tbl_remittance AS A
																											INNER JOIN tbl_delivery AS B ON (A.`track_no` = B.`track_no`)
																											WHERE A.track_no='$track_no'";
																	$result = mysqli_query($DB_Helper->db_con,$sql) or die(mysqli_error($DB_Helper->db_con));
																	
																	if(mysqli_num_rows($result) > 0){
																	
																	
																	$get_user_info 	= $DB_Helper->get_row($sql);
																	$pay_method		= $get_user_info->pay_method;
																	$payment_status	= $get_user_info->payment_status;
																	$date_remit		= $get_user_info->date_remit;
																	
																	if($pay_method == 1){ ?>
																	
																			<p class="font-weight-700 text-success">
																			<i class="ri-arrow-drop-right-line"></i> &nbsp; <b>
																					<?php if($payment_status == 1){ 
																						echo "Payment Success"." | <small><em><mark> (".$date_remit.") </mark></em></small>"; 
																					}?>
																			</b></p>
																			
																		<?php }else{
																		
																		
																		$sql = "SELECT * FROM `tbl_errand_delivery_info`
																				WHERE track_no='$track_no'";
																					
																		$result = mysqli_query($DB_Helper->db_con,$sql) or die(mysqli_error($DB_Helper->db_con));
																		
																		$checkdata = mysqli_num_rows($result);
																		if($checkdata > 0){
																		
																					$check_payment_status	= $DB_Helper->get_row($sql);
																					$payment_status			= $check_payment_status->payment_status;
																					$time_deliver			= $check_payment_status->time_deliver;
																			
																		?>
																					<p class="font-weight-700 text-success">
																					<i class="ri-arrow-drop-right-line"></i> &nbsp; <b>
																							<?php if($payment_status == 1){ 
																								echo "Payment Success"." | <small><em><mark> (".$time_deliver.") </mark></em></small>"; 
																							}else{ 
																								echo "Not yet Paid";
																							}?>
																					</b></p>
																		<?php   }
																		}
																	
																	}
																	?>
															</div>
														</div>
														
													</div>
												</div>
											</div> 
										</div>
									</div>
									<?php } /*end of display*/?>
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
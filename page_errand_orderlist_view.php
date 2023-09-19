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

if($self == 'page_errand' || 'page_errand_orderlist' || 'page_errand_orderlist_view'){
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

	function accept_errand_orderlist(track_no,admin_id){
		let confirmAction = confirm("Are you sure you want to ACCEPT this Order?");
		if (confirmAction) {
			var action = 3 ;
			
				$.ajax({
					url:'component/mod_up.php',
					type:'post',
					data:{
						ope:action,
						track_no:track_no,
						admin_id:admin_id
					},
					success:function(data,status){
						if(data == 'true'){
							
							alert("Order's successfully ACCEPT!.");
							window.location.href = "page_errand_orderlist.php";
							
							$.ajax({
								url: "page_vendor_delivery_pickup.php?track_no='" + track_no + "'" ,
								cache: false,
								success: function(html){
									$("#vendor_delivery_pickup").html(html);
								}	
							});
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
			<?php include_once 'template/sidebar_menu_errand.php';?>
			    
			<!-- [INCLUDE - TOPBAR MENU] -->
			<?php include_once 'template/topbar_menu.php';?>
			
			<div class="content-page">
				<div class="container-fluid">
					<div class="row">
					<?php 
					$track_no = $_GET['track_no'];
					$tablename	= TABLE_PREFIX.'delivery';
					$get_info 	= $DB_Helper->get_row(" SELECT A.* , B.*, C.`food_name` , 
											CONCAT(E.firstname ,' ', E.mi,'.', ' ', E.lastname) AS cust_name,A.track_no, C.price,
											CONCAT(D.firstname ,' ', D.mi,'.', ' ', D.lastname) AS vend_name
											FROM $tablename AS A
											INNER JOIN tbl_cart AS B ON (A.cart_id = B.id)
											INNER JOIN tbl_foodlist AS C ON (B.food_id = C.id)
											INNER JOIN tbl_vendor AS D ON (C.vendor_id = D.id)
											INNER JOIN tbl_customer AS E ON (B.cust_ID = E.id)
											WHERE A.`food_status`='2' AND A.`del_status`='0' AND A.`track_no`='$track_no'");
					$vend_name			= $get_info->vend_name;
					$cust_name			= $get_info->cust_name;
					?>
						<div class="col-sm-12">
							<div class="card shadow-bottom shadow-showcase">
								<div class="card-header d-flex justify-content-between">
									<div class="header-title">
										<nav aria-label="breadcrumb">
											<ol class="breadcrumb" style="background-color: #fff !important;padding: 0 !important;margin-bottom: 0 !important;">
											    <li class="breadcrumb-item"><a href="page_errand_orderlist.php">Order List</a></li>
												<li class="breadcrumb-item active" aria-current="page">View Detials</li>
											</ol>
										</nav>
									</div>
									<div class="header-title">
										<h4 class="card-title">Delivery Order</h4>
									</div>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-sm-12">
											<div class="table-responsive-sm bottom-left shadow-showcase" style="border-radius: 10px !important;">
												<table class="table" id="reload_counter_orderlist">
													<thead  class="text-uppercase" style="background-color: #DC143C;color: #FFF;">
														<tr>
															<th scope="col"> &nbsp;&nbsp;&nbsp; Food Name</th>
															<th class="text-center" scope="col">Total Price</th>
														</tr>
													</thead>
														<tbody>
															<?php 
															$track_no = $_GET['track_no'];
															$tablename	= TABLE_PREFIX.'delivery';
																
															$get_order_list = $DB_Helper->get_sql_results("
															SELECT A.* , B.*, C.`food_name` , CONCAT(E.firstname ,' ', E.mi,'.', ' ', E.lastname) AS customer_name,A.track_no, C.price,
															CONCAT(D.firstname ,' ', D.mi,'.', ' ', D.lastname) AS vendors_name
															FROM $tablename AS A
															INNER JOIN tbl_cart AS B ON (A.cart_id = B.id)
															INNER JOIN tbl_foodlist AS C ON (B.food_id = C.id)
															INNER JOIN tbl_vendor AS D ON (C.vendor_id = D.id)
															INNER JOIN tbl_customer AS E ON (B.cust_ID = E.id)
															WHERE A.`food_status`='2' AND A.`del_status`='0' AND A.`track_no`='$track_no'");	
															
															if($get_order_list){
																foreach($get_order_list as $row){
																	$cart_id 		 = $row->cart_id;
																	$food_name 	 	 = $row->food_name;
																	$qty	 	 	 = $row->qty;
																	$price	 	 	 = $row->price;
																	$total_price 	 = $row->total_price;
																	$customer_name 	 = $row->customer_name;
																	$vendors_name 	 = $row->vendors_name;
															?>
															
															
																<tr>
																	<td>
																		<h6 class="mb-0"><i class="ri-price-tag-3-fill"></i> &nbsp; <?= $food_name;?></h6>
																		<h6 class="mb-0"><i class="ri-user-2-fill"></i> &nbsp; <?= $vendors_name;?> - <small><mark><em>Vendors</em></mark></small></h6>
																		<p class="mb-0"><i class="ri-wallet-2-fill"></i> &nbsp; <small><?= $qty.'pc * '.$price.' <mark>(&#8369;'.$total_price.')</mark>';?></small></p>
																	</td>
																	<td class="text-center">
																		<h6 class="mb-0"><?= "&#8369;".number_format( $total_price, 2 );?></h6>
																	</td>
																</tr>
															<?php 	}}  ?>
																<tr>
																	<td class="text-center" colspan='2'> 
																		<h6 class="mb-0"><?= $cust_name;?></h6>
																		<p class="mb-0"><small><mark>Invoice # - (<?=  $_GET['track_no']; ?>)</mark></small></p>
																		<p class="mb-0"><small><mark>Customer</mark></small></p>
																	</td>
																</tr>
																<tr class="table-active">
																	<td class="text-center" colspan='2'>
																	<?php 
																	$track_no = $_GET['track_no'];
																	$sql = "SELECT A.* , B.`qty` , B.`total_price` , C.`price` , C.`food_name`
																				FROM tbl_orderlist AS A
																				INNER JOIN  tbl_cart AS B ON (A.`cart_id` = B.`id`)
																				INNER JOIN tbl_foodlist AS C ON (B.`food_id` =C.`id`)
																				WHERE A.track_no='$track_no' AND A.vendor_status='0'";
																	$result = mysqli_query($DB_Helper->db_con,$sql) or die(mysqli_error($DB_Helper->db_con));
																	
																	$checkdata = mysqli_num_rows($result);
																	if($checkdata > 0){ ?>
																		<div class="alert alert-danger" role="alert">
																			<div class="iq-alert-icon">
																				<i class="ri-error-warning-line"></i>
																			</div>
																			<div class="iq-alert-text">It has a <b>Pending Order's</b>, still waiting for vendor's responce!</div>
																		</div>
																	<?php }else{ ?>
																		<button  onclick="accept_errand_orderlist(<?php echo "'".$_GET['track_no']."'"; ?>,<?php echo $admin_id; ?>)" type="button" class="btn btn-warning btn-block text-uppercase"><b>Accept for Delivery</b></button>
																	<?php } ?>
																	</td>
																</tr>
														</tbody>
												</table>
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
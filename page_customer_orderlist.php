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

if($self == 'page_customer' || 'page_customer_profile' || 'page_customer_changepassword' || 'page_customer_cart'){
	$tablename	= TABLE_PREFIX.'customer';
	
$get_user_info 	= $DB_Helper->get_row(" SELECT A.* , B.image, C.usetype
										FROM $tablename AS A
										INNER JOIN tbl_avatar AS B ON (A.avatar_id = B.id)
										INNER JOIN tbl_usertype AS C ON (A.`usertype` = C.id)
										WHERE A.id='$admin_id'");
$usertype		= $get_user_info->usertype;
$usetype		= $get_user_info->usetype;
$image			= $get_user_info->image;
$pass_word		= $get_user_info->pass_word;
	
	
	$get_del_fee 	= $DB_Helper->get_row(" SELECT * from tbl_delfee");
	$del_fee		= $get_del_fee->del_fee;
	
	
	$get_total_order 	= $DB_Helper->get_row(" SELECT COUNT(*) AS total_order FROM tbl_cart WHERE cust_ID ='$admin_id'  AND order_status='0';");
	$total_order		= $get_total_order->total_order;
	
	$get_total_qty 	= $DB_Helper->get_row(" SELECT SUM(qty) AS total_qty FROM tbl_cart WHERE cust_ID ='$admin_id'  AND order_status='0';");
	$total_qty		= $get_total_qty->total_qty;
	
}

	/*default id=2 (2 = COD/Deliver , 1 = OTC/Pick-up*/
	$get_del_fee 	= $DB_Helper->get_row(" SELECT * from tbl_delfee WHERE id=2");
	$del_fee		= $get_del_fee->del_fee;	
?>
<script>
	function delete_order_cart(id){
		let confirmAction = confirm("Are you sure to Delete this Food?");
		if (confirmAction) {
			var action = 2 ;
			
				$.ajax({
					url:'component/mod_del.php',
					type:'post',
					data:{
						ope:action,
						cart_id:id
					},
					success:function(data,status){
						if(data == 'true'){
							
							alert("Successfully Deleted!.");
							location.reload();
						}
					}
				});
			
		} else {
		 return false;
		}
	}
</script>
<script type="text/javascript">
$(document).ready(function() {
	
	// pick up
	$('#bttn_pickup').click(function(){
		$("#id_indicator").val("1");
		$("#pay_method").val("1");
		var ttl_amnt = parseInt($("#total_amount").val()); 
		var del_fee = parseInt($("#del_fees").val());
		var get_ttl_amnt = ttl_amnt;
		id_indicator
		document.getElementById("del_option").textContent="0";
		document.getElementById("display_ttl_amnt").textContent=get_ttl_amnt;
		
		//this is to indicate Pick-Up is selected or Active
		$("#bttn_pickup").addClass("btn-success");
		$("#bttn_pickup").removeClass("btn-outline-success");
		
		//deliver will be de-Active
		$("#bttn_deliver").removeClass("btn-primary");
		$("#bttn_deliver").addClass("btn-outline-primary");
	}); 
	
	// deliver
	$('#bttn_deliver').click(function(){
		$("#id_indicator").val("1");
		$("#pay_method").val("2");
		var ttl_amnt = parseInt($("#total_amount").val()); 
		var del_fee = parseInt($("#del_fees").val());
		var get_ttl_amnt = ttl_amnt + del_fee;
		
		document.getElementById("del_option").textContent=del_fee;
		document.getElementById("display_ttl_amnt").textContent=get_ttl_amnt;
	
		//this is to indicate deliver is selected or Active
		$("#bttn_deliver").addClass("btn-primary");
		$("#bttn_deliver").removeClass("btn-outline-primary");
		
		//Pick-Up will be de-Active
		$("#bttn_pickup").removeClass("btn-success");
		$("#bttn_pickup").addClass("btn-outline-success");
	});/*btn-outline-success btn-success*/
	
	
	
});
</script>
<script>
function Refresh_orderlist(){
		$( "#reload_counter_orderlist" ).load( "page_customer_orderlist.php #reload_counter_orderlist" );
		$( "#reload_counter_orderdetails" ).load( "page_customer_orderlist.php #reload_counter_orderdetails" );
		$( "#cart_reload" ).load( "template/topbar_menu.php #cart_reload" );
	}
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
			<?php include_once 'template/sidebar_menu_customer.php';?>
			    
			<!-- [INCLUDE - TOPBAR MENU] -->
			<?php include_once 'template/topbar_menu.php';?>
			
			<div class="content-page">
				<div class="container-fluid">
					<div class="row">                  
						<div class="col-lg-12">
							<div class="card card-block card-stretch card-height print rounded bottom-left shadow-showcase">
								<div class="card-header d-flex justify-content-between header-invoice" style="background-color: #DC143C !important;border-top-left-radius: 10px;border-top-right-radius: 10px;">
									<div class="iq-header-title">
									   <h4 class="card-title mb-0">Order List</h4>
									</div>
									<div class="invoice-btn">
									 
									</div>
								</div>
								<div class="card-body" >
									<div class="row">
										
										<div class="col-sm-12">
											<b class="text-danger"><i class="ri-bookmark-fill"></i><small>Order Summary</small></b>
											<div class="table-responsive-sm bottom-left shadow-showcase mt-2" style="border-radius: 10px !important;">
												<table class="table" id="reload_counter_orderlist">
													<thead class="text-uppercase" style="background-color: #DC143C;color: #FFF;">
														<tr>
															<th scope="col" style="width: 2%;">#</th>
															<th scope="col">Item</th>
															<th class="text-center" scope="col">Quantity</th>
															<th class="text-center" scope="col">Price</th>
															<th class="text-center" scope="col">Totals</th>
														</tr>
													</thead>
													<?php 
														$tablename	= TABLE_PREFIX.'cart';
														
														$get_vendor_list = $DB_Helper->get_sql_results("SELECT A.*, B.`food_name`, B.`price`, 
																		CONCAT(C.firstname ,' ', C.mi,'. ', ' ', C.lastname) AS vendor_name
																		FROM $tablename AS A
																		INNER JOIN tbl_foodlist AS B ON (A.food_id = B.id)
																		INNER JOIN tbl_vendor AS C ON (B.vendor_id = C.id)
																		WHERE A.cust_ID='$admin_id' AND A.order_status='0'");	
														if($get_vendor_list){
															foreach($get_vendor_list as $row){
																$vendor_name 	 = $row->vendor_name;
																$food_name 	 	 = $row->food_name;
																$date_order 	 = $row->date_order;
																$food_id 	 	 = $row->food_id;
																$order_status 	 = $row->order_status;
																$qty 	 	  	 = $row->qty;
																$total_price 	 = $row->total_price;
																$price 	 		 = $row->price;
																$id 	 		 = $row->id;
																
																
													?>
													<tbody>
														<tr>
															<th class="text-center" scope="col">
																<a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
																onclick="delete_order_cart(<?= $id;?>)" href="#"><i class="ri-delete-bin-line mr-0"></i>
																</a>
															</th>
															<td>
															   <h6 class="mb-0"><?= $food_name;?></h6>
															   <p class="mb-0"><small><?= $vendor_name;?> - <mark>Vendor</mark></small></p>
															</td>
															<td class="text-center"><?= $qty;?></td>
															<td class="text-center"><?= "&#8369;".number_format( $price, 2 );?></td>
															<td class="text-center"><b><?= "&#8369;".number_format( $total_price, 2 );?></b></td>
														</tr>
													</tbody>
													<?php }}?>
												</table>
											</div>
										</div>                              
									</div>
									<div class="row">
										<div class='col-sm-12'>
											<form id="frm_orderlist" name="frm_orderlist" method="post" class="form-horizontal" enctype="multipart/form-data">
												<?php 
												if(isset($_POST['bttn_placeorder'])){
													
													if($_POST['pay_method'] == ""){
														echo "
															<div class='col-md-12'>
																<div class='alert text-white bg-warning' role='alert col-md-12'>
																	<div class='iq-alert-icon'>
																		<i class='ri-error-warning-line' style='font-size:24px;color: red;></i>
																	</div>
																<div class='iq-alert-text'>" . $messages['fg']['Payment_method_err'] . "</div>
																	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
																		<i class='ri-close-line'></i>
																	</button>
																</div>
															</div>
															";
														
													}else{
														$result					='false';
														$tablename_cart			= TABLE_PREFIX.'cart';
														$tablename_orderlist	= TABLE_PREFIX.'orderlist';
														
														$data = random_int(1000, 9999);
														$track_invoice = $admin_id.'-'.$data.'-'.date("md");
									

														$sql = "SELECT * FROM $tablename_cart WHERE cust_ID=$admin_id AND order_status=0";
														$result = mysqli_query($DB_Helper->db_con,$sql) or die(mysqli_error($DB_Helper->db_con));
														
														
														// echo $sql;
														// exit;	
													
														if (mysqli_num_rows($result) > 0) {
															while($row = mysqli_fetch_array($result)){
																$food_id = $row['food_id'];
																/*
																vendor_status = 0(Pending),1(Accept),2(Canceled)
																food_status	  = 0(pending), 1(preparing), 2(ready for pick-up), 3(ready for deliver), 4(canceled)
																pay_method	  = 1(over the counter),2(cash on delivery)
																*/
																
																$cart_id 							= $row['id'];
																$vendor_status 						= 0;
																$food_status						= 0;
																$food_id							= $row['food_id'];
																$track_no							= $track_invoice;
																$pay_method							= $_POST['pay_method'];;
																$date_order							= date("m/d/Y h:i:s A");
																
																$sql_insert = "INSERT INTO $tablename_orderlist (cart_id,vendor_status,food_id,food_status,track_no,pay_method,date_order)
																VALUES($cart_id,'$vendor_status','$food_id','$food_status','$track_no','$pay_method','$date_order')";
																// echo $sql_insert;
																// exit;
																
																$insert_result = mysqli_query($DB_Helper->db_con,$sql_insert) or die(mysqli_error($DB_Helper->db_con));
																$id = mysqli_insert_id($DB_Helper->db_con);
																
																$update_sql = "UPDATE $tablename_cart SET order_status='1' WHERE cust_ID=$admin_id AND food_id=$food_id";
																mysqli_query($DB_Helper->db_con,$update_sql) or die(mysqli_error($DB_Helper->db_con));
																
															}
														}
														if($id > 0){
															
															echo "
																
																
																<div class='col-md-12'> 
																	<div class='alert text-white bg-success' role='alert'>
																		<div class='iq-alert-icon'>
																			<i class='ri-check-line' style='font-size:24px;color: green;'></i>
																		</div>
																	<div class='iq-alert-text'>" . $messages['fg']['Payment_Success'] . "</div>
																		<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
																			<i class='ri-close-line'></i>
																		</button>
																	</div>
																</div>
																
																
																";	
															header("Location: page_customer_trackorder.php?msg=suc&trackno=0", true, 301);
															exit();
															
														}else{
															echo "
															<div class='col-md-12'>
																<div class='alert text-white bg-warning' role='alert col-md-12'>
																	<div class='iq-alert-icon'>
																		<i class='ri-error-warning-line' style='font-size:24px;color: red;></i>
																	</div>
																<div class='iq-alert-text'>" . $messages['fg']['Payment_err'] . "</div>
																	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
																		<i class='ri-close-line'></i>
																	</button>
																</div>
															</div>
															";
														}
													
													}
													
												}
												?>
										</div>
									</div>
											<div class="row mt-4 mb-3 ">
												<div class="offset-lg-8 col-lg-4 d-flex justify-content-between">
													<div class="or-detail rounded bottom-left shadow-showcase">
														<div class="p-3">
															<div class="mb-2"><h5>Payment Method :</h5>
															<input type="hidden" id="pay_method" name="pay_method"></div>
															<button id="bttn_pickup" name="bttn_pickup" type="button" class="btn btn-outline-success mr-2 mb-2"><i class='fa fa-download'></i>Over The Counter</button>
															<button id="bttn_deliver" name="bttn_deliver" type="button" class="btn btn-outline-primary mr-2 mb-2"><i class='fa fa-truck-pickup'></i>Cash-On Delivery</button>
														</div>
													</div>
												</div>
											</div>
											<div class="row mt-4 mb-3">
												<div class="offset-lg-8 col-lg-4">
													<div class="or-detail rounded bottom-left shadow-showcase" id="reload_counter_orderdetails">
														<?php 
															$get_sub_total 	= $DB_Helper->get_row(" SELECT SUM(total_price) AS sub_total FROM tbl_cart WHERE cust_ID = '$admin_id'  AND order_status='0'");
															$sub_total		= $get_sub_total->sub_total;
														?>
														<div class="p-3">
															<h5 class="mb-3">Order Details</h5>
															<div class="mb-2">
																<h6>Total Quantity</h6>
																<p><b><mark><?php if($total_qty != null){ echo $total_qty; }else{ echo '0';} ?></mark></b></p>
															</div>
															<div class="mb-2">
																<h6>Total Item's</h6>
																<p><b><mark><?= $total_order;?></mark></b></p>
															</div>
															<div class="mb-2">
																<h6>Sub Total</h6>
																<p><b><mark><?= "&#8369;".number_format( $sub_total, 2 );?></mark></b></p>
															</div>
															<div class="mb-2">
																<h6>Delivery Fee </h6>
																<p><b><mark><span id="del_option">0</span></mark></b></p>
															</div>
														</div>
														
														<div class="ttl-amt py-2 px-3 d-flex justify-content-between align-items-center">
															<h6>Total</h6>
																<input type="hidden" id="del_fees" name="del_fees" value="<?= $del_fee;?>">
																<input type="hidden" id="total_amount" name="total_amount" value="<?php if($sub_total != null){ echo $sub_total; }else{ echo '0';} ?>">
																<input type="hidden" id="id_indicator" name="id_indicator" value="0">
															<h3 class="text-primary font-weight-700">&#8369; <span id="display_ttl_amnt"></span>.<em>00</em></h3>
														</div>
													</div>
												</div>
											</div> 
											
											<div class="row mt-4 mb-3">
												<div class="offset-lg-8 col-lg-4 ">
												<?php if($sub_total != null){?>
													<button id="bttn_placeorder" name="bttn_placeorder" type="submit" class="btn btn-danger mr-2"><i class='fa fa-cart-arrow-down'></i>Place to Order</button>
												<?php }else{?>
													<button disabled id="bttn_placeorder" name="bttn_placeorder" type="submit" class="btn btn-danger mr-2"><i class='fa fa-cart-arrow-down'></i>Place to Order</button>
												<?php }?>
												</div>
											</div>
										</form>
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
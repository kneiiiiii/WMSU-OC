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
					
						<div class="col-sm-12">
							<div class="card shadow-bottom shadow-showcase">
								<div class="card-header d-flex justify-content-between"  style="color: #FFF; background-color: #DC143C !important;border-top-left-radius: 10px;border-top-right-radius: 10px;">
									<div class="header-title">
										<h4 class="card-title">Delivery Order</h4>
									</div>
									<h3><i class="ri-settings-5-fill"></i></h3>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-sm-12">
											<div class="table-responsive-sm bottom-left shadow-showcase" style="border-radius: 10px !important;">
												<table class="table" id="reload_counter_orderlist">
													<thead  class="text-uppercase" style="background-color: #DC143C;color: #FFF;">
														<tr>
															<th class="text-center" scope="col">Customer Order #</th>
															<th class="text-center" scope="col" style="width: 46%;">Details</th>
														</tr>
													</thead>
													
														
													<tbody>
														<?php 
															$tablename	= TABLE_PREFIX.'delivery';
															$sql = "
																SELECT A.* , B.*, C.`food_name` , CONCAT(E.firstname ,' ', E.mi,'.', ' ', E.lastname) AS customer_name,A.track_no, C.price
																FROM $tablename AS A
																INNER JOIN tbl_cart AS B ON (A.cart_id = B.id)
																INNER JOIN tbl_foodlist AS C ON (B.food_id = C.id)
																INNER JOIN tbl_vendor AS D ON (C.vendor_id = D.id)
																INNER JOIN tbl_customer AS E ON (B.cust_ID = E.id)
																WHERE A.`food_status`='2' AND A.`del_status`='0' AND A.pay_method='2'
																GROUP BY A.track_no;
																";
																	
															$get_order_list = $DB_Helper->get_sql_results($sql);	
															$result = mysqli_query($DB_Helper->db_con,$sql) or die(mysqli_error($DB_Helper->db_con));
																	
															if(mysqli_num_rows($result) > 0){
																		
																if($get_order_list){
																	foreach($get_order_list as $row){
																		
																	
																		$track_no 		 = $row->track_no;
																		$food_status 	 = $row->food_status;
																	
														?>
															<tr>
																<td class="text-center">
																	<h6 class="mb-0"><?= $track_no;?></h6>
																</td>
																<td class="text-center">
																	 <p><a href="page_errand_orderlist_view.php?track_no=<?= $track_no;?>" class="text-bg-info">VIEW</a></p>
																</td>
															</tr>
														<?php 	
																	
																	}
																} 
															
															}else{
																echo "<tr><td class='text-center text-danger mt-1' colspan='2'><em>No Record Found!</em></td></tr>";
															}
														?>		
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
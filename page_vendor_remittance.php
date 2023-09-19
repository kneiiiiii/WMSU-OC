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

		
		function recieved_money(trackno,vendor_id){
		
		let confirmAction = confirm("Do you want to continue?");
		if (confirmAction) {
			var action = 7 ;
			
				$.ajax({
					url:'component/mod_up.php',
					type:'post',
					data:{
						ope:action,
						trackno:trackno,
						vendor_id:vendor_id
					},
					success:function(data,status){
						if(data == 'true'){
							//alert(data);
							alert("Successfully Received Money!.");
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
										<h4 class="card-title">Remittance</h4>
									</div>
									<h3><i class="ri-settings-5-fill"></i></h3>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-sm-12 col-lg-12 col-md-12">
											<div class="table-responsive rounded mb-3">
												<table class="data-tables table mb-0 tbl-server-info table-hover shadow-bottom shadow-showcase" id="vendor_table">
													<thead class="bg-white text-uppercase">
														<tr class="ligth ligth-data">
															<th  class="text-left">Track # / Invoice</th>
															<th  class="text-center">Total Payment</th>
															<th  class="text-center">Errand Name</th>
															<th  class="text-center">Status</th>
															<th  class="text-center">Action</th>
														</tr>
													</thead>
													<tbody class="ligth-body">
														<?php 
															$tablename	= TABLE_PREFIX.'vendor';
															if($vendor_id == 0){
																$v_id = $admin_id;
															}elseif($vendor_id == $vendor_id){
																$v_id = $vendor_id;
															}
															$sql = "SELECT A.* , B.*, C.pay_method, C.`errand_id`, CONCAT(D.firstname ,' ', D.mi,'. ', ' ', D.lastname) AS v_name,
																	(SELECT SUM(B.`total_price`) 
																	FROM tbl_errand_delivery_info AS E
																	INNER JOIN tbl_cart AS F ON (A.`cart_id` = B.`id`)
																	GROUP BY A.`track_no`
																	) AS tots_price
																FROM tbl_errand_delivery_info AS A
																INNER JOIN tbl_cart AS B ON (A.`cart_id` = B.`id`)
																INNER JOIN  tbl_delivery AS C ON (A.`cart_id` = C.`cart_id`)
																INNER JOIN tbl_errand AS D ON (C.`errand_id` = D.`id`)
																WHERE A.`vendor_id`='$v_id' 
																GROUP BY A.`track_no`";
															//echo $sql;
															$get_vendor_list = $DB_Helper->get_sql_results($sql);	
															if($get_vendor_list){
																foreach($get_vendor_list as $row){
																	$track_no 			 = $row->track_no;
																	$tots_price 	 	 = $row->tots_price;
																	$v_name		 	 	 = $row->v_name;
																	$time_remit	 	 	 = $row->time_remit;
																	$remit_status 	 	 = $row->remit_status;
																	
														?>
														<tr>
															<td class="text-center">
																<div class="d-flex align-items-center text-center">
																	<div><b><?= $track_no; ?></b></div>
																</div>
															</td>
															<td  class="text-center"><?= "&#8369;".number_format( $tots_price, 2 );?></td>
															<td  class="text-center"><?= $v_name; ?></td>
															<td  class="text-center">
															<?php 
																if($remit_status == 1){
																	$time_remit_msg = "Done Remit";
																	$time_remit_color = "primary";
																	
																}elseif($remit_status == 2){
																	$time_remit_msg = "Done Transaction";
																	$time_remit_color = "success";
																	
																}else{
																	$time_remit_msg = "Pending";
																	$time_remit_color = "danger";
																}
															?>
																<span class="pt-1 badge badge-pill badge-<?= $time_remit_color;?>"><?= $time_remit_msg;?></span>
															</td>
															<td  class="text-center">
																<button onclick="recieved_money(<?= "'".$track_no."'";?>,<?= $v_id;?>)" 
																	id="bttn_confirm_pass" 
																	name="bttn_confirm_pass" 
																	type="button" 
																	class="btn btn-danger btn-sm mr-2" <?php if($remit_status == 0 || $remit_status == 2){ echo "disabled"; }else{ echo ""; } ?>>
																	
																	<b>Recieved Money</b> <i class="ri-hand-coin-fill"></i>
																</button>
															</td>
														</tr>
														<?php }}?>
														
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
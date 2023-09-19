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

if($self == 'page_errand' || 'page_errand_remittance'){
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

	
	
	function remit_money(trackno,tots_price,errand_id,cust_ID){
		
		let confirmAction = confirm("Do you want to continue?");
		if (confirmAction) {
			var action = 6 ;
			
				$.ajax({
					url:'component/mod_up.php',
					type:'post',
					data:{
						ope:action,
						trackno:trackno,
						tots_price:tots_price,
						errand_id:errand_id,
						cust_ID:cust_ID
					},
					success:function(data,status){
						if(data == 'true'){
							//alert(data);
							alert("Successfully Remit Money!.");
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
															<th  class="text-center">Vendor Name</th>
															<th  class="text-center">Status</th>
															<th  class="text-center">Action</th>
														</tr>
													</thead>
													<tbody class="ligth-body">
														<?php 
															$tablename	= TABLE_PREFIX.'vendor';
															
															$get_vendor_list = $DB_Helper->get_sql_results("
																SELECT A.* , B.*, C.pay_method, C.`errand_id`, CONCAT(D.firstname ,' ', D.mi,'. ', ' ', D.lastname) AS v_name,
																	(SELECT SUM(B.`total_price`) 
																	FROM tbl_errand_delivery_info AS E
																	INNER JOIN tbl_cart AS F ON (A.`cart_id` = B.`id`)
																	GROUP BY A.`track_no`
																	) AS tots_price
																FROM tbl_errand_delivery_info AS A
																INNER JOIN tbl_cart AS B ON (A.`cart_id` = B.`id`)
																INNER JOIN  tbl_delivery AS C ON (A.`cart_id` = C.`cart_id`)
																INNER JOIN tbl_vendor AS D ON (C.`vendor_id` = D.`id`)
																WHERE C.`errand_id`='$admin_id' 
																GROUP BY A.`track_no`
															");	
															if($get_vendor_list){
																foreach($get_vendor_list as $row){
																	$track_no 			 = $row->track_no;
																	$tots_price 	 	 = $row->tots_price;
																	$v_name		 	 	 = $row->v_name;
																	$time_remit	 	 	 = $row->time_remit;
																	$remit_status 	 	 = $row->remit_status;
																	$cust_ID 	 	 	 = $row->cust_ID;
																	
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
																<button onclick="remit_money(<?= "'".$track_no."'";?>,<?= $tots_price; ?>,<?= $admin_id;?>,<?= $cust_ID;?>)" 
																	id="bttn_confirm_pass" 
																	name="bttn_confirm_pass" 
																	type="button" 
																	class="btn btn-success btn-sm mr-2" <?php if($remit_status == 1 || $remit_status == 2){ echo "disabled"; }else{ echo ""; } ?>>
																	
																	<b>Remit Money</b> <i class="ri-hand-coin-fill"></i>
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
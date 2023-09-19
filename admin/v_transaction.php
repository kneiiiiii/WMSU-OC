<!-- [INCLUDE - TOP] -->
<?php 
include_once 'template/top.php';

if(isset($_SESSION[WEB_NAME]['login_id'])){
	$admin_id 		 = $_SESSION[WEB_NAME]['login_id'];
	$admin_name 	 = $_SESSION[WEB_NAME]['login_name'];
	$admin_email_add = $_SESSION[WEB_NAME]['email_add'];
}else{
	header("Location:login_form.php");
	exit();
}
?>
<script type="text/javascript" language="javascript" >
	$(document).ready(function(){
		
		$("#search_keyword").keyup(function(){
			var input = $(this).val();
			var v_id = "<?php echo $_GET['v_id'];?>";
			
			//alert(sam);
			
			if(input != ""){
				$.ajax({
					
					url:"ajax_v_transaction.php",
					method:"POST",
					data:{input:input,v_id:v_id},
					
					success:function(data){
						$("#display_data").html(data);
						$("#display_data").css("display","block");
					}
				});
			}else{
				$.post("ajax_get_vlist.php",{input:input,v_id:v_id},function(data){
					$("#display_data").html(data);
					$("#display_data").css("display","block");
				});
				
				
				//$( "#display_data" ).load( "v_transaction.php #display_data" );
				//alert("asdf");
				//$("#display_data").load("v_transaction.php");
				
				//$("#display_data").load(location.href + " #display_data");
			}
		});
	});
</script>
<style></style>
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
					
						<div class="col-lg-12">
							<div class="card shadow-bottom shadow-showcase">
								<div class="card-header d-flex justify-content-between" style="color: #FFF; background-color: #DC143C !important;border-top-left-radius: 10px;border-top-right-radius: 10px;">
									<div class="header-title">
										<h4 class="card-title">Vendor's Transaction</h4>
									</div>
									<h3><i class="ri-settings-5-fill"></i></h3>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-sm-3 col-lg-3 col-md-3">
											<div class="card shadow-bottom shadow-showcase">
												<div class="card-header d-flex justify-content-between" style="color: #FFF; background-color: #DC143C !important;border-top-left-radius: 10px;border-top-right-radius: 10px;">
													<div class="header-title">
														<h4 class="card-title">Vendor's List</h4>
													</div>
													<h3><i class="ri-settings-5-fill"></i></h3>
												</div>
												<div class="card-body">
													<div class="row">
														<div class="col-sm-12 col-lg-12 col-md-12">
															<input autocomplete="off" type="search" class="form-control input-group-text mb-2" id="search_keyword" placeholder="Type Name Here . . ."
																aria-controls="user-list-table">
														</div>
														<div class="col-sm-12 col-lg-12 col-md-12" id="display_data">
															<div class="list-group">
																<?php 
																	$tablename	= TABLE_PREFIX.'delivery';
																	$sql = "
																			SELECT A.*, CONCAT(B.firstname ,' ', B.mi,'. ', ' ', B.lastname) AS v_name
																			FROM tbl_remittance AS A
																			INNER JOIN tbl_vendor AS B ON (A.`vendor_id` = B.`id`)
																			GROUP BY B.id
																			ORDER BY A.`id` DESC
																			";
																	$result = mysqli_query($DB_Helper->db_con,$sql) or die(mysqli_error($DB_Helper->db_con));
																		
																		if(mysqli_num_rows($result) > 0){
																			
																			$get_order_list = $DB_Helper->get_sql_results($sql);	
																			
																			if($get_order_list){
																				foreach($get_order_list as $row){
																					$v_name 			 = $row->v_name;
																					$vendor_id 	 		 = $row->vendor_id;
																					
																			
																?>
																<a href="v_transaction.php?v_id=<?= $vendor_id;?>" class="list-group-item list-group-item-action
																	<?php if($_GET['v_id'] == $vendor_id){echo 'active';}else{echo'';}?>">
																	<div class="d-flex w-100 justify-content-between">
																		<h6 class="mb-1"><i class='fas fa-arrow-circle-right' style='font-size:20px;color: crimson;'></i> &nbsp;&nbsp; <?= $v_name; ?></h6>
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
										<div class="col-sm-9 col-lg-9 col-md-9">
											<div class="row">
												<?php 
													if($_GET['v_id'] != 0){
												?>
												<div class="col-lg-12">
													<ul class="nav nav-tabs" id="myTab-1" role="tablist">
														<li class="nav-item">
															<a class="nav-link active" id="delivery-tab" data-toggle="tab" href="#delivery" role="tab" aria-controls="delivery" aria-selected="true">DELIVERY</a>
														</li>
														<li class="nav-item">
															<a class="nav-link" id="pickup-tab" data-toggle="tab" href="#pickup" role="tab" aria-controls="pickup" aria-selected="false">PICK - UP</a>
														</li>
													</ul>
													<div class="tab-content" id="myTabContent-2">
														<div class="tab-pane fade show active" id="delivery" role="tabpanel" aria-labelledby="delivery-tab">
														   
															<div class="table-responsive-sm bottom-left shadow-showcase" style="border-radius: 10px !important;">
																<table class="table" id="reload_counter_orderlist">
																	<thead  class="text-uppercase" style="background-color: #DC143C;color: #FFF;">
																		<tr>
																			<th class="text-center" scope="col">Customer Names</th>
																			<th class="text-center" scope="col">Errand Names</th>
																			<th class="text-center" scope="col">Date Remit</th>
																			<th class="text-left" scope="col">Track # / Invoice</th>
																			<th class="text-center" scope="col">Total Payment</th>
																		</tr>
																	</thead>
																	<tbody>
																
																		<?php  
																		$v_id = $_GET['v_id'];
																		$tablename	= TABLE_PREFIX.'remittance';
																															
																		$query = "SELECT A.* , CONCAT(B.firstname ,' ', B.mi,'. ', ' ', B.lastname) AS v_name, 
																					CONCAT(F.firstname ,' ', F.mi,'. ', ' ', F.lastname) AS c_name, 
																					CONCAT(C.firstname ,' ', C.mi,'. ', ' ', C.lastname) AS e_name,
																					(SELECT COUNT(id) 
																					FROM tbl_remittance WHERE vendor_id = '$v_id' AND pay_method ='2') AS total_data,
																					(SELECT SUM(total_amt) 
																					FROM tbl_remittance AS D
																					INNER JOIN tbl_errand AS E ON (D.`errand_id` = E.`id`) WHERE vendor_id = '$v_id' AND pay_method ='2') AS tots_price,
																					(SELECT COUNT(id) 
																					FROM tbl_remittance WHERE vendor_id = '$v_id' AND pay_method ='2') AS tots_record
																					FROM tbl_remittance AS A
																					INNER JOIN tbl_vendor AS B ON (A.`vendor_id` = B.`id`)
																					INNER JOIN tbl_errand AS C ON (A.`errand_id` = C.`id`)
																					INNER JOIN tbl_customer AS F ON (A.cust_ID = F.id)
																					WHERE A.`vendor_id` = '$v_id'
																					ORDER BY A.`id` DESC LIMIT 10";
																		//echo $query;
																		$result = mysqli_query($DB_Helper->db_con,$query) or die(mysqli_error($DB_Helper->db_con));
																		
																		if(mysqli_num_rows($result) > 0 ){
																		while($row = mysqli_fetch_assoc($result)){
																				$track_no 			 = $row['track_no'];
																				$total_amt 	 	 	 = $row['total_amt'];
																				$e_name		 	 	 = $row['e_name'];
																				$date_remit	 	 	 = $row['date_remit'];
																				$remit_status 	 	 = $row['remit_status'];
																				$tots_price 	 	 = $row['tots_price'];
																				$total_data 	 	 = $row['total_data'];
																				$tots_record 	 	 = $row['tots_record'];
																				$c_name 	 		 = $row['c_name'];
																				
																		?>
																				<tr>
																					<td class="text-center">
																						<h6 class="mb-0"><i class="ri-user-2-fill"></i> &nbsp; <?= $c_name;?></h6>
																					</td>
																					<td class="text-center">
																						<h6 class="mb-0"><i class="ri-numbers-fill"></i> &nbsp; <?= $e_name; ?></h6>
																					</td>
																					<td class="text-center">
																						<h6 class="mb-0"><?php echo  date_format(date_create($date_remit), "m/d/Y"); ?></h6>
																					</td>
																					<td>
																						<h6 class="mb-0"><?= $track_no;?></h6>
																					</td>
																					<td class="text-center">
																						<h6 class="mb-0"><?= "&#8369;".number_format( $total_amt, 2 );?></h6>
																					</td>
																				</tr>
																	<?php   } ?>
																	<tr  style="background-color: antiquewhite;">
																		<td class="text-right" colspan="4">
																			<h6 class="mb-0"><strong>TOTAL SALES <strong></h6>
																		</td>
																		<td class="text-center">
																			<h4 class="mb-0 text-danger font-weight-500"><strong><?= "&#8369;".number_format( $tots_price, 2 );?><stron></h4>
																		</td>
																	</tr>
																	<tr>
																		<td class="text-right" colspan="5">
																			<h6 class="mb-0 text-primary font-weight-700">Total Record : <?= $tots_record;?>  of <?= $tots_record;?></h6>
																		</td>
																	</tr>
																	
																	<?php } ?>
																	</tbody>
																</table>
															</div>
														   
														   
														</div>
														<div class="tab-pane fade" id="pickup" role="tabpanel" aria-labelledby="pickup-tab">
														   
														   
															<div id="display_data" class="table-responsive-sm bottom-left shadow-showcase" style="border-radius: 10px !important;">
												
																<table class="table" id="reload_counter_orderlist">
																	<thead  class="text-uppercase" style="background-color: #DC143C;color: #FFF;">
																		<tr>
																			<th class="text-center" scope="col">Customer Names</th>
																			<th class="text-center" scope="col">Date Completed</th>
																			<th class="text-left" scope="col">Track # / Invoice</th>
																			<th class="text-center" scope="col">Total Payment</th>
																		</tr>
																	</thead>
																	<tbody>
																
																		<?php  
																		$tablename	= TABLE_PREFIX.'remittance';
																		$v_id = $_GET['v_id'];
																		
																		$query = "
																					SELECT A.* , CONCAT(B.firstname ,' ', B.mi,'. ', ' ', B.lastname) AS v_name, 
																					CONCAT(F.firstname ,' ', F.mi,'. ', ' ', F.lastname) AS c_name, 
																					(SELECT COUNT(id) 
																					FROM tbl_remittance WHERE vendor_id = '$v_id' AND pay_method ='1') AS total_data,
																					(SELECT SUM(total_amt) FROM tbl_remittance WHERE vendor_id = '$v_id'  AND pay_method ='1') AS tots_price, 
																					(SELECT COUNT(id) 
																					FROM tbl_remittance WHERE vendor_id = '$v_id' AND pay_method ='1') AS tots_record
																					FROM tbl_remittance AS A
																					INNER JOIN tbl_vendor AS B ON (A.`vendor_id` = B.`id`)
																					INNER JOIN tbl_customer AS F ON (A.cust_ID = F.id)
																					WHERE A.`vendor_id` = '$v_id' AND A.pay_method ='1'
																					ORDER BY A.`id` DESC LIMIT 10";
																		//echo $query;
																		$result = mysqli_query($DB_Helper->db_con,$query) or die(mysqli_error($DB_Helper->db_con));
																		
																		if(mysqli_num_rows($result) > 0 ){
																		while($row = mysqli_fetch_assoc($result)){
																				$track_no 			 = $row['track_no'];
																				$total_amt 	 	 	 = $row['total_amt'];
																				$date_remit	 	 	 = $row['date_remit'];
																				$remit_status 	 	 = $row['remit_status'];
																				$tots_price 	 	 = $row['tots_price'];
																				$total_data 	 	 = $row['total_data'];
																				$tots_record 	 	 = $row['tots_record'];
																				
																		?>
																				<tr>
																					<td class="text-center">
																						<h6 class="mb-0"><i class="ri-user-2-fill"></i> &nbsp; <?= $c_name;?></h6>
																					</td>
																					<td class="text-center">
																						<h6 class="mb-0"><?php echo  date_format(date_create($date_remit), "m/d/Y"); ?></h6>
																					</td>
																					<td>
																						<h6 class="mb-0"><?= $track_no;?></h6>
																					</td>
																					<td class="text-center">
																						<h6 class="mb-0"><?= "&#8369;".number_format( $total_amt, 2 );?></h6>
																					</td>
																				</tr>
																	<?php   } ?>
																	<tr  style="background-color: antiquewhite;">
																		<td class="text-right" colspan="3">
																			<h6 class="mb-0"><strong>TOTAL SALES <strong></h6>
																		</td>
																		<td class="text-center">
																			<h4 class="mb-0 text-danger font-weight-500"><strong><?= "&#8369;".number_format( $tots_price, 2 );?><stron></h4>
																		</td>
																	</tr>
																	<tr>
																		<td class="text-right" colspan="4">
																			<h6 class="mb-0 text-primary font-weight-700">Total Record : <?= $tots_record;?>  of <?= $tots_record;?></h6>
																		</td>
																	</tr>
																	
																	<?php } ?>
																	</tbody>
																</table>
															</div>
														   
														</div>
													</div>
												</div>
												<?php }?>
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
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
			var e_id = "<?php echo $_GET['e_id'];?>";
			
			//alert(sam);
			
			if(input != ""){
				$.ajax({
					
					url:"ajax_e_transaction.php",
					method:"POST",
					data:{input:input,e_id:e_id},
					
					success:function(data){
						$("#display_data").html(data);
						$("#display_data").css("display","block");
					}
				});
			}else{
				$.post("ajax_get_elist.php",{input:input,e_id:e_id},function(data){
					$("#display_data").html(data);
					$("#display_data").css("display","block");
				});
				
			}
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
																			SELECT A.*, CONCAT(B.firstname ,' ', B.mi,'. ', ' ', B.lastname) AS e_name
																			FROM tbl_remittance AS A
																			INNER JOIN tbl_errand AS B ON (A.`errand_id` = B.`id`)
																			GROUP BY B.id
																			ORDER BY A.`id` DESC
																			";
																	$result = mysqli_query($DB_Helper->db_con,$sql) or die(mysqli_error($DB_Helper->db_con));
																		
																		if(mysqli_num_rows($result) > 0){
																			
																			$get_order_list = $DB_Helper->get_sql_results($sql);	
																			
																			if($get_order_list){
																				foreach($get_order_list as $row){
																					$e_name 			 = $row->e_name;
																					$errand_id 	 		 = $row->errand_id;
																					
																			
																?>
																<a href="e_transaction.php?e_id=<?= $errand_id;?>" class="list-group-item list-group-item-action
																	<?php if($_GET['e_id'] == $errand_id){echo 'active';}else{echo'';}?>">
																	<div class="d-flex w-100 justify-content-between">
																		<h6 class="mb-1"><i class='fas fa-arrow-circle-right' style='font-size:20px;color: crimson;'></i> &nbsp;&nbsp; <?= $e_name; ?></h6>
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
													if($_GET['e_id'] != 0){
												?>
												<div class="col-lg-12">
													<div class="table-responsive-sm bottom-left shadow-showcase" style="border-radius: 10px !important;">
														<table class="table" id="reload_counter_orderlist">
															<thead  class="text-uppercase" style="background-color: #DC143C;color: #FFF;">
																<tr>
																	<th class="text-center" scope="col">Customer Names</th>
																	<th class="text-center" scope="col">Vendor's Names</th>
																	<th class="text-center" scope="col">Date Remit</th>
																	<th class="text-left" scope="col">Track # / Invoice</th>
																	<th class="text-center" scope="col">Total Payment</th>
																</tr>
															</thead>
															<tbody>
														
																<?php  
																$e_id = $_GET['e_id'];
																
																$get_delfee 	= $DB_Helper->get_row("SELECT * FROM tbl_errand WHERE id='$e_id'");
																$del_fee	= $get_delfee->del_fee;
																
																$tablename	= TABLE_PREFIX.'remittance';
																													
																$query = "
																			SELECT A.* , 
																			CONCAT(B.firstname ,' ', B.mi,'. ', ' ', B.lastname) AS v_name,
																			CONCAT(C.firstname ,' ', C.mi,'. ', ' ', C.lastname) AS e_name,
																			CONCAT(D.firstname ,' ', D.mi,'. ', ' ', D.lastname) AS c_name,
																			(SELECT COUNT(id) 
																			FROM tbl_remittance WHERE errand_id = '$e_id') AS total_data,
																			(SELECT SUM(total_amt) 
																			FROM tbl_remittance AS E
																			INNER JOIN tbl_errand AS F ON (E.`errand_id` = F.`id`) WHERE errand_id = '$e_id') AS tots_price,
																			(SELECT COUNT(id) 
																			FROM tbl_remittance WHERE errand_id = '$e_id') AS tots_record
																			FROM tbl_remittance AS A
																			INNER JOIN tbl_vendor AS B ON (A.`vendor_id` = B.`id`)
																			INNER JOIN tbl_errand AS C ON (A.`errand_id` = C.`id`)
																			INNER JOIN tbl_customer AS D ON (A.`cust_ID` = D.`id`)
																			WHERE errand_id = '$e_id'
																			ORDER BY A.`id` DESC LIMIT 10";
																
																$result = mysqli_query($DB_Helper->db_con,$query) or die(mysqli_error($DB_Helper->db_con));
																
																if(mysqli_num_rows($result) > 0 ){
																while($row = mysqli_fetch_assoc($result)){
																		$track_no 			 = $row['track_no'];
																		$total_amt 	 	 	 = $row['total_amt'];
																		$v_name		 	 	 = $row['v_name'];
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
																				<h6 class="mb-0"><i class="ri-numbers-fill"></i> &nbsp; <?= $v_name; ?></h6>
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
																	<h4 class="mb-0 text-danger font-weight-500"><strong><?= "&#8369;".number_format( $tots_record * $del_fee, 2 )  ;?><stron></h4>
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
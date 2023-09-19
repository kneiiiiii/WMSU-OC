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
<script type="text/javascript" language="javascript" >
	$(document).ready(function(){
		
		
		var dataTable = $('#order_data').DataTable({
			"processing" : true,
			"serverSide" : true,
			"order" : [],
			"ajax" : {
				url:"fetch.php",
				type:"POST"
			},
			drawCallback:function(settings)
			{
				$('#total_order').html(settings.json.total);
			}
		});

		
		$("#search_keyword").keyup(function(){
			var input = $(this).val();
			var select_val = $("#selectsearch").val();
			var v_id =  <?php echo $vendor_id; ?>
			
			//alert(v_id);
			//alert(select_val);
			//alert(input);
			
			if(select_val == "Choose..."){
				alert("Please Choose at Select section..");
			}else{
				
				if(input != ""){
					$.ajax({
						
						url:"ajax_vendor_sales.php",
						method:"POST",
						data:{input:input,select_val:select_val,v_id:v_id},
						
						success:function(data){
							$("#display_data").html(data);
							$("#display_data").css("display","block");
						}
					});
				}else{
					// $("#display_data").css("display","none");
					// $("#display_data").html();
					$( "#display_data" ).load( "page_vendor_sales.php #display_data" );
				}
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
					
						<div class="col-sm-12">
							<div class="card shadow-bottom shadow-showcase">
								<div class="card-header d-flex justify-content-between" style="color: #FFF; background-color: #DC143C !important;border-top-left-radius: 10px;border-top-right-radius: 10px;">
									<div class="header-title">
										<h4 class="card-title">Delivery Sales Remittance </h4>
									</div>
									<h3><i class="ri-settings-5-fill"></i></h3>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-sm-12 col-lg-12 col-md-12">
											<div class="row justify-content-between mb-2">
												<div class="col-sm-6 col-md-6">
													<div class="input-group mb-4">
														<div class="input-group-prepend ">
															<label class="input-group-text bg-danger" for="inputGroupSelect01">Search By : </label>
														</div>
														<select class="custom-select" id="selectsearch">
															<option selected>Choose...</option>
															<option value="VN">Vendors Name</option>
															<option value="T">Track #</option>
															<option value="D">Date</option>
														</select>
														<input type="search" class="form-control input-group-text" id="search_keyword" placeholder="Type Here . . ."
																aria-controls="user-list-table">
													</div>
												</div>
												<div class="col-sm-6 col-md-6">
													<!-- -->
												</div>
											</div>
											<div id="display_data" class="table-responsive-sm bottom-left shadow-showcase" style="border-radius: 10px !important;">
												
												<table class="table" id="reload_counter_orderlist">
													<thead  class="text-uppercase" style="background-color: #DC143C;color: #FFF;">
														<tr>
															<th class="text-center" scope="col">Errand Names</th>
															<th class="text-center" scope="col">Date Remit</th>
															<th class="text-left" scope="col">Track # / Invoice</th>
															<th class="text-center" scope="col">Total Payment</th>
														</tr>
													</thead>
													<tbody>
												
														<?php  
														$tablename	= TABLE_PREFIX.'remittance';
														if($vendor_id == 0){
															$v_id = $admin_id;
														}elseif($vendor_id == $vendor_id){
															$v_id = $vendor_id;
														}													
														$query = "SELECT A.* , CONCAT(B.firstname ,' ', B.mi,'. ', ' ', B.lastname) AS v_name, 
																	CONCAT(C.firstname ,' ', C.mi,'. ', ' ', C.lastname) AS e_name,
																	(SELECT COUNT(id) 
																	FROM tbl_remittance WHERE vendor_id = '$v_id') AS total_data,
																	(SELECT SUM(total_amt) 
																	FROM tbl_remittance AS D
																	INNER JOIN tbl_errand AS E ON (D.`errand_id` = E.`id`) WHERE vendor_id = '$v_id') AS tots_price,
																	(SELECT COUNT(id) 
																	FROM tbl_remittance WHERE vendor_id = '$v_id') AS tots_record
																	FROM tbl_remittance AS A
																	INNER JOIN tbl_vendor AS B ON (A.`vendor_id` = B.`id`)
																	INNER JOIN tbl_errand AS C ON (A.`errand_id` = C.`id`)
																	WHERE A.`vendor_id` = '$v_id' AND A.pay_method ='2'
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
																
														?>
																<tr>
																	<td class="text-center">
																		<h6 class="mb-0"><i class="ri-numbers-fill"></i> &nbsp; <em><?= $e_name; ?><em></h6>
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
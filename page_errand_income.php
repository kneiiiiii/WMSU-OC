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

$get_delfee 	= $DB_Helper->get_row("SELECT A.* , (B.`del_fee`) AS delivery_fee
										FROM tbl_errand AS A
										INNER JOIN tbl_delfee AS B ON (A.`del_fee` = B.`id`)
										WHERE A.id='$admin_id'");
$delivery_fee	= $get_delfee->delivery_fee;
?>
<script>
	function get_staff_avatar(id){
		//alert(id);
		$("#avatar_id").val(id);
		document.getElementById("span1").textContent="You Choose Avatar: " + id;
	}

	
	
	function remit_money(trackno){
		
		let confirmAction = confirm("Do you want to continue?");
		if (confirmAction) {
			var action = 6 ;
			
				$.ajax({
					url:'component/mod_up.php',
					type:'post',
					data:{
						ope:action,
						trackno:trackno
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
<script type="text/javascript" language="javascript" >
	$(document).ready(function(){
		
		$("#search_keyword").keyup(function(){
			var input = $(this).val();
			var select_val = $("#selectsearch").val();
			
			//alert(select_val);
			//alert(input);
			
			if(select_val == "Choose..."){
				alert("Please Choose at Select section..");
			}else{
				
				
				if(input != ""){
					$.ajax({
						
						url:"ajax_errand_income.php",
						method:"POST",
						data:{input:input,select_val:select_val},
						
						success:function(data){
							$("#display_data").html(data);
							$("#display_data").css("display","block");
						}
					});
				}else{
					//alert("asdf");
					//$( ".table" ).load( "page_errand_income.php .table" );
					$( "#display_data" ).load( "page_errand_income.php #display_data" );
					//location.reload();
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
										<h4 class="card-title">My Income</h4>
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
											<div  id="display_data" class="table-responsive rounded mb-3">
												<table class="table" id="reload_errand">
													<thead  class="text-uppercase" style="background-color: #DC143C;color: #FFF;">
														<tr>
															<th class="text-center" scope="col">Vendors Name</th>
															<th class="text-center" scope="col">Date Remit</th>
															<th class="text-left" scope="col">Track # / Invoice</th>
															<th class="text-center" scope="col">Total Payment</th>
														</tr>
													</thead>
													<tbody>
												
														<?php  
														$tablename	= TABLE_PREFIX.'remittance';
																											
														$query = "SELECT A.* , CONCAT(B.firstname ,' ', B.mi,'. ', ' ', B.lastname) AS v_name, 
																	CONCAT(C.firstname ,' ', C.mi,'. ', ' ', C.lastname) AS e_name,
																		(SELECT COUNT(id) 
																		FROM tbl_remittance WHERE errand_id = '$admin_id' ) AS total_data,
																			(SELECT SUM(total_amt) 
																			FROM tbl_remittance AS D
																			INNER JOIN tbl_errand AS E ON (D.`errand_id` = E.`id`) WHERE errand_id = '$admin_id') AS tots_price,
																				(SELECT COUNT(F.id) 
																				FROM tbl_remittance AS F
																				INNER JOIN tbl_errand AS G ON (F.`errand_id` = G.`id`) WHERE errand_id = '$admin_id') AS tots_record,
																					(SELECT COUNT(id) 
																					FROM tbl_remittance WHERE errand_id = '$admin_id') AS all_record
																	FROM tbl_remittance AS A
																	INNER JOIN tbl_vendor AS B ON (A.`vendor_id` = B.`id`)
																	INNER JOIN tbl_errand AS C ON (A.`errand_id` = C.`id`)
																	WHERE A.`errand_id` = '$admin_id' 
																	ORDER BY A.`id` DESC LIMIT 10";
														
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
																$v_name 	 	 	 = $row['v_name'];
																$all_record 	 	 = $row['all_record'];
																
														?>
																<tr>
																	<td class="text-center">
																		<h6 class="mb-0"><i class="ri-numbers-fill"></i> &nbsp; <em><?= $v_name; ?><em></h6>
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
															<h6 class="mb-0"><strong>TOTAL DELIVERY INCOME <strong></h6>
														</td>
														<td class="text-center"> 
															<h4 class="mb-0 text-danger font-weight-500"><strong><?= "&#8369;".number_format( $tots_record * $delivery_fee, 2 )  ;?><stron></h4>
														</td>
													</tr>
													<tr>
														<td class="text-right" colspan="4">
															<h6 class="mb-0 text-primary font-weight-700">Total Record : <?= $tots_record;?>  of <?= $all_record;?></h6>
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
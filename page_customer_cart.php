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
	
	/*default id=2 (2 = COD/Deliver , 1 = OTC/Pick-up
	$get_del_fee 	= $DB_Helper->get_row(" SELECT * from tbl_delfee WHERE id=2");
	$del_fee		= $get_del_fee->del_fee;*/
	
}
	
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
						<div class="col-lg-2"></div>
						<div class="col-lg-8">
							<div class="card bottom-left shadow-showcase">
								<form id="frm_foodcart" name="frm_foodreg" method="post" >
								
									<div class="card-body">
										
										<?php 
												
											$tablename	= TABLE_PREFIX.'foodlist';
											$get_id = $_GET['fID'];
											
											$get_food_record = $SQL_Helper->get_row("SELECT * FROM $tablename WHERE id= '$get_id' ");
												
												$food_name  	 = $get_food_record->food_name;
												$price  		 = $get_food_record->price;
												$food_status 	 = $get_food_record->food_status;
												$category 		 = $get_food_record->category;
												$image 			 = $get_food_record->image;
											
										?>
										<?php 
									if(isset($_POST['bttn_addtocart'])){
										
										$food_id = $_GET['fID'];
										$result='false';
										$tablename1	= TABLE_PREFIX."cart";
										
										$post_data['food_id'] 		=   $food_id;
										$post_data['cust_ID'] 		=   $admin_id;
										$post_data['qty']			=   $_POST['food_quantity'];
										$post_data['total_price'] 	=   ceil($_POST['food_quantity'] * $price);
										$post_data['order_status'] 	=   0;
										$post_data['date_order'] 	=   date("m/d/Y h:i:s A");
										
										$id = $SQL_Helper->INSERT_ALL($tablename1,$post_data);
										$is_added = $id > 0 ? true : false;		
										$result =  $is_added==true ? $result='true' : $result='false';
								
										if($result == "true"){
										echo "
												<div class='col-md-12'> 
													<div class='alert text-white bg-success' role='alert'>
														<div class='iq-alert-icon'>
															<i class='ri-check-line' style='font-size:24px;color: green;'></i>
														</div>
													<div class='iq-alert-text'>" . $messages['fg']['cart_Suc_Save'] . "</div>
														<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
															<i class='ri-close-line'></i>
														</button>
													</div>
												</div>
											";	
											
										}else{
											echo "
												<div class='col-md-12'>
													<div class='alert text-white bg-warning' role='alert col-md-12'>
														<div class='iq-alert-icon'>
															<i class='ri-alert-fill'  style='font-size:24px;color: red;'></i>
														</div>
													<div class='iq-alert-text'>" . $messages['fg']['cart_Er_Save'] . "</div>
														<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
															<i class='ri-close-line'></i>
														</button>
													</div>
												</div>
											";
										}
									}
								?>
										<div class="col-md-6 d-inline-block">
											<img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($image); ?>" class="card-img-top" alt="#" style="border-bottom-right-radius: 9px !important;border-bottom-left-radius: 9px !important;">
										</div>
										<div class=" col-md-6 card-text d-inline-block float-right">
												
												<hr class="border border-danger border-1 opacity-50 mb-3">
												
											<h4 class="card-title"><?= $food_name;?></h4>
											
												<hr class="border border-danger border-1 opacity-50">
											
											<h6><?php echo "&#8369;".number_format( $price, 2 );?></h6>
											<p><em> - <?= $category;?></em></p>
											<!-- <h6 class="text-muted">Delivery Fee : <?= $del_fee;?></h6>-->
											
												<hr class="border border-danger border-1 opacity-50">
											
											<h6>Quantity : </h6>
											<input type="number" class="form-control input-sm input-float" id="food_quantity" name="food_quantity" maxlength="10"  value="1"
											style="width: 50% !important;text-align: center;">
											
												<hr class="border border-danger border-1 opacity-50">
												
											<button id="bttn_addtocart" name="bttn_addtocart" type="submit" class="btn btn-primary mr-2 mt-3 mb-3">
												<i class='fa fa-cart-plus'></i> &nbsp;&nbsp;  Add to Cart
											</button>
											
											<a href="page_customer_foodslist.php" id="bttn_back" name="bttn_back" class="btn btn-danger mr-2 mt-3 mb-3">
												<i class='fa fa-arrow-left'></i> &nbsp;&nbsp;  Back
											</a>
										</div>
										
											
										
									</div>
								</form>
							</div>
						</div>
						<div class="col-lg-2"></div>
					</div>
					<!-- Page end  -->
				</div>
			</div>
		</div>
		
		<!-- [INCLUDE - FOOTER] -->
		<?php include_once 'template/footer.php';?>
	</body>
</html>
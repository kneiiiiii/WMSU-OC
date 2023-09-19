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


$action = $_GET['action'];
?>
<script>
	function preview() {
		frame.src=URL.createObjectURL(event.target.files[0]);
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
										<h4 class="card-title"><?php  if($_GET['action'] == 'addNew'){echo "Foods Information";}else{echo "Update Food Information";}?></h4>
									</div>
									<h3><i class="ri-settings-5-fill"></i></h3>
								</div>
								<div class="card-body">
									<form id="frm_vendor" name="frm_vendor" method="post" enctype="multipart/form-data" data-toggle="validator">
										<div class="row">
											<div class="col-md-6">
												<div class="row">
													<?php 
													if($_GET['action'] == 'addNew'){
														$tablename	= TABLE_PREFIX.'foodlist';
														$result='false';
														if($vendor_id == 0){
															$v_id = $admin_id;
														}elseif($vendor_id == $vendor_id){
															$v_id = $vendor_id;
														}
														
														if(isset($_POST['bttn_save'])){
															// Get file info 
															$fileName = basename($_FILES["upload_image_food"]["name"]); 
															$fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
															
															$allowTypes = array('jpg','png','jpeg','webp'); 
													 
															if(in_array($fileType, $allowTypes)){ 
															
																$image = $_FILES['upload_image_food']['tmp_name']; 
																$imgContent = addslashes(file_get_contents($image));
															
																$post_data['food_name'] 	=   $_POST['food_name'];
																$post_data['price'] 		=   $_POST['price'];
																$post_data['food_status']	=   $_POST['food_status'];
																$post_data['category'] 		=   $_POST['category'];
																$post_data['image'] 		=   $imgContent;
																$post_data['vendor_id'] 	=   $v_id;
																$post_data['datecreated'] 	= 	date("Y/m/d h:i:s");
																
																$id = $SQL_Helper->INSERT_ALL($tablename,$post_data);
																$is_added = $id > 0 ? true : false;		
																$result =  $is_added==true ? $result='true' : $result='false';
															
															
																if($result == "true"){
																echo "
																		<div class='col-md-12'> 
																			<div class='alert text-white bg-success' role='alert'>
																				<div class='iq-alert-icon'>
																					<i class='ri-check-line' style='font-size:24px;color: green;'></i>
																				</div>
																			<div class='iq-alert-text'>" . $messages['fg']['food_Suc_Save'] . "</div>
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
																					<i class='ri-error-warning-line' style='font-size:24px;color: red;></i>
																				</div>
																			<div class='iq-alert-text'>" . $messages['fg']['food_Er_Save'] . "</div>
																				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
																					<i class='ri-close-line'></i>
																				</button>
																			</div>
																		</div>
																	";
																}
															}
														}
													}elseif( $_GET['action'] == 'edit' ){
														
														if(isset($_POST['bttn_save'])){
															// Get file info 
															$tablename	= TABLE_PREFIX.'foodlist';
															$id = $_GET['id'];
															$fileName = basename($_FILES["update_image_food"]["name"]); 
															$fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
															$image = $_FILES["update_image_food"]['tmp_name']; 
															
															$post_data['food_name'] 	=   $_POST['food_name'];
															$post_data['price'] 		=   $_POST['price'];
															$post_data['food_status']	=   $_POST['food_status'];
															$post_data['category'] 		=   $_POST['category'];
															
															if(!empty($image)) { 
																$imgContent = addslashes(file_get_contents($image));
																$post_data['image'] 			=   $imgContent;
															}											
														
															$id = $SQL_Helper->UPDATE_ALL($tablename ,"id=$id" ,$post_data);
															$is_added = $id > 0 ? true : false;		
															$result =  $is_added==true ? $result='true' : $result='false';
																									
															if($result == "true"){
															echo "
																	<div class='col-md-12'> 
																		<div class='alert text-white bg-success' role='alert'>
																			<div class='iq-alert-icon'>
																				<i class='ri-check-line' style='font-size:24px;color: green;'></i>
																			</div>
																		<div class='iq-alert-text'>" . $messages['fg']['food_Suc_Update'] . "</div>
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
																				<i class='ri-error-warning-line' style='font-size:24px;color: red;></i>
																			</div>
																		<div class='iq-alert-text'>" . $messages['fg']['food_Er_Save'] . "</div>
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
													
													<?php 
														if( $_GET['action'] == 'edit' ){
															
															$tablename	= TABLE_PREFIX.'foodlist';
															$get_id = $_GET['id'];
															
															$get_food_record = $SQL_Helper->get_row("SELECT * FROM $tablename WHERE id= '$get_id' ");
																
																$food_name  	 = $get_food_record->food_name;
																$price  		 = $get_food_record->price;
																$food_status 	 = $get_food_record->food_status;
																$category 		 = $get_food_record->category;
																$image 			 = $get_food_record->image;
																
														}
													?>
													
													<div class="col-md-12">                      
														<div class="form-group">
															<label>Food Name *</label>
															<input id="food_name" name="food_name" type="text" class="form-control" placeholder="Type Here.." 
															value="<?php if($action == 'edit'){echo $food_name;}else{echo "";}; ?>" autocomplete="off" data-errors="Please Enter Food Name." required>
															<div class="help-block with-errors"></div>
														</div>
													</div>    
													<div class="col-md-12">                      
														<div class="form-group">
															<label>Price *</label>
															<input id="price" name="price" type="number" class="form-control" placeholder="Type Here.." 
															value="<?php if($action == 'edit'){echo $price;}else{echo "";}; ?>" autocomplete="off" data-errors="Please Enter Price." required>
															<div class="help-block with-errors"></div>
														</div>
													</div>
													
													<div class="col-md-12">
														<div class="form-group">
															<label>Food Status *</label>
															<select id="food_status" name="food_status" class="custom-select" required>
																<option value="Available" <?php if($_GET['action'] == 'edit'){if($food_status == "Available"){echo "selected";}}else{echo "";} ?>>Available</option>
																<option value="Not Available" <?php if($_GET['action'] == 'edit'){if($food_status == "Not Available"){echo "selected";}}else{echo "";} ?>>Not Available</option>
															</select>
															<div class="help-block with-errors"></div>
														</div>
													</div>   
													<div class="col-md-12">
														<div class="form-group">
															<label>Category *</label>
															<select id="category" name="category" class="custom-select" required>
																<option value="Solo Meal" <?php if($_GET['action'] == 'edit'){if($category == "Solo Meal"){echo "selected";}}else{echo "";} ?>>Solo Meal</option>
																<option value="Combo Meal" <?php if($_GET['action'] == 'edit'){if($category == "Combo Meal"){echo "selected";}}else{echo "";} ?>>Combo Meal</option>
																<option value="Drinks" <?php if($_GET['action'] == 'edit'){if($category == "Drinks"){echo "selected";}}else{echo "";} ?>>Drinks</option>
																<option value="Snacks" <?php if($_GET['action'] == 'edit'){if($category == "Snacks"){echo "selected";}}else{echo "";} ?>>Snacks</option>
																<option value="Desserts" <?php if($_GET['action'] == 'edit'){if($category == "Desserts"){echo "selected";}}else{echo "";} ?>>Desserts</option>
															</select>
															<div class="help-block with-errors"></div>
														</div>
													</div>     
													
												</div>
											</div>
											
											<div class="col-md-6">
												
												<div class="col-md-12">
													<div class="crm-profile-img-edit position-relative" >
														
														<?php 
														if( $_GET['action'] == 'edit' ){ ?>
															<img id="frame" name="frame" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($image); ?>" style="height: 287px !important;width: 312px !important;" class="crm-profile-pic rounded avatar-100 blur-shadow shadow-showcase" alt="profile-pic">
														<?php }else{ ?>
															<img id="frame" name="frame" style="height: 287px !important;width: 312px !important;" class="crm-profile-pic rounded avatar-100 blur-shadow shadow-showcase" src="images/blank-face.jpeg" alt="profile-pic">
														<?php } ?>
														<div class="crm-p-image bg-primary" style="left: 285px !important;">
															<i class="las la-pen upload-button"></i>
															<input class="file-upload" type="file" accept="image/*" onchange="preview()" id="<?php if($_GET['action'] == 'addNew'){echo "upload_image_food";}else{echo "update_image_food";}?>" name="<?php if($_GET['action'] == 'addNew'){echo "upload_image_food";}else{echo "update_image_food";}?>" />
														</div>
													</div>
												</div>
												
											</div>
											
										</div>                            
										<button id="bttn_save" name="bttn_save" type="submit" class="btn btn-primary mr-2 mt-3">
											<?php 
											if($action == 'edit'){
												echo '<i class="ri-edit-2-fill"></i>Update Information';
											}else{
												echo '<i class="ri-save-3-fill"></i>Save Information';
											}; ?>
											
										</button>
										<button type="reset" class="btn btn-danger mt-3"><i class="ri-refresh-line"></i>Reset</button>
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
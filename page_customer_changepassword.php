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

if($self == 'page_customer' || 'page_customer_profile' || 'page_customer_changepassword'){
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
							<div class="card auth-card basic-drop-shadow p-4 shadow-showcase">
								<div class="card-body p-0">
									<div class="d-flex align-items-center auth-content">
										<div class="col-lg-8 align-self-center">
											<div class="p-3">
											
												<h3 class="mb-2">Change Password </h3>
												<p>For your account's security, do not share your password with anyone else</p> 
													<form id="frm_vendor" name="frm_vendor" method="post" enctype="multipart/form-data" data-toggle="validator">
															<div class="row">
															<?php
															
															if(isset($_POST['bttn_confirm_pass'])){
																$tablename		= TABLE_PREFIX.'customer';
																$current_pass 	= $_POST['current_password'];
																$new_pass 		= $_POST['new_password'];
																$confirm_pass 	= $_POST['confirm_password'];
																
																if($new_pass == $confirm_pass){
																	
																		$sqlquery 	= "SELECT * FROM $tablename WHERE pass_word = $current_pass";
																		$sqlresult 	= mysqli_query($DB_Helper->db_con,$sqlquery);
																		$count		= mysqli_num_rows($sqlresult);
																		if($count > 0){
																			
																			$post_data['pass_word'] 	=   $_POST['new_password'];
																			
																			$id = $SQL_Helper->UPDATE_ALL($tablename ,"id=$admin_id" ,$post_data);
																			$is_added = $id > 0 ? true : false;		
																			$result =  $is_added==true ? $result='true' : $result='false';
																													
																			if($result == "true"){
																				echo "
																						<div class='col-md-8'> 
																							<div class='alert text-white bg-success' role='alert'>
																								<div class='iq-alert-icon'>
																									<i class='fas fa-check' style='font-size:24px;color: green;'></i>
																								</div>
																							<div class='iq-alert-text'>" . $messages['fg']['password_Suc_Update'] . "</div>
																								<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
																									<i class='ri-close-line'></i>
																								</button>
																							</div>
																						</div>
																				";	
																			}
																			
																		}else{
																			echo "
																				<div class='col-md-8'>
																					<div class='alert text-white bg-warning' role='alert col-md-12'>
																						<div class='iq-alert-icon'>
																							<i class='fas fa-exclamation-triangle' style='font-size:24px;color: red;'></i>
																						</div>
																					<div class='iq-alert-text'>" . $messages['fg']['old_password_notmatch'] . "</div>
																						<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
																							<i class='ri-close-line'></i>
																						</button>
																					</div>
																				</div>
																			";
																		}
																}else{
																	echo "
																			<div class='col-md-8'>
																				<div class='alert text-white bg-warning' role='alert col-md-12'>
																					<div class='iq-alert-icon'>
																						<i class='fas fa-exclamation-triangle' style='font-size:24px;color: red;'></i>
																					</div>
																				<div class='iq-alert-text'>" . $messages['fg']['password_notmatch'] . "</div>
																					<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
																						<i class='ri-close-line'></i>
																					</button>
																				</div>
																			</div>
																		";
																}
															
															}
														?>
																<div class="col-md-8">                    
																	<div class="form-group">
																		<input id="current_password" name="current_password" type="password" class="form-control" placeholder="Current Password" 
																		autocomplete="off" data-errors="Please Enter Last Name." required>
																		<div class="help-block with-errors"></div>
																	</div>
																</div>    
																<div class="col-md-8">                      
																	<div class="form-group">
																		<input id="new_password" name="new_password" type="password" class="form-control" placeholder="New Password" 
																		autocomplete="off" data-errors="Please Enter First Name." required>
																		<div class="help-block with-errors"></div>
																	</div>
																</div>
																
																<div class="col-md-8">                      
																	<div class="form-group">
																		<input id="confirm_password" name="confirm_password" type="password" class="form-control" placeholder="Confirm Password" 
																		autocomplete="off" data-errors="Please Enter Middle Name." required>
																		<div class="help-block with-errors"></div>
																	</div>
																</div> 
															</div>
															<button id="bttn_confirm_pass" name="bttn_confirm_pass" type="submit" class="btn btn-primary mr-2"><i class="ri-thumb-up-fill"></i>Confirm</button>
														</form>
											</div>
										</div>
										<div class="col-lg-4 content-right">
											<img src="<?= PATH_V_IMAGES.'login/01=.png';?>" class="img-fluid image-right" alt="">
										</div>
									</div>
								</div>
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
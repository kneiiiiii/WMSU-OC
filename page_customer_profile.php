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

if($self == 'page_customer' || 'page_customer_profile'){
	$tablename	= TABLE_PREFIX.'customer';
	
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
			<?php include_once 'template/sidebar_menu_customer.php';?>
			    
			<!-- [INCLUDE - TOPBAR MENU] -->
			<?php include_once 'template/topbar_menu.php';?>
			
			<div class="content-page">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-12">
							<div class="card shadow-bottom shadow-showcase">
								<div class="card-header d-flex justify-content-between" style="color: #FFF; background-color: #DC143C !important;border-top-left-radius: 10px;border-top-right-radius: 10px;">
									<div class="header-title text-center">
										<h4 class="card-title">Customer Profiles</h4>
									</div>
									<h3><i class="ri-settings-5-fill"></i></h3>
								</div>
								<div class="card-body">
									<form id="frm_vendor" name="frm_vendor" method="post" enctype="multipart/form-data" data-toggle="validator">
										<div class="row">
											
												<?php 
												
			
											
													if(isset($_POST['bttn_save'])){
														$tablename	= TABLE_PREFIX.'customer';
																												
														$post_data['lastname'] 		=   $_POST['lastname'];
														$post_data['firstname'] 	=   $_POST['firstname'];
														$post_data['mi']			=   $_POST['mi'];
														$post_data['contact'] 		=   $_POST['contact'];
														$post_data['email_add'] 	=   $_POST['email_add'];
														$post_data['avatar_id'] 	=   $_POST['avatar_id'];
																									
													
														$id = $SQL_Helper->UPDATE_ALL($tablename ,"id=$admin_id" ,$post_data);
														$is_added = $id > 0 ? true : false;		
														$result =  $is_added==true ? $result='true' : $result='false';
																								
														if($result == "true"){
														echo "
																<div class='col-md-12'> 
																	<div class='alert text-white bg-success' role='alert'>
																		<div class='iq-alert-icon'>
																			<i class='fas fa-check' style='font-size:24px;color: green;'></i>
																		</div>
																	<div class='iq-alert-text'>" . $messages['fg']['customer_Suc_Update'] . "</div>
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
																			<i class='fas fa-exclamation-triangle' style='font-size:24px;color: red;'></i>
																		</div>
																	<div class='iq-alert-text'>" . $messages['fg']['customer_Er_Save'] . "</div>
																		<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
																			<i class='ri-close-line'></i>
																		</button>
																	</div>
																</div>
															";
														}
													}
											
													
												?>
											<?php 
												$tablename	= TABLE_PREFIX.'customer';
													
												$get_customer_record = $SQL_Helper->get_row("
												SELECT CONCAT(A.firstname ,' ', A.mi,'. ', ' ', A.lastname) AS Fullname,
												A.* , B.image
												FROM $tablename AS A
												LEFT JOIN tbl_avatar AS B ON (A.avatar_id = B.id)
												WHERE A.id= '$admin_id' ");
												
												// $get_customer_record = $SQL_Helper->get_row(" SELECT *,
													// CONCAT(firstname ,' ', mi,'. ', ' ', lastname) AS Fullname FROM $tablename WHERE id='$admin_id'");
													
												$lastname    = $get_customer_record->lastname;
												$firstname   = $get_customer_record->firstname;
												$mi 		 = $get_customer_record->mi;
												$contact 	 = $get_customer_record->contact;
												$email_add 	 = $get_customer_record->email_add;
												$pass_word 	 = $get_customer_record->pass_word;
												$avatar_id 	 = $get_customer_record->avatar_id;
												$image	 	 = $get_customer_record->image;
												$Fullname	 = $get_customer_record->Fullname;
												
											?>
											
											<div class="col-lg-12 col-md-12">
												<div class="card card-block card-stretch card-height">
													<div class="card-body ">
														<div class="row">
															<div class="col-md-5 bottom-left shadow-showcase p-3 ml-3 mt-1 mr-3" style="color: #FFF;  background-color: #DC143C !important;border-top-left-radius: 10px;border-top-right-radius: 10px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
																<h4>Information</h4>
																<div class="d-flex align-items-center " >
																	<div class="iq-avatar mr-2">
																	<?php
																	if( $image == null){ ?>
																		<img class="avatar-100 rounded" src="<?php echo PATH_V_IMAGES.'user/i1.jpg'; ?>" alt="#" data-original-title="" title="">
																	<?php }else{ ?>
																		<img class="avatar-100 rounded" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($image); ?>" alt="#" data-original-title="" title="">
																	<?php }?>
																		
																	</div>
																	<blockquote class="blockquote">
																		<p class="mb-0"><?= $Fullname;?></p>
																		<footer class="blockquote-footer text-white"><cite title="Source Title"><?= $email_add;?></cite></footer>
																	</blockquote>
																</div>
															</div>
														
														</div>
													</div>
												</div>
											</div>
											
											<div class="col-md-6">                      
												<div class="form-group">
													<label>Last Name *</label>
													<input id="lastname" name="lastname" type="text" class="form-control" placeholder="Enter Last Name" 
													value="<?= $lastname;?>" autocomplete="off" data-errors="Please Enter Last Name." required>
													<div class="help-block with-errors"></div>
												</div>
											</div>    
											<div class="col-md-6">                      
												<div class="form-group">
													<label>First Name *</label>
													<input id="firstname" name="firstname" type="text" class="form-control" placeholder="Enter First Name" 
													value="<?= $firstname;?>" autocomplete="off" data-errors="Please Enter First Name." required>
													<div class="help-block with-errors"></div>
												</div>
											</div>
											
											<div class="col-md-6">                      
												<div class="form-group">
													<label>Middle Name *</label>
													<input id="mi" name="mi" type="text" class="form-control" placeholder="Enter Middle Name" 
													value="<?= $mi;?>" autocomplete="off" data-errors="Please Enter Middle Name." required>
													<div class="help-block with-errors"></div>
												</div>
											</div>  
											<div class="col-md-6">
												<div class="form-group">
													<label>Email Address *</label>
													<input id="email_add" name="email_add" type="email" class="form-control" placeholder="Enter Email Address" 
													value="<?= $email_add;?>" autocomplete="off" data-errors="Please Enter Email Address." required>
													<div class="help-block with-errors"></div>
												</div>
											</div>
											
											<div class="col-md-6">
												<div class="form-group">
													<label>Contact *</label>
													<input id="contact" name="contact" type="text" class="form-control" placeholder="Enter Contact" 
													value="<?= $contact;?>" autocomplete="off" data-errors="Please Enter Contact." required>
													<div class="help-block with-errors"></div>
												</div>
											</div>     
											<div class="col-lg-6 col-md-6">
												<div class="card card-block card-stretch card-height">
													<div class="card-body">
														<label>Select Avatar *</label>
														<div class="iq-avatars d-flex flex-wrap align-items-center">
															<div class="iq-avatar">
															   <div class="iq-media-grouptext-center">
																<?php 
																$tablename	= TABLE_PREFIX.'avatar';
																	$sql = "SELECT * FROM $tablename";
																		$result = mysqli_query($DB_Helper->db_con,$sql) or die(mysqli_error($DB_Helper->db_con));
																		
																		while($row = mysqli_fetch_array($result)){
																?>
																	
																	<a href="#">
																		<img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" onclick="get_staff_avatar(<?= $row['id'];?>)" 
																		class="mr-1 m-1 img-fluid avatar-60 rounded img-thumbnail" id="avatar_img" 
																		style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?= $row['id'];?>">
																	</a>
																<?php }?> 
																
															   </div>
															</div>
														</div>
													<em><span name="span1" id="span1"></span></em>
													<input id="avatar_id" name="avatar_id" type="hidden" value="<?php echo $avatar_id; ?>" autocomplete="off"  required>
													<div class="help-block with-errors"></div>
													</div>
												</div>
											</div>
											
										</div>                            
										<button id="bttn_save" name="bttn_save" type="submit" class="btn btn-primary mr-2"><i class="ri-check-line"></i>Update Information</button>
										<button type="reset" class="btn btn-danger"><i class="ri-refresh-line"></i>Reset</button>
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
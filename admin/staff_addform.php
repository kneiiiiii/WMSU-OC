<!-- [INCLUDE - TOP] -->
<?php include_once 'template/top.php';
if(isset($_SESSION[WEB_NAME]['login_id'])){
	$admin_id 		 = $_SESSION[WEB_NAME]['login_id'];
	$admin_name 	 = $_SESSION[WEB_NAME]['login_name'];
	$admin_email_add = $_SESSION[WEB_NAME]['email_add'];
}else{
	
	header("Location:login_form.php");
	exit();
}
$action = $_GET['action'];
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
                            <h4 class="card-title"><?php  if($_GET['action'] == 'addNew'){echo "Add New Staff / Personnel";}else{echo "Update Staff / Personnel";}?></h4>
						</div>
						<h3><i class="ri-settings-5-fill"></i></h3>
                    </div>
                    <div class="card-body">
                        <form id="frm_staff" name="frm_staff" method="post" enctype="multipart/form-data" data-toggle="validator">
                            <div class="row">
                                <?php 
									if($_GET['action'] == 'addNew'){
										if(isset($_POST['bttn_save'])){
											$tablename	= TABLE_PREFIX.'vendor';
											
											$post_data['lastname'] 		=   $_POST['lastname'];
											$post_data['firstname'] 	=   $_POST['firstname'];
											$post_data['mi']			=   $_POST['mi'];
											$post_data['contact'] 		=   $_POST['contact'];
											$post_data['email_add'] 	=   $_POST['email_add'];
											$post_data['pass_word'] 	=   $_POST['pass_word'];
											$post_data['vendor_id'] 	=   $_POST['vendor_id'];
											$post_data['avatar_id'] 	=   $_POST['avatar_id'];
											$post_data['usertype'] 		=	'3';
											$post_data['datecreated'] 	= 	date("Y/m/d h:i:s");
										
											$id = $SQL_Helper->INSERT_ALL($tablename,$post_data);
											$is_added = $id > 0 ? true : false;		
											$result =  $is_added==true ? $result='true' : $result='false';
									
											if($result == "true"){
											echo "
													<div class='col-md-12'> 
														<div class='alert text-white bg-success' role='alert'>
															<div class='iq-alert-icon'>
																<i class='fas fa-check' style='font-size:24px;color: green;'></i>
															</div>
														<div class='iq-alert-text'>" . $messages['fg']['staff_Suc_Save'] . "</div>
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
														<div class='iq-alert-text'>" . $messages['fg']['staff_Er_Save'] . "</div>
															<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
																<i class='ri-close-line'></i>
															</button>
														</div>
													</div>
												";
											}
										}
									}elseif( $_GET['action'] == 'edit' ){
										if(isset($_POST['bttn_save'])){
											$tablename	= TABLE_PREFIX.'vendor';
											$get_id = $_GET['id'];
											
											$post_data['lastname'] 		=   $_POST['lastname'];
											$post_data['firstname'] 	=   $_POST['firstname'];
											$post_data['mi']			=   $_POST['mi'];
											$post_data['contact'] 		=   $_POST['contact'];
											$post_data['email_add'] 	=   $_POST['email_add'];
											$post_data['pass_word'] 	=   $_POST['pass_word'];
											$post_data['vendor_id'] 	=   $_POST['vendor_id'];
											$post_data['avatar_id'] 	=   $_POST['avatar_id'];
											
											$id = $SQL_Helper->UPDATE_ALL($tablename ,"id=$get_id" ,$post_data);
											$is_added = $id > 0 ? true : false;		
											$result =  $is_added==true ? $result='true' : $result='false';
									
											if($result == "true"){
											echo "
													<div class='col-md-12'> 
														<div class='alert text-white bg-success' role='alert'>
															<div class='iq-alert-icon'>
																<i class='fas fa-check' style='font-size:24px;color: green;'></i>
															</div>
														<div class='iq-alert-text'>" . $messages['fg']['staff_Suc_Update'] . "</div>
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
														<div class='iq-alert-text'>" . $messages['fg']['staff_Er_Save'] . "</div>
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
										
										$get_id = $_GET['id'];
										$tablename	= TABLE_PREFIX.'vendor';
										
										//$get_vendor_record = $SQL_Helper->get_row("SELECT * FROM $tablename WHERE id= '$get_id' ");
											
											$get_vendor_staff_record = $SQL_Helper->get_row("
												SELECT CONCAT(A.firstname ,' ', A.mi,'. ', ' ', A.lastname) AS Fullname, A.*, 
												CONCAT(B.firstname ,' ', B.mi,'. ', ' ', B.lastname) AS current_vendors_assign, 
												C.image, venimg.image AS Vendor_img
												FROM $tablename AS A
												INNER JOIN tbl_vendor AS B ON (A.vendor_id = B.id)
												INNER JOIN tbl_avatar AS C ON (A.avatar_id = C.id)
												INNER JOIN tbl_avatar AS venimg ON (B.avatar_id = venimg.id)
												WHERE A.id= '$get_id';
											");
											
											$lastname    				 = $get_vendor_staff_record->lastname;
											$firstname   				 = $get_vendor_staff_record->firstname;
											$mi 		 				 = $get_vendor_staff_record->mi;
											$contact 	 				 = $get_vendor_staff_record->contact;
											$email_add 	 				 = $get_vendor_staff_record->email_add;
											$pass_word 	 				 = $get_vendor_staff_record->pass_word;
											$vendor_id 	 			  	 = $get_vendor_staff_record->vendor_id;
											$current_vendors_assign 	 = $get_vendor_staff_record->current_vendors_assign;
											$avatar_id 	 			  	 = $get_vendor_staff_record->avatar_id;
											$image 	 			  		 = $get_vendor_staff_record->image;
											$Fullname 	 		  		 = $get_vendor_staff_record->Fullname;
											$Vendor_img 	 			 = $get_vendor_staff_record->Vendor_img;
											
									}
								?>
								<?php 
								if($action == 'edit'){?>
									<div class="col-lg-12 col-md-12">
										<div class="card card-block card-stretch card-height">
											<div class="card-body ">
												<div class="row">
													<div class="col-md-5 bottom-left shadow-showcase p-3 ml-3 mt-1 mr-3" style="color: #FFF;  background-color: #DC143C !important;border-top-left-radius: 10px;border-top-right-radius: 10px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
														<h4>Information</h4>
														<div class="d-flex align-items-center ">
															<div class="iq-avatar mr-2">
																<img class="avatar-100 rounded" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($image); ?>" alt="#" data-original-title="" title="">
															</div>
															<blockquote class="blockquote">
																<p class="mb-0"><?= $Fullname;?></p>
																<footer class="blockquote-footer  text-white"><cite title="Source Title"><?= $email_add;?></cite></footer>
															</blockquote>
														</div>
													</div>
													<div class="col-md-5 bottom-left shadow-showcase p-3 ml-3 mt-1 mr-3 " style="color: #FFF;  background-color: #DC143C !important;border-top-left-radius: 10px;border-top-right-radius: 10px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
														<h4>Currently Assign</h4>
												
															<div class="d-flex align-items-center ">
																<div class="iq-avatar mr-2">
																   <img class="avatar-100 rounded" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($Vendor_img); ?>" alt="#" data-original-title="" title="">
																</div>
																<blockquote class="blockquote">
																	<p class="mb-0"><?= $current_vendors_assign; ?></p>
																	<footer class="blockquote-footer text-white"><cite title="Source Title">Vendor's Name</cite></footer>
																</blockquote>
															</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php } ?>
                                <div class="col-md-6">                      
                                    <div class="form-group">
                                        <label>Last Name *</label>
                                        <input id="lastname" name="lastname" type="text" class="form-control" placeholder="Enter Last Name" 
										value="<?php if($action == 'edit'){echo $lastname;}else{echo "";}; ?>" autocomplete="off" data-errors="Please Enter Last Name." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>    
                                <div class="col-md-6">                      
                                    <div class="form-group">
                                        <label>First Name *</label>
                                        <input id="firstname" name="firstname" type="text" class="form-control" placeholder="Enter First Name" 
										value="<?php if($action == 'edit'){echo $firstname;}else{echo "";}; ?>" autocomplete="off" data-errors="Please Enter First Name." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
								
								<div class="col-md-6">                      
                                    <div class="form-group">
                                        <label>Middle Name *</label>
                                        <input id="mi" name="mi" type="text" class="form-control" placeholder="Enter Middle Name" 
										value="<?php if($action == 'edit'){echo $mi;}else{echo "";}; ?>" autocomplete="off" data-errors="Please Enter Middle Name." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>  
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email Address *</label>
                                        <input id="email_add" name="email_add" type="email" class="form-control" placeholder="Enter Email Address" 
										value="<?php if($action == 'edit'){echo $email_add;}else{echo "";}; ?>" autocomplete="off" data-errors="Please Enter Email Address." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact *</label>
                                        <input id="contact" name="contact" type="text" class="form-control" placeholder="Enter Contact" 
										value="<?php if($action == 'edit'){echo $contact;}else{echo "";}; ?>" autocomplete="off" data-errors="Please Enter Contact." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>     
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password *</label>
                                        <input id="pass_word" name="pass_word" type="password" class="form-control" placeholder="Enter Password" 
										value="<?php if($action == 'edit'){echo $pass_word;}else{echo "";}; ?>" autocomplete="off" data-errors="Please Password." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Assign Vendor *</label>
										
											<?php 
												
												
												if($action == 'edit'){ 
												$hold_vendorsID = $vendor_id;
												$string_class = "selected active";
												?>
												
													<select class="form-control selectpicker" id="vendor_id" name="vendor_id" required class="selectpicker form-control" data-style="py-0">
													<option selected disabled value="">Choose...</option>
													<?php 	
														
														$tablename	= TABLE_PREFIX.'vendor';
														$string_class = 'selected active';
												
														$display_vendor = $DB_Helper->get_sql_results("SELECT * FROM $tablename WHERE vendor_id=0");	
														if($display_vendor){
															foreach($display_vendor as $row){
															$vendor_name 	 = $row->firstname." ".$row->mi.". ".$row->lastname;
															$vendor_id 	 	 = $row->id;
															
																
													?>
														
													
														<?php 
														if( $vendor_id == $hold_vendorsID){
															echo "
																<option value='".$vendor_id."' selected active> ".$vendor_name."</option>
															";
														}else{
															echo "
																<option value='".$vendor_id."' class=''> ".$vendor_name."</option>
															";
														}
														?>
													
													
													<?php }}?>
													</select>
													<div class="help-block with-errors"></div>
													
												<?php }elseif($action == 'addNew'){ ?> 
											
											
													<select class="form-control selectpicker" id="vendor_id" name="vendor_id" required class="selectpicker form-control" data-style="py-0">
													<option selected disabled value="">Choose...</option>
													<?php 
														$tablename	= TABLE_PREFIX.'vendor';
												
														$display_vendor = $DB_Helper->get_sql_results("SELECT * FROM $tablename WHERE vendor_id=0");	
														if($display_vendor){
															foreach($display_vendor as $row){
															$vendor_name 	 = $row->firstname." ".$row->mi.". ".$row->lastname;
															$vendor_id 	 	 = $row->id;
													?>
											  
													<option value="<?= $vendor_id; ?>"><?= $vendor_name; ?></option>
													<?php }}?>
													</select>
													<div class="help-block with-errors"></div>
											<?php }?>
										
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
																class="mr-1 m-1 img-fluid avatar-60 rounded img-thumbnail" id="avatar_img" style="cursor: pointer;" 
																data-toggle="tooltip" data-placement="top" title="" data-original-title="<?= $row['id'];?>">
															</a>
														<?php }?> 
														
													   </div>
													</div>
												</div>
											<em><span name="span1" id="span1"></span></em>
											<input id="avatar_id" name="avatar_id" type="hidden" value="<?php if($action == 'edit'){echo $avatar_id;}else{echo "8";}; ?>" autocomplete="off" data-errors="Please Password." required>
                                        <div class="help-block with-errors"></div>
											</div>
										</div>
								</div>
                                
                            </div>                            
                            <button id="bttn_save" name="bttn_save" type="submit" class="btn btn-primary mr-2">
								<i class="ri-check-line"></i>
								<?php 
								if($action == 'edit'){
									echo "Update Information";
								}else{
									echo "Save Information";
								}; ?>
								
							</button>
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
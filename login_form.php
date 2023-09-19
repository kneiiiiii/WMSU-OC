<!-- [INCLUDE - TOP] -->
<?php include_once 'template/top.php';?>
  
<script type="text/javascript">
	$(document).ready(function() {
		
		 $("#customSwitch03").on('change',function(){
			 if ($("#customSwitch03").is(':checked')) {
				
				$("#frmLogin_vendor").removeAttr("style").show();
				$("#frmLogin_errand").attr("style", "display:none");
				document.getElementById("mySpantxt").textContent="VENDOR";
			}else{
			 
				$("#frmLogin_vendor").attr("style", "display:none");
				$("#frmLogin_errand").removeAttr("style").show();
				document.getElementById("mySpantxt").textContent="ERRAND";
			}
		  
	  });
	});
 </script>

	<body class=" ">
		<!-- loader Start -->
		<div id="loading">
			  <div id="loading-center">
			  </div>
		</div>
		<!-- loader END -->

		<div class="wrapper">
			<section class="login-content">
				<div class="container">
					<div class="row align-items-center justify-content-center height-self-center">
						<div class="col-lg-9">
							<div class="card auth-card">
								<div class="card-body p-0">
									<div class="d-flex align-items-center auth-content">
										<div class="col-lg-7 align-self-center">
											<div class="p-3 ml-3">
											
												<h3 class="mb-2">Login to continue your Business Transaction.</h3>
												<p>SIGN - IN as "<span id="mySpantxt">VENDOR</span>"</p> 
													
													<div class="row">
													
														<div class="col-lg-12">
															<div id="login-indicator text-center" >
																<div id="indicator-msg" style="margin: 0px 0 20px 0px !important;">
																	<span id="login-indicator-msg" style="display:none"></span>
																</div>
															</div>
														</div>
														<div class="custom-control custom-switch custom-switch-color custom-control-inline mb-2">
															<input type="checkbox" class="custom-control-input bg-danger" id="customSwitch03" checked="" role="switch">
															<label class="custom-control-label" for="customSwitch03"><em>Switch it, if you want to login as Errand or Vendor</em></label>
														</div>
														<form  id="frmLogin_vendor" class="needs-validation" novalidate>
															<div class="form-row">
																<div class="col-lg-12">
																	<div class="floating-label form-group">
																		<input autocomplete="off" type="email" id="email_add" name="email_add" class="form-control" id="validationCustom01"  required placeholder="Email Address">
																		<div class="invalid-feedback">Please check your <strong>Email Address</strong></div>
																	</div>
																	
																</div>
																<div class="col-lg-12">
																	<div class="floating-label form-group">
																		<input autocomplete="off" type="password" id="pass_word" name="pass_word" class="form-control" id="validationCustom02"  required placeholder="Password">
																		<div class="invalid-feedback">Please check your <strong>Password</strong></div>
																	</div>
																</div>
															</div>
															<button name="vendor_login_bttn" id="vendor_login_bttn" class="btn btn-primary" type="submit"><i class='fa fa-arrow-alt-circle-right' style='font-size:20px;'></i>Log-in as Vendor</button>
														</form>
														
														<form  id="frmLogin_errand" class="needs-validation" novalidate style="display: none";>
															<div class="form-row">
																<div class="col-lg-12">
																	<div class="floating-label form-group">
																		<input autocomplete="off" type="email" id="email_add_errand" name="email_add_errand" class="form-control" id="validationCustom01"  required placeholder="Email Address">
																		<div class="invalid-feedback">Please check your <strong>Email Address</strong></div>
																	</div>
																	
																</div>
																<div class="col-lg-12">
																	<div class="floating-label form-group">
																		<input autocomplete="off" type="password" id="pass_word_errand" name="pass_word_errand" class="form-control" id="validationCustom02"  required placeholder="Password">
																		<div class="invalid-feedback">Please check your <strong>Password</strong></div>
																	</div>
																</div>
															</div>
															<button name="errand_login_bttn" id="errand_login_bttn" class="btn btn-primary" type="submit"><i class='fa fa-arrow-alt-circle-right' style='font-size:20px;'></i>Log-in as Errand</button>
														</form>
														
														<div class="col-lg-12 mt-3">
															<a href="index.php"><small><em>Back to Main Page</em></small></a>
														</div>
													</div>
											</div>
										</div>
										<div class="col-lg-4 content-right">
											<img src="<?= PATH_V_IMAGES.'login/01.png';?>" class="img-fluid image-right" alt="">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>

	<!-- [INCLUDE - FOOTER SCRIPT] -->
	<?php include_once 'template/footer_script.php';?>
	</body>
</html>
<!-- [INCLUDE - TOP] -->
<?php include_once 'template/top.php';?>
  

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
											
												<h3 class="mb-2">Sign In and stay connected.</h3>
												<p>A Moments of Delivered on Time</p> 
													
													<div class="row">
													
														<div class="col-lg-12">
															<div id="login-indicator text-center" >
																<div id="indicator-msg" style="margin: 0px 0 20px 0px !important;">
																	<span id="login-indicator-msg" style="display:none"></span>
																</div>
															</div>
														</div>
														<form  id="frmLogin_customer" class="needs-validation" novalidate>
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
															<button name="customer_login_bttn" id="customer_login_bttn" class="btn btn-primary" type="submit"><i class='fa fa-arrow-alt-circle-right' style='font-size:20px;'></i>Log-in as Customer</button>
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
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
						<div class="col-lg-8">
							<div class="card auth-card">
								<div class="card-body p-0">
									<div class="d-flex align-items-center auth-content">
										<div class="col-lg-7 align-self-center">
											<div class="p-3">
												<h2 class="mb-2">Sign In</h2>
												<p>Login to stay connected.</p>
													
													<div class="row">
													
														<div class="col-lg-12">
															<div id="login-indicator text-center" >
																<div id="indicator-msg" style="margin: 0px 0 20px 0px !important;">
																	<span id="login-indicator-msg" style="display:none"></span>
																</div>
															</div>
														</div>
														<form  id="frmLogin_administrator" class="needs-validation" novalidate>
															<div class="form-row">
																<div class="col-lg-12">
																	<div class="floating-label form-group">
																		<input autocomplete="off" type="email" id="email_add" name="email_add" class="form-control" id="validationCustom01" placeholder="Email Address" required>
																		<div class="invalid-feedback">Please check your <strong>Email Address</strong></div>
																	</div>
																	
																</div>
																<div class="col-lg-12">
																	<div class="floating-label form-group">
																		<input autocomplete="off" type="password" id="pass_word" name="pass_word" class="form-control" id="validationCustom02" placeholder="Password" required>
																		<div class="invalid-feedback">Please check your <strong>Password</strong></div>
																	</div>
																</div>
															</div>
															<button name="admin_login_bttn" id="admin_login_bttn" class="btn btn-primary" type="submit">Sign In</button>
														</form>
														
													</div>
											</div>
										</div>
										<div class="col-lg-5 content-right">
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
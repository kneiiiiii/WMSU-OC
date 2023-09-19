<!-- [INCLUDE - TOP] -->

<?php 
include_once 'template/top.php';

if(isset($_SESSION[WEB_NAME]['login_id'])){
	$admin_id 		 = $_SESSION[WEB_NAME]['login_id'];
	$admin_name 	 = $_SESSION[WEB_NAME]['login_name'];
	$admin_email_add = $_SESSION[WEB_NAME]['email_add'];
}else{
	header("Location:login_form.php");
	exit();
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
			<?php include_once 'template/sidebar_menu.php';?>
			    
			<!-- [INCLUDE - TOPBAR MENU] -->
			<?php include_once 'template/topbar_menu.php';?>
			
			<div class="content-page">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-4">
							<div class="card card-transparent card-block card-stretch card-height border-none">
								<div class="card-body p-0 mt-lg-2 mt-0">
									<h3 class="mb-3">Hi Graham, Good Morning</h3>
									<p class="mb-0 mr-4">Your dashboard gives you views of key performance or business process.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-8">
							<div class="row">
								<div class="col-lg-4 col-md-4">
									<div class="card card-block card-stretch card-height">
										<div class="card-body">
											<div class="d-flex align-items-center mb-4 card-total-sale">
												<div class="icon iq-icon-box-2 bg-info-light">
													<img src="assets/images/product/1.png" class="img-fluid" alt="image">
												</div>
												<div>
													<p class="mb-2">Total Sales</p>
													<h4>31.50</h4>
												</div>
											</div>                                
											<div class="iq-progress-bar mt-2">
												<span class="bg-info iq-progress progress-1" data-percent="10">
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-md-4">
									<div class="card card-block card-stretch card-height">
										<div class="card-body">
											<div class="d-flex align-items-center mb-4 card-total-sale">
												<div class="icon iq-icon-box-2 bg-danger-light">
													<img src="assets/images/product/2.png" class="img-fluid" alt="image">
												</div>
												<div>
													<p class="mb-2">Total Cost</p>
													<h4>$ 4598</h4>
												</div>
											</div>
											<div class="iq-progress-bar mt-2">
												<span class="bg-danger iq-progress progress-1" data-percent="70">
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-md-4">
									<div class="card card-block card-stretch card-height">
										<div class="card-body">
											<div class="d-flex align-items-center mb-4 card-total-sale">
												<div class="icon iq-icon-box-2 bg-success-light">
													<img src="assets/images/product/3.png" class="img-fluid" alt="image">
												</div>
												<div>
													<p class="mb-2">Product Sold</p>
													<h4>4589 M</h4>
												</div>
											</div>
											<div class="iq-progress-bar mt-2">
												<span class="bg-success iq-progress progress-1" data-percent="75">
												</span>
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
<?php 
$get_total_order 	= $DB_Helper->get_row(" SELECT COUNT(*) AS total_order FROM tbl_cart WHERE cust_ID ='$admin_id' AND order_status=0;");
$total_order		= $get_total_order->total_order;
?>
<div class="iq-top-navbar">
	<div class="iq-navbar-custom">
		<nav class="navbar navbar-expand-lg navbar-light p-0">
			<div class="iq-navbar-logo d-flex align-items-center justify-content-between">
				<i class="ri-menu-line wrapper-menu"></i>
				<a href="#" class="header-logo">
					<img src="images/n_logo.png" class="img-fluid rounded-normal" alt="logo">
					<h5 class="logo-title ml-3">WMSU - Online Canteen</h5>

				</a>
			</div>
			<div class="iq-search-bar device-search"></div>
			<div class="d-flex align-items-center">
				<button class="navbar-toggler" type="button" data-toggle="collapse"
					data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
					aria-label="Toggle navigation">
					<i class="ri-menu-3-line"></i>
				</button>
				
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto navbar-list align-items-center" id="cart_reload">
					<?php 
					if($usertype == 5){ ?>
					<li class="nav-item nav-icon dropdown">
						<a href="page_customer_orderlist.php" class="search-toggle dropdown-toggle" id="dropdownMenuButton">
							<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16"> <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/> </svg>
							<span class="mt-2 badge badge-danger" style="position: absolute;left: 15px !important;top: 2px !important;"><?php if($total_order != null){ echo $total_order; }else{ echo '0';} ?></span>
						</a>
					</li>	
					<?php }	?>
					
					
					<li class="nav-item nav-icon dropdown caption-content">
						  <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton4"
							  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							  <?php 
							  if( $image == null){ ?>
								<img src="<?php echo PATH_V_IMAGES.'user/i1.jpg'; ?>" class="img-fluid rounded" alt="user">  
							  <?php }else{ ?>
								<img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($image); ?>" class="img-fluid rounded" alt="user">
							  <?php }?>
							  
							
						  </a>
							<div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
								<div class="card shadow-none m-0">
									<div class="card-body p-0 text-center">
										<div class="media-body profile-detail text-center">
											<img src="assets/images/page-img/07.jpg" alt="profile-bg"
												class="rounded-top img-fluid mb-4">
												<?php if( $image == null){ ?>
													<img src="<?php echo PATH_V_IMAGES.'user/i1.jpg'; ?>" alt="profile-img"
													class="rounded profile-img img-fluid avatar-70">
												<?php }else{ ?>
													<img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($image); ?>" alt="profile-img"
													class="rounded profile-img img-fluid avatar-70">
												<?php }?>
											
										</div>
										<div class="p-3">
											<h5 class="mb-1"><?= $admin_email_add; ?></h5>
											<p class="mb-0"><?= $admin_name; ?></p> <br>
											<p class="mb-0 text-uppercase"><mark><small><b><?= $usetype;?></b></small></mark></p>
											<div class="d-flex align-items-center justify-content-center mt-3">
												<a href="logout.php" class="btn border">Sign Out</a>
											</div>
										</div>
									</div>
								</div>
							</div>
					</li>
				</ul>
			</div>
			</div>
		</nav>
	</div>
</div>
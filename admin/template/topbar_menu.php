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
				<ul class="navbar-nav ml-auto navbar-list align-items-center">
					<li class="nav-item nav-icon dropdown caption-content">
						  <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton4"
							  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							  <img src="assets/images/user/08.jpg" class="img-fluid rounded" alt="user">
						  </a>
							<div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
								<div class="card shadow-none m-0">
									<div class="card-body p-0 text-center">
										<div class="media-body profile-detail text-center">
											<img src="assets/images/page-img/07.jpg" alt="profile-bg"
												class="rounded-top img-fluid mb-4">
											<img src="assets/images/user/08.jpg" alt="profile-img"
												class="rounded profile-img img-fluid avatar-70">
										</div>
										<div class="p-3">
											<h5 class="mb-1"><?= $admin_email_add; ?></h5>
											<p class="mb-0"><?= $admin_name; ?></p>
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
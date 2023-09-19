<div class="iq-sidebar  sidebar-default ">
	<div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
		<a href="page_customer_foodslist.php" class="header-logo">
			<img src="images/n_logo.png" class="img-fluid rounded-normal light-logo" alt="logo"><h5 class="logo-title light-logo m-1">Dashboard</h5>
		</a>
		<div class="iq-menu-bt-sidebar ml-0">
			<i class="las la-bars wrapper-menu"></i>
		</div>
	</div>
	<?php 
	if($self == 'page_customer' || 'page_customer_profile' || 'page_customer_changepassword' || 'page_customer_foodslist' || 'page_customer_trackorder' ){ ?>
	<div class="data-scrollbar" data-scroll="1">
			<nav class="iq-sidebar-menu">
				<ul id="iq-sidebar-toggle" class="iq-menu">
			
					<li class=" ">
						<a href="#useraccount" class="collapsed" data-toggle="collapse" aria-expanded="false">
							<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16"> 
								<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/> <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/> 
							</svg>
							
							<span class="ml-4">My Account</span>
							
							<svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
								<polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
							</svg>
						</a>
						<ul id="useraccount" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
							<li class="<?php if($self == 'page_customer_profile'){echo 'active';}else{echo '';}?>">
								<a href="page_customer_profile.php">
									<i class="las la-minus"></i><span>Profile</span>
								</a>
							</li>
							<li class="<?php if($self == 'page_customer_changepassword'){echo 'active';}else{echo '';}?>">
								<a href="page_customer_changepassword.php">
									<i class="las la-minus"></i><span>Change Password</span>
								</a>
							</li>
						</ul>
					</li>
			
					<li class=" ">
						<a href="#transaction" class="collapsed" data-toggle="collapse" aria-expanded="false">
							<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-sliders" viewBox="0 0 16 16"> 
								<path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z"/> 
							</svg>
							
							<span class="ml-4">My Transaction</span>
							
							<svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
								<polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
							</svg>
						</a>
						<ul id="transaction" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
							<li class="<?php if($self == 'page_customer_foodslist' || $self == 'page_customer_cart'){echo 'active';}else{echo '';}?>">
								<a href="page_customer_foodslist.php">
									<i class="las la-minus"></i><span>Food's List</span>
								</a>
							</li>
							<li class="<?php if($self == 'page_customer_trackorder' ){echo 'active';}else{echo '';}?>">
								<a href="page_customer_trackorder.php?msg=no&trackno=0">
									<i class="las la-minus"></i><span>Order Track</span>
								</a>
							</li>
							<li class="<?php if($self == 'page_customer_complete_order' ){echo 'active';}else{echo '';}?>">
								<a href="page_customer_complete_order.php?msg=no&trackno=0">
									<i class="las la-minus"></i><span>Order Completed</span>
								</a>
							</li>
						</ul>
						
					</li>
				</ul>
			</nav>	
		<div class="p-3"></div>
	</div>
	<?php }?>
</div> 
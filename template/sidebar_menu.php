<div class="iq-sidebar  sidebar-default ">
	<div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
		<a href="page_vendor.php" class="header-logo">
			<img src="images/n_logo.png" class="img-fluid rounded-normal light-logo" alt="logo"><h5 class="logo-title light-logo m-1">Dashboard</h5>
		</a>
		<div class="iq-menu-bt-sidebar ml-0">
			<i class="las la-bars wrapper-menu"></i>
		</div>
	</div>
	
	<?php 
	
	if($self == 'page_vendor' || 'page_vendor_profile' || 'page_vendor_foodlist_addform'){ ?>
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
							<li class="<?php if($self == 'page_vendor_profile'){echo 'active';}else{echo '';}?>">
								<a href="page_vendor_profile.php">
									<i class="las la-minus"></i><span>Profile</span>
								</a>
							</li>
							<li class="<?php if($self == 'page_vendor_changepassword'){echo 'active';}else{echo '';}?>">
								<a href="page_vendor_changepassword.php">
									<i class="las la-minus"></i><span>Change Password</span>
								</a>
							</li>
						</ul>
					</li>
					
					<li class=" ">
						<a href="#business" class="collapsed" data-toggle="collapse" aria-expanded="false">
							<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-graph-up-arrow" viewBox="0 0 16 16"> 
								<path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5Z"/> 
							</svg>
							
							<span class="ml-4">My Business</span>
							
							<svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
								<polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
							</svg>
						</a>
						<ul id="business" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
							<li class="<?php if($self == 'page_vendor_foodlist' || $self == 'page_vendor_foodlist_addform'){echo 'active';}else{echo '';}?>">
								<a href="page_vendor_foodlist.php">
									<i class="las la-minus"></i><span>Food List</span>
								</a>
							</li>
							<li class="<?php if($self == 'page_vendor_orderlist'){echo 'active';}else{echo '';}?>">
								<a href="page_vendor_orderlist.php?cust_id=0">
									<i class="las la-minus"></i><span>Order List</span>
								</a>
							</li>
							<li class="<?php if($self == 'page_vendor_delivery_pickup'){echo 'active';}else{echo '';}?>">
								<a href="page_vendor_delivery_pickup.php?track_no=0">
									<i class="las la-minus"></i><span>Delivery / Pick-up List</span>
								</a>
							</li>
							<li class="<?php if($self == 'page_vendor_remittance'){echo 'active';}else{echo '';}?>">
								<a href="page_vendor_remittance.php">
									<i class="las la-minus"></i><span>Money Remittance</span>
								</a>
							</li>
						</ul>
						
					</li>
					
					<li class=" ">
						<a href="#mysales" class="collapsed" data-toggle="collapse" aria-expanded="false">
							<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16"> 
								<path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/> <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/> <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/> <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/> 
							</svg>
							
							<span class="ml-4">My Sale's</span>
							
							<svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
								<polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
							</svg>
						</a>
						<ul id="mysales" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
							
							<li class="<?php if($self == 'page_vendor_sales'){echo 'active';}else{echo '';}?>">
								<a href="page_vendor_sales.php">
									<i class="las la-minus"></i><span>Delivery Sales</span>
								</a>
							</li>
							<li class="<?php if($self == 'page_vendor_pickup_sales'){echo 'active';}else{echo '';}?>">
								<a href="page_vendor_pickup_sales.php">
									<i class="las la-minus"></i><span>Pick-Up Sales</span>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>	
		<div class="p-3"></div>
	</div>	
	<?php }elseif($self == 'page_errand'){ ?>
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
							<li class="<?php if($self == 'vendor' || $self == 'vendor_addform'){echo 'active';}else{echo '';}?>">
								<a href="vendor.php">
									<i class="las la-minus"></i><span>Profile</span>
								</a>
							</li>
							<li class="<?php if($self == 'staff' || $self == 'staff_addform'){echo 'active';}else{echo '';}?>">
								<a href="staff.php">
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
							<li class="<?php if($self == 'v_transaction'){echo 'active';}else{echo '';}?>">
								<a href="v_transaction.php">
									<i class="las la-minus"></i><span>List of Order's</span>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>	
		<div class="p-3"></div>
	</div>		
	<?php } ?>
	
</div> 
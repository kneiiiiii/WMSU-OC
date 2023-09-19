<?php 
	$self = $_SERVER['PHP_SELF'];
	$self = str_replace('/wmsucanteen/admin/', '', $self);
	$self = trim(strtolower(str_replace('.php', '', $self)));
	//echo $self;
?>
<div class="iq-sidebar  sidebar-default shadow-bottom shadow-showcase">
	<div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
		<a href="backend/index.html" class="header-logo">
			<img src="images/n_logo.png" class="img-fluid rounded-normal light-logo" alt="logo"><h5 class="logo-title light-logo m-1">Dashboard</h5>
		</a>
		<div class="iq-menu-bt-sidebar ml-0">
			<i class="las la-bars wrapper-menu"></i>
		</div>
	</div>
	<div class="data-scrollbar" data-scroll="1">
		<nav class="iq-sidebar-menu">
			<ul id="iq-sidebar-toggle" class="iq-menu">
				<li class=" ">
					<a href="#useraccount" class="collapsed" data-toggle="collapse" aria-expanded="false">
						<svg  id="p-dash2" width="25" height="25" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16"> 
							<path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/> 
						</svg>
						
						<span class="ml-4">User Account</span>
						
						<svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
						</svg>
					</a>
					<ul id="useraccount" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
						<li class="<?php if($self == 'vendor' || $self == 'vendor_addform'){echo 'active';}else{echo '';}?>">
							<a href="vendor.php">
								<i class="las la-minus"></i><span>Vendor's</span>
							</a>
						</li>
						<li class="<?php if($self == 'staff' || $self == 'staff_addform'){echo 'active';}else{echo '';}?>">
							<a href="staff.php">
								<i class="las la-minus"></i><span>Staff's</span>
							</a>
						</li>
						<li class="<?php if($self == 'errand' || $self == 'errand_addform'){echo 'active';}else{echo '';}?>">
							<a href="errand.php">
								<i class="las la-minus"></i><span>Errand's</span>
							</a>
						</li>
				  </ul>
				</li>
				
				<li class=" ">
					<a href="#transaction" class="collapsed" data-toggle="collapse" aria-expanded="false">
						<svg id="p-dash3" width="25" height="25" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-diagram-3" viewBox="0 0 16 16"> 
							<path fill-rule="evenodd" d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1H14a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 2 7h5.5V6A1.5 1.5 0 0 1 6 4.5v-1zM8.5 5a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1zM0 11.5A1.5 1.5 0 0 1 1.5 10h1A1.5 1.5 0 0 1 4 11.5v1A1.5 1.5 0 0 1 2.5 14h-1A1.5 1.5 0 0 1 0 12.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm4.5.5A1.5 1.5 0 0 1 7.5 10h1a1.5 1.5 0 0 1 1.5 1.5v1A1.5 1.5 0 0 1 8.5 14h-1A1.5 1.5 0 0 1 6 12.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm4.5.5a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"/> 
						</svg>
						
						<span class="ml-4">Transaction's</span>
						
						<svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
						</svg>
					</a>
					<ul id="transaction" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
						<li class="<?php if($self == 'v_transaction'){echo 'active';}else{echo '';}?>">
							<a href="v_transaction.php?v_id=0">
								<i class="las la-minus"></i><span>Vendor's Transaction</span>
							</a>
						</li>
						<li class="<?php if($self == 'e_transaction'){echo 'active';}else{echo '';}?>">
							<a href="e_transaction.php?e_id=0">
								<i class="las la-minus"></i><span>Errand's Transaction</span>
							</a>
						</li>
					</ul>
				</li>
			
			</ul>
		</nav>
		<div class="p-3"></div>
	</div>
</div> 
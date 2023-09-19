<!-- [INCLUDE - TOP] -->

<?php 
include_once 'template/top.php';

$self = $_SERVER['PHP_SELF'];
$self = str_replace('/wmsucanteen/', '', $self);
$self = trim(strtolower(str_replace('.php', '', $self)));
//echo $self;

if(isset($_SESSION[WEB_NAME]['login_id'])){
	$admin_id 		 = $_SESSION[WEB_NAME]['login_id'];
	$admin_name 	 = $_SESSION[WEB_NAME]['login_name'];
	$admin_email_add = $_SESSION[WEB_NAME]['email_add'];
}else{
	header("Location:login_form.php");
	exit();
}

if($self == 'page_customer_foodslist'){
	$tablename	= TABLE_PREFIX.'customer';
}
	
$get_user_info 	= $DB_Helper->get_row(" SELECT A.* , B.image, C.usetype
										FROM $tablename AS A
										INNER JOIN tbl_avatar AS B ON (A.avatar_id = B.id)
										INNER JOIN tbl_usertype AS C ON (A.`usertype` = C.id)
										WHERE A.id='$admin_id'");
$usertype		= $get_user_info->usertype;
$usetype		= $get_user_info->usetype;
$image			= $get_user_info->image;


if(isset($_GET['page_no']) && $_GET['page_no'] !== ""){
	$page_no = $_GET['page_no'];
}else{
	$page_no = 1;
}

//total row or records to display
$total_records_per_page = 12;
//get the pag offset foth e LIMIT query
$offset = ($page_no - 1) * $total_records_per_page;
//get previous page
$previous_page = $page_no - 1;
//get next page
$next_page =  $page_no + 1;

$result_count = $SQL_Helper->get_row("SELECT COUNT(*) as total_records FROM tbl_foodlist WHERE food_status = 'Available'");
$total_records 	 = $result_count->total_records;

$total_no_of_pages = ceil($total_records / $total_records_per_page);

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
			<?php include_once 'template/sidebar_menu_customer.php';?>
			    
			<!-- [INCLUDE - TOPBAR MENU] -->
			<?php include_once 'template/topbar_menu.php';?>
			
			<div class="content-page">
				<div class="container-fluid">
					<div class="row">
						
						<div class="col-lg-12">
							<div class="row">
								<div class="col-lg-12">
									<div class="card card-block card-stretch card-height">
										<div class="card-body">
											<div class="row">
												<div class="col-md-12 text-end" style="margin-top: 15px;">
													<nav aria-label="Page navigation example">
														<ul class="pagination pagination-sm justify-content-center">
															<li class="page-item"><a class="page-link <?= ($page_no <= 1) ? 'disabled' : '' ;?>"
															<?= ($page_no > 1) ? 'href=?page_no=' . $previous_page : ''; ?>> Previous</a></li>
															
															<?php for($counter = 1; $counter <= $total_no_of_pages; $counter ++ ) {?>
																<?php if($page_no != $counter){?>
															<li class="page-item"><a class="page-link" href="?page_no=<?= $counter;?>"><?= $counter;?></a></li>
																<?php }else{?>
															<li class="page-item"><a class="page-link active" href="#"><?= $counter;?></a></li>
															<?php } }?>
															
															<li class="page-item"><a class="page-link <?= ($page_no >= $total_no_of_pages) ? 'disabled' : '' ;?>" 
															<?= ($page_no < $total_no_of_pages) ? 'href=?page_no=' . $next_page : ''; ?>>Next</a></li>
														</ul>
													</nav>
												</div>
												<div class="col-md-12 col-md-6 ">
													
													<div class="row row-cols-1 row-cols-md-4 g-4">
														<?php 
														$sql = "SELECT A.* , (A.id) AS food_id , (A.image) AS foods_image, B.* , 
																CONCAT(B.firstname ,' ', B.mi,'. ', ' ', B.lastname) AS vendor_name, 
																(C.image) AS vendor_image
																FROM tbl_foodlist AS A
																INNER JOIN tbl_vendor AS B ON (A.vendor_id = B.id)
																INNER JOIN tbl_avatar AS C ON (B.avatar_id = C.id)
																WHERE A.`food_status` = 'Available'
																LIMIT $offset,$total_records_per_page ";
														$result = mysqli_query($DB_Helper->db_con,$sql) or die(mysqli_error($DB_Helper->db_con));
														
														while($row = mysqli_fetch_array($result)){
														?>
													
														<div class="col">
														
															<div class="card bottom-left shadow-showcase">
																<img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['foods_image']); ?>" 
																	width="250px" height="350px" class="card-img-top" alt="<?= $row['food_name'];?>">
																<div class="card-body text-danger" style="padding: 10px 10px 0px 15px !important;">
																	<p class="card-title d-inline-block"><i class="ri-restaurant-fill"></i>&nbsp;<small><?= $row['food_name'];?></small></p>
																	<p class="card-text d-inline-block float-right "><small><?php echo "&#8369;".number_format( $row['price'], 2 );?></small></p>
																</div>
																<div class="card-footer text-muted">
																	<a href="#" class="card-link d-inline-block ">
																		<span class="mt-2 badge badge-primary"><?= $row['vendor_name'];?></span>
																	</a>
																	<a href="page_customer_cart.php?fID=<?= $row['food_id'];?>" class="card-link btn btn-danger d-inline-block float-right mr-2" >
																		<small>Add to Cart</small>
																	</a>
																</div>
															</div>
														</div>
														<?php }?>
													</div>
												</div>
												<div class="col-md-12" style="margin-top: 15px;">
													<nav aria-label="Page navigation example">
														<ul class="pagination pagination-sm justify-content-center">
															<li class="page-item"><a class="page-link <?= ($page_no <= 1) ? 'disabled' : '' ;?>"
															<?= ($page_no > 1) ? 'href=?page_no=' . $previous_page : ''; ?>> Previous</a></li>
															
															<?php for($counter = 1; $counter <= $total_no_of_pages; $counter ++ ) {?>
																<?php if($page_no != $counter){?>
															<li class="page-item"><a class="page-link" href="?page_no=<?= $counter;?>"><?= $counter;?></a></li>
																<?php }else{?>
															<li class="page-item"><a class="page-link active" href="#"><?= $counter;?></a></li>
															<?php } }?>
															
															<li class="page-item"><a class="page-link <?= ($page_no >= $total_no_of_pages) ? 'disabled' : '' ;?>" 
															<?= ($page_no < $total_no_of_pages) ? 'href=?page_no=' . $next_page : ''; ?>>Next</a></li>
														</ul>
													</nav>
												</div>
												<div class="col-md-12 text-center" style="margin-top: 5px;">
														<strong> Page <?= $page_no; ?> of <?= $total_no_of_pages;?></strong>
												</div>
											
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
<!-- [INCLUDE - TOP] -->
<?php include_once 'template/top.php';

if(isset($_SESSION[WEB_NAME]['login_id'])){
	$admin_id 		 = $_SESSION[WEB_NAME]['login_id'];
	$admin_name 	 = $_SESSION[WEB_NAME]['login_name'];
	$admin_email_add = $_SESSION[WEB_NAME]['email_add'];
}else{
	
	header("Location:login_form.php");
	exit();
}

?>
<script>
	function delete_vendor(id){
		let confirmAction = confirm("Are you sure to Delete this Record?");
		if (confirmAction) {
			var action = 1 ;
			
				$.ajax({
					url:'component/mod_del.php',
					type:'post',
					data:{
						ope:action,
						vendor_id:id
					},
					success:function(data,status){
						if(data == 'true'){
							
							alert("Successfully Deleted!.");
							location.reload();
						}
					}
				});
			
		} else {
		 return false;
		}
	}
</script>
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
						<div class="col-lg-12">
							<div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
								<div>
									<h4 class="mb-3">Vendor's Panel</h4>
								</div>
								<a href="vendor_addform.php?action=addNew" class="btn btn-danger add-list"><i class="las la-plus mr-3"></i>Add New Vendor</a>
							</div>
						</div>
						
						<div class="col-lg-12">
							<div class="table-responsive rounded mb-3">
							<table class="data-tables table mb-0 tbl-server-info table-hover shadow-bottom shadow-showcase" id="vendor_table">
								<thead class="bg-white text-uppercase">
									<tr class="ligth ligth-data">
										<th>
											<div class="checkbox d-inline-block">
												<input type="checkbox" class="checkbox-input" id="checkbox1">
												<label for="checkbox1" class="mb-0"></label>
											</div>
										</th>
										<th>Vendor's Name</th>
										<th>Contact</th>
										<th>Email Address</th>
										<th>Password</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody class="ligth-body">
									<?php 
										$tablename	= TABLE_PREFIX.'vendor';
										
										$get_vendor_list = $DB_Helper->get_sql_results("SELECT CONCAT(A.firstname ,' ', A.mi,'. ', ' ', A.lastname) AS Fullname,
										A.* , B.image
										FROM $tablename AS A
										INNER JOIN tbl_avatar AS B ON (A.avatar_id = B.id) WHERE A.usertype = 2;");	
										if($get_vendor_list){
											foreach($get_vendor_list as $row){
												$vendor_name 	 = $row->firstname." ".$row->mi.". ".$row->lastname;
												$contact 		 = $row->contact;
												$email_add 	 	 = $row->email_add;
												$pass_word 	 	 = $row->pass_word;
												$datecreated 	 = $row->datecreated;
												$id 	 	 	 = $row->id;
												$image 		 	 = $row->image;
												
									?>
									<tr>
										<td>
											<div class="checkbox d-inline-block">
												<input type="checkbox" class="checkbox-input" id="checkbox2">
												<label for="checkbox2" class="mb-0"></label>
											</div>
										</td>
										<td>
											<div class="d-flex align-items-center">
												<img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($image); ?>" class="img-fluid rounded avatar-50 mr-3" alt="image">
												<div>
													<?= $vendor_name; ?>
													<p class="mb-0"><small><?= date_format(date_create($datecreated),"m/d/Y"); ?></small></p>
												</div>
											</div>
										</td>
										<td><?= $contact; ?></td>
										<td><?= $email_add; ?></td>
										<td><?= md5($pass_word); ?></td>
										<td>
											<div class="d-flex align-items-center list-action">
												<a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
													href="vendor_addform.php?action=edit&id=<?= $id;?>"><i class="ri-pencil-line mr-0"></i></a>
												<a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
													onclick="delete_vendor(<?= $id;?>)" href="#"><i class="ri-delete-bin-line mr-0"></i></a>
											</div>
										</td>
									</tr>
									<?php }}?>
									
								</tbody>
							</table>
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
<?php 
include_once('includes/config_mod.php');
include_once('includes/libraries_mod.php');

		$input 		= 	$_POST["input"];
		$v_id 		= 	$_POST["v_id"];
		$tablename	= TABLE_PREFIX.'delivery';
		?>
		<div class="list-group" >
					<?php
			$sql = "
				SELECT A.*, CONCAT(B.firstname ,' ', B.mi,'. ', ' ', B.lastname) AS v_name
				FROM tbl_remittance AS A
				INNER JOIN tbl_vendor AS B ON (A.`vendor_id` = B.`id`)
				WHERE firstname LIKE '{$input}%' OR lastname LIKE '{$input}%'
				GROUP BY B.id
				ORDER BY A.`id` DESC
				";
			
			$result = mysqli_query($DB_Helper->db_con,$sql) or die(mysqli_error($DB_Helper->db_con));

			if(mysqli_num_rows($result) > 0){
				
				$get_order_list = $DB_Helper->get_sql_results($sql);	
				
				if($get_order_list){
					foreach($get_order_list as $row){
						$v_name 			 = $row->v_name;
						$vendor_id 	 		 = $row->vendor_id;
				
			?>
				<a href="v_transaction.php?v_id=<?= $vendor_id;?>" class="list-group-item list-group-item-action
					<?php if($vendor_id  == $v_id){echo 'active';}else{echo'';}?>">
					<div class="d-flex w-100 justify-content-between">
						<h6 class="mb-1"><i class='fas fa-arrow-circle-right' style='font-size:20px;color: crimson;'></i> &nbsp;&nbsp; <?= $v_name; ?></h6>
					</div>
				</a>

			<?php 	}
				}
			}else{
				echo "<p class='text-danger mt-1'><em>No Record Found!</em></p>";
			}?>
		</div>


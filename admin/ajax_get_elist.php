<?php 
include_once('includes/config_mod.php');
include_once('includes/libraries_mod.php');

		$input 		= 	$_POST["input"];
		$e_id 		= 	$_POST["e_id"];
		$tablename	= TABLE_PREFIX.'delivery';
		?>
		<div class="list-group" >
						<?php
				$sql = "
					SELECT A.*, CONCAT(B.firstname ,' ', B.mi,'. ', ' ', B.lastname) AS e_name
							FROM tbl_remittance AS A
							INNER JOIN tbl_errand AS B ON (A.`errand_id` = B.`id`)
							WHERE firstname LIKE '{$input}%' OR lastname LIKE '{$input}%'
							GROUP BY B.id
							ORDER BY A.`id` DESC
					";
				
				$result = mysqli_query($DB_Helper->db_con,$sql) or die(mysqli_error($DB_Helper->db_con));

			if(mysqli_num_rows($result) > 0){
				
				$get_order_list = $DB_Helper->get_sql_results($sql);	
				
				if($get_order_list){
					foreach($get_order_list as $row){
						$e_name 			 = $row->e_name;
						$errand_id 	 		 = $row->errand_id;
				
			?>
				<a href="e_transaction.php?e_id=<?= $errand_id;?>" class="list-group-item list-group-item-action
					<?php if($errand_id  == $e_id){echo 'active';}else{echo'';}?>">
					<div class="d-flex w-100 justify-content-between">
						<h6 class="mb-1"><i class='fas fa-arrow-circle-right' style='font-size:20px;color: crimson;'></i> &nbsp;&nbsp; <?= $e_name; ?></h6>
					</div>
				</a>

			<?php 	}
				}
			}else{
				echo "<p class='text-danger mt-1'><em>No Record Found!</em></p>";
			}?>
		</div>


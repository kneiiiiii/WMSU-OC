<?php 
include_once('includes/config_mod.php');
include_once('includes/libraries_mod.php');


if(isset($_POST["input"])){
	
	$input 		 = 	$_POST["input"];
	$select_val  =	$_POST["select_val"];
	$v_id		 =	$_POST["v_id"];
	$ven_id	=	$_SESSION[WEB_NAME]['login_id'];
	$tablename	= 	TABLE_PREFIX.'remittance';
	
	if($v_id == 0){
		$vendor_id = $ven_id;
	}elseif($v_id == $v_id){
		$vendor_id = $v_id;
	}		
	
	if($select_val == "VN"){
		
		$sql_fields = "";
		$sql_fields_1 = " AND C.firstname LIKE '{$input}%' OR C.lastname LIKE '{$input}%' ";
		$sql_fields_2 = " AND E.firstname LIKE '{$input}%' OR E.lastname LIKE '{$input}%' ";
		$sql_fields_3 = " AND G.firstname LIKE '{$input}%' OR G.lastname LIKE '{$input}%' ";
		
	}elseif($select_val == "T"){
		
		
		$sql_fields_1 = "";
		$sql_fields_2 = "";
		$sql_fields_3 = "";
		$sql_fields = " AND track_no LIKE '{$input}%' ";
	}elseif($select_val == "D"){
		
		
		$sql_fields_1 = "";
		$sql_fields_2 = "";
		$sql_fields_3 = "";
		$sql_fields = " AND date_remit LIKE '{$input}%' ";
	
	}
	
															
		$query = "SELECT A.* , CONCAT(B.firstname ,' ', B.mi,'. ', ' ', B.lastname) AS v_name, 
					CONCAT(C.firstname ,' ', C.mi,'. ', ' ', C.lastname) AS e_name,
						(SELECT COUNT(id) 
						FROM tbl_remittance WHERE vendor_id = '$vendor_id' $sql_fields $sql_fields_1 ) AS total_data,
						(SELECT SUM(total_amt) 
						FROM tbl_remittance AS D
						INNER JOIN tbl_errand AS E ON (D.`errand_id` = E.`id`) WHERE vendor_id = '$vendor_id' $sql_fields $sql_fields_2  ) AS tots_price,
						(SELECT COUNT(F.id) 
						FROM tbl_remittance AS F
						INNER JOIN tbl_errand AS G ON (F.`errand_id` = G.`id`) WHERE vendor_id = '$vendor_id'  $sql_fields $sql_fields_3) AS tots_record,
						(SELECT COUNT(id) 
						FROM tbl_remittance WHERE vendor_id = '$vendor_id') AS all_record
					FROM $tablename AS A
					INNER JOIN tbl_vendor AS B ON (A.`vendor_id` = B.`id`)
					INNER JOIN tbl_errand AS C ON (A.`errand_id` = C.`id`)
					WHERE A.`vendor_id` = '$vendor_id' $sql_fields $sql_fields_1  
					ORDER BY A.`id` DESC";
		
		//echo $query;
		
		$result = mysqli_query($DB_Helper->db_con,$query) or die(mysqli_error($DB_Helper->db_con));
		
		if(mysqli_num_rows($result) > 0 ){?>
			
			<table class="table" id="reload_counter_orderlist">
				<thead  class="text-uppercase" style="background-color: #DC143C;color: #FFF;">
					<tr>
						<th class="text-center" scope="col">Errand Names</th>
						<th class="text-center" scope="col">Date Remit</th>
						<th class="text-left" scope="col">Track # / Invoice</th>
						<th class="text-center" scope="col">Total Payment</th>
					</tr>
				</thead>
				<tbody>
				<?php  
					while($row = mysqli_fetch_assoc($result)){
							$track_no 			 = $row['track_no'];
							$total_amt 	 	 	 = $row['total_amt'];
							$e_name		 	 	 = $row['e_name'];
							$date_remit	 	 	 = $row['date_remit'];
							$remit_status 	 	 = $row['remit_status'];
							$tots_price 	 	 = $row['tots_price'];
							$total_data 	 	 = $row['total_data'];
							$tots_record 	 	 = $row['tots_record'];
							$all_record 	 	 = $row['all_record'];
					?>
							<tr>
								<td class="text-center">
									<h6 class="mb-0"><i class="ri-numbers-fill"></i> &nbsp; <em><?= $e_name; ?><em></h6>
								</td>
								<td class="text-center">
									<h6 class="mb-0"><?php echo  date_format(date_create($date_remit), "m/d/Y"); ?></h6>
								</td>
								<td>
									<h6 class="mb-0"><?= $track_no;?></h6>
								</td>
								<td class="text-center">
									<h6 class="mb-0"><?= "&#8369;".number_format( $total_amt, 2 );?></h6>
								</td>
							</tr>
				<?php   } ?>
				<tr  style="background-color: antiquewhite;">
					<td class="text-right" colspan="3">
						<h6 class="mb-0"><strong>TOTAL SALES <strong></h6>
					</td>
					<td class="text-center">
						<h4 class="mb-0 text-danger font-weight-500"><strong><?= "&#8369;".number_format( $tots_price, 2 );?><stron></h4>
					</td>
				</tr>
				<tr>
					<td class="text-right" colspan="4">
						<h6 class="mb-0 text-primary font-weight-700">Total Record : <?= $tots_record;?> of <?= $all_record;?></h6>
					</td>
				</tr>
				
				</tbody>
			</table>
			
		<?php } else { ?>
			
					<div class="alert text-white bg-secondary" role="alert">
						<div class="iq-alert-icon">
							<i class="ri-information-line"></i>
						</div>
						<div class="iq-alert-text"><strong>No Record has Found!!</strong></div>
					</div>
			
		<?php   }
	
	
}
?>
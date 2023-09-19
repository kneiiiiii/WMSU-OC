<?php

//fetch.php

		
		$column = array('track_no', 'date_remit', 'e_name');

		$query = '
		SELECT A.* , CONCAT(B.firstname ,' ', B.mi,'. ', ' ', B.lastname) AS v_name, 
			CONCAT(C.firstname ,' ', C.mi,'. ', ' ', C.lastname) AS e_name
			FROM tbl_remittance AS A
			INNER JOIN tbl_vendor AS B ON (A.`vendor_id` = B.`id`)
			INNER JOIN tbl_errand AS C ON (A.`errand_id` = C.`id`)
		WHERE track_no LIKE "%'.$_POST["search"]["value"].'%" 
		OR date_remit LIKE "%'.$_POST["search"]["value"].'%" 
		OR e_name LIKE "%'.$_POST["search"]["value"].'%" 
		';

		if(isset($_POST["order"]))
		{
			$query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
		}
		else
		{
			$query .= 'ORDER BY order_id DESC ';
		}

		$query1 = '';

		if($_POST["length"] != -1)
		{
			$query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}

	$statement =$DB_Helper->db_con->prepare($query);

	$statement->execute();

	$number_filter_row = $statement->rowCount();

	$statement = $DB_Helper->db_con->prepare($query . $query1);

	$statement->execute();

	$result = $statement->fetchAll();

	$data = array();

	$total_order = 0;

	foreach($result as $row)
	{
		$sub_array = array();
		$sub_array[] = $row["track_no"];
		$sub_array[] = $row["date_remit"];
		$sub_array[] = $row["e_name"];
		$sub_array[] = $row["order_value"];

		$total_order = $total_order + floatval($row["order_value"]);
		$data[] = $sub_array;
	}

	function count_all_data($DB_Helper->db_con)
	{
		$query = "SELECT * FROM tbl_order";
		$statement = $DB_Helper->db_con->prepare($query);
		$statement->execute();
		return $statement->rowCount();
	}

	$output = array(
		'draw'    			=> intval($_POST["draw"]),
		'recordsTotal'  	=> count_all_data($DB_Helper->db_con),
		'recordsFiltered' 	=> $number_filter_row,
		'data'    			=> $data,
		'total'    			=> number_format($total_order, 2)
	);

echo json_encode($output);


?>
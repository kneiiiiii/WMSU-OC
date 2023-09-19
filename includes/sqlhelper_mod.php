<?php
class SQL_Helper extends DB_Helper
{
	
	
		function get_row_info($query=null, $where="")
		{
			if($where)
			{
				$where = " WHERE ".$where;
			}
			
			$sql = $query.$where;
			$row = get_row($sql);
			return $row;
		}
		
		//Insert all values at one call
		function INSERT_ALL($table=null, $values=array())
		{
		
			$i				= 0;
			$fields 		= "";
			$field_vals 	= "";
			
			foreach( $values as $field => $field_val)
			{
				if($i == 0)
				{
					$fields			.= "`$field`";
					$field_vals		.= "'$field_val'";
				}else{
					$fields			.= ", `$field`";
					$field_vals		.= ", '$field_val'";
				}
				$i++;
			}
			$sql = "INSERT INTO $table ($fields)VALUES($field_vals)";
			//echo $sql;
			//exit;
			
			mysqli_query($this->db_con,$sql);
			$id = mysqli_insert_id($this->db_con);
			//mysqli_query($sql);  
			//$id = mysqli_insert_id();  
			return $id;
		}
		
		//Update all values at one call
		function UPDATE_ALL($table=null, $where="", $values=array())
		{
			$i				= 0;
			$fields 		= "";
			$data 	= "";
			if($where != "")
			{
				$where = " WHERE ".$where;
			}
			
			foreach( $values as $field => $field_val)
			{
				if($i == 0)
				{
					$data		.= " `$field` = '$field_val'";
				}else{
					$data		.= ", `$field` = '$field_val'";
				}
				$i++;
			}
			$sql = "UPDATE $table SET $data $where";
			//echo $sql;
			//exit;
			/*mysql_query($sql);
			$id = mysql_affected_rows();
			return $id;*/
			
			mysqli_query($this->db_con,$sql);
			$id = mysqli_affected_rows($this->db_con);  
			return $id;
			
		}
		
		//Delete SQL QUERY
		function DELETE($table=null, $where)
		{
			$where = "WHERE ".$where;
			$sql = "DELETE FROM $table $where";
			/*mysql_query($sql);
			$id = mysql_affected_rows();
			return $id;*/
			
			mysqli_query($this->db_con,$sql);
			$id = mysqli_affected_rows($this->db_con);  
			return $id;
			
		}
		
		
}
	

?>

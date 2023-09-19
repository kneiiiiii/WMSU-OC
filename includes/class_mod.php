<?php

	class DB_Helper
	{
		
		/*
		function dbase_connection(){
			
			$conn = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
			
			if ($conn -> connect_errno) {
			  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
			  exit();
			}
			echo "Successfully connect to MySQL: ";
			return $this->conn = $conn;
		}
		
		*/
		/*=====================================    DATABASE CONFIGURATION AND SELECT DATABASE NAME   =========================*/
		
		function DB_Helper($dbhost, $dbuser, $dbpass, $dbname)
		{
			
			$this->db_con = @mysqli_connect($dbhost, $dbuser, $dbpass);
			// mysqli_connect
			if(!$this->db_con)
			{
				//Call the class error for notification
				$this->print_error_message
				(
					'
						<ol>
							<b>DATABASE CONNECTION ERROR:</b>
							<li>
								Are you sure you have the correct hostname?
							</li>
							
							<li>
								Are you sure you have the correct username or password?
							</li>
							
							<li>
								Are you sure that the database server is running?
							</li>
						</ol>
					'
				);
				exit;
			}
			
			$this->db_select($dbname);
			
		}

/*================================   END DATABASE CONFIGURATION AND SELECT DATABASE NAME   ========================*/

/*========================================   SELECT DATABASE NAME CONFIGURATION   =================================*/	

		function db_select($dbname)
		{
			
			if(!@mysqli_select_db($this->db_con,$dbname))
			{ 
			
				//Call the class error for notification
				$this->print_error_message
				(
					'
						<ol>
							<b>DATABASE NAME ERROR:</b>
							<li>
								Are you sure your database name it exist?
							</li>
							
							<li>
								Are you sure there is a valid database connection?
							</li>
							
							<li>
								Are you sure that you have a correct database name?
							</li>
						</ol>
					'
				);
				exit;
			}
			
			
		}
		
/*=====================================   END SELECT DATABASE NAME CONFIGURATION   ==================================*/
/*==============================================   PRINT ERROR CONFIGURATION   ======================================*/
		
		function print_error_message($str="")
		{
		
			if(!$str) $str = mysqli_error();
			
			// If there is an error then take note of it
			
			echo "<blockquote style=float:left;margin:100px;margin-bottom:10px;padding:5px;width:80%;border:1px;border-style:solid;border-color:#b00;><font face=arial size=2 color=ff0000>";
			echo "<b>DATABASE / SQL ERROR :</b> ";
			echo "<font color=000077>$str</font>";
			echo "</font></blockquote>";
			
		
		}

/*============================================   END PRINT ERROR CONFIGURATION   ====================================*/		

/*============================================   GET SQL RESULT CONFIGURATION   ====================================*/

		function get_sql_results($query=null)
		{
			//Perform the query using mysql_query function
			if($query)
			{
				$this->sql_query($query);
			}
			if(!$this->last_query_result)
			{
				// $this->print_error_message();
				// exit;
			}
			// Send back array of objects. Each row is an object
			return $this->last_query_result;	
		}

/*============================================   END GET SQL RESUKT CONFIGURATION   ====================================*/
/*==============================================   SQL QUERY CONFIGURATION   =======================================*/		

		function sql_query($query)
		{	
			$this->last_query_result = null;
			
			//Perform the query using mysql_query function
			//$this->sql_result = mysql_query($query,$this->db_con); 
			$this->sql_result = mysqli_query($this->db_con,$query);
			//Call the class error for notification
			if(mysqli_error($this->db_con)) 
			{
				$this->print_error_message();
			}else{
				
				//if the sql_result is not empty
				if($this->sql_result)
				{
					//Store the Query Results
					$i = 0;
					//while($row =  @mysql_fetch_object($this->sql_result)) 
					while($row =  @mysqli_fetch_object($this->sql_result)) 
						
					{
						//Store the results as an OJBJECT within the main array
						$this->last_query_result[$i] = $row;
						$i++;
					}
					
					@mysqli_free_result($this->sql_result);
					
					//If there were result then return true to $DB_Helper->sql_query
					if($i)
					{
						return true;
					}else{
						return false;
					}
				}
			
			}
		}

/*============================================   END SQL QUERY CONFIGURATION   ====================================*/				
/*============================================   GET SQL ROW CONFIGURATION   ===========================================*/

		function get_row($query=null,$int=0)
		{
		
			//Perform the query using mssql_query function
			if($query)
			{
				$this->sql_query($query);
				return $this->last_query_result[$int] ? $this->last_query_result[$int] : null;
			}
		
		}

/*============================================   END SQL ROW CONFIGURATION   ============================================*/		
	}


?>
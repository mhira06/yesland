<?php
	class Databases{
		public $generate;
		public function __construct(){
			$this->generate = new Generate();
		}
		
		public function connect($host, $user, $pass, $database, $port = null){
			$connect = new mysqli($host, $user, $pass, $database, $port);
			
			mysqli_query($connect, "SET CHARACTER SET utf8");
			mysqli_query($connect, "SET NAMES 'utf8'");
			mysqli_query($connect, "SET SESSION collation_connection = 'utf8_general_ci'");
			mysqli_query($connect, "SET SESSION group_concat_max_len=1500000");
			return $connect;
		}
		
		public function select_connection($connection, $database = null){
			$hostName = "localhost";
			$userName = "root";
			$passWord = "";
			$dataBase = "ylr_portal";
			$port = "3306";
			
			if($database != ""){
				$dataBase = $database;
			}
			
			$connect = $this->connect($hostName, $userName, $passWord, $dataBase, $port);
			return $connect;
		}
		
		public function sql_query($sqlString, $connection, $database = null){
			$db = $this->select_connection($connection, $database);
			
			$query = $db->query($sqlString);
			
			$response = $query;
			
			return $response;
		}
		
		public function insert($tableName, $data, $connection, $database = null){
			$response = "";
			$db = $this->select_connection($connection, $database);
			
			$columns = $this->generate->sql_columns($data);
			$values = $this->generate->sql_column_values($data);
			$insertQuery = "insert into ".$tableName."(".$columns.") values ".$values;
			$insert = $db->query($insertQuery);
		
			if(!$insert){
				$response = $db->error;
			}
			else{
				$response = $db->insert_id;
			}
			
			return $response;
		}
		
		public function update($tableName, $data, $condition, $connection, $database = null){
			$response = "";
			$db = $this->select_connection($connection, $database);
			
			$values = $this->generate->sql_update_values($data);
			$updateCondition = $this->generate->sql_update_condition($condition);
			$updateQuery = "update " . $tableName . " set " . $values ." where ". $updateCondition;
			
			$update = $db->query($updateQuery);
			if(!$update){
				$response = $update->error;
			}
			else{
				$response = 1;
			}
			
			return $response;
		}
		
		public function select_result($sql, $connection, $database = null){
			$response = array();
			$db = $this->select_connection($connection, $database);
			$query = $db->query($sql);
			//print_r($query);
			if(isset($db->error) && $db->error != ""){
				$message = $db->error." <br>";
				$message .= $sql;
				echo $message;
				exit;
			}
			$numRows = $query->num_rows;
			if($numRows > 0){
				while($rows = $query->fetch_array()){
					$response[] = $rows;
				}
			}
			return $response;
		}
		
		public function select_row($sql, $connection, $database = null){
			$response = array();
			$db = $this->select_connection($connection, $database);
			$query = $db->query($sql);
			if(isset($db->error) && $db->error != ""){
				$message = $db->error." <br>";
				$message .= $sql;
				echo $message;
				exit;
			}
			$numRows = $query->num_rows;
			if($numRows > 0){
				while($rows = $query->fetch_array()){
					$response = $rows;
				}
			}
			return $response;
		}
	}
?>
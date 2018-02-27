<?php
	
	/**
	* MYSQLI_DB
	*/
	class MQ
	{
		function __construct() {
			$this->mq = mysqli_connect(MQ_HOST, MQ_NAME, MQ_PASSWORD, MQ_DB);
			if ($this->mq->connect_errno) {
				UT::show("Mysqli error: ");
				UT::show($this->mq->connect_error);
				exit();
			}
			$this->mq->set_charset('utf8');
			$this->query("SET NAMES 'utf8';"); 
			$this->query("SET CHARACTER SET 'utf8';"); 
			$this->query("SET SESSION collation_connection = 'utf8_general_ci';"); 
		}
		function query($sql) {
			$result = $this->mq->query($sql);
			if (!$result) {
				UT::show("Mysqli query error");
				exit();
			}
			return $result;
		}
		function get_table($table) {
			$query = "SELECT * FROM $table";
			$result = $this->mq->query($query);
			$results = [];
			if($result){
				while ($row = $result->fetch_object()){
					array_push($results, $row);
				}
				$result->close();
			} else {
				UT::show($db->error);
			}
			return $results;
		}
		function get_json_first_var($table,$var) {
			$query = "SELECT $var FROM $table";
			$result = $this->mq->query($query);
			if (!$result) {
				UT::show($db->error);
			}
			$row = $result->fetch_object()->$var;
			$row = json_decode($row);
			$result->close();
			return $row;
		}
		function update_json_first_var($table,$var,$obj) {
			$json = json_encode($obj, JSON_UNESCAPED_UNICODE);
			$query = "UPDATE $table SET $var='$json'";
			$result = $this->mq->query($query);
			if (!$result) {
				UT::show($db->error);
			}
			return $result;
		}
		function get_json_var($table,$var,$which) {
			$query = "SELECT $var FROM $table ".$which;
			$result = $this->mq->query($query);
			if (!$result) {
				UT::show($db->error);
			}
			$row = $result->fetch_object()->$var;
			$row = json_decode($row);
			$result->close();
			return $row;
		}
		function update_json_var($table,$var,$obj,$which) {
			$json = json_encode($obj, JSON_UNESCAPED_UNICODE);
			$query = "UPDATE $table SET $var='$json' ".$which;
			$result = $this->mq->query($query);
			if (!$result) {
				UT::show($db->error);
			}
			return $result;
		}
	}

?>
<?php
session_start();

class Action
{
	private $db;

	public function __construct()
	{
		include 'db_connect.php';

		$this->db = $conn;
	}
	
	function __destruct()
	{
		$this->db->close();
	}

	function save_reserve(){
		extract($_POST);
		$data = " event_id = '".$event_id."' ";
		$data .= ", name = '".$name."' ";
		$data .= ", email = '".$email."' ";
		$data .= ", phone = '".$phone."' ";
		$data .= ", qty = '".$qty."' ";
	
		$save = $this->db->query("INSERT INTO orders SET ".$data);
		if ($save) {
			return 1;
		} else {
			error_log("Error in save_reserve: " . $this->db->error . " - Query: INSERT INTO orders SET " . $data);
			return 0;
		}		
	}
	
}

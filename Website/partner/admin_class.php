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

	function login()
	{
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM users where email = '" . $username . "' and password = '" . $password . "' ");
		if ($qry->num_rows > 0) {
			foreach ($qry->fetch_array() as $key => $value) {
				if ($key != 'password' && !is_numeric($key))
					$_SESSION['login_' . $key] = $value;
			}
			return 1;
		} else {
			return 2;
		}
	}
	
	function logout()
	{
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:../index.php");
	}
	
	public function save_movie()
	{
		extract($_POST);

		$location = mysqli_real_escape_string($this->db, $location);
		$price = mysqli_real_escape_string($this->db, $price);
		$title = mysqli_real_escape_string($this->db, $title);
		$description = mysqli_real_escape_string($this->db, $description);

		$data = " location = '$location' ";
		$data .= ", price = '$price' ";
		$data .= ", partner_id = '$partner_id' ";
		$data .= ", title = '$title' ";
		$data .= ", description = '$description' ";
		$data .= ", date_showing = '$date_showing' ";
		$data .= ", end_date = '$end_date' ";
		$duration = $duration_hour . '.' . (($duration_min / 60) * 100);
		$data .= ", duration = '$duration' ";

		if ($_FILES['cover']['tmp_name'] != '') {
			$fname = $_FILES['cover']['name'];
			$move = move_uploaded_file($_FILES['cover']['tmp_name'], '../assets/img/' . $fname);
			$data .= ", cover_img = '" . $fname . "' ";
		}

		if (empty($id)) {
			$save = $this->db->prepare("INSERT INTO events SET $data");
		} else {
			$save = $this->db->prepare("UPDATE events SET $data WHERE id = ?");
			$save->bind_param("i", $id);
		}

		if ($save->execute()) {
			return 1;
		} else {
			error_log("Error in save_movie: " . $this->db->error);
			return 0;
		}
	}

	function delete_movie()
	{
		extract($_POST);
		$delete  = $this->db->query("DELETE FROM events where id =" . $id);
		if ($delete)
			return 1;
	}

	function save_reserve()
	{
		extract($_POST);
		$data = " event_id = '".$event_id."' ";
		$data .= ", name = '".$name."' ";
		$data .= ", email = '".$email."' ";
		$data .= ", phone = '".$phone."' ";
		$data .= ", qty = '".$qty."' ";
	
		$save = $this->db->query("INSERT INTO orders SET ".$data);
		if($save) {
			return 1;
		} else {
			error_log("Error in save_reserve: " . $this->db->error);
			return 0;
		}
	}
	
}

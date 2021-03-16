<?php
class Loginlogs {
	private $db;

	public function __construct() {
		$this->db = new Database();
	}

	public function add() {
		$this->db->query("INSERT INTO login_times_logs(user_id) VALUES(:user_id);");
		$this->db->bind(':user_id', $_SESSION['PMP_USER_ID']);
		return ($this->db->execute());
	}
    
}
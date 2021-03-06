<?php
class Loginlog {
	private $db;

	public function __construct() {
		$this->db = new Database();
	}

	function fetchAll($userId) {

		try {
			$this->db->query("SELECT * from login_times_logs where user_id=:user_id ORDER BY date DESC;");
            $this->db->bind("user_id", $userId);
			$row = $this->db->resultSetAssocArray();
			if($this->db->rowCount() > 0)
				return $row;
			return false;
		} catch (\Throwable $th) {
			return false;
		}

	}

	public function add() {
		$this->db->query("INSERT INTO login_times_logs(user_id) VALUES(:user_id);");
		$this->db->bind(':user_id', $_SESSION['PMP_USER_ID']);
		return ($this->db->execute());
	}

}
<?php
class Membership {
	private $db;

	public function __construct() {
		$this->db = new Database();
	}

	function fetchAll() {

		try {
			$this->db->query("SELECT * FROM memberships;");
			$row = $this->db->resultSetAssocArray();
			if($this->db->rowCount() > 0)
				return $row;
			return false;
		} catch (\Throwable $th) {
			return false;
		}

	}

}
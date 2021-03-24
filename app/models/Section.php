<?php
class Section {
	private $db;

	public function __construct() {
		$this->db = new Database();
	}

	function fetchAll() {

		try {
			$event = "Event Name";
$data = "99.99";
$coreid = "ABCD";
$published_at = "987654321";

$sql = "INSERT INTO temperature (name, data, published_at, coreid) VALUES ('".$event."', '".$data."', '".$published_at."', '".$coreid."')";

			$this->db->query("SELECT * FROM sections;");
			$row = $this->db->resultSetAssocArray();
			if($this->db->rowCount() > 0)
				return $row;
			return false;
		} catch (\Throwable $th) {
			return false;
		}

	}

	function isSectionAvailable($id) {

		try {
			$this->db->query("SELECT * FROM sections where section_id=:id;");
			$this->db->bind(":id", $id);
			$row = $this->db->single();
			return ($this->db->rowCount() > 0);
		} catch (\Throwable $th) {
			diee($th);
			return false;
		}

	}
    
}
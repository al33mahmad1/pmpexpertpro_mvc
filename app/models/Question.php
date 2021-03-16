<?php
class Question {
	private $db;

	public function __construct() {
		$this->db = new Database();
	}

	function fetchAll() {

		try {
			$this->db->query("SELECT q.*, a.assessment_name, s.section_name, ac.assessment_category_name from questions q, assessments a, sections s, assessment_category ac where q.assessment_id=a.assessment_id AND q.section_id=s.section_id AND a.assessment_category_id=ac.assessment_category_id ORDER BY q.assessment_id ASC;");
			$row = $this->db->resultSetAssocArray();
			if($this->db->rowCount() > 0)
				return $row;
			return false;
		} catch (\Throwable $th) {
			return false;
		}

	}

}
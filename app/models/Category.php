<?php
class Category {
	private $db;

	public function __construct() {
		$this->db = new Database();
	}

	public function totalQuestionInAgileCategory() {

		try {
			$this->db->query("SELECT a.*, ac.assessment_category_name, count(ac.assessment_category_id) totalCount FROM assessments a, assessment_category ac, questions q WHERE a.assessment_category_id=ac.assessment_category_id AND q.assessment_id=a.assessment_id AND ac.assessment_category_name='agile' GROUP BY ac.assessment_category_id;");
			$row = $this->db->single();
			if($this->db->rowCount() > 0)
				return $row->totalCount;
			return 0;
		} catch (\Throwable $th) {
			return 0;
		}

	}

    public function totalQuestionInScrumCategory() {

		try {
			$this->db->query("SELECT a.*, ac.assessment_category_name, count(ac.assessment_category_id) totalCount FROM assessments a, assessment_category ac, questions q WHERE a.assessment_category_id=ac.assessment_category_id AND q.assessment_id=a.assessment_id AND ac.assessment_category_name='scrum' GROUP BY ac.assessment_category_id;");
			$row = $this->db->single();
			if($this->db->rowCount() > 0)
				return $row->totalCount;
			return 0;
		} catch (\Throwable $th) {
			return 0;
		}

	}

}
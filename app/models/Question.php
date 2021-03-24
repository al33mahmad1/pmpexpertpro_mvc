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

	function fetch($qId) {

		try {
			$this->db->query("SELECT q.*, a.assessment_name, s.section_name, ac.assessment_category_name from questions q, assessments a, sections s, assessment_category ac where q.question_id=:question_id AND q.assessment_id=a.assessment_id AND q.section_id=s.section_id AND a.assessment_category_id=ac.assessment_category_id ORDER BY q.assessment_id ASC;");
			$this->db->bind(':question_id', $qId);
			$row = $this->db->singleAssoc();
			if($this->db->rowCount() > 0)
				return $row;
			return false;
		} catch (\Throwable $th) {
			return false;
		}

	}

	public function add($data) {
		try {
			$this->db->query("INSERT INTO questions(assessment_id, section_id, question, reasoning, a, b, c, d, correct_option) VALUES(:assessment_id, :section_id, :question, :reasoning, :a, :b, :c, :d, :correct_option);");
			$this->db->bind(':assessment_id', $data['assessmentId']);
			$this->db->bind(':section_id', $data['sectionId']);
			$this->db->bind(':question', $data['questionStatement']);
			$this->db->bind(':reasoning', $data['questionReasoning']);
			$this->db->bind(':a', $data['optionA']);
			$this->db->bind(':b', $data['optionB']);
			$this->db->bind(':c', $data['optionC']);
			$this->db->bind(':d', $data['optionD']);
			$this->db->bind(':correct_option', $data['correctOption']);
			if($this->db->execute())
				return true;
			return false;
		} catch (\Throwable $th) {
			diee($th);
			return false;
		}
	}

	

	public function edit($data) {
		try {
			$this->db->query("UPDATE `questions` SET `assessment_id`=:assessment_id,`section_id`=:section_id,`question`=:question,`reasoning`=:reasoning,`a`=:a,`b`=:b,`c`=:c,`d`=:d,`correct_option`=:correct_option WHERE question_id=:question_id;");
			$this->db->bind(':question_id', $data['questionId']);
			$this->db->bind(':assessment_id', $data['assessmentId']);
			$this->db->bind(':section_id', $data['sectionId']);
			$this->db->bind(':question', $data['questionStatement']);
			$this->db->bind(':reasoning', $data['questionReasoning']);
			$this->db->bind(':a', $data['optionA']);
			$this->db->bind(':b', $data['optionB']);
			$this->db->bind(':c', $data['optionC']);
			$this->db->bind(':d', $data['optionD']);
			$this->db->bind(':correct_option', $data['correctOption']);
			if($this->db->execute())
				return true;
			return false;
		} catch (\Throwable $th) {
			return false;
		}
	}

	function isAvailableByID($id) {
		try {

			$this->db->query("SELECT question_id FROM questions WHERE question_id=:id;");
			$this->db->bind(':id', $id);
			$row = $this->db->singleAssoc();
			return ($this->db->rowCount() > 0);
		} catch (\Throwable $th) {
			return false;
		}
	}

	public function deleteQuestion($id) {
		try {
			$this->db->query("DELETE FROM questions WHERE question_id=:id;");
			$this->db->bind(':id', $id);
			return ($this->db->execute());
		} catch (\Throwable $th) {
			return false;
		}
	} 

}
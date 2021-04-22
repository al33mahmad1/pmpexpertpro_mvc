<?php
class Assessment {
	private $db;

	public function __construct() {
		$this->db = new Database();
	}

	function fetchAll() {

		try {
			$this->db->query("SELECT assessments.*, assessments_taken.assessment_t_id FROM assessments LEFT OUTER JOIN assessments_taken ON assessments.assessment_id=assessments_taken.assessment_id;");
			$row = $this->db->resultSetAssocArray();
			if($this->db->rowCount() > 0)
				return $row;
			return false;
		} catch (\Throwable $th) {
			return false;
		}

	}

	function isAssessmentAvailable($id) {

		try {
			$this->db->query("SELECT * FROM assessments where assessment_id=:id;");
			$this->db->bind(":id", $id);
			$row = $this->db->single();
			return ($this->db->rowCount() > 0);
		} catch (\Throwable $th) {
			return false;
		}

	}

	function getTakenAssessment($assessmentId) {

		try {
			$this->db->query("SELECT att.*, a.assessment_name FROM assessments_taken att, assessments a where att.assessment_id=:assessmentI_d AND att.user_id=:user_id AND a.assessment_id=att.assessment_id ORDER BY date_done DESC LIMIT 1;");
			$this->db->bind(":assessmentI_d", $assessmentId);
			$this->db->bind(":user_id", $_SESSION['PMP_USER_ID']);
			$row = $this->db->singleAssoc();
			if($this->db->rowCount() > 0)
				return $row;
			return false;
		} catch (\Throwable $th) {
			return false;
		}

	}

	function getAssessmentsTakenHistory() {

		try {
			$this->db->query("SELECT ac.assessment_category_name, att.*, a.assessment_name FROM assessments_taken att, assessments a, assessment_category ac where att.user_id=:user_id AND a.assessment_id=att.assessment_id AND ac.assessment_category_id=a.assessment_category_id ORDER BY date_done DESC;");
			$this->db->bind(":user_id", $_SESSION['PMP_USER_ID']);
			$row = $this->db->resultSetAssocArray();
			if($this->db->rowCount() > 0)
				return $row;
			return false;
		} catch (\Throwable $th) {
			return false;
		}

	}

	function getAssessmentsTakenHistoryById($userId) {

		try {
			$this->db->query("SELECT att.*, a.assessment_name FROM assessments_taken att, assessments a where att.user_id=:user_id AND a.assessment_id=att.assessment_id ORDER BY date_done DESC;");
			$this->db->bind(":user_id", $userId);
			$row = $this->db->resultSetAssocArray();
			if($this->db->rowCount() > 0)
				return $row;
			return false;
		} catch (\Throwable $th) {
			return false;
		}

	}

	function fetchBasicAssessments() {

		try {
			$this->db->query("SELECT assessments.*, assessments_taken.assessment_t_id, assessments_taken.date_done, assessment_category.assessment_category_name FROM assessments LEFT OUTER JOIN assessments_taken ON assessments.assessment_id=assessments_taken.assessment_id AND assessments_taken.user_id=:user_id INNER JOIN assessment_category ON assessment_category.assessment_category_id=assessments.assessment_category_id AND assessment_category.assessment_category_name='agile' GROUP BY assessments.assessment_id ORDER BY assessments.assessment_id ASC LIMIT 8;");
			$this->db->bind(":user_id", $_SESSION['PMP_USER_ID']);
			$row = $this->db->resultSetAssocArray();
			if($this->db->rowCount() > 0)
				return $row;
			return false;
		} catch (\Throwable $th) {
			return false;
		}

	}

	function fetchBasicAssessmentsIds() {

		try {
			$this->db->query("SELECT assessments.assessment_id FROM assessments INNER JOIN assessment_category ON assessment_category.assessment_category_id=assessments.assessment_category_id AND assessment_category.assessment_category_name='agile' ORDER BY assessments.assessment_id ASC LIMIT 8;");
			$row = $this->db->resultSetAssocArray();
			if($this->db->rowCount() > 0)
				return $row;
			return false;
		} catch (\Throwable $th) {
			return false;
		}

	}

	function fetchStandardAssessments() {

		try {
			$this->db->query("SELECT assessments.*, assessments_taken.assessment_t_id, assessments_taken.date_done, assessment_category.assessment_category_name FROM assessments LEFT OUTER JOIN assessments_taken ON assessments.assessment_id=assessments_taken.assessment_id AND assessments_taken.user_id=:user_id INNER JOIN assessment_category ON assessment_category.assessment_category_id=assessments.assessment_category_id AND assessment_category.assessment_category_name='scrum' GROUP BY assessments.assessment_id ORDER BY assessments.assessment_id ASC;");
			$this->db->bind(":user_id", $_SESSION['PMP_USER_ID']);
			$row = $this->db->resultSetAssocArray();
			if($this->db->rowCount() > 0)
				return $row;
			return false;
		} catch (\Throwable $th) {
			return false;
		}

	}

	function fetchStandardAssessmentsIds() {

		try {
			$this->db->query("SELECT assessments.assessment_id FROM assessments INNER JOIN assessment_category ON assessment_category.assessment_category_id=assessments.assessment_category_id AND assessment_category.assessment_category_name='scrum' ORDER BY assessments.assessment_id ASC;");
			$row = $this->db->resultSetAssocArray();
			if($this->db->rowCount() > 0)
				return $row;
			return false;
		} catch (\Throwable $th) {
			return false;
		}

	}

	function fetchPremiumAssessments() {

		try {
			$this->db->query("SELECT assessments.*, assessments_taken.assessment_t_id, assessments_taken.date_done, assessment_category.assessment_category_name FROM assessments LEFT OUTER JOIN assessments_taken ON assessments.assessment_id=assessments_taken.assessment_id AND assessments_taken.user_id=:user_id INNER JOIN assessment_category ON assessment_category.assessment_category_id=assessments.assessment_category_id AND assessment_category.assessment_category_name='agile' GROUP BY assessments.assessment_id ORDER BY assessments.assessment_id ASC;");
			$this->db->bind(":user_id", $_SESSION['PMP_USER_ID']);
			$row = $this->db->resultSetAssocArray();
			if($this->db->rowCount() > 0)
				return $row;
			return false;
		} catch (\Throwable $th) {
			return false;
		}

	}

	function fetchPremiumAssessmentsIds() {

		try {
			$this->db->query("SELECT assessments.assessment_id FROM assessments INNER JOIN assessment_category ON assessment_category.assessment_category_id=assessments.assessment_category_id AND assessment_category.assessment_category_name='agile' ORDER BY assessments.assessment_id ASC;");
			$row = $this->db->resultSetAssocArray();
			if($this->db->rowCount() > 0)
				return $row;
			return false;
		} catch (\Throwable $th) {
			return false;
		}

	}

	function fetchComprehensiveAssessments() {

		try {
			$this->db->query("SELECT assessments.*, assessments_taken.assessment_t_id, assessments_taken.date_done, assessment_category.assessment_category_name FROM assessments LEFT OUTER JOIN assessments_taken ON assessments.assessment_id=assessments_taken.assessment_id AND assessments_taken.user_id=:user_id INNER JOIN assessment_category ON assessment_category.assessment_category_id=assessments.assessment_category_id GROUP BY assessments.assessment_id ORDER BY assessments.assessment_id ASC;");
			$this->db->bind(":user_id", $_SESSION['PMP_USER_ID']);
			$row = $this->db->resultSetAssocArray();
			if($this->db->rowCount() > 0)
				return $row;
			return false;
		} catch (\Throwable $th) {
			return false;
		}

	}

	function fetchComprehensiveAssessmentsIds() {

		try {
			$this->db->query("SELECT assessments.assessment_id FROM assessments INNER JOIN assessment_category ON assessment_category.assessment_category_id=assessments.assessment_category_id ORDER BY assessments.assessment_id ASC;");
			$row = $this->db->resultSetAssocArray();
			if($this->db->rowCount() > 0)
				return $row;
			return false;
		} catch (\Throwable $th) {
			return false;
		}

	}

	function getAssessmentWithCategoryAndQuestionCount() {

		try {
			$this->db->query("SELECT a.*, ac.assessment_category_name, count(q.question_id) question_count FROM assessments a, assessment_category ac, questions q WHERE a.assessment_category_id=ac.assessment_category_id AND q.assessment_id=a.assessment_id GROUP BY q.assessment_id;");
			$row = $this->db->resultSetAssocArray();
			if($this->db->rowCount() > 0)
				return $row;
			return false;
		} catch (\Throwable $th) {
			return false;
		}

	}

	public function getAssessmentQuestions($assessmentId) {

		try {
			$this->db->query("SELECT q.* from questions q WHERE q.assessment_id=:assessment_id ORDER BY q.question_id ASC;");
			$this->db->bind(":assessment_id", $assessmentId);
			$row = $this->db->resultSetAssocArray();
			if($this->db->rowCount() > 0)
				return $row;
			return false;
		} catch (\Throwable $th) {
			return false;
		}

	}

	public function getAssessmentQuestionsWithSectionNames($assessmentId) {

		try {
			$this->db->query("SELECT q.*,s.section_name from questions q, sections s WHERE q.assessment_id=:assessment_id and s.section_id=q.section_id ORDER BY q.question_id ASC;");
			$this->db->bind(":assessment_id", $assessmentId);
			$row = $this->db->resultSetAssocArray();
			if($this->db->rowCount() > 0)
				return $row;
			return false;
		} catch (\Throwable $th) {
			return false;
		}

	}

	public function getSectionsForAssessment($assessmentId) {

		try {
			$this->db->query("SELECT DISTINCT(s.section_name) from questions q, sections s WHERE q.assessment_id=1 and s.section_id=q.section_id ORDER BY q.question_id ASC;");
			$this->db->bind(":assessment_id", $assessmentId);
			$row = $this->db->resultSetAssocArray();
			if($this->db->rowCount() > 0)
				return $row;
			return false;
		} catch (\Throwable $th) {
			return false;
		}

	}
	

	public function getQuestionAnswersWithIds($assessmentId) {

		try {
			$this->db->query("SELECT q.question_id, q.correct_option from questions q WHERE q.assessment_id=:assessment_id ORDER BY q.question_id ASC;");
			$this->db->bind(":assessment_id", $assessmentId);
			$row = $this->db->resultSetAssocArray();
			if($this->db->rowCount() > 0)
				return $row;
			return false;
		} catch (\Throwable $th) {
			return false;
		}

	}

	public function getAssessmentName($assessmentId) {

		try {
			$this->db->query("SELECT a.assessment_name from assessments a WHERE a.assessment_id=:assessment_id;");
			$this->db->bind(":assessment_id", $assessmentId);
			$row = $this->db->single();
			if($this->db->rowCount() > 0)
				return $row->assessment_name;
			return false;
		} catch (\Throwable $th) {
			return false;
		}

	}

	public function getAssessmentCountInSystem() {

		try {
			$this->db->query("SELECT count(assessment_id) as counts from assessments;");
			$row = $this->db->single();
			if($this->db->rowCount() > 0)
				return $row->counts;
			return 0;
		} catch (\Throwable $th) {
			return 0;
		}

	}

	public function getAssessmentCountPerMembership() {

		try {
			$this->db->query("SELECT count(assessment_id) as counts from assessments;");
			$row = $this->db->single();
			if($this->db->rowCount() > 0)
				return $row->counts;
			return 0;
		} catch (\Throwable $th) {
			return 0;
		}

	}
	
	public function totalAssessmentsInAgileCategory() {

		try {
			$this->db->query("SELECT count(a.assessment_id) assessmentsCount from assessments a, assessment_category ac WHERE a.assessment_category_id = ac.assessment_category_id AND ac.assessment_category_name='agile';");
			$row = $this->db->single();
			if($this->db->rowCount() > 0)
				return $row->assessmentsCount;
			return 0;
		} catch (\Throwable $th) {
			return 0;
		}

	}

	public function totalAssessmentsInScrumCategory() {

		try {
			$this->db->query("SELECT count(a.assessment_id) assessmentsCount from assessments a, assessment_category ac WHERE a.assessment_category_id = ac.assessment_category_id AND ac.assessment_category_name='scrum';");
			$row = $this->db->single();
			if($this->db->rowCount() > 0)
				return $row->assessmentsCount;
			return 0;
		} catch (\Throwable $th) {
			return 0;
		}

	}

	public function getAccomplishedAssessmentsCount() {

		try {
			$this->db->query("SELECT count(DISTINCT(a.assessment_id)) assessmentsCount from assessments_taken a WHERE a.user_id =:id;");
			$this->db->bind(":id", $_SESSION['PMP_USER_ID']);
			$row = $this->db->single();
			if($this->db->rowCount() > 0)
				return $row->assessmentsCount;
			return 0;
		} catch (\Throwable $th) {
			return 0;
		}

	}

	public function add($data) {
		try {
			$this->db->query("INSERT INTO assessments(assessment_category_id, assessment_name) VALUES(:assessment_category_id, :assessment_name);");
			$this->db->bind(':assessment_category_id', $data['assessmentCategoryId']);
			$this->db->bind(':assessment_name', $data['assessmentName']);
			if($this->db->execute())
				return true;
			return false;
		} catch (\Throwable $th) {
			return false;
		}
	}

	public function addAssessment($assessmentId, $totalQuestions, $right, $json) {
		try {
			$this->db->query("INSERT INTO assessments_taken(user_id, assessment_id, totalQuestions, score, selected_answers) VALUES(:user_id, :assessment_id, :totalQuestions, :score, :selected_answers);");
			$this->db->bind(':user_id', $_SESSION['PMP_USER_ID']);
			$this->db->bind(':assessment_id', $assessmentId);
			$this->db->bind(':totalQuestions', $totalQuestions);
			$this->db->bind(':score', $right);
			$this->db->bind(':selected_answers', json_encode($json));
			if($this->db->execute())
				return true;
			return false;
		} catch (\Throwable $th) {
			return false;
		}
	}
	
	// function findUserByEmail($email) {

	// 	try {
	// 		$this->db->query("SELECT * FROM user WHERE email=:email;");
	// 		$this->db->bind(':email', $email);
	// 		$row = $this->db->single();
	// 		if($this->db->rowCount() > 0)
	// 			return true;
	// 		return false;
	// 	} catch (\Throwable $th) {
	// 		return false;
	// 	}

	// }

	

	// public function getResIdByUserEmail($email) {
	// 	try {
	// 		$this->db->query("SELECT user_res_id from user WHERE email=:email;");
	// 		$this->db->bind(":email", $email);
	// 		$row = $this->db->singleAssoc();
			
	// 		if($this->db->rowCount() > 0)
	// 			return $row;
	// 		return false;
	// 	} catch (\Throwable $th) {
	// 		die($th->getMessage());
	// 		return false;
	// 	}
	// }

	// function isAvailableByEmailAndId($resId, $userEmail) {

	// 	try {
	// 		$this->db->query("SELECT id FROM user WHERE user_res_id=:res_id AND email=:email;");
	// 		$this->db->bind(':res_id', $resId);
	// 		$this->db->bind(':email', $userEmail);
	// 		$row = $this->db->singleAssoc();
	// 		return ($this->db->rowCount() > 0);
	// 	} catch (\Throwable $th) {
	// 		return false;
	// 	}

	// }

	// function isAuthorizedWorker($resId, $resEmail) {

	// 	try {
	// 		$this->db->query("SELECT id FROM user WHERE user_res_id=:user_res_id AND email=:email;");
	// 		$this->db->bind(':user_res_id', $resId);
	// 		$this->db->bind(':email', $resEmail);
	// 		$row = $this->db->singleAssoc();
	// 		return ($this->db->rowCount() > 0);
	// 	} catch (\Throwable $th) {
	// 		return false;
	// 	}

	// }
	
	// public function add($data) {
	// 	$this->db->query("INSERT INTO user(name, email, password,roleType) VALUES(:name, :email, :password, :roleType);");
	// 	// Bind Values
	// 	$this->db->bind(':name', $data['firstName'].' '.$data['lastName']);
	// 	$this->db->bind(':email', $data['userName']);
	// 	$this->db->bind(':password', $data['password']);
	// 	$this->db->bind(':roleType', $data['role']);

	// 	if($this->db->execute()) {
	// 		return true;
	// 	} else {
	// 		return false;
	// 	}
	// }

	// <----------->

	// public function register($data) {
	// 	$this->db->query("INSERT INTO users(username, email, password) VALUES(:name, :email, :password);");
	// 	// Bind Values
	// 	$this->db->bind(':name', $data['name']);
	// 	$this->db->bind(':email', $data['email']);
    //     $this->db->bind(':password', $data['password']);

	// 	if($this->db->execute()) {
	// 		return true;
	// 	} else {
	// 		return false;
	// 	}
	// }

	// Login User
	 
	// public function isPasswordMatched($password) {
	// 	$this->db->query("SELECT * FROM user;");
	// 	if($row = $this->db->single()) {
	// 		$hashedPassword = $row->password;
	// 		if(password_verify($password, $hashedPassword)) {
	// 			return true;
	// 		} else{
	// 			return false;
	// 		}
	// 	}else{
	// 		return false;
	// 	}
		
	// } 

	// function findUserByUserNameAndId($username, $id) {
	// 	$this->db->query("SELECT * FROM user WHERE user_name=:username AND id<>:id;");

	// 	$this->db->bind(':id', $id);
	// 	$this->db->bind(':username', $username);

	// 	$row = $this->db->single();
	// 	if($this->db->rowCount() > 0) {
	// 		return true;
	// 	}else{
	// 		return false;
	// 	}
	// }

	
	// public function changeUsername($userName) {
		
	// 	$this->db->query("UPDATE `user` SET `user_name`=:user_name WHERE id=:id;");
		
	// 	$this->db->bind(':user_name', $userName);
	// 	$this->db->bind(':id', 1);
		
	// 	if($this->db->execute()) {
	// 		return true;
	// 	} else {
	// 		return false;
	// 	}

	// }

	// public function edit($data, $id) {
		
	// 	$this->db->query("UPDATE `user` SET `name`=:name, user_name=:userName, `role_type`=:role, `current_status`=:status WHERE id=:id;");
		
	// 	$this->db->bind(':id', $id);
	// 	$this->db->bind(':name', $data['firstName'].' '.$data['lastName']);
	// 	$this->db->bind(':userName', $data['userName']);
	// 	$this->db->bind(':status', $data['status']);
	// 	$this->db->bind(':role', $data['roleType']);
		
	// 	if($this->db->execute()) {
	// 		return true;
	// 	} else {
	// 		return false;
	// 	}

	// }

	// public function pwdChange($id, $pwd) {
		
	// 	$this->db->query("UPDATE `user` SET `password`=:pwd WHERE id=:id;");
		
	// 	$this->db->bind(':id', $id);
	// 	$this->db->bind(':pwd', $pwd);
		
	// 	if($this->db->execute()) {
	// 		return true;
	// 	} else {
	// 		return false;
	// 	}

	// }

	// public function delete($id) {
	// 	$this->db->query("DELETE FROM `user` WHERE id=:id;");
		
	// 	$this->db->bind(':id', $id);
		
	// 	if($this->db->execute()) {
	// 		return true;
	// 	} else{
	// 		return false;
	// 	}
	// } 

}
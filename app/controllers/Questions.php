<?php
	class Questions extends Controller {
		public function __construct() {
			$this->questionsModel = $this->model('Question');
			$this->assessmentModel = $this->model('Assessment');
			$this->categoryModel = $this->model('Category');
			$this->sectionModel = $this->model('Section');
		}
		public function index() {

			redirect("questions/list");
			
		}

        public function list() {

			if(isLoggedIn() && isAdmin()) {
				$data = [
					'title' => SITENAME . " | Questions",
					'questions' => false,
                    'collapsedSideBar' => true
				];

                if($temp = $this->questionsModel->fetchAll())
                    $data['questions'] = $temp;

                    // die(var_dump($data));
				$this->view("questions/list", $data);
			} else
				redirect("pages/home");
			
		}

		public function add() {
			if(isLoggedIn() && isAdmin()) {
				$data = [
					'title' => SITENAME . " | Questions",
					'assessments' => false,
					'sections' => false,
				];

                if($temp = $this->assessmentModel->fetchAll())
                    $data['assessments'] = $temp;

				if($temp = $this->sectionModel->fetchAll())
                    $data['sections'] = $temp;
				// diee($data);
				$this->view("questions/add", $data);
			} else
				redirect("questions/add	");
		}

		
		public function addQuestion() {

			if($_SERVER['REQUEST_METHOD'] == 'POST' ) {

				if(!isLoggedIn())
					echo json_encode(["status"=> "logout"]);
				else if(!isAdmin())
					echo json_encode(["status"=> "notAdmin"]);
				else {
					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

					$data = [
						'assessmentId' => trim($_POST['assessment_id']),
						'sectionId' => trim($_POST['section_id']),
						'questionStatement' => trim($_POST['question_statement']),
						'optionA' => trim($_POST['option_a']),
						'optionB' => trim($_POST['option_b']),
						'optionC' => trim($_POST['option_c']),
						'optionD' => trim($_POST['option_d']),
						'correctOption' => trim($_POST['correct_option']),
						'questionReasoning' => trim($_POST['question_reasoning']),
						'status' => "success",

						'assessmentIdErr' => '',
						'sectionIdErr' => '',
						'questionStatementErr' => '',
						'optionAErr' => '',
						'optionBErr' => '',
						'optionCErr' => '',
						'optionDErr' => '',
						'correctOptionErr' => '',
						'questionReasoningErr' => ''
					];


					if(empty($data['assessmentId']) || !$this->assessmentModel->isAssessmentAvailable($data['assessmentId'])) {
						$data['status'] = "error";
						$data['assessmentIdErr'] = "Valid exam selected required!";
					}

					if(empty($data['sectionId']) || !$this->sectionModel->isSectionAvailable($data['sectionId'])) {
						$data['status'] = "error";
						$data['sectionIdErr'] = "Invalid Section selected!";
					}

					if(empty($data['questionStatement'])) {
						$data['status'] = "error";
						$data['questionStatementErr'] = "Invalid question statement!";
					}

					if(empty($data['optionA'])) {
						$data['status'] = "error";
						$data['optionAErr'] = "Invalid Option A value!";
					}

					if(empty($data['optionB'])) {
						$data['status'] = "error";
						$data['optionBErr'] = "Invalid Option B value!";
					}

					if(empty($data['optionC'])) {
						$data['status'] = "error";
						$data['optionCErr'] = "Invalid Option C value!";
					}

					if(empty($data['optionD'])) {
						$data['status'] = "error";
						$data['optionDErr'] = "Invalid Option D value!";
					}

					if(empty($data['correctOption']) || !in_array($data['correctOption'], ["a", "b", "c", "d"])) {
						$data['status'] = "error";
						$data['correctOptionErr'] = "Invalid Correct Option value!";
					}

					if(empty($data['questionReasoning'])) {
						$data['status'] = "error";
						$data['questionReasoningErr'] = "Reasoning required for question!";
					}

					// diee($data);
					if($data['status'] != "error") {

						if(!$this->questionsModel->add($data))
							$data['status'] = "db_error";

					}
					echo json_encode($data);
				}
				

			} else
				echo json_encode(["status"=> "404"]);
		}

		public function edit($questionId = null) {

			if($questionId == null)	
				redirect("questions/list");
			if(!is_numeric($questionId)) {
				flash('error', "Invalid question selected!");
				redirect("questions/list");
			}
			if(isLoggedIn() && isAdmin()) {
				$data = [
					'title' => SITENAME . " | Edit Questions",
					'questionId' => $questionId,
					'question' => false,
					'assessments' => false,
					'sections' => false,
				];

				if($temp = $this->assessmentModel->fetchAll())
					$data['assessments'] = $temp;

				if($temp = $this->sectionModel->fetchAll())
					$data['sections'] = $temp;

                if($temp = $this->questionsModel->fetch($data['questionId'])) {
                    $data['question'] = $temp;
					// diee($data);
					$this->view("questions/edit", $data);
				} else {
					flash('error', 'Please select a valid question Id!', 'alert alert-warning');
					redirect("questions/list");
				}

			} else
				redirect("questions/add	");
		}

		public function editQuestion() {

			if($_SERVER['REQUEST_METHOD'] == 'POST' ) {

				if(!isLoggedIn())
					echo json_encode(["status"=> "logout"]);
				else if(!isAdmin())
					echo json_encode(["status"=> "notAdmin"]);
				else {
					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

					$data = [
						'questionId' => trim($_POST['question_id']),
						'assessmentId' => trim($_POST['assessment_id']),
						'sectionId' => trim($_POST['section_id']),
						'questionStatement' => trim($_POST['question_statement']),
						'optionA' => trim($_POST['option_a']),
						'optionB' => trim($_POST['option_b']),
						'optionC' => trim($_POST['option_c']),
						'optionD' => trim($_POST['option_d']),
						'correctOption' => trim($_POST['correct_option']),
						'questionReasoning' => trim($_POST['question_reasoning']),
						'status' => "success",

						'assessmentIdErr' => '',
						'sectionIdErr' => '',
						'questionStatementErr' => '',
						'optionAErr' => '',
						'optionBErr' => '',
						'optionCErr' => '',
						'optionDErr' => '',
						'correctOptionErr' => '',
						'questionReasoningErr' => ''
					];


					if(!($temp = $this->questionsModel->fetch($data['questionId']))) {
						flash('error', 'Please select a valid question Id!', 'alert alert-warning');
						echo json_encode(["status"=> "invalidQuestionId"]);
						exit;
					}

					if(empty($data['assessmentId']) || !$this->assessmentModel->isAssessmentAvailable($data['assessmentId'])) {
						$data['status'] = "error";
						$data['assessmentIdErr'] = "Valid exam selected required!";
					}

					if(empty($data['sectionId']) || !$this->sectionModel->isSectionAvailable($data['sectionId'])) {
						$data['status'] = "error";
						$data['sectionIdErr'] = "Invalid Section selected!";
					}

					if(empty($data['questionStatement'])) {
						$data['status'] = "error";
						$data['questionStatementErr'] = "Invalid question statement!";
					}

					if(empty($data['optionA'])) {
						$data['status'] = "error";
						$data['optionAErr'] = "Invalid Option A value!";
					}

					if(empty($data['optionB'])) {
						$data['status'] = "error";
						$data['optionBErr'] = "Invalid Option B value!";
					}

					if(empty($data['optionC'])) {
						$data['status'] = "error";
						$data['optionCErr'] = "Invalid Option C value!";
					}

					if(empty($data['optionD'])) {
						$data['status'] = "error";
						$data['optionDErr'] = "Invalid Option D value!";
					}

					if(empty($data['correctOption']) || !in_array($data['correctOption'], ["a", "b", "c", "d"])) {
						$data['status'] = "error";
						$data['correctOptionErr'] = "Invalid Correct Option value!";
					}

					if(empty($data['questionReasoning'])) {
						$data['status'] = "error";
						$data['questionReasoningErr'] = "Reasoning required for question!";
					}

					if($data['status'] != "error") {

						if(!$this->questionsModel->edit($data))
							$data['status'] = "db_error";
						else
							flash('error', 'Question updated successfully!', 'alert alert-success');

					}
					echo json_encode($data);
				}
				

			} else
				echo json_encode(["status"=> "404"]);
		}

		public function delete() {
			if($_SERVER['REQUEST_METHOD'] == 'POST' ) {

				if(!isLoggedIn())
					echo json_encode(["status"=> "logout"]);
				else if(!isAdmin())
					echo json_encode(["status"=> "notAdmin"]);
				else {

					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
					$data = [
						'questionId' => $_POST['questionId'],
						"status"=> "success"
					];

					if(!$this->questionsModel->isAvailableByID($data['questionId']))
						$data["status"] = "invalidQuestionId";
					else {
						if(!$this->questionsModel->deleteQuestion($data['questionId']))
							$data["status"] = "db_error";
					}
					
					echo json_encode($data);
				}
			}  else
				echo json_encode(["status"=> "404"]);
		}

	}
<?php
	class Assessments extends Controller{
		public function __construct() {
			$this->assessmentModel = $this->model('Assessment');
			$this->categoryModel = $this->model('Category');
		}
		public function index() {
			redirect("assessments/list");
		}

        public function list() {

			if(!isLoggedIn())
				redirect("users/login");
			
			$data = [
				'title' => SITENAME . " | Assessments",
				'assessments' => false
			];

			switch($_SESSION['PMP_USER_MEMBERSHIP']) {
				case BASIC:
					if($temp = $this->assessmentModel->fetchBasicAssessments())
						$data['assessments'] = $temp;
					break;
				case STANDARD:
					if($temp = $this->assessmentModel->fetchStandardAssessments())
						$data['assessments'] = $temp;
					break;
				case PREMIUM:
					if($temp = $this->assessmentModel->fetchPremiumAssessments())
						$data['assessments'] = $temp;
					break;
				case COMPREHENSIVE:
					if($temp = $this->assessmentModel->fetchComprehensiveAssessments())
						$data['assessments'] = $temp;
					break;
				default:
					redirect("pages/home");
					break;
			}

			$this->view("assessments/list", $data);
			
		}

		public function take($assessmentId) {

			if(!isLoggedIn())
				redirect("users/login");
			
			if(isExamStarted() && $assessmentId != $_SESSION['PMP_EXAM_STARTED_ID']) {
				flash('error', 'You can\'t access other exams unless you finish this exam!', 'alert alert-warning');
				redirect("assessments/take/".$_SESSION['PMP_EXAM_STARTED_ID']);
			}

			if(!is_numeric($assessmentId)) {
				flash('error', "Invalid exam selected!");
				redirect("assessments/list");
			}
			
			$data = [
				'title' => SITENAME . " | ",
				'assessmentId' => $assessmentId,
				'assessmentName' => "",
				'assessments' => false
			];
			$ids = [];

			// Check if have access to this assessment
			switch($_SESSION['PMP_USER_MEMBERSHIP']) {
				case BASIC:
					if($temp = $this->assessmentModel->fetchBasicAssessmentsIds())
						$ids = $temp;
					break;
				case STANDARD:
					if($temp = $this->assessmentModel->fetchStandardAssessmentsIds())
						$ids = $temp;
					break;
				case PREMIUM:
					if($temp = $this->assessmentModel->fetchPremiumAssessmentsIds())
						$ids = $temp;
					break;
				case COMPREHENSIVE:
					if($temp = $this->assessmentModel->fetchComprehensiveAssessmentsIds())
						$ids = $temp;
					break;
				default:
					redirect("pages/home");
					break;
			}

			if(!containsId($assessmentId, $ids)) {
				flash('error', "Sorry, you not have access to this exam!", "alert alert-danger");
				redirect("assessments/list");
			}

			if($temp = $this->assessmentModel->getAssessmentQuestions($data['assessmentId'])) {
				$data['assessment'] = $temp;
				$data['assessmentName'] = $this->assessmentModel->getAssessmentName($data['assessmentId']);
				$data['title'] .= $data['assessmentName'];
				startExam($data['assessmentId']);
			} else {
				flash('error', "Invalid exam selected!");
				redirect("assessments/list");
			}

			$this->view("assessments/take", $data);
			
		}

		public function add() {

			if($_SERVER['REQUEST_METHOD'] == 'POST' ) {

				if(!isLoggedIn())
					echo json_encode(["status"=> "logout"]);
				else if(!isAdmin())
					echo json_encode(["status"=> "notAdmin"]);
				else {
					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

					$data = [
						'assessmentName' => trim($_POST['assessmentName']),
						'assessmentCategoryId' => trim($_POST['assessmentCategory']),
						'assessmentNameErr' => '',
						'assessmentCategoryErr' => '',
						'status' => "success"
					];


					if(empty($data['assessmentName'])) {
						$data['status'] = "error";
						$data['assessmentNameErr'] = "Valid exam name required!";
					}

					if(empty($data['assessmentCategoryId'])) {
						$data['status'] = "error";
						$data['assessmentCategoryErr'] = "Invalid exam Category selected!";
					}
					if(!$this->categoryModel->isCategoryAvailable($data['assessmentCategoryId'])) {
						$data['status'] = "error";
						$data["assessmentCategoryErr"] = "Invalid Category Selected!";
					}

					if($data['status'] != "error") {

						if(!$this->assessmentModel->add($data))
							$data['status'] = "db_error";

					}
					echo json_encode($data);
				}
				

			} else
				echo json_encode(["status"=> "404"]);
		}

		function getChatData() {
			if($_SERVER['REQUEST_METHOD'] == 'POST' ) {
				if(!isLoggedIn())
					echo json_encode(["status"=> "logout"]);
				else {
					$data = [
						'assessmentId' => $_POST['hiddenAssessmentId'],
						'questions' => false,
						'result' => false,
						'sections' => false,
						'status' => "success"
					];
					
					if($temp = $this->assessmentModel->getSectionsForAssessment($data['assessmentId'])) {
						$data['sections'] = $temp;
					} else {
						flash('error', "Something unexpected happened, please try again after refresh!", "alert alert-danger");
						echo json_encode(["status"=> "error"]);
					}

					$sections = [];
					$right = [];
					foreach ($data['sections'] as $key => $value) {
						$sections += [$value['section_name'] => 0];
						$right += [$value['section_name'] => 0];
					}
					
					if($temp = $this->assessmentModel->getTakenAssessment($data['assessmentId'])) {
						$data['result'] = $temp;
						$data['result']['selected_answers'] = json_decode($data['result']['selected_answers'], true);
					} else {
						flash('error', "Something unexpected happened, please try again after refresh!", "alert alert-danger");
						echo json_encode(["status"=> "error"]);
					}

					if($q = $this->assessmentModel->getAssessmentQuestionsWithSectionNames($data['assessmentId'])) {
						$data['questions'] = $q;
						foreach ($data['questions'] as $key => $value) {
							if(isset($sections[$value['section_name']])) {
								$sections[$value['section_name']]++;
							}
							if(isset($data['result']['selected_answers'][$value['question_id']]) && $data['result']['selected_answers'][$value['question_id']] == $value['correct_option']) {
								$right[$value['section_name']]++;
							}
						}
						
						foreach ($sections as $key => $value) {
							if($sections[$key] > 0)	
								$sections[$key] = (100 / $sections[$key] ) * $right[$key] ;
							else
								$sections[$key] = 0;
						}
						echo json_encode(["status"=> "success", "data" => $sections]);
					} else {
						flash('error', "Something unexpected happened, please try again after refresh!", "alert alert-danger");
						echo json_encode(["status"=> "error"]);
					}

				}
				
			}  else {
				echo json_encode(["status"=> "404"]);
			}
		}

		public function results($assessmentId = null) {

			if(!isLoggedIn())
				redirect("users/logout");
			else if($assessmentId == null ) { 
				flash("error", "Please select valid exam!", "alert alert-danger");
				redirect("assessments/list");
			} else {

				$data = [
					'title' => SITENAME . " | Report",
					'assessmentId' => $assessmentId,
					'questions' => false,
					'reportData' => false,
					'total' => 0,
					'right' => 0
				];

				$ids = [];
				// Check if have access to this assessment
				switch($_SESSION['PMP_USER_MEMBERSHIP']) {
					case BASIC:
						if($temp = $this->assessmentModel->fetchBasicAssessmentsIds())
							$ids = $temp;
						break;
					case STANDARD:
						if($temp = $this->assessmentModel->fetchStandardAssessmentsIds())
							$ids = $temp;
						break;
					case PREMIUM:
						if($temp = $this->assessmentModel->fetchPremiumAssessmentsIds())
							$ids = $temp;
						break;
					case COMPREHENSIVE:
						if($temp = $this->assessmentModel->fetchComprehensiveAssessmentsIds())
							$ids = $temp;
						break;
					default:
						redirect("pages/home");
						break;
				}
	
				if(!containsId($data['assessmentId'], $ids)) {
					flash('error', "Sorry, you are not allowed to access this exam results!", "alert alert-danger");
					redirect("assessments/list");
				}

				if($temp = $this->assessmentModel->getTakenAssessment($data['assessmentId'])) {
					$data['reportData'] = $temp;
					$data['reportData']['selected_answers'] = json_decode($data['reportData']['selected_answers'], true);

					if($q = $this->assessmentModel->getAssessmentQuestions($data['assessmentId'])) {
						$data['questions'] = $q;
						// diee($data);
						$this->view("assessments/report", $data);
					} else {
						flash('error', "Something unexpected happened, please try again after refresh!", "alert alert-danger");
						redirect("assessments/list");
					}

				} else {
					flash('error', "You have not yet taken this exam!", "alert alert-warning");
					redirect("assessments/list");
				}
			
			}
		}

		public function storeResults() {

			if($_SERVER['REQUEST_METHOD'] == 'POST' ) {
				if(!isLoggedIn())
					echo json_encode(["status"=> "logout"]);
				else {

					$data = [
						'assessmentId' => $_POST['assessmentId'],
						'totalQuestions' => $_POST['totalQuestions'],
						'questions' => $_POST['questions'],
						'status' => "success",
						'wrong' => 0,
						'right' => 0,
						'json' => [] 
					];

					$ids = [];
					switch($_SESSION['PMP_USER_MEMBERSHIP']) {
						case BASIC:
							if($temp = $this->assessmentModel->fetchBasicAssessmentsIds())
								$ids = $temp;
							break;
						case STANDARD:
							if($temp = $this->assessmentModel->fetchStandardAssessmentsIds())
								$ids = $temp;
							break;
						case PREMIUM:
							if($temp = $this->assessmentModel->fetchPremiumAssessmentsIds())
								$ids = $temp;
							break;
						case COMPREHENSIVE:
							if($temp = $this->assessmentModel->fetchComprehensiveAssessmentsIds())
								$ids = $temp;
							break;
						default:
							echo json_encode(["status"=> "noMembership"]);
							exit;
							break;
					}
		
					if(!containsId($data['assessmentId'], $ids)) {
						flash('error', "Sorry, you are not allowed to access this exam!", "alert alert-danger");
						echo json_encode(["status"=> "notHaveAccessToThisAssessment"]);
						exit;
					}

					foreach ($data['questions'] as $key => $question) {
						list($string, $qId) = explode('_', $question['id'], 2);
						$data['json'] += [$qId => $question['answer']];
					}

					if($temp = $this->assessmentModel->getQuestionAnswersWithIds($data['assessmentId'])) {
						foreach ($temp as $key => $value) {
							if(isset($data['json'][$value['question_id']]) && $value['correct_option'] == $data['json'][$value['question_id']])
								$data['right']++;
							else
								$data['wrong']++;
						}

						if($this->assessmentModel->addAssessment($data['assessmentId'], $data['totalQuestions'], $data['right'], $data['json'])) {
							endExam();
							$data['status'] = "success";
						} else {
							flash('error', "Something unexpected happened, please try again after refresh!", "alert alert-danger");
							$data['status'] = "somethingUnexpectedHappened";
						}
					} else {
						flash('error', "Something unexpected happened, please try again after refresh!", "alert alert-danger");
						$data['status'] = "somethingUnexpectedHappened";
					}
				
					echo json_encode(["status" => $data['status'], "assessmentId" => $data['assessmentId']]);

				}
			} else {
				echo json_encode(["status"=> "404"]);
			}
		}

		public function getAssessmentCategories() {
			if($_SERVER['REQUEST_METHOD'] == 'POST' ) {

				if(!isLoggedIn())
					echo json_encode(["status"=> "logout"]);
				else if(!isAdmin())
					echo json_encode(["status"=> "notAdmin"]);
				else {

					$data = [
						'assessmentCategories' => false,
						'status' => "success"
					];

					if($temp = $this->assessmentModel->getAssessmentCategories($data))
						$data["assessmentCategories"] = $temp;
				
					echo json_encode($data);
				}
			}  else {
				echo json_encode(["status"=> "404"]);
			}
		}
	}
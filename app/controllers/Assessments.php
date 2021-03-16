<?php
	class Assessments extends Controller{
		public function __construct() {
			$this->assessmentModel = $this->model('Assessment');
		}
		public function index() {
			redirect("assessments/list");
		}

        public function list() {

			if(isLoggedIn()) {
				$data = [
					'title' => SITENAME . " | Assessments",
					'assessments' => false
				];
				if($temp = $this->assessmentModel->fetchBasicAssessments())
							$data['assessments'] = $temp;
				// switch($_SESSION['PMP_USER_MEMBERSHIP']) {
				// 	case BASIC:
				// 		if($temp = $this->assessmentModel->fetchBasicAssessments())
				// 			$data['assessments'] = $temp;
				// 		break;
				// 	case STANDARD:
				// 		if($temp = $this->assessmentModel->fetchStandardAssessments())
				// 			$data['assessments'] = $temp;
				// 		break;
				// 	case PREMIUM:
				// 		$dataUser['yourAssessments'] = $this->assessmentModal->totalAssessmentsInScrumCategory();
				// 		break;
				// 	case COMPREHENSIVE:
				// 		$dataUser['yourAssessments'] = $this->assessmentModal->getAssessmentCountInSystem();
				// 		break;
				// 	default:
				// 	redirect("pages/home");
				// 		break;
				// }

				// diee($data);

				$this->view("assessments/list", $data);
			} else
				redirect("users/login");
			
		}

		public function take($assessmentId) {

			if(!isLoggedIn())
				redirect("users/login");

			if(!is_numeric($assessmentId)) {
				flash('error', "Invalid assessment selected!");
				redirect("assessments/list");
			}
			
			$data = [
				'title' => SITENAME . " | ",
				'assessmentId' => $assessmentId,
				'assessmentName' => "",
				'assessment' => false
			];

			// Check if have access to this assessment
			// Also check if already taken this assessment
			if($temp = $this->assessmentModel->getAssessmentQuestions($data['assessmentId'])) {
				$data['assessment'] = $temp;
				$data['assessmentName'] = $this->assessmentModel->getAssessmentName($data['assessmentId']);
				$data['title'] .= $data['assessmentName'];
			} else {
				flash('error', "Invalid assessment selected!");
				redirect("assessments/list");
			}

			// die(var_dump($data));

			$this->view("assessments/take", $data);
			
		}

		public function results() {
			die(var_dump($_POST));
		}

		public function about() {
			$data = [
				'title' => "ABOUT US"
			];
			$this->view("pages/about", $data);
		}
	}
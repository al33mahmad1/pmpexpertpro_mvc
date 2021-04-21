<?php
	class Pages extends Controller{
		public function __construct() {
			$this->userModal = $this->model('User');
			$this->assessmentModal = $this->model('Assessment');
			$this->membershipModal = $this->model('Membership');
			$this->categoryModal = $this->model('Category');
		}
		public function index() {
			redirect("pages/home");
		}

		public function home() {

			if(!isLoggedIn())
				redirect("users/login");

			$dataAdmin = [
				'title' => SITENAME . " | Dashboard",
				'totalAssessmentsInSystem' => 0,
				'totalUsersInSystem' => 0,
				'totalQuestionInAgileCategory' => 0,
				'totalQuestionInScrumCategory' => 0,
				'membershipTable' => false,
				'assessmentsTable' => false,
			];

			$dataUser = [
				'title' => SITENAME . " | Dashboard",
				'yourAssessments' => 0,
				'totalAssessmentsPending' => 0,
				'totalAssessmentsAccomplished' => 0,
				'assessmentsHistory' => false
			];

			if(isAdmin()) {
				$dataAdmin['totalAssessmentsInSystem'] = $this->assessmentModal->getAssessmentCountInSystem();
				$dataAdmin['totalUsersInSystem'] = $this->userModal->getUsersCountInSystem();
				$dataAdmin['totalQuestionInAgileCategory'] = $this->categoryModal->totalQuestionInAgileCategory();
				$dataAdmin['totalQuestionInScrumCategory'] = $this->categoryModal->totalQuestionInScrumCategory();
				$dataAdmin['assessmentsTable'] = $this->assessmentModal->getAssessmentWithCategoryAndQuestionCount();
				$dataAdmin['membershipTable'] = $this->membershipModal->fetchAll();
				$this->view("pages/index", $dataAdmin);
			} else {
				switch($_SESSION['PMP_USER_MEMBERSHIP']) {
					case BASIC:
						$temp = $this->assessmentModal->totalAssessmentsInAgileCategory();
						$dataUser['yourAssessments'] = ($temp > 8)? 8 : $temp;
						break;
					case STANDARD:
						$dataUser['yourAssessments'] = $this->assessmentModal->totalAssessmentsInScrumCategory();
						break;
					case PREMIUM:
						$dataUser['yourAssessments'] = $this->assessmentModal->totalAssessmentsInAgileCategory();
						break;
					case COMPREHENSIVE:
						$dataUser['yourAssessments'] = $this->assessmentModal->getAssessmentCountInSystem();
						break;
					default:
					redirect("pages/home");
						break;
				}

				$dataUser['totalAssessmentsAccomplished'] = $this->assessmentModal->getAccomplishedAssessmentsCount();
				$dataUser['assessmentsHistory'] = $this->assessmentModal->getAssessmentsTakenHistory();
				$dataUser['totalAssessmentsPending'] = $dataUser['yourAssessments'] - $dataUser['totalAssessmentsAccomplished'];
				// diee($dataUser);
				$this->view("pages/index", $dataUser);
			}
			
		}

	}
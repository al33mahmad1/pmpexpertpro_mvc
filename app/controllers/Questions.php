<?php
	class Questions extends Controller {
		public function __construct() {
			$this->questionsModel = $this->model('Question');
		}
		public function index() {

			if(isLoggedIn() && isAdmin()) {
				$data = [
					'title' => SITENAME . " | Questions",
					'users' => false
				];

				$this->view("questions/list", $data);
			} else
				redirect("pages/home");
			
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

		public function about() {
			$data = [
				'title' => "ABOUT US"
			];
			$this->view("pages/about", $data);
		}
	}
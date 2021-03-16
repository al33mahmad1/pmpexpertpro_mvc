<?php
	class Logs extends Controller{
		public function __construct() {
			$this->userModel = $this->model('User');
			$this->loginLogsModelModel = $this->model('Loginlog');
		}

		public function index() {

			if(isLoggedIn()) {
				$data = [
					'title' => SITENAME . " | Dashboard",
					'users' => false
				];

				$this->view("pages/index", $data);
			} else {
				redirect("users/login");
			}
			
		}

		public function loginLogs($userId = NULL) {

			if(isLoggedIn()) {
				if(isAdmin()) {
					if($userId === NULL)
						redirect("users/list");

					if($this->userModel->isUserAvailableById($userId)) {

						$data = [
							'title' => SITENAME . " | Dashboard",
							'loginLogs' => false
						];

						if($temp = $this->loginLogsModelModel->fetchAll($userId))
							$data['loginLogs'] = $temp;

						$this->view("logs/loginlogs", $data);
					} else {
						flash("error", "Invalid Client id!");
						redirect("users/list");
					}
				} else
					redirect("pages/home");

			} else
				redirect("users/login");
			
		}

		public function about() {
			$data = [
				'title' => "ABOUT US"
			];
			$this->view("pages/about", $data);
		}
	}
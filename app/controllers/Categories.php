<?php
	class Categories extends Controller{
		public function __construct() {
			$this->categoryModel = $this->model('Category');
		}

		public function index() {
			redirect("pages/home");
		}

		public function fetchAll() {
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

					if($temp = $this->categoryModel->fetchAll($data))
						$data["assessmentCategories"] = $temp;
				
					echo json_encode($data);
				}
			}  else {
				echo json_encode(["status"=> "404"]);
			}
		}

	}
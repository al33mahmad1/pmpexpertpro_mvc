<?php
	class Users extends Controller {

		public function __construct() {

			$this->userModel = $this->model('User');
			$this->LoginlogsModel = $this->model('Loginlogs');

		}

		public function index() {

			$data = [];
			$this->view("users/login", $data);
			
		}

		public function login() {
			$data = [];
			$this->view("users/login", $data);
		}

        public function register() {
			$data = [];
			$this->view("users/register", $data);
		}

		public function validate() {
		
			if($_SERVER['REQUEST_METHOD'] == 'POST' ) {

				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				
				$data = [
					'email' => trim($_POST['email']),
					'password' => trim($_POST['password']),
					'status' => false
				];

				try {

					if(empty($data['email'])) $data['status'] = "invalid";
					elseif(empty($data['password'])) $data['status'] = "invalid";
					elseif(!$this->userModel->findUserByEmail($data['email'])) $data['status'] = "invalid";

				} catch (\Throwable $th) {

					$data['status'] = "invalid";

				}

				if($data['status'] === false) {
					if($loggedIn = $this->userModel->login($data['email'], $data['password'])) {

                        $this->createUserSession($loggedIn);
                        $data['status'] = "success";
						$this->LoginlogsModel->add();
						
					} else {
						$data['status'] = "invalid";
					}
				}

                echo json_encode(["status" => $data['status']]);

			} else {

				echo json_encode(["status"=> "invalid", "message" => "Invalid route request!"]);

			}

		}

		public function createUserSession($user) {

			$_SESSION['PMP_USER_ID'] = $user->id;
			$_SESSION['PMP_USER_NAME'] = $user->name;
			$_SESSION['PMP_USER_EMAIL'] = $user->email;
			$_SESSION['PMP_USER_ROLE'] = strtolower($user->roleType);
			$_SESSION['PMP_USER_MEMBERSHIP'] = strtolower($user->membership);
			$_SESSION['PMP_LAST_ACTIVITY'] = time();

		}

		public function logout() {

			unset($_SESSION['PMP_USER_ID']);
			unset($_SESSION['PMP_USER_NAME']);
			unset($_SESSION['PMP_USER_EMAIL']);
			unset($_SESSION['PMP_USER_ROLE']);
			unset($_SESSION['PMP_USER_MEMBERSHIP']);
			unset($_SESSION['PMP_LAST_ACTIVITY']);
			session_unset();
      		session_destroy();
			redirect('users/login');

		}

        public function list() {
            if(isLoggedIn() && isAdmin()) {
                $data = [
                    'title' => SITENAME . " | Clients",
                    'users' => false
                ];
                if($temp = $this->userModel->fetchAll())
					$data['users'] = $temp;

                $this->view("users/list", $data);
            } else
                redirect("pages/home");
        }

		public function monitor() {
            if(isLoggedIn()) {
                $data = [
                    'title' => SITENAME . " | Monitor Users Activity",
                    // 'users' => false
                ];
                // if($temp = $this->userModel->fetchAll())
				// 	$data['users'] = $temp;

                $this->view("users/monitor", $data);
            } else
                redirect("users/login");
        }

		public function profile() {
            if(isLoggedIn()) {
                $data = [
                    'title' => SITENAME . " | Monitor Users Activity",
                    // 'users' => false
                ];
                // if($temp = $this->userModel->fetchAll())
				// 	$data['users'] = $temp;

                $this->view("users/profile", $data);
            } else
                redirect("users/login");
        }

		public function changePassword() {

			if(!isLoggedIn()) {
				echo json_encode(["status" => "logout"]);
				exit;
			}

			if($_SERVER['REQUEST_METHOD'] == 'POST' ) {
				$data = [
					'current_password' =>  trim($_POST['current_password']),
					'new_password' =>  trim($_POST['new_password']),
					'confirm_password' =>  trim($_POST['confirm_password']),
					'status' => "success"
				];

				// die(var_dump($data));

				if(!isValidPassword($data['new_password']))
					$data['status'] = "InvalidNewPassword";
				else if($data['new_password'] !== $data['confirm_password'])
					$data['status'] = "passwordsMismatch";
				else if($data['current_password'] === $data['new_password'])
					$data['status'] = "samePasswords";

				if($data['status'] == "success") {

					if($pwd = $this->userModel->getPassword()) {
						if(!password_verify($data['current_password'], $pwd))
							$data['status'] = "invalidCurrentPassword";
						else {
							$data['password'] = password_hash($data['new_password'], PASSWORD_DEFAULT);
							if(!$this->userModel->pwdChange($data['password']))
								$data['status'] = "errorWhileUpdating";
						}
					} else
						$data['status'] = "errorWhileUpdating";
				}

				echo json_encode(["status" => $data['status']]);
			} else
				echo json_encode(["status" => "404", "message" => "Invalid Route"]);
		}

		// <--------------->

		// public function add() {

		// 	if(!isLoggedIn() || $_SESSION['user_role'] != 'admin') {
		// 		redirect("users/logout");
		// 	}
		// 	// Check if post request
		// 	if($_SERVER['REQUEST_METHOD'] == 'POST' ){

		// 		// Sanitize Post Data
		// 		$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		// 		// init data 
		// 		$data = [
		// 			'firstName' => trim($_POST['firstName']),
		// 			'lastName' => trim($_POST['lastName']),
		// 			'userName' => trim($_POST['userName']),
		// 			'password' => trim($_POST['password']),
		// 			'role' => trim($_POST['role']),
		// 			'firstName_err' => '',
		// 			'lastName_err' => '',
		// 			'userName_err' => '',
		// 			'password_err' => '',
		// 			'role_err' => '',
		// 			'footer' =>true
		// 		];

		// 		// Validating Form Data

		// 		// Validate User Name
		// 		if(empty($data['userName'])){
		// 			$data['userName_err'] = "Please Enter User Name";
		// 		} elseif(preg_match('/\s/',$data['userName'])){
		// 			$data['userName_err'] = "User Name Doesn't contain spaces.";
		// 		}else{
		// 			if($this->userModel->findUserByUserName($data['userName']))
		// 				$data['userName_err'] = "User Name Already Taken";
		// 		}

		// 		// Validate Name
		// 		if(empty($data['firstName'])){
		// 			$data['firstName_err'] = "Please enter First Name";
		// 		}
		// 		if(empty($data['lastName'])){
		// 			$data['lastName_err'] = "Please enter Last Name";
		// 		}

		// 		// Validate Password
		// 		if(empty($data['password'])){
		// 			$data['password_err'] = "Please enter Password";
		// 		} elseif(strlen($data['password']) < 6){
		// 			$data['password_err'] = "Password must be at least 6 characters";
		// 		}

		// 		// validate Role
		// 		$roles = array('frontdeskofficer', 'dataentryofficer'); 
  
		// 		if (!in_array($data['role'], $roles)) { 
		// 			$data['role_err'] = "Invalid Role Selected!";
		// 		} 

		// 		// Make sure that not any error 
		// 		if(empty($data['firstName_err']) && empty($data['lastName_err']) && empty($data['userName_err']) && empty($data['password_err']) && empty($data['role_err'])) {
		// 			// Validated

		// 			// Register
		// 			// Hash Password
		// 			$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
		// 			if($this->userModel->add($data)) {
		// 				flash('message', 'New User Registered Successfully!');
		// 				redirect("users/add");
		// 			} else {
		// 				flash('message', 'Something Unexpected happen please try again!');
		// 				redirect("users/add");
		// 			}
		// 		} else {
		// 			$this->view("users/add", $data);
		// 		}

		// 	} else {
		// 		// Load Form
		// 		$data = [
		// 			'firstName' => '',
		// 			'lastName' => '',
		// 			'userName' => '',
		// 			'password' => '',
		// 			'role' => '',
		// 			'firstName_err' => '',
		// 			'lastName_err' => '',
		// 			'userName_err' => '',
		// 			'password_err' => '',
		// 			'role_err' => '',
		// 			'footer' =>true

		// 		];
		// 		// Load View
		// 		$this->view('users/add', $data);
		// 	}
		// }


		// public function register() {
		// 	redirect("pages/index");
		// 	// Check if post request
		// 	if($_SERVER['REQUEST_METHOD'] == 'POST' ){

		// 		// Sanitize Post Data
		// 		$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		// 		// init data 
		// 		$data = [
		// 			'name' => trim($_POST['name']),
		// 			'email' => trim($_POST['email']),
		// 			'password' => trim($_POST['password']),
		// 			'confirm_password' => trim($_POST['confirm_password']),
		// 			'name_err' => '',
		// 			'email_err' => '',
		// 			'password_err' => '',
		// 			'confirm_password_err' => ''
		// 		];

		// 		// Validating Form Data

		// 		// Validate Email
		// 		if(empty($data['email'])){
		// 			$data['email_err'] = "Please enter email";
		// 		} else{
		// 			if($this->userModel->findUserByEmail($data['email']))
		// 				$data['email_err'] = "Email Already Taken";
		// 			// die("Taken");
		// 		}

		// 		// Validate Name
		// 		if(empty($data['name'])){
		// 			$data['name_err'] = "Please enter name";
		// 		}

		// 		// Validate Password
		// 		if(empty($data['password'])){
		// 			$data['password_err'] = "Please enter Password";
		// 		} elseif(strlen($data['password']) < 6){
		// 			$data['password_err'] = "Password must be at least 6 characters";
		// 		}

		// 		// Validate Confirm Password
		// 		if(empty($data['confirm_password'])){
		// 			$data['confirm_password_err'] = "Please enter Confirm Password";
		// 		} else {
		// 			if($data['password'] != $data['confirm_password'])
		// 				$data['confirm_password_err'] = "Password must match";
		// 		}

		// 		// Make sure that not any error
		// 		if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
		// 			// Validated

		// 			// Hash Password
		// 			$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

		// 			// Register
		// 			if($this->userModel->register($data)) {
		// 				flash('register_success', 'Registered Successfully! Now you can Login');
		// 				redirect("users/login");
		// 			} else {
		// 				die("SOmething went Wrong");
		// 			}
		// 		} else {
		// 			$this->view("users/register", $data);
		// 		}

		// 	} else {
		// 		// Load Form
		// 		$data = [
		// 			'name' => '',
		// 			'email' => '',
		// 			'password' => '',
		// 			'confirm_password' => '',
		// 			'name_err' => '',
		// 			'email_err' => '',
		// 			'password_err' => '',
		// 			'confirm_password_err' => ''
		// 		];
		// 		// Load View
		// 		$this->view('users/register', $data);
		// 	}
		// }

		// public function validate() {
		// 	// Check if post request
		// 	if($_SERVER['REQUEST_METHOD'] == 'POST' ) {
		// 		// Sanitize Post Data
		// 		$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				
		// 		$data = [
		// 			'footer' => false,
		// 			'username' => trim($_POST['username']),
		// 			'password' => trim($_POST['password']),
		// 			'err' => ''
		// 		];

		// 		// Validate Username
		// 		if(empty($data['username'])) {
		// 			$data['err'] = 'Invalid Username or Password '; 
		// 		}
		// 		// Spaces Are Not Allowed in User Names
		// 		if (strpos($data['username'], ' ') !== false) {
		// 			$data['err'] = 'Invalid Username or Password '; 
		// 		}
		// 		// Validate Password
		// 		if(empty($data['password'])){
		// 			$data['err'] = 'Invalid Username or Password '; 
		// 		}

		// 		// Check For User Exists Or Not
		// 		if(!$this->userModel->findUserByUserName($data['username'])) {
		// 			$data['err'] = 'Invalid Username or Password ';
		// 		}

		// 		// Make sure that not any error
		// 		if(empty($data['err'])) {
		// 			// Validated
		// 			if($loggedIn = $this->userModel->login($data['username'], $data['password'])) {
		// 				// Login Success
		// 				$this->createUserSession($loggedIn);
		// 				redirect("pages/index");
		// 			}else {
		// 				$data['err'] = 'Invalid Username or Password '; 
		// 				flash("error", "Invalid Username or Password!", "alert alert-danger");
		// 				$this->view('users/login', $data);
		// 			}
		// 		} else {
		// 			flash("error", "Invalid Username or Password!", "alert alert-danger");
		// 			$this->view("users/login", $data);
		// 		}

		// 	} else {
		// 		// Load Form
		// 		if(isLoggedIn()) {
		// 			redirect("pages/index");
		// 		}
		// 		$data = [
		// 			'username' => '',
		// 			'password' => '',
		// 			'err' => '',
		// 			'footer' => false
		// 		];
		// 		// Load View
		// 		$this->view('users/login', $data);
		// 	}
		// }

		// public function manage() {

		// 	if(!isLoggedIn() || $_SESSION['user_role'] != 'admin') {
		// 		redirect("users/logout");
		// 	}

		// 	$data = [
		// 		'footer' => true,
		// 		'records' => false
		// 	];

		// 	// Get All data from DB
		// 	if($records = $this->userModel->userRecords()) {
        //         $data['records'] = $records;
        //     }
			
		// 	$this->view("users/manage", $data);
		// }

		// public function edit($id) {

		// 	if(!isLoggedIn() || $_SESSION['user_role'] != 'admin') {
		// 		redirect("users/logout");
		// 	}
		// 	// Check if post request
		// 	if($_SERVER['REQUEST_METHOD'] == 'POST' ) {

		// 		// Sanitize Post Data
		// 		$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		// 		// init data 
		// 		$data = [
		// 			'id' => $id,
		// 			'firstName' => trim($_POST['firstName']),
		// 			'lastName' => trim($_POST['lastName']),
		// 			'userName' => trim($_POST['userName']),
		// 			'status' => trim($_POST['status']),
		// 			'roleType' => trim($_POST['role']),
		// 			'firstName_err' => '',
		// 			'lastName_err' => '',
		// 			'userName_err' => '',
		// 			'status_err' => '',
		// 			'role_err' => '',
		// 			'footer' =>true
		// 		];

		// 		// Validating Form Data

		// 		// Validate User Name
		// 		if(empty($data['userName'])){
		// 			$data['userName_err'] = "Please Enter User Name";
		// 		} elseif(preg_match('/\s/',$data['userName'])){
		// 			$data['userName_err'] = "User Name Doesn't contain spaces.";
		// 		}else{
		// 			if($this->userModel->findUserByUserNameAndId($data['userName'], $id))
		// 				$data['userName_err'] = "User Name Already Taken";
		// 		}

		// 		// Validate Name
		// 		if(empty($data['firstName'])){
		// 			$data['firstName_err'] = "Please enter First Name";
		// 		}
		// 		if(empty($data['lastName'])){
		// 			$data['lastName_err'] = "Please enter Last Name";
		// 		}

		// 		// validate Role
		// 		$roles = array('frontdeskofficer', 'dataentryofficer'); 
  
		// 		if (!in_array($data['roleType'], $roles)) { 
		// 			$data['role_err'] = "Invalid Role Selected!";
		// 		}

		// 		$status = array('0', '1');
		// 		if (!in_array($data['status'], $status)) { 
		// 			$data['status_err'] = "Invalid Status Selected!";
		// 		}
		// 		// Make sure that not any error  
		// 		if(empty($data['firstName_err']) && empty($data['lastName_err']) && empty($data['userName_err']) && empty($data['status_err']) && empty($data['role_err'])) {
		// 			// Validated

		// 			if($this->userModel->edit($data, $id)) {
		// 				flash('message', 'User Updated Successfully!');
		// 				redirect("users/manage");
		// 			} else {
		// 				flash('message', 'Something Unexpected happen please try again!');
		// 				redirect("users/manage");
		// 			}
		// 		} else {
		// 			$this->view("users/edit", $data);
		// 		}

		// 	}  else {

		// 		if($row = $this->userModel->getUserById($id)){
		// 			$names = explode(' ', $row['name']);
		// 			$lastName = '';
		// 			if(count($names)>1) {
		// 				$lastName = $names[1];
		// 			}
        //             $data = [
		// 				'id' => $id,
		// 				'firstName' => explode(' ', $row['name'])[0],
		// 				'lastName' => $lastName,
		// 				'userName' => $row['user_name'],
		// 				'roleType' => $row['role_type'],
		// 				'status' => $row['current_status'],
		// 				'firstName_err' => '',
		// 				'lastName_err' => '',
		// 				'userName_err' => '',
		// 				'role_err' => '',
		// 				'status_err' => '',
		// 				'footer' =>true
        //             ];
        //             $this->view('users/edit', $data);
        //         } else{
		// 			flash("message", "No User with this ID!");
		// 			redirect('users/manage');
        //         }
		// 	}
		// }

		// public function changeUsername() {
		// 	if(!isLoggedIn()) {
		// 		redirect("users/logout");
		// 	}
			
		// 	// Check if post request
		// 	if($_SERVER['REQUEST_METHOD'] == 'POST' ) {
		// 		$data = [
		// 			'username' =>  trim($_POST['username']),
		// 			'username_err' => '',
		// 			'footer' => true
		// 		];

		// 		if(empty($data['username'])) {
		// 			flash("message", "Invalid Username, Please Enter Valid one!", "alert alert-danger");
		// 		}elseif(strlen($data['username']) < 8) {
		// 			flash("message", "Username must be 8 characters or longer", "alert alert-danger");
		// 		}

		// 		if(empty($data['username_err'])) {
		// 			if($this->userModel->changeUsername($data['username'])) {
		// 				flash("message", "Username Changed Successfully!");
		// 				redirect("users/admin");
		// 			}else {
		// 				flash("message", "Something Unexpected Happen, Please Try Again!", "alert alert-danger");
		// 				redirect("users/admin");
		// 			}
		// 		} else{
		// 			redirect('users/admin');
		// 		}
		// 	} else {
		// 			redirect('pages/index');
		// 	}
		// }

		
		
		// public function delete($id) {

        //     // For Inserting Player Data Into Database
		// 	if(!isLoggedIn() || $_SESSION['user_role'] != 'admin') {
		// 		redirect("users/logout");
		// 	}

		// 	// Check if post request
		// 	if($_SERVER['REQUEST_METHOD'] == 'POST' ) {
		// 		if($this->userModel->delete($id)) {
		// 			flash("message", "User Deleted Successfully");
		// 			redirect("users/manage");
		// 		}else {
		// 			flash("message", "Something Unexpected Happen, Please Try Again!", "alert alert-danger");
		// 			redirect("users/manage");
		// 		}
		// 	} else{
		// 		flash("message", "Something Unexpected Happen, Please Try Again!", "alert alert-danger");
		// 		redirect("users/index");
		// 	}
		// }

		// public function isLoggedIn() {
		// 	return (isset($_SESSION['user_id']))? true : false;
		// }

	}
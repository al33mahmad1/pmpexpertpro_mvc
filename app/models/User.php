<?php
class User {
	private $db;

	public function __construct() {
		$this->db = new Database();
	}

	public function login($email, $password) {
		
		try {
			$this->db->query("SELECT u.*, r.role_name as roleType, m.membership_name as membership FROM user u, role r, memberships m WHERE BINARY email=:email AND u.role_id=r.role_id AND u.membership_id=m.membership_id;");
			$this->db->bind(':email', $email);
			if($row = $this->db->single()) {
				$hashedPassword = $row->password;
				if(password_verify($password, $hashedPassword))
					return $row;
			}
			return false;
		} catch (\Throwable $th) {
			die(var_dump($th));
			return false;
		}
		
	}

	function fetchAll() {

		try {

			$this->db->query("SELECT u.*, r.role_name, m.membership_name FROM user u, role r, memberships m where u.role_id=r.role_id AND u.membership_id=m.membership_id;");
			$row = $this->db->resultSetAssocArray();
			if($this->db->rowCount() > 0)
				return $row;
			return false;
		} catch (\Throwable $th) {
			return false;
		}

	}

	public function getPassword() {
		$this->db->query("SELECT password FROM user WHERE email=:email;");
		$this->db->bind(':email', $_SESSION['PMP_USER_EMAIL']);
		if($row = $this->db->single())
			return $row->password;
			// if(password_verify($password, $hashedPassword)) {
			// 	return true;
			// } else{
			// 	return false;
			// }
		return false;
		
	} 
	
	function findUserByEmail($email) {

		try {
			$this->db->query("SELECT * FROM user WHERE email=:email;");
			$this->db->bind(':email', $email);
			$row = $this->db->single();
			if($this->db->rowCount() > 0)
				return true;
			return false;
		} catch (\Throwable $th) {
			return false;
		}

	}

	public function pwdChange($pwd) {
		
		$this->db->query("UPDATE `user` SET `password`=:pwd WHERE email=:email;");
		$this->db->bind(':email', $_SESSION['PMP_USER_EMAIL']);
		$this->db->bind(':pwd', $pwd);
		return ($this->db->execute());

	}

	function isUserAvailableById($userId) {

		try {
			$this->db->query("SELECT * FROM user WHERE id=:id;");
			$this->db->bind(':id', $userId);
			$row = $this->db->single();
			if($this->db->rowCount() > 0)
				return true;
			return false;
		} catch (\Throwable $th) {
			return false;
		}

	}

	function isAuthorizedUser($userId) {

		try {
			$this->db->query("SELECT * FROM user WHERE email=:email AND id=:id;");
			$this->db->bind(':email', $_SESSION['PMP_USER_EMAIL']);
			$this->db->bind(':id', $userId);
			$row = $this->db->single();
			if($this->db->rowCount() > 0)
				return true;
			return false;
		} catch (\Throwable $th) {
			return false;
		}

	}

	public function getUsersCountInSystem() {

		try {
			$this->db->query("SELECT count(id) as counts from user where role_id <> 1;");
			$row = $this->db->single();
			if($this->db->rowCount() > 0)
				return $row->counts;
			return 0;
		} catch (\Throwable $th) {
			return 0;
		}

	}

	public function addClient($data) {
		try {
			$this->db->query("INSERT INTO user(role_id, membership_id, name, email, password) VALUES(:role_id, :membership_id, :name, :email, :password);");
			$this->db->bind(':role_id', '2');
			$this->db->bind(':membership_id', $data['membershipId']);
			$this->db->bind(':name', $data['name']." " . $data['surname']);
			$this->db->bind(':email', $data['email']);
			$this->db->bind(':password', $data['password']);
			return ($this->db->execute());
		} catch (\Throwable $th) {
			return false;
		}
	}

	public function validateIsUserAvailable($email) {

		try {
			$this->db->query("SELECT id from user WHERE email=:email;");
			$this->db->bind(":email", $email);
			$row = $this->db->singleAssoc();
			
			return ($this->db->rowCount() > 0);
		} catch (\Throwable $th) {
			return false;
		}

	}

	public function getOTPAndData($email) {
		
		try {
			$this->db->query("SELECT is_set_for_pass_resetting, pass_reset_code, pwd_reset_date FROM  `user` WHERE email=:email;");
			$this->db->bind(':email', $email);
			$row = $this->db->singleAssoc();

			if($this->db->rowCount() > 0)
				return $row;
			return false;
		} catch (\Throwable $th) {
			return false;
		}

	}

	public function updatePasswordResetStatus($email, $OTP) { // *
		
		try {
			$this->db->query("UPDATE `user` SET `is_set_for_pass_resetting`=:is_set_for_pass_resetting, pass_reset_code=:pass_reset_code, pwd_reset_date=:pwd_reset_date WHERE email=:email;");
		
			$this->db->bind(':email', $email);
			$this->db->bind(':is_set_for_pass_resetting', 1);
			$this->db->bind(':pass_reset_code', $OTP);
			$this->db->bind(':pwd_reset_date', date("Y-m-d H:i:s"));
			
			return ($this->db->execute());
		} catch (\Throwable $th) {
			return false;
		}

	}

	public function updatePassword($email, $password) { // *
		
		try {
			$this->db->query("UPDATE `user` SET `password`=:password, `is_set_for_pass_resetting`=:is_set_for_pass_resetting, pass_reset_code=:pass_reset_code WHERE email=:email;");
			$this->db->bind(':password', $password);
			$this->db->bind(':email', $email);
			$this->db->bind(':is_set_for_pass_resetting', "0");
			$this->db->bind(':pass_reset_code', "0000");
			
			return $this->db->execute();
		} catch (\Throwable $th) {
			return false;
		}

	}

	// public function getUserById($id) {

	// 	try {
	// 		$this->db->query("SELECT * from user WHERE id=:id;");
	// 		$this->db->bind(":id", $id);
	// 		$row = $this->db->singleAssoc();
			
	// 		if($this->db->rowCount() > 0)
	// 			return $row;
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

	

	// Login User
	 
	

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
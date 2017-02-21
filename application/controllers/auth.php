<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		header('Access-Control-Allow-Origin: http://penherz.com');
		// header("Access-Control-Allow-Methods", "POST, GET, OPTIONS, DELETE");
		// header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
		parent::__construct();
	}

	public function index()
	{
		$output['error'] = true;
		$output['description'] = "invalid request";
		print_r(json_encode($output));
		die();
	}

	// Login User
	public function login()
	{
		if(isset($_POST['username']) && isset($_POST['password'])){
			///////////process data
			$_username = $_POST['username'];
			$_password = $_POST['password'];
			$_params = array("username"=>$_username,"password"=>$_password);
			$data = $this->profilemodel->_login($_params);
			if($data['message'] == "success"){
				$output['error'] = false;
				$output['token'] = $data["token"];
				$output['username'] = $data["username"];
				$output['user_id'] = $data["user_id"];
				$output['description'] = "success";
			}
			else if($data['message'] == "Please activate your account"){
				$output['error'] = true;
				$output['description'] = $data['message'];
			}
			else if($data['message'] == "Your have been banned from Penherz until"){
				$output['error'] = true;
				$output['bandate'] = $data['bandate'];
				$output['description'] = $data['message'];
			}
			else{
				$output['error'] = true;
				$output['description'] = "Please check username and password.";
			}
		}
		else{
			$output['error'] = true;
			$output['description'] = "invalid request";
		}
		print_r(json_encode($output));
		die();
	}

	// Register All
	function registeroffice()
	{
		if(isset($_POST['username']) && isset($_POST['fullname']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['type']) && isset($_POST['sub_category'])){
			// Insert into login
			$_params = $_POST;
			$data = $this->profilemodel->_insert_login($_params);
			$output['error'] = false;
			if($data['message'] != 'Already Exist'){
				$output['result'] = $this->profilemodel->_registeroffice($_params);
				$output['description'] = "success";
				$data = $this->profilemodel->_login($_params);
				if($data['message'] == "success"){
					$output['token'] = $data["token"];
					$output['username'] = $data["username"];
					$output['user_id'] = $data["user_id"];
				}
			}else{
				$output['description'] = 'User Already Exist';
			}
		}
		else{
			$output['error'] = true;
			$output['description'] = "invalid request";

		}
		print_r(json_encode($output));
		die();
	}

	function registerpage()
	{
		if(isset($_POST['username']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['type']) && isset($_POST['sub_category'])){
			// Insert into login
			$_params = $_POST;
			$data = $this->profilemodel->_insert_login($_params);
			$output['error'] = false;
			if($data['message'] != 'Already Exist'){
				$output['result'] = $this->profilemodel->_registerpage($_params);
				$output['description'] = "success";
				$data = $this->profilemodel->_login($_params);
				if($data['message'] == "success"){
					$output['token'] = $data["token"];
					$output['username'] = $data["username"];
					$output['user_id'] = $data["user_id"];
				}
			}else{
				$output['description'] = 'User Already Exist';
			}
		}
		else{
			$output['error'] = true;
			$output['description'] = "invalid request";

		}
		print_r(json_encode($output));
		die();
	}

	function registeruser()
	{
		if(isset($_POST['username']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['type'])){
			// Insert into login
			$_params = $_POST;
			$data = $this->profilemodel->_insert_login($_params);
			$output['error'] = false;
			if($data['message'] != 'Already Exist'){
				$output['result'] = $this->profilemodel->_registeruser($_params);
				$output['description'] = "success";
				$data = $this->profilemodel->_login($_params);
				if($data['message'] == "success"){
					$output['token'] = $data["token"];
					$output['username'] = $data["username"];
					$output['user_id'] = $data["user_id"];
				}
			}else{
				$output['description'] = 'User Already Exist';
			}
		}
		else{
			$output['error'] = true;
			$output['description'] = "invalid request";

		}
		print_r(json_encode($output));
		die();
	}

	// Logout User
	function logout(){
		$output = array();
		if(isset($_POST['token'])){
			///////////process data
			$token = $_POST['token'];
			$logout = $this->profilemodel->_deactivateToken($token);
			$output['error'] = false;
			$output['description'] = "done";

		}
		else{
			$output['error'] = true;
			$output['description'] = "invalid request";
		}
		print_r(json_encode($output));
		die();
	}
}

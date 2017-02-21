<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	function __construct()
	{
		header('Access-Control-Allow-Origin: http://penherz.com');
		// header("Access-Control-Allow-Methods", "POST, GET, OPTIONS, DELETE");
		// header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
		parent::__construct();
	}

	public function index()
	{
		if(isset($_POST['username']) && isset($_POST['token'])){
			$_username = $_POST['username'];
			$_token = $_POST['token'];
			$_id = $this->profilemodel->_get_user_id_from_token($_token);
			if($_id){
				$_data = $this->profilemodel->loadProfileuser($_username,$_id);
				$output['error'] = false;
				$output['data'] = $_data;
				$output['description'] = "success";
			}
			else{
				$output['error'] = true;
				$output['description'] = "Invalid Username";
			}

		}
		else{
			$output['error'] = true;
			$output['description'] = "invalid request";
		}

		print_r(json_encode($output));
		die();
	}

	function social(){
		if(isset($_POST['token'])){
			$_params = $_POST;
			$_token = $_params['token'];
			$_user_id = $this->profilemodel->_get_user_id_from_token($_token);
			if($_user_id){
				unset($_params['token']);
				$_user = array('user_id' => $_user_id);
				$_params = array_merge($_params, $_user);
				$_data = $this->profilemodel->_add_social($_params,$_user_id);
				$output['error'] = false;
				$output['description'] = "success";
			}
			else{
				$output['error'] = true;
				$output['description'] = "Invalid Username";
			}
		}
		else{
			$output['error'] = true;
			$output['description'] = "invalid request";
		}
		print_r(json_encode($output));
		die();
	}

    function hours(){
		if(isset($_POST['token'])){
			$_params = $_POST;
			$_token = $_params['token'];
			$_user_id = $this->profilemodel->_get_user_id_from_token($_token);
			$_store_no = $this->miscelanousmodel->_fetch_storeno_from_id($_user_id);
			if($_user_id){
				unset($_params['token']);
				$_user = array('user_id' => $_user_id, 'store_no' => $_store_no);
				$_params = array_merge($_params, $_user);
				$_data = $this->profilemodel->_add_hours($_params,$_user_id,$_store_no);
				$output['error'] = false;
				$output['description'] = "success";
			}
			else{
				$output['error'] = true;
				$output['description'] = "Invalid Username";
			}
		}
		else{
			$output['error'] = true;
			$output['description'] = "invalid request";
		}
		print_r(json_encode($output));
		die();
	}

	function updateprofile(){
		if(isset($_POST['token'])){
			$_params = $_POST;
			$_token = $_params['token'];
			$_user_id = $this->profilemodel->_get_user_id_from_token($_token);
			if($_user_id){
				unset($_params['token']);
				$_data = $this->profilemodel->_update_profile($_params,$_user_id);
				$output['error'] = false;
				$output['description'] = "success";
			}
			else{
				$output['error'] = true;
				$output['description'] = "Invalid Username";
			}
		}
		else{
			$output['error'] = true;
			$output['description'] = "invalid request";
		}
		print_r(json_encode($output));
		die();
	}

	function bookswritten(){
		if(isset($_POST['token']) && isset($_POST['book_name']) && isset($_POST['image']) && isset($_POST['year'])){
			$_params = $_POST;
			$_token = $_params['token'];
			$_user_id = $this->profilemodel->_get_user_id_from_token($_token);
			if($_user_id){
				unset($_params['token']);
				$_user = array('user_id' => $_user_id);
				$_params = array_merge($_params, $_user);
				$_data = $this->profilemodel->_add_books_written($_params);
				$output['error'] = false;
				$output['description'] = "success";
			}
			else{
				$output['error'] = true;
				$output['description'] = "Invalid Username";
			}
		}
		else{
			$output['error'] = true;
			$output['description'] = "invalid request";
		}
		print_r(json_encode($output));
		die();
	}
}

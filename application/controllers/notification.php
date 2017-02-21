<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends CI_Controller {

	function __construct()
	{
		header('Access-Control-Allow-Origin: http://penherz.com');
		// header("Access-Control-Allow-Methods", "POST, GET, OPTIONS, DELETE");
		// header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
		parent::__construct();
	}

	public function index()
	{
		if(isset($_POST['token'])){
			$_token = $_POST['token'];
			$_id = $this->profilemodel->_get_user_id_from_token($_token);
			if($_id){
				$_data = $this->notificationmodel->_load_notifications($_id);
				$output['error'] = false;
				$output['notification'] = $_data;
				$output['description'] = "success";
			}
			else{
				$output['error'] = true;
				$output['description'] = "invalid request";
			}
		}
		else{
			$output['error'] = true;
			$output['description'] = "invalid request";
		}
		
		print_r(json_encode($output));
		die();
	}

	function checknew(){
		if(isset($_POST['token'])){
			$_token = $_POST['token'];
			$_user_id = $this->profilemodel->_get_user_id_from_token($_token);
			if($_user_id){
				$_data = $this->notificationmodel->_check_new_notifications($_user_id);
				$output['error'] = false;
				$output['notification'] = $_data;
				$output['description'] = "success";
			}
			else{
				$output['error'] = true;
				$output['description'] = "invalid request";
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

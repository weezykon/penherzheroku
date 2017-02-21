<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Follow extends CI_Controller {

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
			$_following_id = $_POST['follow'];
			$_user_id = $this->profilemodel->_get_user_id_from_token($_token);
			if($_user_id){
				$_data = $this->followmodel->_follow($_following_id,$_user_id);
				$output['error'] = false;
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

	function followers(){
		if(isset($_POST['token'])){
			$_token = $_POST['token'];
			$_id = $this->profilemodel->_get_user_id_from_token($_token);
			if($_id){
				$_data = $this->followmodel->_fetch_followers_full_details($_id);
				$output['error'] = false;
				$output['followers'] = $_data;
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

	function following(){
		if(isset($_POST['token'])){
			$_token = $_POST['token'];
			$_user_id = $this->profilemodel->_get_user_id_from_token($_token);
			if($_user_id){
				$_data = $this->followmodel->_fetch_following_full_details($_user_id);
				$output['error'] = false;
				$output['following'] = $_data;
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

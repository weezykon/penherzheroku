<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Note extends CI_Controller {

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

	function publicnotes()
	{
		if(isset($_POST['token']) && isset($_POST['user_id'])){
			$_token = $_POST['token'];
			$_user_id = $_POST['user_id'];
			$_id = $this->profilemodel->_get_user_id_from_token($_token);
			if($_id){
				$_data = $this->notemodel->_fetch_public_notes($_user_id);
				$output['error'] = false;
				$output['notes'] = $_data;
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

	function all()
	{
		if(isset($_POST['token']) && isset($_POST['user_id'])){
			$_token = $_POST['token'];
			$_user_id = $_POST['user_id'];
			$_id = $this->profilemodel->_get_user_id_from_token($_token);
			if($_id){
				$_data = $this->notemodel->_fetch_all_notes($_user_id);
				$output['error'] = false;
				$output['notes'] = $_data;
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

	function fetchnote()
	{
		if(isset($_POST['token']) && isset($_POST['note_id'])){
			$_token = $_POST['token'];
			$_note_id = $_POST['note_id'];
			$_user_id = $this->profilemodel->_get_user_id_from_token($_token);
			if($_user_id){
				$_data = $this->notemodel->_fetch_single_note($_note_id);
				$output['error'] = false;
				$output['note'] = $_data;
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

	function addnote()
	{
		if(isset($_POST['token']) && isset($_POST['title']) && isset($_POST['note']) && isset($_POST['privacy'])){
			$_params = $_POST;
			$_token = $_params['token'];
			$_user_id = $this->profilemodel->_get_user_id_from_token($_token);
			if($_user_id){
				$_data = $this->notemodel->_add_note($_params,$_user_id);
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

	function editnote()
	{
		if(isset($_POST['token']) && isset($_POST['note_id']) && isset($_POST['title']) && isset($_POST['note']) && isset($_POST['privacy'])){
			$_params = $_POST;
			$_token = $_params['token'];
			$_user_id = $this->profilemodel->_get_user_id_from_token($_token);
			if($_user_id){
				$_data = $this->notemodel->_edit_note($_params);
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

	function deletenote(){
		if(isset($_POST['token']) && isset($_POST['note_id'])){
			$_token = $_POST['token'];
			$_id = $_POST['note_id'];
			$_user_id = $this->profilemodel->_get_user_id_from_token($_token);
			if($_user_id){
				$_data = $this->notemodel->_delete_note($_id);
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
}

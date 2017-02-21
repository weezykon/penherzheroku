<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stories extends CI_Controller {

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

	function single_story(){
		if(isset($_POST['token']) && isset($_POST['story_id'])){
			$_token = $_POST['token'];
			$_story_id = $_POST['story_id'];
			$_user_id = $this->profilemodel->_get_user_id_from_token($_token);
			if($_user_id){
				$_data = $this->storiesmodel->_load_story_story_id($_story_id,$_user_id);
				$output['error'] = false;
				$output['story'] = $_data;
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

	function user(){
		if(isset($_POST['token']) && isset($_POST['username'])){
			$_token = $_POST['token'];
			$_username = $_POST['username'];
			$_for_id = $this->profilemodel->_get_user_id_from_token($_token);
			$_user_id = $this->miscelanousmodel->_fetch_id_from_username($_username);
			if($_user_id){
				$_data = $this->storiesmodel->_load_story_user_id($_user_id,$_for_id);
				$output['error'] = false;
				$output['story'] = $_data;
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

	function love(){
		if(isset($_POST['token']) && isset($_POST['story_id'])){
			$_token = $_POST['token'];
			$_story_id = $_POST['story_id'];
			$_id = $this->profilemodel->_get_user_id_from_token($_token);
			if($_id){
				$_data = $this->storiesmodel->_love_story($_id,$_story_id);
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

	function comment(){
		if(isset($_POST['token']) && isset($_POST['story_id']) && isset($_POST['comment'])){
			$_token = $_POST['token'];
			$_story_id = $_POST['story_id'];
			$_comment = $_POST['comment'];
			$_user_id = $this->profilemodel->_get_user_id_from_token($_token);
			if($_user_id){
				$_data = $this->storiesmodel->_comment_story($_user_id,$_story_id,$_comment);
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

	function delete(){
		if(isset($_POST['token']) && isset($_POST['story_id'])){
			$_token = $_POST['token'];
			$_story_id = $_POST['story_id'];
			$_id = $this->profilemodel->_get_user_id_from_token($_token);
			if($_id){
				$_data = $this->storiesmodel->_delete_story($_story_id);
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

	function report(){
		if(isset($_POST['token']) && isset($_POST['story_id'])){
			$_token = $_POST['token'];
			$_story_id = $_POST['story_id'];
			$_id = $this->profilemodel->_get_user_id_from_token($_token);
			if($_id){
				$_parameters = array("story_id"=>$_story_id,"user_id"=>$_id);
				$_data = $this->storiesmodel->_report_story($_parameters);
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

	function insert(){
		if(isset($_POST['token']) && isset($_POST['story']) && isset($_POST['image']) && isset($_POST['audio'])){
			$_token = $_POST['token'];
			$_story = $_POST['story'];
			$_image = $_POST['image'];
			$_audio = $_POST['audio'];
			$_id = $this->profilemodel->_get_user_id_from_token($_token);
			if($_id){
				$_parameters = array("story"=>$_story,"user_id"=>$_id,"image"=>$_image,"audio"=>$_audio);
				$_data = $this->storiesmodel->_insertstory($_parameters);
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

	function savestory(){
		if(isset($_POST['token']) && isset($_POST['story_id'])){
			$_token = $_POST['token'];
			$_story_id = $_POST['story_id'];
			$_id = $this->profilemodel->_get_user_id_from_token($_token);
			if($_id){
				$_parameters = array("story_id"=>$_story_id,"user_id"=>$_id);
				$_data = $this->storiesmodel->_save_story($_parameters);
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

	function fetchsavedstories(){
		if(isset($_POST['token'])){
			$_token = $_POST['token'];
			$_id = $this->profilemodel->_get_user_id_from_token($_token);
			if($_id){
				$_data = $this->storiesmodel->_fetch_saved_stories($_id);
				$output['error'] = false;
				$output['data'] = $_data;
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

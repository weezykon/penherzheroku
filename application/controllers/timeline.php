<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Timeline extends CI_Controller {

	function __construct()
	{
		header('Access-Control-Allow-Origin: http://penherz.com');
		// header("Access-Control-Allow-Methods", "POST, GET, OPTIONS, DELETE");
		// header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
		parent::__construct();
		$this->load->model('timelinemodel');
	}

	public function index()
	{
		if(isset($_POST['token'])){
			$_token = $_POST['token'];
			$_user_id = $this->profilemodel->_get_user_id_from_token($_token);
			if($_user_id){
				$_data = $this->timelinemodel->_load_timeline($_user_id);
				$output['error'] = false;
				$output['stories'] = $_data;
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

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct()
	{
		header('Access-Control-Allow-Origin: http://penherz.com');
		// header("Access-Control-Allow-Methods", "POST, GET, OPTIONS, DELETE");
		// header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
		parent::__construct();
	}

	public function index()
	{

	}
}

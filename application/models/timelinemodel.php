<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class timelinemodel extends CI_Model {

    public function __construct()
    {
            parent::__construct();
            $ci =& get_instance();
            // $this->load->model('miscelanousmodel');
            // $this->load->model('postmodel');
            // $this->load->model('followmodel');
    }

    function _load_timeline($_id){
        $_following = $this->followmodel->_fetch_following($_id);
        array_push($_following,$_id);
        $_data = array();
        $_len_following = sizeof($_following);
        // var_dump($_following);
        $q = implode(" OR `user_id` =", $_following);
        $q = "`user_id` = ".$q;
        // var_dump($q);
        $_data = $this->storiesmodel->_load_timeline($q,$_id);

        return $_data;
    }
    
    
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class miscelanousmodel extends CI_Model {

    public function __construct()
    {
            parent::__construct();
            $ci =& get_instance();
    }

    // function _fetch_likes($_postid){
    //     $this->db->select('*');
    //     $_likes = $this->db->get_where('like', array('post_id' => $_postid));
    //     if($_likes->num_rows > 1){
    //         return $_likes->result();
    //     }
    //     return false;
    // }

    function _fetch_id_from_username($_username){
        $this->db->select('id');
        $_data = $this->db->get_where('login', array('username' => $_username));
        if($_data->num_rows == 1){
            return $_data->row()->id;
        }
        return false;
    }

    function _fetch_email_from_username($_username){
        $this->db->select('email');
        $_data = $this->db->get_where('login', array('username' => $_username));
        if($_data->num_rows == 1){
            return $_data->row()->email;
        }
        return false;
    }

    function _fetch_type_from_username($_username){
        $this->db->select('type');
        $_data = $this->db->get_where('login', array('username' => $_username));
        if($_data->num_rows == 1){
            return $_data->row()->type;
        }
        return false;
    }

    function _fetch_email_from_id($_user_id){
        $this->db->select('email');
        $_data = $this->db->get_where('login', array('id' => $_user_id));
        if($_data->num_rows == 1){
            return $_data->row()->email;
        }
        return false;
    }

    function _fetch_user_id_from_story_id($_story_id){
        $this->db->select('user_id');
        $_data = $this->db->get_where('stories', array('id' => $_story_id));
        if($_data->num_rows == 1){
            return $_data->row()->user_id;
        }
        return false;
    }

    function _fetch_type_from_id($_user_id){
        $this->db->select('type');
        $_data = $this->db->get_where('login', array('id' => $_user_id));
        if($_data->num_rows == 1){
            return $_data->row()->type;
        }
        return false;
    }

    function _fetch_username_from_id($_user_id){
        $this->db->select('username');
        $_data = $this->db->get_where('login', array('id' => $_user_id));
        if($_data->num_rows == 1){
            return $_data->row()->username;
        }
        return false;
    }

    function _fetch_fulname_from_id($_user_id){
      $_type = $this->_fetch_type_from_id($_user_id);
      if ($_type == 'member') {
        $this->db->select('firstname,lastname');
        // var_dump($_user_id);
        $_data = $this->db->get_where('members', array('user_id' => $_user_id));
        if($_data->num_rows == 1){
            return ($_data->row()->firstname ." ". $_data->row()->lastname);
        }
        return false;
      }elseif ($_type == 'page'){
        $this->db->select('firstname,lastname');
        // var_dump($_user_id);
        $_data = $this->db->get_where('pages', array('user_id' => $_user_id));
        if($_data->num_rows == 1){
            return ($_data->row()->firstname ." ". $_data->row()->lastname);
        }
        return false;
      }elseif ($_type == 'office') {
        $this->db->select('fullname');
        // var_dump($_user_id);
        $_data = $this->db->get_where('offices', array('user_id' => $_user_id));
        if($_data->num_rows == 1){
            return ($_data->row()->fullname);
        }
        return false;
      }
    }

    function _fetch_storeno_from_id($_user_id){
      $_type = $this->_fetch_type_from_id($_user_id);
      if ($_type == 'page'){
        $this->db->select('store_no');
        // var_dump($_user_id);
        $_data = $this->db->get_where('pages', array('user_id' => $_user_id));
        if($_data->num_rows == 1){
            return ($_data->row()->store_no);
        }
        return false;
      }elseif ($_type == 'office') {
        $this->db->select('store_no');
        // var_dump($_user_id);
        $_data = $this->db->get_where('offices', array('user_id' => $_user_id));
        if($_data->num_rows == 1){
            return ($_data->row()->store_no);
        }
        return false;
      }
    }

    function _fetch_profile_pic($_user_id){
        $_type = $this->_fetch_type_from_id($_user_id);
        if ($_type == 'member') {
          $this->db->select('profilepic');
          $_data = $this->db->get_where('members', array('user_id' => $_user_id));

          if($_data->num_rows == 1){
              return $_data->row()->profilepic;
          }
          return false;
        }elseif ($_type == 'page'){
          $this->db->select('profilepic');
          $_data = $this->db->get_where('pages', array('user_id' => $_user_id));

          if($_data->num_rows == 1){
              return $_data->row()->profilepic;
          }
          return false;
        }elseif ($_type == 'office') {
          $this->db->select('profilepic');
          $_data = $this->db->get_where('offices', array('user_id' => $_user_id));

          if($_data->num_rows == 1){
              return $_data->row()->profilepic;
          }
          return false;
        }
    }

    function _check_handles($_string){
        $_return = preg_replace_callback("/@\w*\s*|@\w*/ ",function($match){
            $url = substr($match[0],1);
            return "<a href='#/$url'>$match[0]</a>";
        }, $_string);
        return $_return;
    }
}

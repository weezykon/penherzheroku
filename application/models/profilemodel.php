<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class profilemodel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $ci =& get_instance();
    }


    function loadProfileuser($_username,$_for_id){
	   $_type = $this->miscelanousmodel->_fetch_type_from_username($_username);
      if ($_type == 'office') {
        $this->db->select('*');
        $_data = $this->db->get_where('offices', array('username' => $_username));
        if($_data){
            $_data = $_data->row();
            unset($_data->password);
            $_user_id = $this->miscelanousmodel->_fetch_id_from_username($_username);
            $_data->storiescount =  $this->_countStories($_user_id);
            $_data->lovecount =  $this->_countLove($_user_id);
            $_data->hours =  $this->_fetch_hours($_user_id);
            $_data->social =  $this->_fetch_social($_user_id);
            $_data->books =  $this->_fetch_books_written($_user_id);
            $_data->followers =  $this->followmodel->_fetch_followers_full_details($_user_id);
            $_data->followerscount =  $this->followmodel->_count_followers($_user_id);
            $_data->following =  $this->followmodel->_fetch_following_full_details($_user_id);
            $_data->followingcount =  $this->followmodel->_count_following($_user_id);
            $_data->stories =  $this->storiesmodel->_load_story_user_id($_user_id,$_for_id);
            return $_data;
        }
        return false;
      }elseif ($_type == 'page') {
        $this->db->select('*');
        $_data = $this->db->get_where('pages', array('username' => $_username));
        if($_data){
            $_data = $_data->row();
            unset($_data->password);
            $_user_id = $this->miscelanousmodel->_fetch_id_from_username($_username);
            $_data->storiescount =  $this->_countStories($_user_id);
            $_data->social =  $this->_fetch_social($_user_id);
            $_data->books =  $this->_fetch_books_written($_user_id);
            $_data->lovecount =  $this->_countLove($_user_id);
            $_data->followers =  $this->followmodel->_fetch_followers_full_details($_user_id);
            $_data->followerscount =  $this->followmodel->_count_followers($_user_id);
            $_data->following =  $this->followmodel->_fetch_following_full_details($_user_id);
            $_data->followingcount =  $this->followmodel->_count_following($_user_id);
            $_data->stories =  $this->storiesmodel->_load_story_user_id($_user_id,$_for_id);
            return $_data;
        }
        return false;
      }elseif ($_type == 'member') {
        $this->db->select('*');
        $_data = $this->db->get_where('members', array('username' => $_username));
        if($_data){
            $_data = $_data->row();
            unset($_data->password);
            $_user_id = $this->miscelanousmodel->_fetch_id_from_username($_username);
            $_data->storiescount =  $this->_countStories($_user_id);
            $_data->social =  $this->_fetch_social($_user_id);
            $_data->lovecount =  $this->_countLove($_user_id);
            $_data->followers =  $this->followmodel->_fetch_followers_full_details($_user_id);
            $_data->followerscount =  $this->followmodel->_count_followers($_user_id);
            $_data->following =  $this->followmodel->_fetch_following_full_details($_user_id);
            $_data->followingcount =  $this->followmodel->_count_following($_user_id);
            $_data->stories =  $this->storiesmodel->_load_story_user_id($_user_id,$_for_id);
            return $_data;
        }
        return false;
      }
    }

    function _countStories($_user_id){
        $this->db->select('*');
        $_result = $this->db->get_where('stories', array('user_id' => $_user_id,'visible' => 1));
        if($_result){
            return sizeof($_result->result());
        }
        return 0;
    }

    function _countLove($_user_id){
        $this->db->select('*');
        $_result = $this->db->get_where('love', array('user_id' => $_user_id, 'status' => 1));
        if($_result){
            return sizeof($_result->result());
        }
        return 0;
    }

    function _get_user_id_from_token($_token){
      $this->db->select('*');
      $_data = $this->db->get_where('login', array('token' => $_token,'valid_token'=>1));
      if($_data->num_rows == 1){
          return $_data->row()->id;
      }
      return false;
    }

    function _fetch_hours($_user_id){
      $this->db->select('*');
      $_data = $this->db->get_where('hours', array('user_id' => $_user_id));
      if($_data->num_rows == 1){
          return $_data->row();
      }
      return '';
    }

    function _add_hours($_params,$_user_id,$_store_no){
        $this->db->select('*');
        $_data = $this->db->get_where('hours', array('user_id' => $_user_id));
        if($_data->num_rows == 1){
            $this->db->set($_params);
            $where = "user_id = '$_user_id'";
            $this->db->where($where);
            $this->db->update("hours");
            return true;
        }else{
            $this->db->insert('hours', $_params);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }    
    }

    function _fetch_social($_user_id){
      $this->db->select('*');
      $_data = $this->db->get_where('social', array('user_id' => $_user_id));
      if($_data->num_rows == 1){
          return $_data->row();
      }
      return '';
    }

    function _fetch_books_written($_user_id){
      $this->db->select('*');
        $_books = $this->db->get_where('books_written', array('user_id' => $_user_id));
        $data = array();
        if($_books->num_rows > 0){
            $_books_result = $_books->result();
            foreach ($_books_result as $key => $value) {
                $_user_id = $value->user_id;
                $_book_name = $value->book_name;
                $_id = $value->id;
                $_year = $value->year;
                $_date = $value->date;
                $_image = $value->image;
                
                $data[sizeof($data)] = json_decode(json_encode(['id'=>$_id,'user_id'=>$_user_id,'book_name'=>$_book_name,'year'=>$_year,'year'=>$_year,'date'=>$_date,'image'=>$_image]));
            }
            return $data;
        }
        return false;
    }

    function _add_social($_params,$_user_id){
        $this->db->select('*');
        $_data = $this->db->get_where('social', array('user_id' => $_user_id));
        if($_data->num_rows == 1){
            $this->db->set($_params);
            $where = "user_id = '$_user_id'";
            $this->db->where($where);
            $this->db->update("social");
            return true;
        }else{
            $this->db->insert('social', $_params);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }    
    }

    function _add_books_written($_params){
        $this->db->insert('books_written', $_params);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function _update_profile($_params,$_user_id){
        $_type = $this->miscelanousmodel->_fetch_type_from_id($_user_id);
        if ($_type == 'member') {
            $this->db->select('*');
            $_data = $this->db->get_where('members', array('user_id' => $_user_id));
            if($_data->num_rows == 1){
                $this->db->set($_params);
                $where = "user_id = '$_user_id'";
                $this->db->where($where);
                $this->db->update("members");
                return true;
            }
            return false;
        }elseif ($_type == 'page') {
            $this->db->select('*');
            $_data = $this->db->get_where('pages', array('user_id' => $_user_id));
            if($_data->num_rows == 1){
                $this->db->set($_params);
                $where = "user_id = '$_user_id'";
                $this->db->where($where);
                $this->db->update("pages");
                return true;
            }
            return false;
        }elseif ($_type == 'office') {
            $this->db->select('*');
            $_data = $this->db->get_where('offices', array('user_id' => $_user_id));
            if($_data->num_rows == 1){
                $this->db->set($_params);
                $where = "user_id = '$_user_id'";
                $this->db->where($where);
                $this->db->update("offices");
                return true;
            }
            return false;
        }        
    }

    function _deactivateToken($_token){
        $this->db->set('valid_token', 0);
        $where = "token = '$_token'";
        $this->db->where($where);
        $this->db->update("login");
        return true;
    }

    function _createToken($_user_id){
        $_token = sha1(mt_rand());
        while(true){
            if($this->_get_user_id_from_token($_token)){
                $_token = sha1(mt_rand());
            }
            else{
                break;
            }
        }
        $_data = [
                'token' => $_token,
                'valid_token' => 1
        ];
        $this->db->set($_data);
        $where = "id = '$_user_id'";
        $this->db->where($where);
        $this->db->update('login');
        return $_token;
    }

    function _login($_params){
        $_username = $_params['username'];
        $_password = $_params['password'];
        $_password = md5($_password);

        $_token = "";
        $_user = "";
        if(sizeof(explode("@", $_username))>1 ){
            $this->db->select('*');
            $_data = $this->db->get_where('login', array('email' => $_username,'password'=>$_password));
        }
        else{
            $this->db->select('*');
            $_data = $this->db->get_where('login', array('username' => $_username,'password'=>$_password));
        }
        // var_dump($_data->row());

        if($_data->num_rows == 1){
            if($_data->row()->activated == 1){
                $_user_id = $_data->row()->id;
                $_user = $_data->row()->username;
                $_token = $this->_createToken($_user_id);
                $_message = "success";
            }
            else if($_data->row()->ban == 1){
              $_bandate = $_data->row()->due_ban;
              $_message = "Your have been banned from Penherz until";
            }
            else{
                $_message = "Please activate your account";
            }
        }
        else{
            $_message = "Invalid Credentials";
        }
        return array("token"=>$_token,"username"=>$_user,"user_id"=>$_user_id,"message"=>$_message);
    }

    function _insert_login($_params){
        $_username = $_params['username'];
        $_password = $_params['password'];
        $_email = $_params['email'];
        $_valid_token = '1';
        $_ban = '0';
        $_activated = '1';
        $_token = sha1(mt_rand());
        $_type = $_params['type'];

        $this->db->select('*');
        $_data = $this->db->get_where('login', array('username' => $_username));
        // var_dump($_data->num_rows);

        $_emails = $this->miscelanousmodel->_fetch_email_from_username($_username);
        if($_data->num_rows == 0 && $_emails == false){
          $_datauser = [
                  'username' => $_username,
                  'password' => md5($_password),
                  'email' => $_email,
                  'valid_token' => $_valid_token,
                  'token' => $_token,
                  'ban' => $_ban,
                  'activated' => $_activated,
                  'type' => $_type
          ];
          $this->db->insert('login', $_datauser);
          $insert_id = $this->db->insert_id();
          return $insert_id;
        }
        else{
            $_message = "Already Exist";
        }
        return array("message"=>$_message);
    }

    function _registeroffice($_params){
        $_username = $_params['username'];
        $_nationality = 'Nigeria';
        $_fullname = $_params['fullname'];
        $_sub_category = $_params['sub_category'];
        $_user_id = $this->miscelanousmodel->_fetch_id_from_username($_username);
        $_store = mt_rand(100,1000);
        $_store_no = $_user_id."".$_store;

        $_data = [
            'username' => $_username,
            'nationality' => $_nationality,
            'fullname' => $_fullname,
            'user_id' => $_user_id,
            'sub_category' => $_sub_category,
            'store_no' => $_store_no,
            'profilepic' => "default.png",
            'date' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('offices', $_data);
        $insert_id = $this->db->insert_id();

        $_storedata = [
            'store_no' => $_store_no,
            'user_id' => $_user_id
        ];
        $this->db->insert('stores', $_storedata);
        return $insert_id;
    }

    function _registerpage($_params){
        $_username = $_params['username'];
        $_nationality = 'Nigeria';
        $_firstname = $_params['firstname'];
        $_lastname = $_params['lastname'];
        $_sub_category = $_params['sub_category'];
        $_user_id = $this->miscelanousmodel->_fetch_id_from_username($_username);
        $_store = mt_rand(100,1000);
        $_store_no = $_user_id."".$_store;

        $_data = [
            'username' => $_username,
            'nationality' => $_nationality,
            'firstname' => $_firstname,
            'lastname' => $_lastname,
            'user_id' => $_user_id,
            'sub_category' => $_sub_category,
            'store_no' => $_store_no,
            'profilepic' => "default.png",
            'date' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('pages', $_data);
        $insert_id = $this->db->insert_id();

        $_storedata = [
            'store_no' => $_store_no,
            'user_id' => $_user_id
        ];
        $this->db->insert('stores', $_storedata);
        return $insert_id;
    }

    function _registeruser($_params){
        $_username = $_params['username'];
        $_nationality = 'Nigeria';
        $_firstname = $_params['firstname'];
        $_lastname = $_params['lastname'];
        $_user_id = $this->miscelanousmodel->_fetch_id_from_username($_username);

        $_data = [
                'username' => $_username,
                'nationality' => $_nationality,
                'firstname' => $_firstname,
                'lastname' => $_lastname,
                'user_id' => $_user_id,
                'profilepic' => "default.png",
                'date' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('members', $_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function _changepic($_parameters){
        $_user_id = $_parameters['userid'];
        $_image = $_parameters['image'];
        $this->db->set('profilepic', $_image);
        $where = "id = '$_user_id'";
        $this->db->where($where);
        $this->db->update("profile");
        return true;
    }

    function _changeusername($_parameters){
        $_user_id = $_parameters['userid'];
        $_username = $_parameters['username'];
        $this->db->set('username', $_username);
        $where = "id = '$_user_id'";
        $this->db->where($where);
        $this->db->update("profile");
        return true;
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class followmodel extends CI_Model {

    public function __construct()
    {
            parent::__construct();
            $ci =& get_instance();
            // $this->load->model('miscelanousmodel');
            // $this->load->model('notificationmodel');
    }

    function _fetch_followers($_user_id){
        $this->db->select('*');
        $_followers = $this->db->get_where('follow', array('user_id' => $_user_id,'status' => 1));
        if($_followers){
            $_data = array();
            foreach ($_followers->result() as $key => $value) {
                array_push($_data,$value->follower_id);
            }
            return $_data;
        } 
        return false;
    }

    function _count_followers($_user_id){
        $this->db->select('*');
        $_followers = $this->db->get_where('follow', array('user_id' => $_user_id,'status' => 1));
        if($_followers){
            return sizeof($_followers->result());
        } 
        return false;
    }

    function _fetch_following($_user_id){
        $this->db->select('*');
        $_following = $this->db->get_where('follow', array('follower_id' => $_user_id,'status' => 1));
        if($_following){
             $_data = array();
            foreach ($_following->result() as $key => $value) {
                array_push($_data,$value->user_id);
            }
            return $_data;
        } 
        return false;
    }

    function _count_following($_user_id){
        $this->db->select('*');
        $_following = $this->db->get_where('follow', array('follower_id' => $_user_id,'status' => 1));
        if($_following){
            return sizeof($_following->result());
        } 
        return false;
    }

    function _fetch_followers_full_details($_user_id){
        $followers = $this->_fetch_followers($_user_id);
        $data = array();
        $_len = sizeof($followers);
        for($i = 0;$i<$_len;$i++){
            $fullname = $this->miscelanousmodel->_fetch_fulname_from_id($followers[$i]);
            $username = $this->miscelanousmodel->_fetch_username_from_id($followers[$i]);
            $profilepic = $this->miscelanousmodel->_fetch_profile_pic($followers[$i]);
            array_push($data, array("id"=>$followers[$i],"username"=>$username,"fullname"=>$fullname,"profilepic"=>$profilepic));

        }
        return $data;
    }

    function _fetch_following_full_details($_user_id){
        $following = $this->_fetch_following($_user_id);
        $data = array();
        $_len = sizeof($following);
        for($i = 0;$i<$_len;$i++){
            $fullname = $this->miscelanousmodel->_fetch_fulname_from_id($following[$i]);
            $username = $this->miscelanousmodel->_fetch_username_from_id($following[$i]);
            $profilepic = $this->miscelanousmodel->_fetch_profile_pic($following[$i]);
            array_push($data, array("id"=>$following[$i],"username"=>$username,"fullname"=>$fullname,"profilepic"=>$profilepic));

        }
        return $data;
    }

    function _follow($_user_id,$_follower_id){
        $this->db->select('*');
        $_follow = $this->db->get_where('follow', array('user_id' => $_user_id,'follower_id' => $_follower_id));
        if(sizeof($_follow->result()) > 0){
            if($_follow->row()->status == 1){
                $this->_unfollow($_user_id,$_follower_id);
            }
            else{
                $this->_update_follow($_user_id,$_follower_id);
            }
            return $_follow->result();
        }
        else{
            $_data = [
                    'user_id' => $_user_id,
                    'follower_id' => $_follower_id,
                    'status' => 1,
                    'date' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('follow', $_data);
            $_insert_id = $this->db->insert_id();
            $_notifications_parameters = array("type"=>"follow","type_id"=>$_insert_id,"user_id"=>$_user_id,"seen"=>"0");
            $this->notificationmodel->_insert_notifications($_notifications_parameters);
        } 
        return false;
    }

    function _update_follow($_user_id,$_follower_id){
        $this->db->set('status', 1);
        $where = "user_id = '$_user_id' AND follower_id = '$_follower_id'";
        $this->db->where($where);
        $this->db->update("follow");
        return true;
    }

    function _unfollow($_user_id,$_follower_id){
        $this->db->set('status', 0);
        $where = "user_id = '$_user_id' AND follower_id = '$_follower_id'";
        $this->db->where($where);
        $this->db->update("follow");
        return true;
    }

    function _fetch_follow_by_id($_id){
        $this->db->select('*');
        $_follow = $this->db->get_where('follow', array('id' => $_id));
        if($_follow->num_rows == 1){
            $_follower_data = $_follow->row();
            $_data = array();
            $_fullname = $this->miscelanousmodel->_fetch_fulname_from_id($_follower_data->follower_id);
            $_username = $this->miscelanousmodel->_fetch_username_from_id($_follower_data->follower_id);
            $_profilepic = $this->miscelanousmodel->_fetch_profile_pic($_follower_data->follower_id);
            array_push($_data, array("id"=>$_follower_data->follower_id,"username"=>$_username,"fullname"=>$_fullname,"profilepic"=>$_profilepic));
            return $_data;
        } 
        return false;
    }


}
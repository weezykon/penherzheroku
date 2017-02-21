<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class notificationmodel extends CI_Model {

    public function __construct()
    {
            parent::__construct();
            $ci =& get_instance();
            // $this->load->model('miscelanousmodel');
            // $this->load->model('listenmodel');
            // $this->load->model('storiesmodel');
    }


    function _insert_notifications($_parameters){
        $_type = $_parameters['type'];
        $_type_id = $_parameters['type_id'];
        $_user_id = $_parameters['user_id'];
        $_data = [
                'type' => $_type,
                'type_id' => $_type_id,
                'user_id' => $_user_id,
                'seen' => '0',
                'date' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('notification', $_data);
        return true;
    }

    function _load_notifications($_user_id){
        $query ="SELECT * FROM notification WHERE user_id = ".$_user_id." ORDER BY `date` DESC LIMIT 10";
        $_notification = $this->db->query($query);
        if($_notification){
            $_notifications = $_notification->result();
            $_data = array();
            foreach ($_notifications as $key => $value) {
                $_type = $value->type;
                $_type_id = $value->type_id;
                $_user_id = $value->user_id;
                $_seen = $value->seen;
                $_date = $value->date;
                
                $_seen = $this->notificationmodel->_seen_notification($_user_id);
                if($_type == "follow"){
                    $data = $this->followmodel->_fetch_follow_by_id($_type_id);
                    // $data[0]['date'] = $_date;
                    if(sizeof($data)>0){
                        array_push($_data, array('type'=>'followed','data'=>$data,'description'=>''));
                    }
                }
                else if($_type == "mention_story"){
                    $data = $this->storiesmodel->_load_story_story_id($_type_id,$_user_id);
                    // $data->date = $_date;
                    if(sizeof($data)>0){
                        array_push($_data, array('type'=>'mentioned in story','data'=>$data,'description'=>''));
                    }
                }
                else if($_type == "mention_comment"){
                    $data = $this->storiesmodel->_get_stories_data_comment($_type_id,$_user_id);
                    // $data[0]['date'] = $_date;
                    if(sizeof($data)>0){
                        array_push($_data, array('type'=>'mentioned in comment','data'=>$data,'description'=>''));
                    }
                }
                else if($_type == "love"){
                    $data = $this->storiesmodel->_get_stories_data_love($_type_id,$_user_id);
                    // $data[0]['date'] = $_date;
                    if(sizeof($data)>0){
                        array_push($_data, array('type'=>'loved','data'=>$data,'description'=>'you participated in'));
                    }      
                }
                else if($_type == "comment"){
                    $data = $this->storiesmodel->_get_stories_data_comment($_type_id,$_user_id);
                    // $data[0]['date'] = $_date;
                    if(sizeof($data)>0){
                        array_push($_data, array('type'=>'commented','data'=>$data));
                    }
                }
            }
            return $_data;
        } 
        return false;
    }

    function _seen_notification($_user_id){
        $this->db->set('seen', '1');
        $where = "user_id = '$_user_id'";
        $this->db->where($where);
        $this->db->update("notification");
        return true;
    }

    function _check_new_notifications($_user_id){
        $this->db->select('*');
        $_data = $this->db->get_where('notification', array('user_id' => $_user_id, 'seen' => '0'));
        if($_data->num_rows > 0){
          return $_data->num_rows();
        }
        return false;
    }
}
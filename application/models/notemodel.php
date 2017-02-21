<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class notemodel extends CI_Model {

    public function __construct()
    {
            parent::__construct();
            $ci =& get_instance();
    }

    function _fetch_all_notes($_user_id){
      $this->db->select('*');
        $_note = $this->db->get_where('notes', array('user_id' => $_user_id,'visible' => 1));
        $data = array();
        if($_note->num_rows > 0){
            $_note_result = $_note->result();
            foreach ($_note_result as $key => $value) {
                $_user_id = $value->user_id;
                $_note = $value->note;
                $_id = $value->id;
                $_title = $value->title;
                $_visible = $value->visible;
                $_date = $value->date;
                $_privacy = $value->privacy;
                if($value->visible == 1){
                    $data[sizeof($data)] = json_decode(json_encode(['id'=>$_id,'user_id'=>$_user_id,'title'=>$_title,'note'=>$_note,'visible'=>$_visible,'date'=>$_date,'privacy'=>$_privacy]));
                }

            }
            return $data;
        }
        return false;
    }

    function _fetch_public_notes($_user_id){
      $this->db->select('*');
        $_note = $this->db->get_where('notes', array('user_id' => $_user_id,'visible' => 1,'privacy' => 0));
        $data = array();
        if($_note->num_rows > 0){
            $_note_result = $_note->result();
            foreach ($_note_result as $key => $value) {
                $_user_id = $value->user_id;
                $_note = $value->note;
                $_id = $value->id;
                $_title = $value->title;
                $_visible = $value->visible;
                $_date = $value->date;
                $_privacy = $value->privacy;
                if($value->visible == 1){
                    $data[sizeof($data)] = json_decode(json_encode(['id'=>$_id,'user_id'=>$_user_id,'title'=>$_title,'note'=>$_note,'visible'=>$_visible,'date'=>$_date,'privacy'=>$_privacy]));
                }

            }
            return $data;
        }
        return false;
    }

    function _fetch_single_note($_note_id){
      $this->db->select('*');
      $_data = $this->db->get_where('notes', array('id' => $_note_id, 'visible' => 1));
      if($_data->num_rows == 1){
          return $_data->row();
      }
      return false;
    }

    function _add_note($_params,$_user_id){
        $_title = $_params['title'];
        $_note = $_params['note'];
        $_privacy = $_params['privacy'];
        $_visible = '1';
        $_data = [
                'title' => $_title,
                'note' => $_note,
                'user_id' => $_user_id,
                'visible' => $_visible,
                'privacy' => $_privacy,
                'date' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('notes', $_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function _edit_note($_params){
        $_title = $_params['title'];
        $_note = $_params['note'];
        $_privacy = $_params['privacy'];
        $_note_id = $_params['note_id'];
        $_data = [
                'title' => $_title,
                'note' => $_note,
                'privacy' => $_privacy,
                'date' => date('Y-m-d H:i:s')
        ];
        $this->db->set($_data);
        $where = "id = '$_note_id'";
        $this->db->where($where);
        $this->db->update("notes");
        return true;
    }

    function _delete_note($_id){
        $this->db->set('visible', 0);
        $where = "id = '$_id'";
        $this->db->where($where);
        $this->db->update("notes");
        return true;
    }

}
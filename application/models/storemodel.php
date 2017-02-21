<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class storemodel extends CI_Model {

    public function __construct()
    {
            parent::__construct();
            $ci =& get_instance();
    }

    function _fetch_categories(){
      $this->db->select('*');
      $_data = $this->db->get_where('category');
      if($_data->num_rows > 0){
          return $_data->row();
      }
      return false;
    }

    function _fetch_stores(){
      $this->db->select('*');
      $_data = $this->db->get_where('stores');
      if($_data->num_rows > 0){
          return $_data->row();
      }
      return false;
    }

    function _fetch_items(){
      $this->db->select('*');
      $_data = $this->db->get_where('items');
      if($_data->num_rows > 0){
          return $_data->row();
      }
      return false;
    }

    function _fetch_cart($_user_id){
      $this->db->select('*');
      $_data = $this->db->get_where('cart', array('user_id' => $_user_id));
      if($_data->num_rows > 0){
          return $_data->row();
      }
      return false;
    }

    function _fetch_wishlist($_user_id){
      $this->db->select('*');
      $_data = $this->db->get_where('cart', array('user_id' => $_user_id));
      if($_data->num_rows > 0){
          return $_data->row();
      }
      return false;
    }

    function _fetch_user_sold_items($_user_id){
      $this->db->select('*');
      $_data = $this->db->get_where('sold_items', array('user_id' => $_user_id));
      if($_data->num_rows > 0){
          return $_data->row();
      }
      return false;
    }

    function _fetch_favorite_store($_user_id){
      $this->db->select('*');
      $_data = $this->db->get_where('favorite_store', array('user_id' => $_user_id));
      if($_data->num_rows > 0){
          return $_data->row();
      }
      return false;
    }
}
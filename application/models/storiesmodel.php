<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class storiesmodel extends CI_Model {

    public function __construct()
    {
            parent::__construct();
            $ci =& get_instance();
            // $this->load->model('notificationmodel');
    }

    function _check_user_loved_story($_user_id,$_story_id){
        $this->db->select('*');
        $_loved = $this->db->get_where('love', array('user_id' => $_user_id,'story_id' => $_story_id,'status' => 1));
        if($_loved->num_rows == 1){
            return 1;
        }
        return 0;
    }

    function _get_username_from_story_id($_story_id){
        $this->db->select('user_id');
        $_user_id = $this->db->get_where('stories', array('id' => $_story_id));
        if($_user_id->num_rows == 1){
            $_user_id = $_user_id->row()->user_id;
            $username = $this->miscelanousmodel->_fetch_username_from_id($_user_id);
            return $username;
        }
        return 0;
    }

    function _load_story_user_id($_user_id,$_for_id){
        $this->db->select('*');
        $_story = $this->db->get_where('stories', array('user_id' => $_user_id,'visible' => 1));
        $data = array();
        if($_story){
            $_story_result = $_story->result();
            foreach ($_story_result as $key => $value) {
                $_user_id = $value->user_id;
                $_story = $value->story;
                $_fstory = $this->miscelanousmodel-> _check_handles($value->story);
                $_id = $value->id;
                $_visible = $value->visible;
                $_image = $value->image;
                $_audio = $value->audio;
                $_date = $value->date;
                $_story_id = $value->id;
                $_comment = $this->_load_comment_story($_story_id);
                $_loved = $this->_check_user_loved_story($_for_id,$_story_id);
                $_fullname = $this->miscelanousmodel->_fetch_fulname_from_id($_user_id);
                $_username = $this->miscelanousmodel->_fetch_username_from_id($_user_id);
                $_profilepic = $this->miscelanousmodel->_fetch_profile_pic($_user_id);
                if($value->visible == 1){
                  $data[sizeof($data)] = json_decode(json_encode(['id'=>$_id,'user_id'=>$_user_id,'story'=>$_story,'formatted_story'=>$_fstory,'visible'=>$_visible,'image'=>$_image,'audio'=>$_audio,'date'=>$_date,'loved' => $_loved,'fullname' => $_fullname,'username' => $_username,'profilepic' => $_profilepic,'comments' => $_comment]));
                }


            }
            return $data;
        }
        return false;
    }

    function _load_story_story_id($_story_id,$_user_id){
        $this->db->select('*');
        $_story = $this->db->get_where('stories', array('id' => $_story_id,'visible' => 1));
        $data = array();
        if($_story->num_rows > 0){
            $_story_result = $_story->result();
            foreach ($_story_result as $key => $value) {
                $_user_id_id = $value->user_id;
                $_story = $value->story;
                $_fstory = $this->miscelanousmodel-> _check_handles($value->story);
                $_id = $value->id;
                $_visible = $value->visible;
                $_image = $value->image;
                $_audio = $value->audio;
                $_date = $value->date;
                $_story_id = $value->id;
                $_comment = $this->_load_comment_story($_story_id);
                $_loved = $this->_check_user_loved_story($_user_id,$_story_id);
                $_fullname = $this->miscelanousmodel->_fetch_fulname_from_id($_user_id_id);
                $_username = $this->miscelanousmodel->_fetch_username_from_id($_user_id_id);
                $_profilepic = $this->miscelanousmodel->_fetch_profile_pic($_user_id_id);
                if($value->visible == 1){
                    $data[sizeof($data)] = json_decode(json_encode(['id'=>$_id,'user_id'=>$_user_id,'story'=>$_story,'formatted_story'=>$_fstory,'visible'=>$_visible,'image'=>$_image,'audio'=>$_audio,'date'=>$_date,'loved' => $_loved,'fullname' => $_fullname,'username' => $_username,'profilepic' => $_profilepic,'comments' => $_comment]));
                }

            }
            return $data;
        }
        return false;
    }

    function _load_timeline($_string,$_user){
        $query ="SELECT * FROM stories WHERE ".$_string."  AND visible = 1";
        $_story = $this->db->query($query);
        $data = array();
        if($_story->num_rows() > 0){
            $_story_result = $_story->result();
            foreach ($_story_result as $key => $value) {
                $_user_id = $value->user_id;
                $_story = $value->story;
                $_fstory = $this->miscelanousmodel-> _check_handles($value->story);
                $_id = $value->id;
                $_visible = $value->visible;
                $_image = $value->image;
                $_audio = $value->audio;
                $_date = $value->date;
                $_story_id = $value->id;
                $_comment = $this->_load_comment_story($_story_id);
                $_loved = $this->_check_user_loved_story($_user,$_story_id);
                $_fullname = $this->miscelanousmodel->_fetch_fulname_from_id($_user_id);
                $_username = $this->miscelanousmodel->_fetch_username_from_id($_user_id);
                $_profilepic = $this->miscelanousmodel->_fetch_profile_pic($_user_id);
                if($value->visible == 1){
                        $data[sizeof($data)] =  json_decode(json_encode(['id'=>$_id,'user_id'=>$_user_id,'story'=>$_story,'formated_story'=>$_fstory,'visible'=>$_visible,'image'=>$_image,'audio'=>$_audio,'date'=>$_date,'loved' => $_loved,'fullname' => $_fullname,'username' => $_username,'profilepic' => $_profilepic,'comments' => $_comment ]));
                }
            }
            return $data;
        }
        return array();
    }

    function _delete_story($_story_id){
        $this->db->set('visible', 0);
        $where = "id = '$_story_id'";
        $this->db->where($where);
        $this->db->update("stories");
        return true;
    }

    function _love_story($_user_id,$_story_id){
        $this->db->select('*');
        $_love = $this->db->get_where('love', array('user_id' => $_user_id,'story_id' => $_story_id));
        if($_love->num_rows == 1){
            $_status = $_love->row()->status;
            if($_status == 0){
                $this->db->set('status', 1);
                $where = "user_id = '$_user_id' AND story_id = '$_story_id'";
                $this->db->where($where);
                $this->db->update("love");
                // $this->_update_love_count($_story_id,"+");
            }
            else if ($_status == 1){
                $this->db->set('status', 0);
                $where = "user_id = '$_user_id' AND story_id = '$_story_id'";
                $this->db->where($where);
                $this->db->update("love");
                // $this->_update_love_count($_story_id,"-");
            }
            return true;
        }
        else{
            $_data = [
                'story_id' => $_story_id,
                'user_id' => $_user_id,
                'status' => 1,
                'date' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('love', $_data);
            $_love_id = $this->db->insert_id();
            $_participants = $this->_get_story_participants($_story_id,$_user_id);
            $_loved_story = $_participants['loved_story'];
            $_len_loved = sizeof($_loved_story);
            $_storyowner = $this->miscelanousmodel->_fetch_user_id_from_story_id($_story_id);
            $_commented_story = $_participants['commented_story'];
            $_all = array();
            array_push($_all,$_user_id);
            // var_dump($_user_id, $_storyowner);
            $_notifications_parameters = array("type"=>"love","type_id"=>$_love_id,"user_id"=>$_storyowner,"user_action"=>"");
            $this->notificationmodel->_insert_notifications($_notifications_parameters);

            for($i = 0;$i<$_len_loved;$i++){
                $_user = $_loved_story[$i];
                if(in_array($_user, $_all)){
                    continue;   
                }
                else{
                    $_notifications_parameters = array("type"=>"love","type_id"=>$_love_id,"user_id"=>$_user,"user_action"=>"");
                    $this->notificationmodel->_insert_notifications($_notifications_parameters);

                    array_push($_all,$_user);
                }
                
            }
        }
        return false;
    }

    function _update_love_count($_story_id,$_status){
        if($_status == "+"){
            $_love_count = $this->db->get_where('story', array('id' => $_story_id))->row()->love_count;
            $_increase = $_love_count + 1;
            $this->db->set('love_count', $_increase);
            $where = "id = '$_story_id'";
            $this->db->where($where);
            $this->db->update("story");
        }
        else if($_status == "-"){
            $_love_count = $this->db->get_where('story', array('id' => $_story_id))->row()->love_count;
            $_decrease = $_love_count - 1;
            $this->db->set('love_count', $_decrease);
            $where = "id = '$_story_id'";
            $this->db->where($where);
            $this->db->update("story");
        }
        return true;
    }

    function _update_comment_count($_story_id){
        $this->db->set('comment_count', 'comment_count + 1');
        $where = "id = '$_story_id'";
        $this->db->where($where);
        $this->db->update("story");
        return true;
    }

    function _get_story_participants($_story_id,$_user_id){
        // $_loved_story = $this->_loved_story($_story_id);
        // $_commented_story =  $this->_commented_story($_story_id);
        // $_storyteller = $this->_load_story_story_id($_story_id,$_user_id)[0]->user_id;
        // foreach ($_commented_story as $key => $value){
        //     $_mentioned_in_comment = $this->_mentioned_in_comment($value);
        //     $_mention_len = sizeof($_mentioned_in_comment);
        //     for($i = 0;$i<$_mention_len;$i++){
        //        array_push($_mentioned_comment, $_mentioned_in_comment[$i]);
        //     }
        // }
        // $_participants = array("loved_story"=>$_loved_story,"commented_story"=>$_commented_story,"storyteller"=>$_storyteller);
        // return $_participants;

        $_loved_story = $this->_loved_story($_story_id);
        $_mentioned_story =  $this->_mentioned_in_story($_story_id);
        $_commented_story =  $this->_commented_story($_story_id);
        $_storyteller = $this->_load_story_story_id($_story_id,$_user_id)[0]->user_id;
        $_mentioned_comment = array();
        foreach ($_commented_story as $key => $value){
            $_mentioned_in_comment = $this->_mentioned_in_comment($value);
            $_mention_len = sizeof($_mentioned_in_comment);
            for($i = 0;$i<$_mention_len;$i++){
               array_push($_mentioned_comment, $_mentioned_in_comment[$i]);
            }
        }
        $_participants = array("loved_story"=>$_loved_story,"mentioned_story"=>$_mentioned_story,"commented_story"=>$_commented_story,"mentioned_comment"=>$_mentioned_comment,"storyteller"=>$_storyteller);
        return $_participants;
    }

    function _loved_story($_story_id){
        $query ="SELECT DISTINCT user_id FROM love WHERE story_id = '$_story_id'  AND status = 1";
        $query = $this->db->query($query);
        if($query->num_rows > 0){
            $_loved_story = $query->result(); 
            $_loved_len = sizeof($_loved_story);
            $_love_array = array();
            for($i = 0;$i<$_loved_len;$i++){
                array_push($_love_array,$_loved_story[$i]->user_id);
            } 
            return $_love_array;
        }
        return array();
    }

    function _comment_id_story($_story_id){
        $query ="SELECT id FROM commenta WHERE story_id = '$_story_id'  AND status = 1";
        $query = $this->db->query($query);
        if($query->num_rows() > 0){
            $_commented_story = $query->result(); 
            $_commented_len = sizeof($_commented_story);
            $_comment_id_array = array();
            for($i = 0;$i<$_commented_len;$i++){
                array_push($_comment_id_array,$_commented_story[$i]->id);
            } 
            return $_comment_id_array;
        }
        return array();
    }

    function _comment_story($_user_id,$_story_id,$_comment){
        $_data = [
                'story_id' => $_story_id,
                'user_id' => $_user_id,
                'comment' => $_comment,
                'status' => 1,
                'date' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('comments', $_data);
        $_comment_id = $this->db->insert_id();
        // $_update = $this->_update_comment_count($_story_id);
        $this->_handle_mention($_comment,"mention_comment",$_comment_id);
        $_participants = $this->_get_story_participants($_story_id,$_user_id);
        $_loved_story = $_participants['loved_story'];
        $_len_loved = sizeof($_loved_story);
        $_mentioned_story = $_participants['mentioned_story'];
        $_len_mentioned_story = sizeof($_mentioned_story);
        $_commented_story = $_participants['commented_story'];
        $_len_commented = sizeof($_commented_story);
        $_mentioned_comment = $_participants['mentioned_comment'];
        $_len_mentioned_comment = sizeof($_mentioned_comment);
        $_storyowner = $this->miscelanousmodel->_fetch_user_id_from_story_id($_story_id);
        // $_storyowner = $_participants['user_id'];
        $_all = array();
        array_push($_all,$_user_id);

        $_notifications_parameters = array("type"=>"comment","type_id"=>$_comment_id,"user_id"=>$_storyowner,"seen"=>"0");
        $this->notificationmodel->_insert_notifications($_notifications_parameters);

        for($i = 0;$i<$_len_loved;$i++){
            $_user = $_loved_story[$i];
            if(in_array($_user, $_all)){
                continue;
            }
            else{
                $_notifications_parameters = array("type"=>"comment","type_id"=>$_comment_id,"user_id"=>$_user,"seen"=>"0");
                $this->notificationmodel->_insert_notifications($_notifications_parameters);

                array_push($_all,$_user);
            }

        }

        for($i = 0;$i<$_len_mentioned_story;$i++){
            $_user = $_mentioned_story[$i];
            if(in_array($_user, $_all)){
                continue;   
            }
            else{
                $_notifications_parameters = array("type"=>"comment","type_id"=>$_comment_id,"user_id"=>$_user,"seen"=>"0");
                $this->notificationmodel->_insert_notifications($_notifications_parameters);

                array_push($_all,$_user);
            }
        }

        for($i = 0;$i<$_len_commented;$i++){
            $_user = $_commented_story[$i];
            if(in_array($_user, $_all)){
                continue;
            }
            else{
                $_notifications_parameters = array("type"=>"comment","type_id"=>$_comment_id,"user_id"=>$_user,"seen"=>"0");
                $this->notificationmodel->_insert_notifications($_notifications_parameters);

                array_push($_all,$_user);
            }
        }

        for($i = 0;$i<$_len_mentioned_comment;$i++){
            $_user = $_mentioned_comment[$i];
            if(in_array($_user, $_all)){
                continue;   
            }
            else{
                $_notifications_parameters = array("type"=>"comment","type_id"=>$_comment_id,"user_id"=>$_user,"seen"=>"0");
                $this->notificationmodel->_insert_notifications($_notifications_parameters);

                array_push($_all,$_user);
            }
        }
        return true;
        ////////////continue comment_story
    }

    function _commented_story($_story_id){
        $query ="SELECT DISTINCT user_id FROM comments WHERE story_id = '$_story_id'  AND status = 1";
        $query = $this->db->query($query);
        if($query->num_rows() > 0){
            $_commented_story = $query->result(); 
            $_commented_len = sizeof($_commented_story);
            $_comment_array = array();
            for($i = 0;$i<$_commented_len;$i++){
                array_push($_comment_array,$_commented_story[$i]->user_id);
            } 
            return $_comment_array;
        }
        return array();
    }

    function _insertstory($_parameters){
        $_story = $_parameters['story'];
        $_user_id = $_parameters['user_id'];
        $_image = $_parameters['image'];
        $_audio = $_parameters['audio'];
        $_data = [
                'user_id' => $_user_id,
                'story' => $_story,
                'image' => $_image,
                'audio' => $_audio,
                'visible' => 1,
                'date' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('stories', $_data);
        $_story_id = $this->db->insert_id();
        $this->_handle_mention($_story,"mention_story",$_story_id);
        return $_story_id;
    }

    function _report_story($_parameters){
        $_story_id = $_parameters['story_id'];
        $_user_id = $_parameters['user_id'];
        $_data = [
                'user_id' => $_user_id,
                'story_id' => $_story_id,
                'date' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('report', $_data);
        $_story_id = $this->db->insert_id();
        return $_story_id;
    }

    function _save_story($_parameters){
        $_story_id = $_parameters['story_id'];
        $_user_id = $_parameters['user_id'];
        $_data = [
                'user_id' => $_user_id,
                'story_id' => $_story_id,
                'date' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('favorite_stories', $_data);
        $_saved_id = $this->db->insert_id();
        return $_saved_id;
    }

    function _fetch_saved_stories($_user_id){
        $this->db->select('*');
        $_stories = $this->db->get_where('favorite_stories', array('user_id' => $_user_id));
        $data = array();
        if($_stories->num_rows > 0){
            $_stories_result = $_stories->result();
            foreach ($_stories_result as $key => $value) {
                $_user_id = $value->user_id;
                $_story_id = $value->story_id;
                $_id = $value->id;
                $_date = $value->date;
                $_storyowner = $this->miscelanousmodel->_fetch_user_id_from_story_id($_story_id); 
                $_storydetails = $this->_load_story_story_id($_story_id,$_storyowner);
                // if($value->visible == 1){
                    $data[sizeof($data)] = json_decode(json_encode(["storydetails"=>$_storydetails]));
                // }
            }
            return $data;
        }
        return false;
    }

    function _get_stories_data_comment($_comment_id,$_user_id){
        $query ="SELECT * FROM comments WHERE id = '$_comment_id'";
        $query = $this->db->query($query);
        if($query->num_rows() > 0){
            $_data = array();
            $_result = $query->row();
            $_story_id = $_result->story_id; 
            $_user_ids = $_result->user_id; 
            $_comment = $_result->comment; 
            $_storydetails = $this->_load_story_story_id($_story_id,$_user_id);
            $_fullname = $this->miscelanousmodel->_fetch_fulname_from_id($_user_id);
            $_username = $this->miscelanousmodel->_fetch_username_from_id($_user_id);
            $_profilepic = $this->miscelanousmodel->_fetch_profile_pic($_user_id);
            

            array_push($_data,array("commenter_id"=>$_user_id,"commenter_username"=>$_username,"commenter_fullname"=>$_fullname,"commenter_profilepic"=>$_profilepic,"comment"=>$_comment,"storydetails"=>$_storydetails));
            return $_data;
        }
        return array();
    }

    function _get_stories_data_love($_comment_id,$_user_id){
        $query ="SELECT * FROM love WHERE id = '$_comment_id'";
        $query = $this->db->query($query);
        if($query->num_rows() > 0){
            $_data = array();
            $_result = $query->row();
            $_story_id = $_result->story_id; 
            $_user_id = $_result->user_id; 
            $_storydetails = $this->_load_story_story_id($_story_id,$_user_id);
            $_fullname = $this->miscelanousmodel->_fetch_fulname_from_id($_user_id);
            $_username = $this->miscelanousmodel->_fetch_username_from_id($_user_id);
            $_profilepic = $this->miscelanousmodel->_fetch_profile_pic($_user_id);

            array_push($_data,array("lover_id"=>$_user_id,"lover_username"=>$_username,"lover_fullname"=>$_fullname,"lover_profilepic"=>$_profilepic,"storydetails"=>$_storydetails));
            return $_data;
        }
        return array();
    }

    function _load_comment_story($_story_id){
        $this->db->select('*');
        $_comment = $this->db->get_where('comments', array('story_id' => $_story_id,'status' => 1));
        $_data = array();
        if($_comment){
            $_comment_result = $_comment->result();
            $data = array();
            foreach ($_comment_result as $key => $value) {
                $_story_id = $value->story_id;
                $_user_id = $value->user_id;
                $_id = $value->id;
                $_status = $value->status;
                $_date = $value->date;
                $_comment = $value->comment;
                $_username = $this->miscelanousmodel->_fetch_username_from_id($_user_id);
                $_fullname = $this->miscelanousmodel->_fetch_fulname_from_id($_user_id);
                $_profilepic = $this->miscelanousmodel->_fetch_profile_pic($_user_id);
                array_push($_data,array("id"=>$_id,"user_id"=>$_user_id,"story_id"=>$_story_id,"comment"=>$_comment,"status"=>$_status,"username"=>$_username,"fullname"=>$_fullname,"profilepic"=>$_profilepic,"date"=>$_date));
            }
            return $_data;
        } 
        return false;
    }

    function _mentioned_in_story($_story_id){
        $_query = "SELECT ids FROM story_meta WHERE type ='mention_story' AND type_id = '$_story_id'";
        $_query = $this->db->query($_query);
        if($_query->num_rows() > 0){
            $_result = $query->result(); 
            $_mention_array = array();
            $_mention_array = explode(',', $_result[0]["ids"]);
            return $_mention_array;

        }
        return array();
    }

    function _mentioned_in_comment($_comment_id){
        $_query = "SELECT ids FROM story_meta WHERE type ='mention_comment' AND type_id = '$_comment_id'";
        $_query = $this->db->query($_query);
        if($_query->num_rows() > 0){
            $_result = $query->result(); 
            $_mention_array = array();
            $_mention_array = explode(',', $_result[0]["ids"]);
            return $_mention_array;

        }
        return array();
    }

    function _check_mention($_string){
        $_handles = preg_match_all("/@\w*\s*|@\w*/ ", $_string,$hand);
        // $_trends = preg_match_all("/#\w*\s*|#\w*/ ", $_string,$tren);
        $_handle = "";
        // $_trend = "";

        $_handles = $hand[0];
        // $_trends = $tren[0];

        if( $_handles != NULL){
            if(sizeof($_handles) > 0){
                $_handles_length = sizeof($_handles);
                $_handles_length_minus = $_handles_length - 1;

                for( $i= 0;$i<$_handles_length;$i++){
                    $_handles[$i] = trim($_handles[$i]);
                    if($i == $_handles_length_minus){
                        $_handle .= $_handles[$i];
                    }
                    else{
                        $_handle .= $_handles[$i].",";
                    }
                }
            }
        }
        else{
            $_handles = array();
        }

        // if( $_trends != NULL){
        //     if(sizeof($_trends) > 0){
        //         $_trends_length = sizeof($_trends);
        //         $_trends_length_minus = $_trends_length - 1;
        //         for( $i= 0;$i<$_trends_length;$i++){
        //             $_trends[$i] = trim($_trends[$i]);
        //             if($i == $_trends_length_minus){
        //                 $_trend .= $_trends[$i];
        //             }
        //             else{
        //                 $_trend .= $_trends[$i].",";
        //             }
        //         }
        //     }
        // }
        // else{
        //     $_trends = array();
        // }

        // $_all = array("handles"=>$_handles,"trends"=>$_trends,"handle_list"=>$_handle,"trend_list"=>$_trend);
        $_all = array("handles"=>$_handles,"handle_list"=>$_handle);
        return $_all;
    }

    function _handle_mention($_string,$_type,$_type_id){
        $_arr = $this->_check_mention($_string);
        $_ids = array();
        $_ids_string = "";
        $_i = 0;
        $_size = sizeof($_arr["handles"]);
        if($_size > 0){
            for($i=0;$i<$_size;$i++){
                $_username = substr($_arr["handles"][$i],1);
                $_id = $this->miscelanousmodel->_fetch_id_from_username($_username);
                array_push($_ids, $_id);
                $_ids_string .= $_id.",";

            }
            $_arr["id_array"] = $_ids;
            $_arr["id"] = $_ids_string;
            $_parameters = array("type"=>$_type,"typeid"=>$_type_id,"ids"=>$_arr["id"],"mentions"=>$_arr["handle_list"]);
            $_insert = $this->_insert_into_story_meta($_parameters);
            for($i=0;$i<$_size;$i++){
                $_user_id = $_ids[$i];
                $_notifications_parameters = array("type"=>$_type,"type_id"=>$_type_id,"user_id"=>$_user_id,"seen"=>"0");
                if($_user_id != false){
                    $this->notificationmodel->_insert_notifications($_notifications_parameters);
                }
            }
            return true;
        }
        else{
            return false;
        }
    }

    function _insert_into_story_meta($_parameters){
        $_type = $_parameters['type'];
        $_type_id = $_parameters['typeid'];
        $_ids = $_parameters['ids'];
        $_mentions = $_parameters['mentions'];
        $_data = [
                'type' => $_type,
                'type_id' => $_type_id,
                'ids' => $_ids,
                'mentions' => $_mentions
        ];
        $this->db->insert('story_meta', $_data);
        $_story_id = $this->db->insert_id();
        return  $_story_id;
    }
}
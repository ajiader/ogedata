<?php
defined('IN_DESTOON') or exit('Access Denied');
class attr {
    var $id;
    var $db;
    var $table;
    var $fields;
    var $errmsg = errmsg;

    function attr() {
        global $db, $DT_PRE;
        $this->table = $DT_PRE.'attribute';
        $this->db = &$db;
        $this->fields = array('attr_id','typeid','attr_name','attr_input_type','attr_type','attr_values','attr_index','sort_order','is_linked','attr_group');
    }

    function pass($post) {
        global $L;
        if(!is_array($post)) return false;
        if(!$post['typeid']) return $this->_('请选择分类名称！');
        if(!$post['attr_name']) return $this->_('请输入属性名称！');
        return true;
    }

    function set($post) {
        global $MOD, $DT_TIME, $_username, $_userid;
        /*		if(!$this->id) $post['addtime'] = $DT_TIME;
                $post['edittime'] = $DT_TIME;
                $post['editor'] = $_username;
                clear_upload($post['thumb']);*/
        return array_map("trim", $post);
    }

    function get_one() {
        return $this->db->get_one("SELECT * FROM {$this->table} WHERE attr_id='$this->id'");
    }

    function get_list($condition = '1', $order = 'id asc') {

        global $MOD, $TYPE, $pages, $page, $pagesize, $offset, $sum;

        if($page > 1 && $sum) {
            $items = $sum;
        } else {
            $r = $this->db->get_one("SELECT COUNT(*) AS num FROM {$this->table} WHERE $condition");
            $items = $r['num'];
        }

        $pages = pages($items, $page, $pagesize);
        $lists = array();
        $result = $this->db->query("SELECT * FROM {$this->table} WHERE $condition ORDER BY $order LIMIT $offset,$pagesize");
        while($r = $this->db->fetch_array($result)) {
            $lists[] = $r;
        }

        return $lists;
    }

    function add($post) {
        global $DT, $MOD, $module;
        $post = $this->set($post);
        $sqlk = $sqlv = '';
        foreach($post as $k=>$v) {
            if(in_array($k, $this->fields)) { $sqlk .= ','.$k; $sqlv .= ",'$v'"; }
        }
        $sqlk = substr($sqlk, 1);
        $sqlv = substr($sqlv, 1);
        $this->db->query("INSERT INTO {$this->table} ($sqlk) VALUES ($sqlv)");
        $this->id = $this->db->insert_id();
        return $this->id;
    }

    function edit($post) {
        global $DT, $MOD, $module;
        $post = $this->set($post);
        $sql = '';
        foreach($post as $k=>$v) {
            if(in_array($k, $this->fields)) $sql .= ",$k='$v'";
        }
        $sql = substr($sql, 1);
        $this->db->query("UPDATE {$this->table} SET $sql WHERE attr_id=$this->id");
        return true;
    }

    function delete($id, $all = true) {
        if(is_array($id)) {
            foreach($id as $v) {
                $this->delete($v, $all);
            }
        } else {
            $this->id = $id;
            $r = $this->get_one();
            if($all) {
                $userid = get_user($r['editor']);
                if($r['thumb']) delete_upload($r['thumb'], $userid);
                $this->db->query("DELETE FROM {$this->table} WHERE attr_id=$id");
            }
        }
    }

    function check($id) {
        global $_username, $DT_TIME;
        if(is_array($id)) {
            foreach($id as $v) { $this->check($v); }
        } else {
            $this->db->query("UPDATE {$this->table} SET status=3,editor='$_username',edittime=$DT_TIME WHERE attr_id=$id");
            return true;
        }
    }

    function order($listorder) {
        if(!is_array($listorder)) return false;
        foreach($listorder as $k=>$v) {
            $k = intval($k);
            $v = intval($v);
            $this->db->query("UPDATE {$this->table} SET sort_order=$v WHERE attr_id=$k");
        }
        return true;
    }


    function _($e) {
        $this->errmsg = $e;
        return false;
    }
}
?>
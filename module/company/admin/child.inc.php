<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2013 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');

$menus = array (
    array('添加代理商', '?moduleid='.$moduleid.'&file='.$file.'&userid='.$userid.'&action=add'),
    array('代理商列表', '?moduleid='.$moduleid.'&file='.$file.'&userid='.$userid),
);
// $TYPE = array('单行文本(text)', '多行文本(textarea)', '列表选择(select)', '复选框(checkbox)');
$do = new comchild;
$do->userid = $userid;
switch($action) {
	case 'add':
		if($submit) {
			if($do->pass($post)) {
				$do->add($post);
				dmsg('添加成功', '?moduleid='.$moduleid.'&file='.$file.'&userid='.$userid);
			} else {
				msg($do->errmsg);
			}
		} else {
		
			$required = $search = 0;
			$name = $value = $extend = '';
			include tpl('childform', $module);
		}
	break;
	case 'edit':
		$id or msg();
		$do->id = $id;
		if($submit) {
			if($do->pass($post)) {
				$do->edit($post);
				dmsg('修改成功', $forward);
			} else {
				msg($do->errmsg);
			}
		} else {
			extract($do->get_one($id));
			include tpl('childform', $module);
		}
	break;
	case 'order':
		$do->order($listorder, $pid);
		dmsg('排序成功', $forward);
	break;
	case 'delete':
		$id or msg();
		$do->id = $id;
		$do->delete($pid);
		dmsg('删除成功', '?moduleid='.$moduleid.'&file='.$file.'&userid='.$userid);
	break;
	default:
		$lists = $do->get_list();
		include tpl('childlist', $module);
	break;
}
class comchild {
	var $db;
	var $id;
	var $userid;
	var $table;
	var $errmsg = errmsg;

	function comchild() {
		global $db, $DT_PRE;
		$this->table = $DT_PRE.'comchild';
		$this->db = &$db;
	}

	function pass($post) {
		if(!is_array($post)) return false;
		//if(!$post['pid']) return $this->_(lang('message->pass_property_op_pid'));
		if(!$post['country']) return $this->_('请填写国家');
		if(!$post['level']) return $this->_('请填写代理级别');
		if(!$post['comname']) return $this->_('请填写商家名称');
		if(!$post['tel']) return $this->_('请填写商家联系方式');
		return true;
	}

	function set($post) {
		$post = array_map('trim', $post);
		if ($action == 'add') {
			$post['addtime'] = time();
		}
		return $post;
	}

	function add($post) {
		$post = $this->set($post);

		$sqlk = $sqlv = '';
		foreach($post as $k=>$v) {
			$sqlk .= ','.$k; $sqlv .= ",'$v'";
		}
        $sqlk = substr($sqlk, 1);
        $sqlv = substr($sqlv, 1);
		$this->db->query("INSERT INTO {$this->table} ($sqlk) VALUES ($sqlv)");
		return true;
	}

	function edit($post) {
		$post = $this->set($post);
		$sql = '';
		foreach($post as $k=>$v) {
			$sql .= ",$k='$v'";
		}
        $sql = substr($sql, 1);
	    $this->db->query("UPDATE {$this->table} SET $sql WHERE id=$this->id");
		return true;
	}

	function get_one() {
        return $this->db->get_one("SELECT * FROM {$this->table} WHERE id=$this->id");
	}

	function delete($pid) {
		$this->db->query("DELETE FROM {$this->table} WHERE id=$this->id");
	}

	function order($listorder) {
		if(!is_array($listorder)) return false;
		foreach($listorder as $k=>$v) {
			$k = intval($k);
			$v = intval($v);
			$this->db->query("UPDATE {$this->table} SET listorder=$v WHERE id=$k");
		}
		return true;
	}

	function get_list() {
		global $pages, $page, $pagesize, $offset, $pagesize, $CAT, $sum;
		$condition = "userid=$this->userid";
		if($page > 1 && $sum) {
			$items = $sum;
		} else {			
			$r = $this->db->get_one("SELECT COUNT(*) AS num FROM {$this->table} WHERE $condition");
			$items = $r['num'];
		}
		// if($items != $CAT['property']) $this->db->query("UPDATE {$this->db->pre}category SET property=$r[num] WHERE catid=$this->catid");
		$pages = pages($items, $page, $pagesize);
		$lists = array();
		$result = $this->db->query("SELECT * FROM $this->table WHERE $condition ORDER BY listorder ASC,id ASC LIMIT $offset,$pagesize");
		while($r = $this->db->fetch_array($result)) {
			$lists[] = $r;
		}
		return $lists;
	}

	function _($e) {
		$this->errmsg = $e;
		return false;
	}
}
?>
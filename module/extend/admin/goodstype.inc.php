<?php
defined('IN_DESTOON') or exit('Access Denied');

require MD_ROOT.'/goodstype.class.php';
require MD_ROOT.'/attr.class.php';
$do = new goodstype();
$att = new attr();
$menus = array (
    array('添加分类', '?moduleid='.$moduleid.'&file='.$file.'&action=add'),
    array('分类列表', '?moduleid='.$moduleid.'&file='.$file),

);
$attr_menus = array (
    array('添加属性', '?moduleid='.$moduleid.'&file='.$file.'&typeid='.$typeid.'&action=attr_add'),
    array('属性列表', '?moduleid='.$moduleid.'&file='.$file.'&typeid='.$typeid.'&action=attr_list'),
);
if($_catids || $_areaids) require DT_ROOT.'/admin/admin_check.inc.php';
$this_forward = '?moduleid='.$moduleid.'&file='.$file;
if(in_array($action, array('', 'check'))) {
	$sorder  = array('结果排序方式', '更新时间降序', '更新时间升序', '是否文字降序', '是否文字升序', '是否推荐降序', '是否推荐升序');
	$dorder  = array('id asc', 'sort_order desc', 'edittime DESC', 'eidttime ASC', 'type DESC', 'type ASC', 'elite DESC', 'elite ASC');
	$stype  = array('类型', '文字', 'LOGO');
	$dtype  = array('0', '1', '2');
	$level = isset($level) ? intval($level) : 0;
	$typeid = isset($typeid) ? intval($typeid) : 0;
	$type = isset($type) ? intval($type) : 0;
	isset($order) && isset($dorder[$order]) or $order = 0;
	$type_select = type_select('link', 1, 'typeid', '请选择分类', $typeid);
	$order_select  = dselect($sorder, 'order', '', $order);
	$level_select = level_select('level', '级别', $level);
	$_type_select  = dselect($stype, 'type', '', $type);
	$condition = '';
	if($_areaids) $condition .= " AND areaid IN (".$_areaids.")";//CITY
	if($keyword) $condition .= " AND name LIKE '%$keyword%'";
	if($typeid) $condition .= " AND typeid=$typeid";
	if($type) $condition .= $type == 1 ? " AND thumb=''" : " AND thumb<>''";
	if($level) $condition .= " AND level=$level";
	if($areaid) $condition .= ($ARE['child']) ? " AND areaid IN (".$ARE['arrchildid'].")" : " AND areaid=$areaid";
}

$this_forward = '?moduleid='.$moduleid.'&file='.$file.'&typeid='.$typeid.'&action=attr_list';
switch($action) {
	case 'add':
		if($submit) {
			if($do->pass($post)) {
				$do->add($post);
				dmsg('添加成功', '?moduleid='.$moduleid.'&file='.$file);
			} else {
				msg($do->errmsg);
			}
		} else {
			foreach($do->fields as $v) {
				isset($$v) or $$v = '';
			}
			$linkurl = 'http://';
			$status = 3;
			$addtime = timetodate($DT_TIME);
			$menuid = 0;
			include tpl('goodstype_edit', $module);
		}
	break;
	case 'edit':
		$id or msg();
		$do->id = $id;
		if($submit) {
			if($do->pass($post)) {
				$do->edit($post);
				dmsg('修改成功', '?moduleid='.$moduleid.'&file='.$file);
			} else {
				msg($do->errmsg);
			}
		} else {
			extract($do->get_one());
			include tpl('goodstype_edit', $module);
		}
	break;
	case 'check':
		if($id) {
			$do->check($id);
			dmsg('审核成功', $forward);
		} else {
			$lists = $do->get_list("status=2 AND username=''".$condition, $dorder[$order]);
			include tpl('link_check', $module);
		}
	break;
	case 'order':
		$do->order($listorder); 
		dmsg('排序成功', $forward);
	break;
	case 'delete':
		$id or msg('请选择需要删除项');
		$status = $do->delete($id);
        if($status>0){dmsg('该类别下有属性，请先删除该类别下的属性！', $forward);}
		dmsg('删除成功', $forward);
	break;

    /*属性相关代码*/
	case 'attr_list':
        $typeid or msg();
        $lists = $att->get_list("typeid=$typeid".$condition, 'sort_order asc');
        $goods_type = $do->getgoodstype();
        include tpl('attr_list', $module);
	break;
    case 'attr_add':

        if($submit) {
            if($att->pass($post)) {
                $att->add($post);

                dmsg('添加成功', $this_forward);
            } else {
                msg($att->errmsg);
            }
        } else {
            $typeid or msg();
            foreach($att->fields as $v) {
                isset($$v) or $$v = '';
            }

            $goods_type = $do->getgoodstype();
            include tpl('attr_edit', $module);
        }
        break;
    case 'attr_edit':
        $attr_id or msg();
        $att->id = $attr_id;
        if($submit) {

            if($att->pass($post)) {
                $att->edit($post);
                dmsg('修改成功', $this_forward);
            } else {
                msg($att->errmsg);
            }
        } else {
            extract($att->get_one());
            $goods_type = $do->getgoodstype();
            include tpl('attr_edit', $module);
        }
        break;
    case 'attr_order':
        $att->order($listorder);
        dmsg('排序成功', $forward);
        break;
    case 'attr_delete':
        $attr_id or msg('请选择需要删除项');
        $att->delete($attr_id);
        dmsg('删除成功', $this_forward);
        break;
	default:

		$lists = $do->get_list("enabled=1".$condition, $dorder[$order]);
		include tpl('goodstype', $module);
	break;
}



?>
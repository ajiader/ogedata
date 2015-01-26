<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($attr_menus);
?>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="attr_id" value="<?php echo $attr_id;?>"/>
<input type="hidden" name="typeid" value="<?php echo $typeid;?>"/>
<input type="hidden" name="post[attr_input_type]" value="0"/>
<input type="hidden" name="post[attr_type]" value="0"/>
<div class="tt"><?php echo $action == 'add' ? '添加' : '修改';?>链接</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 属性分类</td>
<td><?php echo dselect($goods_type, 'post[typeid]', '请选择属性分类', $typeid, 'id="typeid"');?><span id="dtypeid" class="f_red"></span></td>
</tr>
<tr>
  <td class="tl"><span class="f_red">*</span> 属性名称</td>
  <td><input name="post[attr_name]" type="text" id="attr_name" size="40" value="<?php echo $attr_name;?>"/>    <span id="dattr_name" class="f_red"></span></td>
</tr>

</table>
<div class="sbt"><input type="submit" name="submit" value=" 确 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<?php load('clear.js'); ?>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'typeid';
	l = Dd(f).value.length;
	if(l == 0) {
		Dmsg('请选择属性分类', f);
		return false;
	}
	f = 'attr_name';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('请输入属性名称', f);
		return false;
	}
	
}
</script>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>
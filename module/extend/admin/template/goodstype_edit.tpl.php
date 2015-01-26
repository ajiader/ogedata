<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="id" value="<?php echo $id;?>"/>
<div class="tt"><?php echo $action == 'add' ? '添加' : '修改';?>链接</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
  <td class="tl"><span class="f_red">*</span> 分类名称</td>
  <td><input name="post[name]" type="text" id="name" size="40" value="<?php echo $name;?>"/>    <span id="dname" class="f_red"></span></td>
</tr>

</table>
<div class="sbt"><input type="submit" name="submit" value=" 确 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<?php load('clear.js'); ?>
<script type="text/javascript">
function check() {
	var l;
	var f;
	
	f = 'name';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('请输入分类名称', f);
		return false;
	}
	
}
</script>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>
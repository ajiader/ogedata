<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($attr_menus);
?>

<form method="post">
<div class="tt">管理属性列表</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th width="50">排序</th>
<th>属性名称</th>
<th>类型</th>
<th width="50">操作</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="attr_id[]" value="<?php echo $v['attr_id'];?>"/></td>
<td><input type="text" size="2" name="listorder[<?php echo $v['attr_id'];?>]" value="<?php echo $v['sort_order'];?>"/></td>
<td><?php echo $v['attr_name'];?></td>
<td><?php echo $goods_type[$v['typeid']];?></td>
<td>
  <a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&typeid=<?php echo $typeid;?>&action=attr_edit&attr_id=<?php echo  $v['attr_id'];?>"><img src="admin/image/edit.png" width="16" height="16" title="修改" alt=""/></a>&nbsp;

</td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" 更新排序 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=attr_order';"/>&nbsp;
<input type="submit" value=" 删 除 " class="btn" onclick="if(confirm('确定要删除选中吗？此操作将不可撤销')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&typeid=<?php echo $typeid;?>&action=attr_delete'}else{return false;}"/>&nbsp;

</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<br/>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>
<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post">
<input type="hidden" name="forward" value="<?php echo $DT_URL;?>"/>
<input type="hidden" name="catid" value="<?php echo $catid;?>"/>
<div class="tt">属性参数</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="40">排序</th>
<th>ID</th>
<th>国家</th>
<th>级别</th>
<th>商家名称</th>
<th>联系方式</th>

<th width="50">操作</th>
</tr>
<?php foreach($lists as $k=>$v) { ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="text" size="2" name="listorder[<?php echo $v['id'];?>]" value="<?php echo $v['listorder'];?>"/></td>
<td><?php echo $v['id'];?></td>
<td><?php echo $v['country'];?></td>
<td><?php echo $v['level'];?></td>
<td><?php echo $v['comname'];?></td>
<td><?php echo $v['tel'];?></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=edit&userid=<?php echo $v['userid'];?>&id=<?php echo $v['id'];?>"><img src="admin/image/edit.png" width="16" height="16" title="修改" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&userid=<?php echo $v['userid'];?>&id=<?php echo $v['id'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="删除" alt=""/></a>
</td>
</tr>
<?php } ?>
</table>
<div class="btns">
<input type="submit" value=" 更新排序 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&userid=<?php echo $userid;?>&action=order';"/>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" value=" 关 闭 " class="btn" onclick="window.parent.location.reload();"/>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>
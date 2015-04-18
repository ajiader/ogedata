<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="userid" value="<?php echo $userid;?>"/>
<input type="hidden" name="post[userid]" value="<?php echo $userid;?>"/>
<input type="hidden" name="id" value="<?php echo $id;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<div class="tt"><?php echo $action=='add' ? '添加' : '修改';?>下级代理商</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 国家</td>
<td><input name="post[country]" type="text"  size="30" id="country" value="<?php echo $country;?>"/> <span id="dcountry" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 级别</td>
<td><input name="post[level]" type="text"  size="30" id="level" value="<?php echo $level;?>"/> <span id="dlevel" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 商家名称</td>
<td><input name="post[comname]" type="text"  size="30" id="comname" value="<?php echo $comname;?>"/> <span id="dcomname" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 联系方式</td>
<td><input name="post[tel]" type="text"  size="30" id="tel" value="<?php echo $tel;?>"/> <span id="dtel" class="f_red"></span></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 确 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" value=" 关 闭 " class="btn" onclick="window.parent.location.reload();"/></div>
</form>

<script type="text/javascript">Menuon(<?php echo $action=='add' ? 0 : 1;?>);</script>
<?php include tpl('footer');?>
<?php
defined('IN_DESTOON') or exit('Access Denied');
$keywords = strip_tags($keywords);
if ($keywords) {
	tag("table=category&length=20&condition=child=0 and moduleid=$moduleid and catname like '%$keywords%'&order=listorder asc&&template=catelist");
}else{
	tag("table=category&length=20&condition=child=0 and moduleid=$moduleid&order=listorder asc&&template=catelist");
}
?>
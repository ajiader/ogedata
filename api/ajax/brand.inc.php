<?php
defined('IN_DESTOON') or exit('Access Denied');
$keywords = strip_tags($keywords);
if ($admin) {
	if ($keywords) {
		if ($set_type=='id') {
			$keywords = intval($keywords);
			$tags = tag("moduleid=13&length=20&fields=itemid,title&condition=status=3 and itemid = '$keywords'&order=itemid asc&&template=null");
		}else{
			$tags = tag("moduleid=13&length=20&fields=itemid,title&condition=status=3 and title like '%$keywords%'&order=itemid asc&&template=null");
		}
		if ($tags) {
			foreach ($tags as $key => $value) {
				$data[$key]['id'] = $value['itemid'];
				$data[$key]['name'] = $value['title'];
			}
			echo $callback.'(',json_encode($data),')';exit;
		}
		
	}
}else{
	if ($keywords) {
	//$tags = tag("moduleid=13&length=20&condition=status=3 and title like '%$keywords%'&order=itemid asc&&template=null");
	print_r($tags);exit;
	}elseif ($keywords) {
		tag("moduleid=13&length=20&condition=status=3 and title like '%$keywords%'&order=itemid asc&&template=catelist");
	}
	else{
		tag("moduleid=13&length=20&condition=status=3&order=itemid asc&&template=catelist");
	}
}

?>
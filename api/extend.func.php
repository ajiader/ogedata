<?php
defined('IN_DESTOON') or exit('Access Denied');
#Your Functions
function build_attr_html($goods_type=0,$goods_id=0)
{
	global $db;
	//$res = array('error' => $error, 'message' => $message, 'content' => $content);
	if (empty($goods_type)) {
		return array();
	}

	$html = '<table width="100%" id="attrTable">';
	$spec = 0;
	$sql = "SELECT a.attr_id, a.attr_name, a.attr_input_type, a.attr_type, a.attr_values, v.attr_value, v.attr_price ".
            "FROM {$db->pre}attribute AS a ".
            "LEFT JOIN {$db->pre}goods_attr AS v ".
            "ON v.attr_id = a.attr_id AND v.goods_id = '$goods_id' ".
            "WHERE a.typeid = " . intval($goods_type) ." OR a.typeid = 0 ".
            "ORDER BY a.sort_order, a.attr_type, a.attr_id, v.attr_price, v.goods_attr_id";
    $result = $db->query($sql);
    while($row = $db->fetch_array($result)){
    	$val = $row;	
    	$html .= "<tr><td class='label' width='162'>";
    	$html .= "$val[attr_name]</td><td><input type='hidden' name='attr_id_list[]' value='$val[attr_id]' />";

        if ($val['attr_input_type'] == 0)
        {
            $html .= '<input name="attr_value_list[]" type="text" value="' .htmlspecialchars($val['attr_value']). '" size="40 " /> ';
        }
        $html .= '</td></tr>';
    }
    $html .= '</table>';

    return $html;
}

function make_json_response($content='', $error="0", $message='', $append=array())
{
    

    $res = array('error' => $error, 'message' => $message, 'content' => $content);

    if (!empty($append))
    {
        foreach ($append AS $key => $val)
        {
            $res[$key] = $val;
        }
    }

    $val = json_encode($res);

    exit($val);

}

//根据id获取品牌名称
function getBrandName($id,$Trow=1)
{
	global $db;
	$id = intval($id);
	if ($id>0) {
		$sql = "SELECT a.title, a.linkurl, a.telephone, a.thumb, a.company, a.mobile, b.areaname FROM {$db->pre}brand_13 a left join {$db->pre}area  b on a.areaid=b.areaid where a.itemid=$id ";
        $row = $db->get_one($sql);
        // print_r($sql);
        if($Trow == 1){return $row;} 
		else{ return $row['title'];}
	}
}
?>
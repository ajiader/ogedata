/*
	[Destoon B2B System] Copyright (c) 2008-2013 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/

var property_Interval = setInterval('ppt_attach_catid()', 500);
function ppt_attach_catid() {
	if(Dd('catid').value != property_catid) {
		property_catid = Dd('catid').value;
		if(property_catid != '') load_property();
	}
}
function load_property() {
	makeRequest('action=property&itemid='+property_itemid+'&catids='+property_catid+'&admin='+property_admin+'&moduleid='+moduleid, AJPath, 'into_property');
}
function into_property() {
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {
		if(xmlHttp.responseText) {
			Ds('load_property');InnerTBD('load_property', xmlHttp.responseText);
		} else {
			/*InnerTBD('load_property', '<tr><td></td><td></td></tr>');*/Dh('load_property');
		}
	}
}
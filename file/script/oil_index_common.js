// JavaScript Document
window.onload=function()
{
	var sew=document.getElementById("xzclass");
	var txt=document.getElementById("selectip");
	var sedv=document.getElementById("selectdv");
	sew.onmouseover=function()
	{
		sedv.style.display="block";
		txt.style.backgroundPosition="-389px -173px";
	}
	sew.onmouseout=function()
	{
		sedv.style.display="none";
		txt.style.backgroundPosition="-306px -173px";
	}
	var pnum=sedv.getElementsByTagName("p");
	var scids=document.getElementById("destoon_moduleid");
	for(var i=0; i<pnum.length; i++)
	{
		pnum[i].onclick=function()
		{
			txt.value=this.innerHTML;	
			scids.value=this.attributes['scid'].nodeValue;
		}
	}
}

function kefulink()
{
	hz6d_from_page = document.referrer;
	hz6d_from_page = "&keyword=" + window.encodeURIComponent(hz6d_from_page);
	
     var hz6d_referer = '&referer=' + window.encodeURIComponent(window.location.href); //当前访问页面
         window.open('www10.53kf.com/webCompany.php?arg=10085259&style=1'+hz6d_referer+hz6d_from_page+'&tfrom=1&tpl=crystal_blue','','height=473,width=703,top=200,left=200,status=yes,toolbar=no,menubar=no,resizable=yes,scrollbars=no,location=no,titlebar=no');
}

// JavaScript Document

function mfselect(txtid,dvid)
{
	var txt=document.getElementById(txtid);
	var dv=document.getElementById(dvid);
    var dvnum=document.getElementById(dvid).getElementsByTagName("p");
    var catidone=document.getElementById("catid").value;
	txt.onclick=function()
	{
		dv.style.display="block";
		for(var i=0; i<dvnum.length; i++)
		{
			dvnum[i].onclick=function()
			{

				txt.value=this.innerHTML;
				dv.style.display="none";
			}	
		}
		txt.onfocus();		
	}
			
}

function xsdv(cpdv,ulid,txt)
{
	document.getElementById("ppDIV").style.display="none";
	var cp=document.getElementById(cpdv);
	cp.style.display="block";
	var cplist=document.getElementById(ulid).getElementsByTagName("a");	
	var wb=document.getElementById(txt);
	var catidone=document.getElementById("catid");
	for(var j=0;j<cplist.length; j++)
	{
		cplist[j].onclick=function()
		{
			catidone.value=this.attributes['data-id'].nodeValue;
			wb.value=this.innerHTML;
		}	
	}		
}

function ppdv(cpdv1,ulid1,txt1)
{
	document.getElementById("cplxDIV").style.display="none";
	var cp1=document.getElementById(cpdv1);
	cp1.style.display="block";
	var cplist1=document.getElementById(ulid1).getElementsByTagName("a");	
	var wb1=document.getElementById(txt1);
	var catidtwo=document.getElementById("brandid");
	for(var k=0;k<cplist1.length; k++)
	{
		cplist1[k].onclick=function()
		{
			catidtwo.value=this.attributes['data-id'].nodeValue;
			wb1.value=this.innerHTML;
		}	
	}
}
function closedv(cpdv)
{
	var cp=document.getElementById(cpdv);
	cp.style.display="none";	
}

function kefulink()
{
	hz6d_from_page = document.referrer;
	hz6d_from_page = "&keyword=" + window.encodeURIComponent(hz6d_from_page);
	
     var hz6d_referer = '&referer=' + window.encodeURIComponent(window.location.href); //当前访问页面
         window.open('http://tb.53kf.com/webCompany.php?arg=10085259&style=1'+hz6d_referer+hz6d_from_page+'&tfrom=1&tpl=crystal_blue','','height=473,width=703,top=200,left=200,status=yes,toolbar=no,menubar=no,resizable=yes,scrollbars=no,location=no,titlebar=no');
}
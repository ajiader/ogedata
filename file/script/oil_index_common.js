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

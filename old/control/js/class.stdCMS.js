// JavaScript Document

var _stdCMS={
	
	rayarTabla:function (idTabla,estilo,ignorar){
		var tabla=document.getElementById(idTabla);
		var trs=tabla.getElementsByTagName('TR');
		
		j=0;
		for(var i=0; i<trs.length; i++){
			if(i<ignorar){
				continue;
			}
			//alert(i);
			trs[i].className=estilo+j;
			if(j==0){
				j=1;
			}
			else{
				j=0;
			}
		}
	 }
}
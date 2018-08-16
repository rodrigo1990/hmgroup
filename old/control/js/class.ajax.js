// JavaScript clase Ajax
var _stdAjax={
	
	nuevoAjax:function(){
		var xmlhttp;
		try{
			xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e) {
			try{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e2) {
				xmlhttp=false;
			}
		//alert(xmlhttp);
		}
		if (typeof xmlhttp=='boolean' && typeof XMLHttpRequest!='undefined')	{
				xmlhttp=new XMLHttpRequest();
		}
		return xmlhttp;
	},

	getString:function(pagina,callBack){
		var dato="";
		var ajax=_stdAjax.nuevoAjax();
		ajax.open("get", pagina,true);
		ajax.onreadystatechange=function(){
			if (ajax.readyState==4){
				dato='window.'+callBack+"('"+escape(ajax.responseText)+"')";
				//alert (dato);
				eval(dato);
			}
			else{

			}
		}
		ajax.send(null);
	},
	
	sendString:function(pagina){
		var ajax=_stdAjax.nuevoAjax();
		ajax.open("get", pagina,true);
		ajax.send(null);
	},
	
	sendForm:function(idForm,pagina,callBack){
		var parameters=_stdAjax.packForm(idForm);
		var ajax=_stdAjax.nuevoAjax();
		ajax.open("post", pagina,true);
		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    	ajax.setRequestHeader("Content-length", parameters.length);
   		ajax.setRequestHeader("Connection", "close");
   		ajax.send(parameters);
		ajax.onreadystatechange=function(){
			if (ajax.readyState==4){
				var params=ajax.responseText;
				params=params.replace(/'/,"\'");
				params=params.replace(/\n/,"");
				params=params.replace(/\r/,"");
				dato=callBack+"('"+params+"')";
				try{
					eval(dato);
				}
				catch(e){
					alert("ERROR _stdAjax: "+dato);
				}
			}
			else{
				
			}
		}
	},
	
	packForm:function(idForm){
		var formulario=document.getElementById(idForm);
		var largo=formulario.length;
		var parametros="";
		for (i=0; i<largo; i++){
			if (formulario.elements[i].type=='radio' || formulario.elements[i].type=='checkbox'){
				if (formulario.elements[i].checked==false){
				//alert (formulario.elements[i].type+" "+formulario.elements[i].checked);
				continue;
				}
			}
			parametros=parametros+formulario.elements[i].name+'='+ encodeURI(formulario.elements[i].value)+'&';
		}
		parametros=parametros+'rand='+Math.random();
		return parametros;
	}
	
	
}
// JavaScript Document

//OBJETO DE CONFIRMACIÓN. PERMITE CONFIRMAR MENSAJES Y ALERTAR
var objConfirmacion={
	
	objeto:null,
	
	tplConfirmacion:'panelConfirmacion',
	
	tplMsg:'panelMsg',
	
	tplError:'panelError',
	
	panel:null,
	
	confirmado:false,
	
	requerirConfirmacion:function(obj,mensaje){
		if(objConfirmacion.confirmado){
			return true;
		}
		var tag=obj.tagName;
		objConfirmacion.objeto=obj;
		objConfirmacion.desplegarConfimacion(mensaje,objConfirmacion.tplConfirmacion);
		return false;
	},
	
	showMsg:function(mensaje){
		objConfirmacion.confirmado=false;
		objConfirmacion.desplegarConfimacion(mensaje,objConfirmacion.tplMsg);
		return true;
	},
	
	showError:function(mensaje){
		objConfirmacion.confirmado=false;
		objConfirmacion.desplegarConfimacion(mensaje,objConfirmacion.tplError);
		return true;
	},
	
	desplegarConfimacion:function(mensaje,idPanel){
		try{
			objConfirmacion.panel=document.getElementById(idPanel);
			objConfirmacion.ocultarSelects();
			objConfirmacion.panel.style.display='block';
			objConfirmacion.panel.innerHTML=objConfirmacion.panel.innerHTML.replace(/#TEXTO#/g,mensaje);
			window.scroll(0,0);
		}
		catch(e){
			alert('Error al querer desplegar una confirmación!!');
			alert('Verifique el id y las propiedades del panel a desplegar');
		}
	},
	
	confirmar:function(){
		objConfirmacion.panel.style.display='none';
		objConfirmacion.confirmado=true;
		if(objConfirmacion.objeto.tagName=='A'){
			document.location.href=objConfirmacion.objeto.href;
		}
		else if(objConfirmacion.objeto.tagName=='FORM'){
			objConfirmacion.objeto.submit();
		}
		else{
			alert('Error al querer ejecutar una confirmación!!');
			alert('Verifique que haya colocado el evento en un form o en un anchor');
		}
		
	},
	
	cancelar:function(){
		objConfirmacion.panel.style.display='none';
		objConfirmacion.mostrarSelects();
		objConfirmacion.confirmado=false;
	},
	
	ocultarSelects:function(){
		var selects=document.getElementsByTagName('SELECT');
		for(var i=0;i<selects.length;i++){
			selects[i].style.visibility='hidden';
		}
	},
	
	mostrarSelects:function(){
		var selects=document.getElementsByTagName('SELECT');
		for(var i=0;i<selects.length;i++){
			selects[i].style.visibility='visible';
		}
	}
	
}

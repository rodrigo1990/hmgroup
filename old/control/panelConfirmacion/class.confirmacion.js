// JavaScript Document

//OBJETO DE CONFIRMACIÓN. PERMITE CONFIRMAR MENSAJES Y ALERTAR
var objConfirmacion={
	
	objeto:null,
	
	tplConfirmacion:'panelConfirmacion_panelConfirmacion',
	
	tplMsg:'panelConfirmacion_panelMsg',
	
	tplError:'panelConfirmacion_panelError',
	
	panel:null,
	
	confirmado:false,
	
	callback:'',
	
	requerirConfirmacion:function(obj,mensaje){
		if(objConfirmacion.confirmado){
			return true;
		}
		var tag=obj.tagName;
		objConfirmacion.objeto=obj;
		objConfirmacion.desplegarConfimacion(mensaje,objConfirmacion.tplConfirmacion);
		return false;
	},
	
	requerirConfirmacionCallback:function(callback,mensaje){
		objConfirmacion.callback=callback;
		objConfirmacion.desplegarConfimacion(mensaje,objConfirmacion.tplConfirmacion);
		return true;
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
			//objConfirmacion.panel.style.display='block';
			$('#'+objConfirmacion.panel.id).fadeIn("slow");
			//objConfirmacion.panel.innerHTML=objConfirmacion.panel.innerHTML.replace(/#TEXTO#/g,mensaje);
			$('.panelConfirmacionTexto').html(mensaje);
			window.scroll(0,0);
			try{
				$('#panelConfirmacionBG').fadeIn("slow");
				//var alto=objConfirmacion.getAltura();
				//var bg=document.getElementById('panelConfirmacionBG');
				//objConfirmacion.panel.style.top=(alto-250-200)*(-1);
				//bg.style.height=alto+'px';
			}
			catch(e){
				//no hay manto
			}
		}
		catch(e){
			alert('Error al querer desplegar una confirmación!!');
			alert('Verifique el id y las propiedades del panel a desplegar');
		}
	},
	
	confirmar:function(){
		//objConfirmacion.panel.style.display='none';
		$('#'+objConfirmacion.panel.id).fadeOut("slow");
		try{
			//document.getElementById('panelConfirmacionBG').style.display='none';
			$('#panelConfirmacionBG').fadeOut("slow");
		}
		catch(e){
			//no hay manto
		}
		objConfirmacion.confirmado=true;
		if(objConfirmacion.callback!=''){
			eval(objConfirmacion.callback);
		}
		else if(objConfirmacion.objeto.tagName=='A'){
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
		//objConfirmacion.panel.style.display='none';
		$('#'+objConfirmacion.panel.id).fadeOut("slow");
		try{
			//document.getElementById('panelConfirmacionBG').style.display='none';
			$('#panelConfirmacionBG').fadeOut("slow");
		}
		catch(e){
			//no hay manto
		}
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
	},
	
	getAltura:function(){
		if( window.innerHeight && window.scrollMaxY ) // Firefox 
		{
			//pageWidth = window.innerWidth + window.scrollMaxX;
			pageHeight = window.innerHeight + window.scrollMaxY;
		}
		else if( document.body.scrollHeight > document.body.offsetHeight ) 
		// all but Explorer Mac
		{
			//pageWidth = document.body.scrollWidth;
			pageHeight = document.body.scrollHeight;
		}
		else // works in Explorer 6 Strict, Mozilla (not FF) and Safari
		{ 
			//pageWidth = document.body.offsetWidth + document.body.offsetLeft; 
			pageHeight = document.body.offsetHeight + document.body.offsetTop; 
		}
		return pageHeight;
	}
	
}

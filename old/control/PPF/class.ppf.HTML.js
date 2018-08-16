// JavaScript Document
// VERSION 2.0 10-06-2008
var PFHTML = {
	
	/*
	* getFormElement: Devuelve un objeto elemento a partir de la propiedad name y de un formulario
	*/
	getFormElement : function(formulario,variable){
		var form=document.getElementById(formulario);
		if(!form){
			return false;
		}
		var elementos=form.elements;
		for (var j=0;j<elementos.length;j++){
			if(elementos[j].name==variable){
				return elementos[j];
			}
		}
		return false;
	},
	
	/*
	* getElementByName: Devuelve un objeto elemento a partir de la propiedad name 
	*/
	getElementByName: function(variable){
		
		var elementos=document.elements;
		for (var j=0;j<elementos.length;j++){
			if(elementos[j].name==variable){
				return elementos[j];
			}
		}
		return false;
	},
	
	/*
	* rellenarDato: a partir de un id de formulario, id de variable y valor, coloca el valor en
	* el lugar correspondiente
	*/
	rellenarDato : function(formulario,variable,valor){
		
		elemento=PFHTML.getFormElement(formulario,variable);
		if(!elemento){
			return false;
		}
		var tipo=elemento.type;
		if(tipo=="textarea" || tipo=="text" || tipo=="hidden" || tipo=="password"){
			elemento.value=unescape(valor);
		}
		if(tipo=="checkbox"){
			var form =elemento.form;
		    for(var i=0;i<form.elements.length;i++) {
				
				if(form.elements[i].type && form.elements[i].type=='checkbox') {
					//alert(form.elements[i].name);
					if(form.elements[i].name==variable && form.elements[i].value==unescape(valor)){							//alert(form.elements[i].value);
							form.elements[i].checked=true;
					}
				}
			}
		}
		if(tipo=="select-one"){
			for(k=0;k<elemento.length;k++){
				if(elemento.options[k].value==unescape(valor)){
					elemento.options.selectedIndex=k;
				}
			}
		}
		if(tipo=="radio"){
			//puede haber varios
			//alert(valor);
			
			var form =elemento.form;
		    for(var i=0;i<form.elements.length;i++) {
				
				if(form.elements[i].type && form.elements[i].type=='radio') {
					//alert(form.elements[i].name);
					if(form.elements[i].name==variable && form.elements[i].value==unescape(valor)){							//alert(form.elements[i].value);
							form.elements[i].checked=true;
					}
				}
			}
		}
		if(tipo==undefined){
			//alert (elementos[j].id);
			return false;
		}
		return true;
	},
	
	/*
	* checkAll: a partir de un id de checkbox, selecciona o deselecciona toda la familia
	*/
	checkAll: function (elem,inverso){
		var elementos=document.getElementsByTagName('input');
		for (var j=0;j<elementos.length;j++){
			if(elementos[j].name==elem && ( elementos[j].type=="radio" || elementos[j].type=="checkbox")){
				if(inverso=='-1'){
					elementos[j].checked=false;
				}
				else{
					elementos[j].checked=true;
				}
			}
		}
		
	},
	
	/*
	* openWindow: abre una ventana nueva del tamaño especificado sin controles
	*/
	openWindow: function (url,nombre,ancho,alto){
			window.open(url,nombre,'toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=yes,width='+ancho+',height='+alto);
	},
	
	/*
	* display: cambia la propiedad display a block de un id
	*/
	display: function (elem){
		document.getElementById(elem).style.display="block";
	},
	
	/*
	* noDisplay: cambia la propiedad display de un id a none
	*/
	noDisplay: function (elem){
		document.getElementById(elem).style.display="none";
	},
	
	/*
	* getSelectedValue: devuelve el valor selectado en un select
	*/
	getSelectedValue: function (combo){
			var s=document.getElementById(combo);
			return s.options[s.selectedIndex].value;
	},
	
	/*
	* addLoadEvent: agrega la función indicada al evento onLoad()
	*/
	addLoadEvent: function(func){
			var oldonload = window.onload;
		 	if (typeof window.onload != 'function') {
				 window.onload = func;
		 	}
		 	else {
				window.onload = function() {
					oldonload();
			 		func();
				}
			}
   	  },
	  
	/*
	* addFormOnSubmitEvent: agrega la función indicada al evento onSubmit() del formulario
	* indicado. Si la función devuelve false o no devuelve nada se suspende el envío del
	* formulario
	*/
	  addFormOnSubmitEvent: function(form,func){
			 if(typeof PFHTML.formEvents[form]=='undefined'){
			 	PFHTML.formEvents[form]=new Object();
				PFHTML.formEvents[form][0]=func;
			 }
			 else{
				 PFHTML.formEvents[form][PFHTML.formEvents[form].length]=func;
			 }
	  },
	  
	/*
	* submitForm: Produce el envío del formulario ejecutando primero las funciones cargadas por
	* addFormOnSubmitEvent
	*/
	  submitForm: function(form){
		
		if(typeof form=='Object'){
			var idForm=form.id;
		}
		else{
			idForm=form;
			form=document.getElementById(form);
		}
		
		var elemform=PFHTML.getFormElement(idForm,'form');
		
		if(!elemform){
			var input=document.createElement('input');
			input.type="hidden";
			input.value=idForm;
			input.name="form";
			form.appendChild(input);
		}
		else{
			elemform.value=idForm;
		}
		if(typeof PFHTML.formEvents[idForm]!='undefined'){
			
			var exec=true;
			 for(ItemID in PFHTML.formEvents[idForm]){
			 	exec=eval(PFHTML.formEvents[idForm][ItemID]+'()');
				if(!exec){
					return false;
				}
			 }
		}
		
		return true;
		 
	  },
	  
	  disable: function(form,tagName){
	
		var elem=PFHTML.getFormElement(form,tagName);
		if(elem){
			elem.disabled=true;
			var tipo=elem.type;
			if(tipo=="checkbox" || tipo=="radio"){
				var form =elem.form;
				for(var i=0;i<form.elements.length;i++) {
					if(form.elements[i].type && (form.elements[i].type=='checkbox' || form.elements[i].type=='radio')) {
						//alert(form.elements[i].name);
						if(form.elements[i].name==tagName){							
							form.elements[i].disabled=true;
						}
					}
				}
			}
		}
	},
	
	/*
	* encode: Codifica una cadena en base64 para utilizar similar a encodeURL
	*
	*/
	 encode: function(data){
	  	return PFBase64.encode(data);
	 },
	 
	/*
	* decode: Codifica una cadena en base64 para utilizar similar a decodeURL
	*
	*/
	 decode: function(data){
		 return PFBase64.decode(data);
	 },
	 /* 
	 *  formEvents: Objeto auxiliar para el manejo de eventos de formulario
	 */
	 formEvents:new Object()
}

var PFBase64 = {

	// private property
	_keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",

	// public method for encoding
	encode : function (input) {
		var output = "";
		var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
		var i = 0;

		input = Base64._utf8_encode(input);

		while (i < input.length) {

			chr1 = input.charCodeAt(i++);
			chr2 = input.charCodeAt(i++);
			chr3 = input.charCodeAt(i++);

			enc1 = chr1 >> 2;
			enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
			enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
			enc4 = chr3 & 63;

			if (isNaN(chr2)) {
				enc3 = enc4 = 64;
			} else if (isNaN(chr3)) {
				enc4 = 64;
			}

			output = output +
			this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
			this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

		}

		return output;
	},

	// public method for decoding
	decode : function (input) {
		var output = "";
		var chr1, chr2, chr3;
		var enc1, enc2, enc3, enc4;
		var i = 0;

		input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

		while (i < input.length) {

			enc1 = this._keyStr.indexOf(input.charAt(i++));
			enc2 = this._keyStr.indexOf(input.charAt(i++));
			enc3 = this._keyStr.indexOf(input.charAt(i++));
			enc4 = this._keyStr.indexOf(input.charAt(i++));

			chr1 = (enc1 << 2) | (enc2 >> 4);
			chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
			chr3 = ((enc3 & 3) << 6) | enc4;

			output = output + String.fromCharCode(chr1);

			if (enc3 != 64) {
				output = output + String.fromCharCode(chr2);
			}
			if (enc4 != 64) {
				output = output + String.fromCharCode(chr3);
			}

		}

		output = Base64._utf8_decode(output);

		return output;

	},

	// private method for UTF-8 encoding
	_utf8_encode : function (string) {
		string = string.replace(/\r\n/g,"\n");
		var utftext = "";

		for (var n = 0; n < string.length; n++) {

			var c = string.charCodeAt(n);

			if (c < 128) {
				utftext += String.fromCharCode(c);
			}
			else if((c > 127) && (c < 2048)) {
				utftext += String.fromCharCode((c >> 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			}
			else {
				utftext += String.fromCharCode((c >> 12) | 224);
				utftext += String.fromCharCode(((c >> 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}

		}

		return utftext;
	},

	// private method for UTF-8 decoding
	_utf8_decode : function (utftext) {
		var string = "";
		var i = 0;
		var c = c1 = c2 = 0;

		while ( i < utftext.length ) {

			c = utftext.charCodeAt(i);

			if (c < 128) {
				string += String.fromCharCode(c);
				i++;
			}
			else if((c > 191) && (c < 224)) {
				c2 = utftext.charCodeAt(i+1);
				string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
				i += 2;
			}
			else {
				c2 = utftext.charCodeAt(i+1);
				c3 = utftext.charCodeAt(i+2);
				string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
				i += 3;
			}

		}

		return string;
	}

}

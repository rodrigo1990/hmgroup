// JavaScript Document
var pfw_trafico={
	
	ruta:'',
	getFilename: function(){
		var sPath = window.location.pathname;
		var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
		if(sPage==''){
			sPage='index';
		}
		return sPage;
	},
	
	setBeacon: function(){
		archivo=pfw_trafico.getFilename();
		document.write('<img src="'+pfw_trafico.ruta+'trafico.php?traffic=1&archivo='+archivo+'" width="1" height="1">');
	}
}

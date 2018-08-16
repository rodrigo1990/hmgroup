// JavaScript Document
var DBValidator={

	ok:false,
	
	dataSet:null,
	
	complete:true,
	
	errorMsg: new Array(),
	
	check:function(id,type,param){
		var esCorrecto=true;
		
		var value=document.getElementById(id).value;
		switch(type){
			case 'SOLO_CARACTERES':
				if(value.search(/[0-9]/)!=-1){
					esCorrecto=false;
				}
			break;
			case 'OBLIGATORIO':
				var aux=value.replace(/[\s]*/,'');
				if(''==aux){
					esCorrecto=false;
				}
			break;
			case 'SOLO_NUMEROS':
				if(value.search(/[^0-9]/)!=-1){
					esCorrecto=false;
				}
			break;
			case 'EMAIL':
				if(value.search(/@/)==-1){
					esCorrecto=false;
				}
				if(value.search(/\./)==-1){
					esCorrecto=false;
				}
			break;
			case 'IDENTICO':
				var aux=document.getElementById(param).value;
				if(value!=aux){
					esCorrecto=false;
				}
			break;
			case 'DISTINTO_DE':
				var aux=document.getElementById(param).value;
				if(value==aux){
					esCorrecto=false;
				}
			break;
			case 'EDAD':
				if(value.search(/[^0-9]/)!=-1){
					esCorrecto=false;
				}
				else{
					if(value<1 || value >100){
						esCorrecto=false;
					}
				}
			break;
			case 'FECHA':
				
			break;
			case 'SOLO_CARS_OBLIGATORIO':
				var aux=value.replace(/[\s]*/,'');
				if(value.search(/[0-9]/)!=-1 || ''==aux){
					esCorrecto=false;
				}
			break;
		}
		return esCorrecto;
	},
	
	setData:function(obj){
		DBValidator.dataSet=obj;
	},
	
	checkData:function(obj){
		DBValidator.setData(obj);
		var esCorrecto=true;
		for(ItemID in DBValidator.dataSet){
			if(!DBValidator.check(DBValidator.dataSet[ItemID].nombre,DBValidator.dataSet[ItemID].tipo,DBValidator.dataSet[ItemID].param)){
				esCorrecto=false;
				DBValidator.errorMsg[DBValidator.errorMsg.length]=DBValidator.dataSet[ItemID].mensaje;
				if(!DBValidator.complete){
					break;
				}
			}
		}
		return esCorrecto;
	},
	
	getAllErrors:function(separador){
		var cadena='';
		for(ItemId in DBValidator.errorMsg){
			cadena+=DBValidator.errorMsg[ItemId]+separador;
		}
		return cadena
	},
	
	clean:function(){
		DBValidator.errorMsg=new Array();
		DBValidator.dataSet=null;
	}
	
}

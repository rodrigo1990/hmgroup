// JavaScript Document
	/*********************************************************************
		 * Get an object, this function is cross browser
		 * *** Please do not remove this header. ***
		 * This code is working on my IE7, IE6, FireFox, Opera and Safari
		 * 
		 * Usage: 
		 * var object = get_object(element_id);
		 *
		 * @Author Hamid Alipour Codehead @ webmaster-forums.code-head.com		
		**/
		function get_object(id) {
			var object = null;
			if( document.layers )	{			
				object = document.layers[id];
			} else if( document.all ) {
				object = document.all[id];
			} else if( document.getElementById ) {
				object = document.getElementById(id);
			}
			return object;
		}
		/*********************************************************************/
		
		/*********************************************************************
		 * No onMouseOut event if the mouse pointer hovers a child element 
		 * *** Please do not remove this header. ***
		 * This code is working on my IE7, IE6, FireFox, Opera and Safari
		 * 
		 * Usage: 
		 * <div onMouseOut="fixOnMouseOut(this, event, 'JavaScript Code');"> 
		 *		So many childs 
		 *	</div>
		 *
		 * @Author Hamid Alipour Codehead @ webmaster-forums.code-head.com		
		**/
		function is_child_of(parent, child) {
			if( child != null ) {			
				while( child.parentNode ) {
					if( (child = child.parentNode) == parent ) {
						return true;
					}
				}
			}
			return false;
		}
		function fixOnMouseOut(element, event, JavaScript_code) {
			var current_mouse_target = null;
			if( event.toElement ) {				
				current_mouse_target 			 = event.toElement;
			} else if( event.relatedTarget ) {				
				current_mouse_target 			 = event.relatedTarget;
			}
			if( !is_child_of(element, current_mouse_target) && element != current_mouse_target ) {
				eval(JavaScript_code);
			}
		}
		/*********************************************************************/

var menu_level;
var timeOut1;
var timeOut2;

function menu_leave(event){
	
	if (!event) var event = window.event;
	
	var current_mouse_target = null;
	if( event.toElement ) {				
		current_mouse_target 			 = event.toElement;
	} else if( event.relatedTarget ) {				
		current_mouse_target 			 = event.relatedTarget;
	}
	if( !is_child_of(this, current_mouse_target) && this != current_mouse_target ) {
		if(menu_level==1 && this.className=='listaSubCat'){
			timeOut1=setTimeout('subsubmenu_hide()',1000);
			timeOut2=setTimeout('submenu_hide()',1000);
		}
		if(menu_level==2 && this.className=='listaSubSubCat'){
			timeOut1=setTimeout('subsubmenu_hide()',1000);
			timeOut2=setTimeout('submenu_hide()',1000);
		}
	}
}

function menu_ie_leave(){
	if((this.className=='listaSubCat' || this.className=='listaSubSubCat')){
  		if(this.contains(event.toElement)){
		}
		else{
			timeOut1=setTimeout('subsubmenu_hide()',1000);
			timeOut2=setTimeout('submenu_hide()',1000);
		}
	}
}

function findPos(obj) {
	var curleft = curtop = 0;
	if (obj.offsetParent) {
		do {
			curleft += obj.offsetLeft;
			curtop += obj.offsetTop;
		} while (obj = obj.offsetParent);
	}
	return [curleft,curtop];
}


function menu_show(hijo,padre)
{
  submenu_hide();
  subsubmenu_hide();
  var p = document.getElementById(padre);
  var c = document.getElementById(hijo);
  menu_level=1;
  
  
  if(isIE()){
  	c.onmouseout=menu_ie_leave;
	//alert("Es ie");
	 $('#'+hijo).hover(function(){ clearTimeout(timeOut1); clearTimeout(timeOut2);},function(){});
  }
  else{
	 c.onmouseout=menu_leave; 
	 $('#'+hijo).hover(function(){ clearTimeout(timeOut1); clearTimeout(timeOut2);},function(){});
  }
  
  

  
  
  //var top  = p.offsetTop;
  var pos=findPos(p);
  var top=pos[1];
  var left =  p.offsetWidth +2;

  for (; p; p = p.offsetParent)
  {
    //top  += p.offsetTop;
    left += p.offsetLeft;
  }

  
  c.style.position   = "absolute";
  c.style.top        = top +'px';
  c.style.left       = left+'px';
  c.style.visibility = "visible";
  c.style.display = "block";
  
  clearTimeout(timeOut1); 
  clearTimeout(timeOut2);
}

function leave_link(){
  timeOut1=setTimeout('subsubmenu_hide()',1000);
  timeOut2=setTimeout('submenu_hide()',1000);
}

function sub_menu_show(hijo,padre)
{
  subsubmenu_hide();
  var p = document.getElementById(padre);
  var c = document.getElementById(hijo);
  menu_level=2;
  c.onmouseout=menu_leave;
  var top  = 0;
  var left =  p.offsetWidth +2;

  for (; p; p = p.offsetParent)
  {
    top  += p.offsetTop;
    left += p.offsetLeft;
  }

  c.style.position   = "absolute";
  c.style.top        = top +'px';
  c.style.left       = left+'px';
  c.style.visibility = "visible";
  c.style.display = "block";
}
function submenu_hide(){
	$(".listaSubCat").hide();
}
function subsubmenu_hide(){
	$(".listaSubSubCat").hide();
}
function isIE(){
	return /msie/i.test(navigator.userAgent) && !/opera/i.test(navigator.userAgent);
}


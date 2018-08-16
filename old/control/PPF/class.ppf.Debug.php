<?php
class PFDebug {
	
	var $startTime;
	
	/**
	 * Constructor
	 *
	 * @return debug
	 */
	function PFDebug(){
		$GLOBALS['DEBUG']=array();
		$this->startTime=array_sum(explode(' ', microtime()));
		$GLOBALS['DEBUG']['TIME']=$this->startTime;
	}
	
	/**
	 * Publico: añade una variable al debug
	 *
	 * @param string $texto
	 * @param var $obj
	 */
	function debugVar($texto,$obj){
		if(!isset($this->startTime)){
			$this->startTime=$GLOBALS['DEBUG']['TIME'];
		}
		$GLOBALS['DEBUG'][]=array($texto,$obj,array_sum(explode(' ', microtime()))-$this->startTime);
	}
	
	/**
	 * Publico: imprime el resultado del debug
	 *
	 */
	function dumpDebug(){
		echo '<h2>DEBUG</h2>';
		echo '<table border="1" cellpadding="2" cellspacing="0" width="100%">';
		$this->printDebug('POST',$_POST);
		$this->printDebug('GET',$_GET);
		$this->printDebug('SESSION',$_SESSION);
		echo '<tr><td bgcolor="#CCCCCC"><b>CUSTOM</b></td></tr>';
		foreach($GLOBALS['DEBUG'] as $item){
			echo "<tr><td>$item[0] ($item[2] msec) </td></tr>";
			echo '<tr><td><pre>';
			print_r($item[1]);
			echo '</pre></td></tr>';
		}
		echo '</table>';
		
	}
	
	/**
	 * Publico: imprime una seccion del debug
	 *
	 * @param string $title
	 * @param array $array
	 */
	function printDebug($title,$array){
		echo '<tr><td bgcolor="#CCCCCC"><b>'.$title.'</b></td></tr>';
		foreach($array as $ind => $val){
			echo '<tr><td>'.$ind.'</td></tr>';;
			echo '<tr><td><pre>';
			print_r($val);
			echo '</pre></td></tr>';
		}
	}
}
?>
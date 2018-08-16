<?php
class PFError{
	
	/**
	 * Publico: Realiza el manejo de errores
	 *
	 * @param string texto error $string
	 */
	function manage($string){
		echo '<h2>ERROR</h2>';
		echo '<table border="1" cellpadding="2" cellspacing="0" width="100%">';
		echo "<tr><td>$string</td></tr>";
		echo '<tr><td><pre>';
		print_r(debug_backtrace());
		echo '</pre></td></tr>';
		echo '</table>';
		exit();
	}
}
?>
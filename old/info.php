<? 
ini_set('include_path','.:'.ini_get('include_path'));
/*function getMemoryUsage() {

 // try to use PHP build in function
 if( function_exists('memory_get_usage') ) {
  return memory_get_usage();
 }

 // Try to get Windows memory usage via pslist command
 if ( substr(PHP_OS,0,3) == 'WIN') {
 
  $resultRow = 8;
  $resultRowItemStartPosition = 34;
  $resultRowItemLength = 8;
 
  $output = array();
  exec('pslist -m ' . getmypid() , $output);
   print_r($output);
  return trim(substr($output[$resultRow], $resultRowItemStartPosition, $resultRowItemLength)) . ' KB';
 
 }

 
 // No memory functionality available at all
 return '<b style="color: red;">no value</b>';
 
} */
echo memory_get_usage();
phpinfo(); 
?>

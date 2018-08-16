<? 
//ob_start();

if (isset($_FILES['Filedata'])) {
	$archivo = $_FILES["Filedata"]['name'];
	$prefijo = substr(md5(uniqid(rand())),0,6);
	
	if ($archivo != "") {
		$destino =  "flashUpload/files/".$archivo;
		copy($_FILES['Filedata']['tmp_name'], $destino);
	}
}
/*
$g=var_dump($_GET);
$p=var_dump($_POST);
$f=var_dump($_FILES);
$data=ob_get_contents();
ob_clean();
ob_end_clean();
$fp=fopen('testFlashUpload.txt','w');
fwrite($fp,$data);
fclose($fp);
*/
?>
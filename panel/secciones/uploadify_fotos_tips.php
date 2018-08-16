<?php
if (!empty($_FILES)) {

	$num_random = rand(1, 3000);
    @require_once("class.upload.php");
    $handle = new upload($_FILES['Filedata']);
    if ($handle->uploaded) 
    {
        $extension = pathinfo($_FILES['Filedata']['name']);
        $extension = $extension['extension'];
        $foto1_bd = date("H_i") . $num_random . 'tips.' . $extension;
        $foto1 = date("H_i") . $num_random . 'tips';
        $handle->file_new_name_body   = $foto1;
        $handle->image_resize         = true;
        $handle->image_ratio_crop     = true;
        $handle->image_x              = 700;
        $handle->image_y              = 525;
        //$handle->image_ratio_y        = true;
        $handle->jpeg_quality         = 95;
        $handle->process('../tips/');
        
        if ($handle->processed) {
            $handle->clean();
        } else {
            echo 'error : ' . $handle->error;
        }
    }


	$alto_imagen = '';
	$ancho_imagen = '';
	
	$nombre_proyecto = $_POST['nombre_proyecto'];
	$fecha = date("Y-n-d");
	
	include("../conexion.php");
	$alta = "INSERT INTO `tips_fotos` VALUES (null,'$nombre_proyecto', '$foto1_bd', '$fecha', '$ancho_imagen', '$alto_imagen','')";
	echo $alta;
	
	mysql_query($alta);
	mysql_close();

	// $fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
	// $fileTypes  = str_replace(';','|',$fileTypes);
	// $typesArray = split('\|',$fileTypes);
	// $fileParts  = pathinfo($_FILES['Filedata']['name']);

	// if (in_array($fileParts['extension'],$typesArray)) {
		// Uncomment the following line if you want to make the directory if it doesn't exist
		// mkdir(str_replace('//','/',$targetPath), 0755, true);

		move_uploaded_file($tempFile,$targetFile);
		echo "1";
	// } else {
	// 	echo 'Invalid file type.';
	// }
}
?>
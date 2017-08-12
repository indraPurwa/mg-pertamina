<?php  
	$file = date('Hi').'.jpg';
	$nama_file =  @$_FILES['name'];
	$tmp_file = @$_FILES['webcam']['tmp_name'];
	$target = 'uploads/'.$file;
	move_uploaded_file($tmp_file, $target);
	// $upload = move_uploaded_file($tmp_file, $target);
	// echo $target;
?>
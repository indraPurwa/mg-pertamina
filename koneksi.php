<?php 
	$db_host = "localhost";
	$db_user = "root";
	$db_pass = "";
	$db_name = "logbook";

	// $koneksi = mysql_connect($db_host, $db_user, $db_pass, $db_name) or die (mysql_error($koneksi));
	// mysql_select_db($db_name) or die (mysql_error());
	//echo 'Koneksi ke Database Berhasil';

	$koneksi = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if(mysqli_connect_error()){
		//echo 'Gagal melakukan koneksi ke Database : '.mysqli_connect_error();
		mysqli_close($koneksi);
	} else {
		//echo 'Koneksi ke Database Berhasil';
	}
?>
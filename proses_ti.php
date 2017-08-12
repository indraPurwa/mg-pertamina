<?php  
include_once 'koneksi.php';
	$id_pengunjung = @$_POST['id_pengunjung'];
	$type	= @$_POST['type'];
	$no_id = @$_POST['no_id'];
	$query = mysqli_query($koneksi, "INSERT INTO identitas(id_pengunjung,type,no_id) VALUES ('$id_pengunjung','$type','$no_id')");
	if ($query) {
		echo "<script> alert('Data Berhasil Ditambah!')
					   location.replace('tambah_identitas.php?id=".$id_pengunjung."') </script>";
	} else {
		echo "<script> alert('Data Gagal Ditambah!')
					   location.replace('tambah_identitas.php') </script>";
	}
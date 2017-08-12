<?php
	include_once 'koneksi.php';
	$id = $_GET['id'];
	$waktu = $_GET['waktu'];
	$hapus = mysqli_query($koneksi, "UPDATE logbook.buku_tamu SET keluar = now() WHERE buku_tamu.id_pengunjung = '$id' AND buku_tamu.masuk = '$waktu'");
	if ($hapus) {
		echo "<script> alert('Data Berhasil!')
					   location.replace('buku_tamu_cs.php') </script>";
	} else {
		echo "<script> alert('Data Gagal!')
					   location.replace('buku_tamu_cs.php') </script>";
	}
?>
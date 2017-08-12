<?php  
	include_once "koneksi.php";
	$id_pengunjung = $_POST['id_pengunjung'];
	$asal = @$_POST['asal'];
	$fungsi	= @$_POST['fungsi'];
	$keperluan = @$_POST['keperluan'];
	$no_visitor = @$_POST['no_visitor'];

	$sql = mysqli_query($koneksi,"INSERT INTO buku_tamu(id_pengunjung,asal,fungsi,keperluan,no_visitor,masuk) VALUES('$id_pengunjung','$asal', '$fungsi', '$keperluan', '$no_visitor', now())");
	if ($sql) {
		?> <script> alert("Inputan Berhasil Terdaftar"); window.location.href = "input_bt.php";</script> <?php
	} else {
		?> <script> alert("Inputan Gagal Terdaftar"); window.location.href = "input_bt.php";</script> <?php
	}
?>
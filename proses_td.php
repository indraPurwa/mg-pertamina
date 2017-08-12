<?php
	include_once "koneksi.php";
	function date_sql($date){
		$exp = explode('-',$date); //format untuk " - " kalau di "/" contoh "-" : 01-01-20017
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0]; //format untuk menampilkan
		}
		return $date;
	}

	include 'upload.php';
	$nama = @$_POST['nama'];
	$tgl = @$_POST['tgl'];
	$tanggal = date_sql($tgl);
	$alamat = @$_POST['alamat'];
	$no_hp = @$_POST['no_hp'];
	$type = @$_POST['type'];
	$no_id = @$_POST['no_id'];
	$kirim = @$_POST['kirim'];
	$cekuser = mysqli_query($koneksi,"SELECT * FROM identitas WHERE no_id = '$no_id'");
	// $webcam = @$_POST['webcam'];
	// $nama_file =  @$_FILES['name'];
	//$direktori = 'uploads/';
	
		if (mysqli_num_rows($cekuser) > 0) {
			?> <script> alert("Sorry!... Inputan Sudah Terdaftar"); window.location.href = "tambah_data.php";</script> <?php
		} else {
			$sql1 = mysqli_query($koneksi,"INSERT INTO `logbook`.`pengunjung` (`id_pengunjung`, `nama`, `tgl`, `alamat`, `no_hp`, `foto`) VALUES (NULL, '$nama', '$tanggal', '$alamat', '$no_hp', '$target')");
			$sql2 = mysqli_query($koneksi,"SELECT * FROM pengunjung WHERE nama='$nama' AND no_hp='$no_hp'");
			$row = mysqli_fetch_array($sql2);
			$id_pengunjung = $row['id_pengunjung'];
			$sql3 = mysqli_query($koneksi,"INSERT INTO identitas(id_pengunjung,type,no_id) VALUES ('$id_pengunjung','$type', $no_id)");
			// echo $id_pengunjung;
			 if ($sql1&&$sql3) {
				?> <script>  alert("Inputan Berhasil Terdaftar"); window.location.href = "tambah_data.php";</script> <?php
			 } else {
			 	?> <script>  alert("Sorry!... Inputan Gagal Terdaftar"); window.location.href = "tambah_data.php";</script> <?php
			 }
		// } else {
			?>
                  <script type="text/javascript">
                    // alert("Sorry, Tambah foto gagal");
                    // window.location.href = "tambah_data.php";
                    // untuk langsung melihat
                </script>
             <?php
        
		// }
		}
?>

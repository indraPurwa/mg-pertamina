<?php include_once "koneksi.php"; ?>
<?php include_once 'menu.php'; ?>
	<?php if (@$_GET['id'] == 1) { ?>
	<form>
		<table>
		<h1>tadah</h1>
			<tr>
				<td>Type</td>
				<td>
					<select name="type">
					<option value="KTP">KTP</option>
					<option value="SIM">SIM</option>
					<option value="Kartu Pelajar">Kartu Pelajar / Mahasiswa</option>
				</select>
				</td>
			</tr>
			<tr>
				<td>No. Identitas</td>
				<td><input type="number" name="no_id" placeholder="Nomor Identitas" required></td>
			</tr>
			<tr>
				<td>Nama Pengunjung</td>
				<td><input type="text"></td>
			</tr>
			<tr>
				<td>Asal/Instansi/Lembaga</td>
				<td><input type="text" name="asal" placeholder="Asal/Instansi/Lembaga" required></td>
			</tr>
			<tr>
				<td>Keperluan</td>
				<td><input type="text" name="keperluan" placeholder="Keperluan" required></td>
			</tr>
			<tr>
				<td>No. Visitor</td>
				<td><input type="number" name="visitor" placeholder="Nomor Visitor" required></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="reset" value="RESET"></td>
				<td><input type="submit" value="SIMPAN"></td>
			</tr>
		</table>
	</form>
	<?php } else { ?>
	<form method="POST" action="">
		<table align="center">
		<h1>default</h1>
			<tr>
				<td>Type</td>
				<td>
					<select name="type">
					<option value="KTP">KTP</option>
					<option value="SIM">SIM</option>
					<option value="Kartu Pelajar">Kartu Pelajar / Mahasiswa</option>
				</select>
				</td>
			</tr>
			<tr>
				<td>No. Identitas</td>
				<td><input type="number" name="id_pengunjung" placeholder="Nomor Identitas" required></td>
			</tr>
			<tr>
				<td>Nama Pengunjung</td>
				<td><input type="text" placeholder="Nama Pengunjung"></td>
			</tr>
			<tr>
				<td>Asal/Instansi/Lembaga</td>
				<td><input type="text" name="asal" placeholder="Asal/Instansi/Lembaga" disabled="disabled"></td>
			</tr>
			<tr>
				<td>Keperluan</td>
				<td><input type="text" name="keperluan" placeholder="Keperluan" disabled="disabled"></td>
			</tr>
			<tr>
				<td>No. Visitor</td>
				<td><input type="number" name="visitor" placeholder="Nomor Visitor" disabled="disabled"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="reset" value="RESET"></td>
				<td><input type="submit" value="SIMPAN"></td>
			</tr>
		</table>
		<?php  
			$id = $_POST['id_pengunjung'];
			//$no_id = $_POST['id_pengunjung'];
			$cekuser = mysqli_query($koneksi,"SELECT * FROM pengunjung WHERE id_pengunjung = '$id_pengunjung'");
			$data = mysqli_fetch_array($cekuser);
			if ($cekuser) {
				header("input_bt.php?input=1&id=$id");
			}
		?>
	</form>
	<?php } ?>
<?php include_once 'footer.php'; ?>
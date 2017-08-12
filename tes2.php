<?php 
	echo date("F Y") 
?>
<form method="POST" action="">
	
		<select type="submit" name="pilih">
			<option value="0">Pilih</option>
			<option value="pilih 1">Pilih 1</option>
			<option value="pilih 2">Pilih 2</option>
			<option value="pilih 3">Pilih 3</option>
		</select>
		<input type="submit" value="OK">
</form>
<?php 
	$pilih = @$_POST['pilih'];
	echo $pilih;
?>
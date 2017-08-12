<?php
include 'konfigurasi.php';
$term = trim(strip_tags($_GET['term']));

$qstring = "SELECT * FROM identitas WHERE no_id like '%$term%'";
$table = $conn->query($qstring);

if($table->num_rows > 0 ){
  while ($row = $table->fetch_assoc())
  {
      $row_set[] = htmlentities(stripslashes($row['no_id']));
      //buat array yang nantinya akan di konversi ke json
  }
}

echo json_encode($row_set);

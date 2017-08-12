<?php
include 'konfigurasi.php';
$id_peng = $_GET['id'];

$qstring = "SELECT * FROM pengunjung WHERE id_pengunjung= $id_peng";
$table_peng = $conn->query($qstring);

if($table_peng->num_rows > 0 ){
  $row = $table_peng->fetch_assoc();
  $peng = new \stdClass();
  $peng->id_pengunjung = $row['id_pengunjung'];
  $peng->nama = $row['nama'];
  $peng->tgl = $row['tgl'];
  $peng->no_hp = $row['no_hp'];
  $peng->alamat = $row['alamat'];
  $peng->foto= $row['foto'];

  $table_id = $conn->query("SELECT * FROM identitas WHERE id_pengunjung = $peng->id_pengunjung");
  if($table_id->num_rows > 0){
    while ($row2 = $table_id->fetch_assoc()) {
      $row_i = new \stdClass();
      $row_i->type = htmlentities(stripslashes($row2['type']));
      $row_i->no_id = htmlentities(stripslashes($row2['no_id']));
      $row_id[] = $row_i;
      unset($row_i);
    }
    $peng->identitas = $row_id;
  }

  echo json_encode($peng);
}

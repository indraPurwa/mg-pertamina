<?php
include 'konfigurasi.php';
$nama = $_GET['nama'];

$qstring = "SELECT * FROM pengunjung WHERE nama LIKE '".$nama."%'";
$table_peng = $conn->query($qstring);

if($table_peng->num_rows > 0){
  while ($row = $table_peng->fetch_assoc())
  {
    $row_peng = new \stdClass();
    $id = $row['id_pengunjung'];
    $qstring = "SELECT * FROM identitas WHERE id_pengunjung =".$id.";";
    $table_id = $conn->query($qstring);

    if($table_id->num_rows > 0){
      while ($row2 = $table_id->fetch_assoc()) {
        $row_i = new \stdClass();
        $row_i->type = htmlentities(stripslashes($row2['type']));
        $row_i->no_id = htmlentities(stripslashes($row2['no_id']));
        $row_id[] = $row_i;
        unset($row_i);
      }
      $row_peng->id = $row_id;
    }
    $row_peng->no = htmlentities(stripslashes($row['id_pengunjung']));
    $row_peng->nama = htmlentities(stripslashes($row['nama']));
    $row_peng->tgl = htmlentities(stripslashes($row['tgl']));

    $row_id =null;
    $row_table[] = $row_peng;
    unset($row_peng);
  }
}

echo json_encode($row_table);
?>

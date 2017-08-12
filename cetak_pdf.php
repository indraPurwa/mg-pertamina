<?php
session_start();
require_once "koneksi.php";
require_once "mpdf/mpdf.php";
$lap = $_GET['lap'];
$fungsi = $_SESSION['fungsi'];

if($lap == "bulan"){
  $bulan = $_GET['bulan'];
  $exp = explode('-',$bulan);

  $query = mysqli_query($koneksi,"SELECT pengunjung.id_pengunjung, buku_tamu.asal, pengunjung.nama, buku_tamu.keperluan, buku_tamu.no_visitor, buku_tamu.masuk, buku_tamu.keluar
    FROM pengunjung, buku_tamu
    WHERE pengunjung.id_pengunjung = buku_tamu.id_pengunjung
    AND year(buku_tamu.masuk) = '$exp[1]'
    AND month(buku_tamu.masuk) = '$exp[0]'
    AND buku_tamu.fungsi = '$fungsi'
    ORDER BY buku_tamu.masuk ASC");
  $no = 1;

   $html = '<div style="width: 20%; float: left;"><img src="img/logo_pertamina.png" style="width: 80px; height: auto;"></div>
   <h4 style="text-align: center; float: left; width: 80%; padding-top:10px;">
       Report Logbook Tamu<br/>PT. Pertamina (Persero) MOR II<br/>Fungsi '. $fungsi .'</h4><br/>Bulan : '.$bulan.'
      '.
   '<table class="table table-responsive table-bordered report">
     <thead>
       <tr>
       <td>No</td>
       <td>Tanggal</td>
       <td>Nama</td>
       <td>Asal Instansi</td>
       <td>Keperluan</td>
       <td>No Visitor</td>
       <td>Waktu Masuk</td>
       <td>Waktu Keluar</td>
       </tr>
     </thead>
     <tbody>';
     while (@$data = mysqli_fetch_array($query)) {
       $html .= '<tr>
        <td style="width: 3%;">'.$no++.'</td>
        <td style="width: 15%;">';
        $exp_bln = explode(' ',$data['masuk']);
        $html .= date('d-m-Y', strtotime($exp_bln[0]));
       $html .= '</td>
       <td style="width: 20%;">'. $data['nama'] .'</td>
       <td style="width: 20%;">'. $data['asal'] .'</td>
       <td style="width: 15%;">'. $data['keperluan'] .'</td>
       <td style="width: 7%;">'. $data['no_visitor'] .'</td>
       <td style="width: 10%;">';
        $space1 = explode(' ',$data['masuk']);
        $html .= '<STRONG style="color:#5cb85c;">'.$space1[1].'</STRONG>
       </td>
       <td style="width: 10%;">';
         $keluar =$data['keluar'];
         $space2 = explode(' ',$data['keluar']);
         if($keluar == ""){
           // echo '<a id="myButton1" data-end-text="The End" data-load-text="Loading..." class="btn btn-danger waktu-keluar" href="keluar.php?id='.$data['id_pengunjung'].'&waktu='.$data['masuk'].'" autocomplete="off">Keluar</a>';
           $html .= '<STRONG style="color:#428bca;">BELUM KELUAR</STRONG>';
         } else if($keluar != ""){
           $html .= '<STRONG style="color:#d9534f;">'.$space2[1].'</STRONG>';
         }
       $html .= '</td></tr>';
   }
   $html .= '</tbody></table>';
   $mpdf = new mPDF('utf-8', 'A4');
   $mpdf->SetDisplayMode('fullpage');
   $mpdf->list_indent_first_level = 0;
   $stylesheet = file_get_contents('css/bootstrap.css');

   $mpdf->WriteHTML($stylesheet,1);
   $mpdf->WriteHTML($html,2);
   $mpdf->Output('laporan-dengan-mpdf.pdf','I');
   exit;
} else if($lap == "hari"){
  $tgl = $_GET['tgl'];
  $exp = explode('-',$tgl);

  $query = mysqli_query($koneksi,"SELECT pengunjung.id_pengunjung, buku_tamu.asal, pengunjung.nama, buku_tamu.keperluan, buku_tamu.no_visitor, buku_tamu.masuk, buku_tamu.keluar
    FROM pengunjung, buku_tamu
    WHERE pengunjung.id_pengunjung = buku_tamu.id_pengunjung
    AND year(buku_tamu.masuk) = '$exp[2]'
    AND month(buku_tamu.masuk) = '$exp[1]'
    AND day(buku_tamu.masuk) = '$exp[0]'
    AND buku_tamu.fungsi = '$fungsi'
    ORDER BY buku_tamu.masuk ASC");
  $no = 1;

   $html = '<div style="width: 20%; float: left;"><img src="img/logo_pertamina.png" style="width: 80px; height: auto;"></div>
   <h4 style="text-align: center; float: left; width: 80%; padding-top:10px;">
       Report Logbook Tamu<br/>PT. Pertamina (Persero) MOR II<br/>Fungsi '. $fungsi .'</h4><br/>Tanggal : '.$tgl.'
      '.
   '<table class="table table-responsive table-bordered report">
     <thead>
       <tr>
       <td>No</td>
       <td>Nama</td>
       <td>Asal Instansi</td>
       <td>Keperluan</td>
       <td>No Visitor</td>
       <td>Waktu Masuk</td>
       <td>Waktu Keluar</td>
       </tr>
     </thead>
     <tbody>';
     while (@$data = mysqli_fetch_array($query)) {
       $html .= '<tr>
        <td style="width: 3%;">'.$no++.'</td>
       <td style="width: 20%;">'. $data['nama'] .'</td>
       <td style="width: 20%;">'. $data['asal'] .'</td>
       <td style="width: 20%;">'. $data['keperluan'] .'</td>
       <td style="width: 11%;">'. $data['no_visitor'] .'</td>
       <td style="width: 13%;">';
        $space1 = explode(' ',$data['masuk']);
        $html .= '<STRONG style="color:#5cb85c;">'.$space1[1].'</STRONG>
       </td>
       <td style="width: 13%;">';
         $keluar =$data['keluar'];
         $space2 = explode(' ',$data['keluar']);
         if($keluar == ""){
           // echo '<a id="myButton1" data-end-text="The End" data-load-text="Loading..." class="btn btn-danger waktu-keluar" href="keluar.php?id='.$data['id_pengunjung'].'&waktu='.$data['masuk'].'" autocomplete="off">Keluar</a>';
           $html .= '<STRONG style="color:#428bca;">BELUM KELUAR</STRONG>';
         } else if($keluar != ""){
           $html .= '<STRONG style="color:#d9534f;">'.$space2[1].'</STRONG>';
         }
       $html .= '</td></tr>';
   }
   $html .= '</tbody></table>';
   $mpdf = new mPDF('utf-8', 'A4');
   $mpdf->SetDisplayMode('fullpage');
   $mpdf->list_indent_first_level = 0;
   $stylesheet = file_get_contents('css/bootstrap.css');

   $mpdf->WriteHTML($stylesheet,1);
   $mpdf->WriteHTML($html,2);
   $mpdf->Output('laporan-dengan-mpdf.pdf','I');
   exit;
}

 ?>

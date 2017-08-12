<?php  
session_start();
	include_once 'koneksi.php';
	// Fungsi header dengan mengirimkan raw data excel
	header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
	header("Content-Disposition: attachment; filename=Data_logbook_MORII.xls");
    $bulan = @$_GET['bulan'];
    $exp = explode('-',$bulan);
    $fungsi = $_SESSION['fungsi'];
	$query = mysqli_query($koneksi,"SELECT pengunjung.id_pengunjung, buku_tamu.asal, pengunjung.nama, buku_tamu.keperluan, buku_tamu.no_visitor, buku_tamu.masuk, buku_tamu.keluar FROM pengunjung, buku_tamu WHERE pengunjung.id_pengunjung = buku_tamu.id_pengunjung 
                AND year(buku_tamu.masuk) = '$exp[1]' 
                AND month(buku_tamu.masuk) = '$exp[0]'
                AND buku_tamu.fungsi = '$fungsi'
                ORDER BY buku_tamu.masuk ASC");
?>
   <!--  <img src="img/pertamina.png" align="left" height="100px" width="200px"> -->
	<p align="center" style="font-size: 15px; font-weight:bold;">
        Report LogBooks Tamu<br>
        PT.Pertamina (Persero) MOR II<br>
        Fungsi <?php echo $fungsi; ?>
    </p>
    </table>    
    <p><?php echo date("F Y") ?></p>
        <table border="1">  
            <thead bgcolor="#5cb85c" align="center">
	            <tr bgcolor="eeeeee" >
	            	<th>No</th>
	            	<th>Nama</th>
	            	<th>Asal/Instansi/Lembaga</th>
	            	<th>Keperluan</th>
	            	<th>No Visitor</th>
	            	<th>Waktu Masuk</th>
	            	<th>Wakty Keluar</th>
	            </tr>
            </thead>
            <tbody>       
        	</tbody>
  
   <?php     
        //Menampilkan data dari database
        $data = mysqli_fetch_assoc($query);
            $no = 0;
        while($data = mysqli_fetch_assoc($query)){                     
            echo '<tr>';
            echo '<td width="50" align="center">'.$no.'</td>';
            echo '<td width="200">'.$data['nama'].'</td>';
            echo '<td>'.$data['asal'].'</td>';
            echo '<td width="200">'.$data['keperluan'].'</td>';
            echo '<td align="center">'.$data['no_visitor'].'</td>';
            echo '<td align="center">'.$data['masuk'].'</td>';
            echo '<td align="center">'.$data['keluar'].'</td>';
            echo '</tr>';
             $no++;
        }     
    ?>
  </table>   
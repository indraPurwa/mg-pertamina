<?php
  session_start();
  include_once 'koneksi.php';
    if (isset($_SESSION['username']) || isset($_SESSION['fungsi'])){
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $_SESSION['fungsi']; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" sizes="250x250" href="img/logo.png">
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/admin.css" rel="stylesheet">
  <script type="text/javascript" src="js/jam.js"></script>
</head>
<body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
  <?php include_once 'menu.php'; ?>
  <section class="content row">
    <?php include_once 'nav.php'; ?>
    <section class="main-content col-md-10">
      <div class="row" style="margin-top: 30px;">
        <div class="col-xs-offset-1 col-md-10" style="background: #e0e3e0;border-radius: 5px;">
            <div class="i-foto col-md-6" style="border-right: 1px solid black">
              <p style="margin-top:30px;">
                  <?php  
                    $id = $_GET['id'];
                    $query = mysqli_query($koneksi,"SELECT pengunjung.id_pengunjung, pengunjung.nama, pengunjung.tgl, pengunjung.alamat, pengunjung.no_hp, pengunjung.foto, identitas.type, identitas.no_id FROM pengunjung, identitas WHERE pengunjung.id_pengunjung = identitas.id_pengunjung AND identitas.id_pengunjung = '$id'");
                    $data = mysqli_fetch_array($query);
                  ?>
                <img src="<?php echo $data['foto']; ?>" alt="">
                <table style="margin-left: 40px; width:100%; text-align: left;">
                  <tr>
                    <td>NO Pengunjung</td>
                    <td>:</td>
                    <td><?php echo $data['id_pengunjung']; ?></td>
                  </tr>
                  <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?php echo $data['nama']; ?></td>
                  </tr>
                  <tr>
                    <td>Tanggal Lahir</td>
                    <td>:</td>
                    <td><?php echo $data['tgl']; ?></td>
                  </tr>
                  <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?php echo $data['alamat']; ?></td>
                    </tr>
                  <tr>
                    <td>No HP</td>
                    <td>:</td>
                    <td><?php echo $data['no_hp']; ?></td>
                  </tr>
                <?php 
                  $id_pengunjung = $data['id_pengunjung'];
                  $type = $data['type'];
                  $query_type = mysqli_query($koneksi,"SELECT * FROM identitas WHERE id_pengunjung = '$id_pengunjung'");
                  $no = 1;
                  while($data_type = mysqli_fetch_array($query_type)){ 
                ?>
                  <tr>
                    <td><?php echo $data_type['type']; ?></td>
                    <td>:</td>
                    <td><?php echo $data_type['no_id']; ?></td>
                  </tr>
                <?php $no++; } ?>
                </table>
              </p>
            </div>
            <div class="i-data col-md-6" style="padding-top: 10px;padding-bottom: 30px; border-left: none;">
              <center><h3>Tambah Identitas</h3></center><br/>
              <form class="form-horizontal" method="post" action="proses_ti.php"  enctype="multipart/form-data">
                <div class="form-group">
                  <label for="firstname" class="col-md-5 control-label">ID Pengunjung</label>
                  <div class="col-md-7">
                  <input type="text" name="id_pengunjung" class="form-control" value="<?php echo $data['id_pengunjung']; ?>" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label for="firstname" class="col-md-5 control-label">Type</label>
                  <div class="col-md-7">
                  <select class="form-control" name="type" style="width: 100%">
                    <option value="KTP">KTP</option>
                    <option value="SIM A">SIM A</option>
                    <option value="SIM C">SIM C</option>
                  </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="firstname" class="col-md-5 control-label">No Identitas</label>
                  <div class="col-md-7">
                  <input type="text" class="form-control" name="no_id" placeholder="">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10 text-center">
                    <button style="margin-right: 50px; background-color: #ff0000; border-color: #ff0000;" type="reset" class="btn btn-success">Reset</button>
                    <button type="submit" class="btn btn-success">Simpan</button>

                  </div>
                </div>
            </form>
            </div>
        </div>
      </div>

    </section>
  </section>
  <?php include_once 'footer.php'; ?>

  <script src="js/jquery-3.1.1.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/webcam.min.js"></script>
  <script language="Javascript">
      $(document).ready(function(){
    		$('#btn_add_visit').click(function(){
    			$('#visitor').append('<input style="width: 22%;" type="text" class="form-control visitor" name="1" value="">')
    		});
	     });
  </script>
</body>
</html>
<?php
    } else {
        header("location: index.php");
    }
?>
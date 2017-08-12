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
    <link href="css/bootstrap.min.css" rel="stylesheet">
  	<link href="css/admin.css" rel="stylesheet">
  	<link rel="stylesheet" href="css/jquery-ui.css">
		<link href="css/bootstrap-datepicker.css" rel="stylesheet"/>
    <script type="text/javascript" src="js/jam.js"></script>
    <style>
			.report{
				width: 100px;
			}
      .form-group{
        margin-top: 5px;
        margin-left: 7%;
      }
     .col-md-12{margin-left: 15px}
     button.btn{
        margin-right: 80%;
     }
    </style>
</head>
<body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
	<?php include_once 'menu.php'; ?>
	<section class="content row">
	    <?php include_once 'nav.php'; ?>
    <section class="main-content col-md-10 text-center">
      <div class="row" style="margin-top: 10px;">
      <h1>Buku Tamu</h1><br/>
      <div class="col-md-6">
				<form method="POST" action="?tampil=hari" class="form-horizontal" role="form">
	        <div class="form-group">
	          <label style="padding-left: 15px; text-align: left; padding-right: 0;" for="firstname" class="col-md-offset-2 col-md-2 control-label">Perhari</label>
	          <div class="col-md-3" style="padding-right: 0;">
	            <input type="text" name="tgl" class="form-control" id="tgl_hari" placeholder="dd/mm/yyyy">
	          </div>
						<div class="col-md-3" style="padding-left: 0;">
							<button type="submit" class="btn btn-success">OK</button>
						</div>
	        </div>
      	</form>
				<form class="form-horizontal" action="?tampil=bulan" method="POST" role="form">
	        <div class="form-group">
	          <label style="padding-left: 15px;text-align: left;padding-right: 0;" for="firstname" class="col-md-offset-2 col-md-2 control-label">Perbulan</label>
	          <div class="col-md-3" style="padding-right: 0;">
	            <input type="text" name="bulan" class="form-control" id="tgl_bulan" placeholder="mm/yyyy">
	          </div>
						<div class="col-md-3" style="padding-left: 0;">
							<button type="submit" class="btn btn-success">OK</button>
						</div>
	        </div>
      	</form>
		</div>
      <div class="col-md-6">
				<div class="row">
					<div class="col-md-10" style="text-align: right; padding-top: 5px;"><a  href="" class="btn btn-success report" style="width: 20%; padding-left: initial;"><span class="glyphicon glyphicon-print" style="width: 45%"></span>PDF</a></div>
					<div class="col-md-10" style="text-align: right; padding-top: 15px;"><a href="" class="btn btn-success report" style="width: 20%; padding-left: initial;"><span class="glyphicon glyphicon-print" style="width: 45%"></span>EXCEL</a></div>
				</div>
      </div>

        <div class="col-md-10 col-md-offset-1">
          <table class="table table-striped">
            <?php
              @$tampil = $_GET['tampil'];
              if($tampil == 'hari'){
                ?>
            <thead style="    background: #06a0e9;">
              <tr>
                <td>No</td>
                <td>Nama</td>
                <td>Asal/Instansi/lembaga</td>
                <td>Keperluan</td>
                <td>No Visitor</td>
                <td>Waktu Masuk</td>
                <td>Waktu Keluar</td>
              </tr>
            </thead>
            <tbody>
            <?php
                $tgl = @$_POST['tgl'];
                $exp = explode('-',$tgl);
                $query = mysqli_query($koneksi,"SELECT pengunjung.id_pengunjung, buku_tamu.asal, pengunjung.nama, buku_tamu.keperluan, buku_tamu.no_visitor, buku_tamu.masuk, buku_tamu.keluar FROM pengunjung, buku_tamu WHERE pengunjung.id_pengunjung = buku_tamu.id_pengunjung 
                AND year(buku_tamu.masuk) = '$exp[2]' 
                AND month(buku_tamu.masuk) = '$exp[1]' 
                AND day(buku_tamu.masuk) = '$exp[0]'
                ORDER BY buku_tamu.masuk ASC");
                $no = 1;
                  while (@$data = mysqli_fetch_array($query)) {
                    ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['nama']; ?></td>
                <td><?php echo $data['asal']; ?></td>
                <td><?php echo $data['keperluan']; ?></td>
                <td style="text-align: center;">
                  <span class="label label-info"><?php echo $data['no_visitor']; ?></span>
                </td>
                <td>
                  <?php 
                    $space1 = explode(' ',$data['masuk']);
                    // $data['masuk']; 
                    echo '<STRONG style="color:#5cb85c;">'.$space1[1].'</STRONG>';
                  ?>
                </td>
                <td>
                  <?php
                  $keluar =$data['keluar'];
                  $space2 = explode(' ',$data['keluar']);
                  if($keluar == ""){
                    // echo '<a id="myButton1" data-end-text="The End" data-load-text="Loading..." class="btn btn-danger waktu-keluar" href="keluar.php?id='.$data['id_pengunjung'].'&waktu='.$data['masuk'].'" autocomplete="off">Keluar</a>';
                    echo '<STRONG style="color:#428bca;">BELUM KELUAR</STRONG>';
                  } else if($keluar != ""){
                    echo '<STRONG style="color:#d9534f;">'.$space2[1].'</STRONG>';
                  }
                 ?>
                </td>
                <?php 
                } 

              } else if($tampil == 'bulan'){
                ?>
                <thead style="background: #06a0e9;">
              <tr>
                <td>No</td>
                <td>Tanggal</td>
                <td>Nama</td>
                <td>Asal/Instansi/lembaga</td>
                <td>Keperluan</td>
                <td>No Visitor</td>
                <td>Waktu Masuk</td>
                <td>Waktu Keluar</td>
              </tr>
            </thead>
            <tbody>
                <?php
                $bulan = @$_POST['bulan'];
                $exp = explode('-',$bulan);
                $query = mysqli_query($koneksi,"SELECT pengunjung.id_pengunjung, buku_tamu.asal, pengunjung.nama, buku_tamu.keperluan, buku_tamu.no_visitor, buku_tamu.masuk, buku_tamu.keluar FROM pengunjung, buku_tamu WHERE pengunjung.id_pengunjung = buku_tamu.id_pengunjung 
                AND year(buku_tamu.masuk) = '$exp[1]' 
                AND month(buku_tamu.masuk) = '$exp[0]'
                ORDER BY buku_tamu.masuk ASC");
                $no = 1;
                while (@$data = mysqli_fetch_array($query)) {

            ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td>
                  <?php 
                    $exp_bln = explode(' ',$data['masuk']);
                    echo $exp_bln[0];
                  ?>
                </td>
                <td><?php echo $data['nama']; ?></td>
                <td><?php echo $data['asal']; ?></td>
                <td><?php echo $data['keperluan']; ?></td>
                <td style="text-align: center;">
                  <span class="label label-info"><?php echo $data['no_visitor']; ?></span>
                </td>
                <td>
                  <?php 
                    $space1 = explode(' ',$data['masuk']);
                    echo $space1[1];
                  ?>
                </td>
                <td>
                  <?php
                  $keluar =$data['keluar'];
                  $space2 = explode(' ',$data['keluar']);
                  if($keluar == ""){
                    // echo '<a id="myButton1" data-end-text="The End" data-load-text="Loading..." class="btn btn-danger waktu-keluar" href="keluar.php?id='.$data['id_pengunjung'].'&waktu='.$data['masuk'].'" autocomplete="off">Keluar</a>';
                    echo "BELUM KELUAR";
                  } else if($keluar != ""){
                    echo $space2[1];
                  }
                 ?>
                </td>
              </tr>
              <?php 
                } 

              } 
              ?>

            </tbody>
          </table>
        </div>
      </div>
    </section>
  </section>
	<?php include_once 'footer.php'; ?>

	<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"
aria-hidden="true">×
</button>
<h4 class="modal-title" id="myModalLabel">
This Modal title
</h4>
</div>
<div class="modal-body">
Press ESC button to exit.
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default"
data-dismiss="modal">Close
</button>
<button type="button" class="btn btn-primary">
Submit changes
</button>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>

	<script src="js/jquery-3.1.1.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
  <script>
  $(function() {
    $('#tgl_hari').datepicker({
        format: "dd-mm-yyyy",
        // format: "yyyy-mm-dd",
        autoclose:true
    });
		$('#tgl_bulan').datepicker({
        format: "mm-yyyy",
        // format: "yyyy-mm-dd",
        autoclose:true
    });
    $('#myButton1').on("click", function() {
    $('#myButton1').button("load");
    setTimeout(function() {
        $('#myButton1').button("end");
        $('#myButton1').attr('disabled', 'disabled');
      }, 1000);
    });
  } );
  </script>
</body>
</html>
<?php
    } else {
        header("location: index.php");
    }
?>

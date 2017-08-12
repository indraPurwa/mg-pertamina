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
  	<link rel="stylesheet" href="css/jquery-ui.css">
    <script type="text/javascript" src="js/jam.js"></script>
</head>
<body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
	<?php include_once 'menu.php'; ?>
	
	<section class="content row">
	    <?php include_once 'nav.php'; ?>
    <section class="main-content col-md-10 text-center">
      <div class="row isi">
        <div class="panel-body">
          <a href="pencarian.php" class="tambah-peng"><i class="glyphicon glyphicon glyphicon-search"></i><br/>Cari Pengunjung</a>
          <a href="tambah_data.php" class="tambah-peng"><i class="glyphicon glyphicon glyphicon-plus-sign"></i><br/>Tambah Pengunjung</a>
          <br/>
          <a href="input_bt.php" class="tambah-peng"><i class="glyphicon glyphicon glyphicon-book"></i><br/>Input Buku Tamu</a>
          <a href="buku_tamu.php" class="tambah-peng"><i class="glyphicon glyphicon glyphicon-folder-open"></i><br/>Buku Tamu</a>
        </div>
      </div>
    </section>
  </section>
	<?php include_once 'footer.php'; ?>
	<script src="js/jquery-3.1.1.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/bootstrap.js"></script>
  <script>
  $(function() {
    $( "#no_id" ).autocomplete({
      source: "pelanggan.php",
       minLength:1,
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
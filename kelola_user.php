<?php
	session_start();
	include_once 'koneksi.php';
    if (isset($_SESSION['username']) || isset($_SESSION['password'])){
?>
<!DOCTYPE html>
<html>
<head>
	<title>PERTAMINA MOR II || LogBook</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" sizes="250x250" href="img/logo.png">
  	<link href="css/bootstrap.css" rel="stylesheet">
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
      <h1>Daftar User</h1><br/>

        <div class="col-md-10 col-md-offset-1">
          <table class="table table-striped">
            <thead style="    background: #06a0e9;">
              <tr>
								<td>No</td>
                <td>Username</td>
                <td>Password</td>
                <td>Nama</td>
                <td>Fungsi</td>
                <td></td>
              </tr>
            </thead>
            <tbody>
            <?php
                $query = mysqli_query($koneksi,"SELECT * from user");
                $no = 1;
                  while (@$data = mysqli_fetch_array($query)) {
                    ?>
              <tr>
                <td><?php echo $no++; ?></td>
								<td><?php echo $data['username']; ?></td>
                <td><?php echo $data['password']; ?></td>
                <td><?php echo $data['nama']; ?></td>
								<td><?php echo $data['fungsi']; ?></td>
								<td style="padding-top: 5px;">
									<a class="btn btn-success" href="">Edit</a>
									<a class="btn btn-danger" href="">Hapus</a>
								</td>
                <?php
                }
							?>
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </section>
	<?php include_once 'footer.php'; ?>

	<script src="js/jquery-3.1.1.js"></script>
  <script src="js/bootstrap.js"></script>
</body>
</html>
<?php
    } else {
        header("location: index.php");
    }
?>

<?php
	session_start();
	include_once 'konfigurasi.php';
    if (isset($_SESSION['username']) || isset($_SESSION['password'])){
			$table = $conn->query("SELECT * from fungsi");
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
    <script type="text/javascript" src="js/jam.js"></script>
</head>
<body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
	<?php include_once 'menu.php'; ?>

	<section class="content row">
	    <?php include_once 'nav.php'; ?>
    <section class="main-content col-md-10 text-center">
			<div class="row" style="margin-top: 30px;">
        <div class="col-md-offset-4 col-md-4" style="background: #e0e3e0;border-radius: 5px; padding-top: 10px;padding-bottom: 30px; border-left: none;">
            <center><h3>Tambah User</h3></center><br/>
            <form class="form-horizontal" method="post" action="proses_ti.php"  enctype="multipart/form-data">
							<div class="form-group">
                <div class="field">
                  <label>
                    <div class="col-md-4 control-label" style="padding-left: 15px;">
                      <span>Username</span>
                    </div>
                    <div class="col-md-6" style="padding-left: 15px; padding-right: 3px;">
                      <input class='optional form-control' name="username" id="username" placeholder="Masukan username" required/>
                    </div>
                  </label>
                  <span class='extra'></span>
                </div>
              </div>
							<div class="form-group">
                <div class="field">
                  <label>
                    <div class="col-md-4 control-label">
                      <span>Password</span>
                    </div>
                    <div class="col-md-6" style="padding-left: 27px; padding-right: 3px;">
                      <input class='optional form-control' type="password" name="password" id="password" data-validate-length-range="7,100" placeholder="Masukan password" required/>
                    </div>
                    <a href="#" class="tooltip-test" data-toggle="tooltip" id="no_id_tooltip" title="Password minimal 7 karakter">
                      <i class="glyphicon glyphicon-question-sign" style="font-size: 18pt;margin-top: 6px;"></i>
                    </a>.
                  </label>
                  <span class='extra'></span>
                </div>
              </div>
							<div class="form-group">
                <div class="field">
                  <label>
                    <div class="col-md-4 control-label">
                      <span>Ulangi Password</span>
                    </div>
                    <div class="col-md-6" style="padding-left: 27px; padding-right: 3px;">
                      <input class='optional form-control' type="password" name="" data-validate-linked='password' placeholder="Ulangi password" required/>
                    </div>
                  </label>
                  <span class='extra'></span>
                </div>
              </div>
							<div class="form-group">
                <div class="field">
                  <label>
                    <div class="col-md-4 control-label" style="padding-left: 0;">
                      <span>Nama</span>
                    </div>
                    <div class="col-md-6" style="padding-left: 27px; padding-right: 3px;">
                      <input class='optional form-control' type="text" name="nama" placeholder="masukkan nama" required/>
                    </div>
                  </label>
                  <span class='extra'></span>
                </div>
              </div>
							<div class="form-group">
                <div class="field">
                  <label>
                    <div class="col-md-4 control-label">
                      <span>Fungsi</span>
                    </div>
                    <div class="col-md-6" style="padding-left: 27px; padding-right: 3px;">
											<select name="type" class="form-control" required>
												<?php
												while ($row = $table->fetch_assoc() ) {
													echo '<option value="'. $row['fungsi'] .'" required>'. $row['fungsi'] .'</option>';
												}
												?>
			                </select>
                    </div>
                  </label>
                  <span class='extra'></span>
                </div>
              </div>

							<br/>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10 text-center">
                  <button style="margin-right: 50px; background-color: #ff0000; border-color: #ff0000;" type="reset" class="btn btn-success">Reset</button>
                  <button type="submit" class="btn btn-success">Simpan</button>

                </div>
              </div>
          </form>
        </div>
      </div>
    </section>
  </section>
	<?php include_once 'footer.php'; ?>
	<script src="js/jquery-3.1.1.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/bootstrap.js"></script>
	<script src="js/validator.js"></script>
  <script>
	// initialize the validator
	var validator = new FormValidator(),
		$form = $('form');

	document.forms[0].addEventListener('blur', function(e){
		validator.checkField.call(validator, e.target)
	}, true);

	document.forms[0].addEventListener('input', function(e){
		validator.checkField.call(validator, e.target);
	}, true);

	document.forms[0].addEventListener('change', function(e){
		validator.checkField.call(validator, e.target)
	}, true);

	document.forms[0].onsubmit = function(e){
		var submit = true,
			validatorResult = validator.checkAll(this);

		console.log(validatorResult);
		return !!validatorResult.valid;
	};
	$('#alerts').change(function(){
		validator.settings.alerts = (this.checked) ? false : true;
		if( this.checked )
			$('form .alert').remove();
	}).prop('checked',false);
	// end of validation

  </script>
</body>
</html>
<?php
    } else {
        header("location: index.php");
    }
?>

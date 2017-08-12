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
  <link href="css/bootstrap-datepicker.css" rel="stylesheet"/>
  <script type="text/javascript" src="js/jam.js"></script>
</head>
<body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
	<?php include_once 'menu.php'; ?>
  <section class="content row">
    <?php include_once 'nav.php'; ?>
    <section class="main-content col-md-10">
      <div class="row" style="margin-top: 80px;">
        <div class="col-xs-offset-2 col-md-8">
          <form class="" method="post" action="proses_td.php"  enctype="multipart/form-data" role="form" data-toggle="validator">
          	<!-- webcam -->
            <div class="i-foto col-md-6">
              <div id="hasil"></div>
              <br/><br/><button type="button" style="background-color: #5600d6; border-color: #5600d6;" class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-camera"></i> Ambil Foto</button>
            </div>

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					    <div class="modal-dialog">
					      <div class="modal-content">
					        <div class="modal-body">
					          <div id="camera"></div>
					        </div>
					        <div class="modal-footer">
					          <div id="webcam">
					              <input class="btn btn-primary" type=button value="Ambil Foto" onClick="preview()">
					          </div>
					          <div id="simpan" style="display:none">
					              <input class="btn btn-primary" type="button" value="Ambil Ulang" onClick="batal()">
					              <input class="btn btn-primary" type="button" name="webcam" value="Simpan" onClick="simpan()" data-dismiss="modal" style="font-weight:bold;">
					          </div>
					        </div>
					      </div>
					    </div>
					</div>
			<!-- webcam -->

            <div class="i-data col-md-6 form-horizontal">

              <div class="form-group">
                <label for="firstname" class="col-sm-5 control-label">Nama Pengunjung</label>
                <div class="col-sm-7">
                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" required>
                </div>
              </div>
              <div class="form-group">
                <label for="firstname" class="col-sm-5 control-label">Tanggal Lahir</label>
                <div class="col-sm-7">
                	<input type="text" name="tgl" class="form-control" id="tgl" placeholder="Masuk Tanggal" required>
                </div>
              </div>
              <div class="form-group">
                <label for="firstname" class="col-sm-5 control-label">No HP</label>
                <div class="col-sm-7">
                <input type="text" name="no_hp" class="form-control" placeholder="Masukan No Telpon" required>
                </div>
              </div>
              <div class="form-group">
                <label for="firstname" class="col-sm-5 control-label">Alamat</label>
                <div class="col-sm-7"><span style="top: 10px; color: blue;">
                  <textarea name="alamat" rows="3" class="form-control" placeholder="Masukan Alamat" required></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="firstname" class="col-sm-5 control-label">Type</label>
                <div class="col-sm-7">
	                <select name="type" class="form-control" required>
	                  <option value="KTP" required>KTP</option>
	                  <option value="SIM A" required>SIM A</option>
	                  <option value="SIM C" required>SIM C</option>
	                </select>
                </div>
              </div>
              <div class="form-group">
                <div class="field">
                  <label>
                    <div class="col-md-5 control-label">
                      <span>No. Identitas</span>
                    </div>
                    <div class="col-md-6" style="padding-left: 27px; padding-right: 3px;">
                      <input class='optional form-control' name="no_id" id="no_id" data-validate-length="" placeholder="Masukan No Identitas" readonly required/>
                    </div>
                    <a href="#" class="tooltip-test" data-toggle="tooltip" id="no_id_tooltip" title="">
                      <i class="glyphicon glyphicon-question-sign" style="font-size: 18pt;margin-top: 6px;"></i>
                    </a>.
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
            </div>
          </form>
        </div>
      </div>
    </section>
  </section>
	<?php include_once 'footer.php'; ?>

	<script src="js/jquery-3.1.1.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/webcam.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/validator.js"></script>
  <script type="text/javascript" src="js/jam.js"></script>
	<script language="Javascript">
    // selecksi type
    $( "select" ).change(function() {
      var jumlah = "";
      $( "select option:selected" ).each(function() {
        if($( this ).attr('value') == "KTP") jumlah = 16;
        else if($( this ).attr('value') == "SIM A") jumlah = 13;
        else if($( this ).attr('value') == "SIM C") jumlah = 12;
      });
      $('#no_id').removeAttr('readonly');
      $('#no_id').attr('data-validate-length', jumlah);
      $('#no_id_tooltip').attr('title', "Masukkan"+jumlah+" karakter");
    }).trigger( "change" );
    //end of seleksi type

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
		$(function(){
			$('#nama').on("keypress", function(e){
				if(e.which == 13) {
					$("#tgl").focus();
				}
			});
		});
		$(function(){
			var type = "";
			var jumlah =5;
			$("select" ).change(function() {
				var type = $( "select option:selected" ).attr("value");
			});
			$('#no_id').on("keypress", function(e){
				if(e.which == 8 && e.which == 46) {
					jumlah = jumlah +1;
				}
				$('#h').text(jumlah);
			});
		});
	$(function(){
		$('#no_id').on("keypress", function(e){

		});
	});
    $(document).ready(function () {
        $('#tgl').datepicker({
            format: "dd-mm-yyyy",
            // format: "yyyy-mm-dd",
            autoclose:true
        });
    });
    // konfigursi webcam
    Webcam.set({
        width: 600,
        height: 400,
        image_format: 'jpg',
        jpeg_quality: 100
    });
    Webcam.attach( '#camera' );

    function preview() {
        // untuk preview gambar sebelum di upload
        Webcam.freeze();
        // ganti display webcam menjadi none dan simpan menjadi terlihat
        document.getElementById('webcam').style.display = 'none';
        document.getElementById('simpan').style.display = '';
    }

    function batal() {
        // batal preview
        Webcam.unfreeze();

        // ganti display webcam dan simpan seperti semula
        document.getElementById('webcam').style.display = '';
        document.getElementById('simpan').style.display = 'none';
    }

    function simpan() {
        // ambil foto
        Webcam.snap( function(data_url) {

            // upload foto
            Webcam.upload( data_url, 'upload.php', function(code, text) {} );

            // tampilkan hasil gambar yang telah di ambil
            document.getElementById('hasil').innerHTML =
                '<img class="img img-rounded" src="'+data_url+'"/>';

            Webcam.unfreeze();

            document.getElementById('webcam').style.display = '';
            document.getElementById('simpan').style.display = 'none';
        } );
    }
  </script>
</body>
</html>
<?php
    } else {
        header("location: index.php");
    }
?>

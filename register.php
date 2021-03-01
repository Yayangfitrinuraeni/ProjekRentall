<?php
include ("inc/inc.koneksi.php"); 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Sistem Informasi Rental Mobil</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="aset/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="aset/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="aset/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <h3>Sistem Informasi Rental Mobil</h3>
      </div>
      <div class="login-box-body ">
        <h4 class="login-box-msg">Halaman Register</h4>
        <form action="register_aksi.php"  class="login-form" method="post">
            <?php
                $sql ="SELECT max(id_user) as terakhir from user";
                $hasil = mysql_query($sql);
                $data = mysql_fetch_array($hasil);
                $lastID = $data['terakhir'];
                $lastNoUrut = substr($lastID, 3, 9);
                $nextNoUrut = $lastNoUrut + 1;
                $nextID = "USR".sprintf("%03s",$nextNoUrut);
            ?>
          <div class="form-group has-feedback">
            <input type="hidden" name="id_user" class="form-control" placeholder="ID User" value="<?=  $nextID; ?>"/>
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="nama" class="form-control" placeholder="Nama"/>
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="no_hp" class="form-control" placeholder="No HP"/>
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="username" class="form-control" placeholder="Username"/>
          </div>
          <div class="form-group has-feedback"> 
            <input name="password" type="password" class="form-control" placeholder="Password"/>
          </div>
          <div class="row">
            <div class="col-xs-8">                                    
            </div>
            <div class="col-xs-4">
			        <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">
                Daftar
              </button>
            </div>
          </div>
        </form>         
      </div>
    </div>
    <script src="aset/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="aset/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="aset/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%'
        });
      });
    </script>
  </body>
</html>
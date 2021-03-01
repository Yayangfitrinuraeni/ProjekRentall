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
        <h4 class="login-box-msg">Halaman Login</h4>
        <form name="login-form" action="cek_login.php"  class="login-form" method="post">
          <div class="form-group has-feedback">
            <input type="text" name="username" class="form-control" placeholder="Username"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback"> 
            <input name="password" type="password" class="form-control" placeholder="Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">                                    
            </div>
            <div class="col-xs-4">
			        <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">
                <i class="ace-icon fa fa-key"></i>Masuk
              </button>
            </div>
          </div>
        </form>Belum punya akun? Daftar         
        <a href="register.php"> di sini</a><br>
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
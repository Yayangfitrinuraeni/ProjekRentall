<?php
include 'inc/cek_session.php';
include 'inc/fungsi_hdt.php';
include 'inc/inc.library.php';
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Sistem Informasi Rental Mobil</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <link href="../aset/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <link href="../aset/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <link href="../aset/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
  <link href="../aset/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <link href="../aset/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="skin-green sidebar-mini fixed">
  <div class="wrapper">
    <header class="main-header">
      <a href="" class="logo">
        <span class="logo-mini"><b>SIR</b></span>
        <span class="logo-lg" color="ffff">SI Rental Mobil</span>
      </a>
      <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="../aset/dist/img/def.jpg" class="user-image" alt="User Image" />
                <span class="hidden-xs"><?= $_SESSION['nama'];?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <img src="../aset/dist/img/def.jpg" class="img-circle" alt="User Image" />
                  <p>
                    <?= $_SESSION['nama']; ?>
                    <small>(<?= $_SESSION['level'];?>)</small>
                  </p>
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="index.php?module=edit_user&id_user=<?= $_SESSION['id'];?>"
                      class="btn btn-default btn-flat">&nbsp;<i class="fa fa-user"></i>&nbsp;Profil</a>
                  </div>
                  <div class="pull-right">
                    <a href="../logout.php" class="btn btn-default btn-flat">&nbsp;<i
                        class="fa fa-power-off"></i>&nbsp;Keluar</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <aside class="main-sidebar">
      <section class="sidebar">
        <div class="user-panel">
          <div class="pull-left image">
            <img src="../aset/dist/img/def.jpg" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?= $_SESSION['nama']; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <table>
          <tr>
            <td rowspan="3"></td>
            </th>
          </tr>
        </table>
        </li>
        <ul class="sidebar-menu">
          <li class="header">MENU UTAMA</li>
          <li><a href="?module=home"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-tasks"></i> <span>Data Master</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href='?module=merek'><i class="fa fa-th-large"></i><span>Data Merek</i></span></a></li>
              <li><a href='?module=mobil'><i class="fa fa-car"></i><span>Data Mobil</span></a></li>
              <li><a href='?module=sopir'><i class="fa fa-user"></i><span>Data Sopir</span></a></li>
              <li><a href='?module=rute'><i class="fa fa-map-marker"></i><span>Data Rute</span></a></li>
              <li><a href='?module=pelanggan'><i class="fa fa-users"></i><span>Data Pelanggan</span></a></li>
            </ul>
            <li><a href='?module=transaksi'><i class="fa fa-money"></i><span>Data Transaksi</span></a></li>
            <!-- <li><a href='?module=laporan'><i class="fa fa-file"></i><span>Laporan</span></a></li> -->
          </li>
        </ul>
      </section>
    </aside>
    <div style="background:url(../images/mobil.png)" class="content-wrapper">
      <section class="content-header">
        <h1> Sistem Informasi Rental Mobil</h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="glyphicon glyphicon-time"></i><?= Indonesia2Tgl(date('Y-m-d'));?> </a></li>
        </ol>
      </section>
      <section class="content">
        <div class="box box-success">
        
        </div>
        <?php include "isi.php";?>
      </section>
    </div>
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        Sistem Informasi Rental Mobil <b>Version</b> 1.0
      </div>
      <strong>@Copyright by <a href="#">YAYANG FITRI NURAENI</a>.</strong> 
      All rights reserved.|| 
      <a href="#"><i class="fa fa-facebook"></i></a>&nbsp;&nbsp;
      <a href="#"><i class="fa fa-twitter"></i></a>&nbsp;&nbsp;<a href="#"><i class="fa fa-instagram"></i></a>
    </footer>
  </div>
  <script src="../aset/plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <script src="../aset/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="../aset/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
  <script src="../aset/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
  <script src="../aset/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
  <script src="../aset/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
  <script src='../aset/plugins/fastclick/fastclick.min.js'></script>
  <script src="../aset/dist/js/app.min.js" type="text/javascript"></script>
  <script src="../aset/dist/js/demo.js" type="text/javascript"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <script type="text/javascript">
    $(function () {
      $("#example1").dataTable();
      $('#example2').dataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": false,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false
      });
    });
    $('.select2').select2({
      placeholder: "[Pilih]",
    });
  </script>
</body>
</html>
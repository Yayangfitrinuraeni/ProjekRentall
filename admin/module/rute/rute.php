<?php
$aksi="module/rute/rute_aksi.php";
switch($_GET['aksi']){
  default:
?>
<div class="box box-solid box-success">
  <div class="box-header">
    <h3 class="btn btn disabled box-title"><i class="fa fa-map-marker"></i> Data Rute</h3>
    <a class="btn btn-default pull-right" href="?module=rute&aksi=tambah"><i class="fa fa-plus"></i> Tambah Data</a>
  </div>
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr class="text-blue">
          <th class="col-sm-1">No</th>
          <th>Kota Asal</th>
          <th>Kota Tujuan</th>
          <th>Jarak</th>
          <th class="col-sm-1">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $sql = "SELECT * FROM rute";
          $tampil = mysql_query($sql);
          $no=1;
          while ($tampilkan = mysql_fetch_array($tampil)) { 
          $kode = $tampilkan['id_rute'];
        ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $tampilkan['kota_asal']; ?></td>
          <td><?= $tampilkan['kota_tujuan']; ?></td>
          <td><?= $tampilkan['jarak'].' Km'; ?></td>
          <td align="center">
            <a class="btn btn-xs btn-warning"
              href="?module=rute&aksi=edit&id_rute=<?= $tampilkan['id_rute'];?>" alt="Edit Data">
              <i class="glyphicon glyphicon-pencil"></i></a>
            <a class="btn btn-xs btn-danger"
              href="<?= $aksi ?>?module=rute&aksi=hapus&id_rute=<?= $tampilkan['id_rute'];?>"
              alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?= $kode;?> ?')"> 
              <i class="glyphicon glyphicon-trash"></i></a>
          </td>
<?php
	}
?>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<?php 
break;
 case "tambah": 
  $sql ="SELECT max(id_rute) as terakhir from rute";
  $hasil = mysql_query($sql);
  $data = mysql_fetch_array($hasil);
  $lastID = $data['terakhir'];
  $lastNoUrut = substr($lastID, 3, 9);
  $nextNoUrut = $lastNoUrut + 1;
  $nextID = "RUT".sprintf("%03s",$nextNoUrut);
?>
<h3 class="box-title margin text-center">Tambah Data Rute</h3>
<hr />
<form class="form-horizontal" action="<?= $aksi?>?module=rute&aksi=tambah" role="form" method="post">
  <div class="form-group">
    <label class="col-sm-4 control-label">ID Rute </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required name="id_rute" value="<?=  $nextID; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Kota Asal</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required name="kota_asal" placeholder="Kota Asal">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Kota Tujuan</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required name="kota_tujuan" placeholder="Kota Tujuan">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Jarak (Km)</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required name="jarak" placeholder="Jarak (Km)">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label"> </label>
    <div class="col-sm-5">
      <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
      <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i><i> Reset</i></button>
      <a href="javascript:history.back()" class="btn btn-success pull-right"><i class="fa fa-backward"></i> Kembali</a>			 
    </div>
  </div>
</form>
<?php	
break;
case "edit" :
  $data=mysql_query("select * from rute where id_rute='$_GET[id_rute]'");
  $edit=mysql_fetch_array($data);
?>
<h3 class="box-title margin text-center">Edit Data rute</h3>
<br />
<form class="form-horizontal" action="<?= $aksi?>?module=rute&aksi=edit" role="form" method="post">
  <div class="form-group">
    <label class="col-sm-4 control-label">ID Rute </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" readonly name="id_rute" value="<?= $edit['id_rute']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Kota Asal</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required name="kota_asal" placeholder="Kota Asal" value="<?= $edit['kota_asal']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Kota Tujuan</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required name="kota_tujuan" placeholder="Kota Tujuan" value="<?= $edit['kota_tujuan']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Jarak (Km)</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required name="jarak" placeholder="Jarak (Km)" value="<?= $edit['jarak']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4"></label>
    <div class="col-sm-5">
      <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
      <a href="javascript:history.back()" class="btn btn-success pull-right"><i class="fa fa-backward"></i> Kembali</a>			 
    </div>
  </div>
</form>
</div>
</div>
<?php
break;
}
?>
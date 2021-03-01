<?php
$aksi="module/merek/merek_aksi.php";
switch($_GET['aksi']){
  default:
?>
<div class="box box-solid box-success">
  <div class="box-header">
    <h3 class="btn btn disabled box-title"><i class="fa fa-th-large"></i> Data Merek Mobil</h3>
    <a class="btn btn-default pull-right" href="?module=merek&aksi=tambah"><i class="fa fa-plus"></i> Tambah Data</a>
  </div>
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr class="text-blue">
          <th class="col-sm-1">No</th>
          <th>Kode Merek</th>
          <th>Merek</th>
          <th class="col-sm-1">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $sql = "SELECT * FROM merek";
          $tampil = mysql_query($sql);
          $no=1;
          while ($tampilkan = mysql_fetch_array($tampil)) { 
          $kode = $tampilkan['id_merek'];
        ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $kode; ?></td>
          <td><?= $tampilkan['nama_merek']; ?></td>
          <td align="center">
            <a class="btn btn-xs btn-warning" 
              href="?module=merek&aksi=edit&id_merek=<?= $tampilkan['id_merek'];?>" 
              alt="Edit Data"><i class="glyphicon glyphicon-pencil"></i></a>
            <a class="btn btn-xs btn-danger"
              href="<?= $aksi ?>?module=merek&aksi=hapus&id_merek=<?= $tampilkan['id_merek'];?>"
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
  $sql ="SELECT max(id_merek) as terakhir from merek";
  $hasil = mysql_query($sql);
  $data = mysql_fetch_array($hasil);
  $lastID = $data['terakhir'];
  $lastNoUrut = substr($lastID, 3, 9);
  $nextNoUrut = $lastNoUrut + 1;
  $nextID = "MRK".sprintf("%03s",$nextNoUrut);
?>
<h3 class="box-title margin text-center">Tambah Data Merek Mobil</h3>
<hr />
<form class="form-horizontal" action="<?= $aksi?>?module=merek&aksi=tambah" role="form" method="post">
  <div class="form-group">
    <label class="col-sm-4 control-label">ID merek </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="id_merek" value="<?=  $nextID; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama merek</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="nama_merek" placeholder="Nama merek">
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
  $data=mysql_query("select * from merek where id_merek='$_GET[id_merek]'");
  $edit=mysql_fetch_array($data);
?>
<h3 class="box-title margin text-center">Edit Data Merek Mobil</h3>
<br />
<form class="form-horizontal" action="<?= $aksi?>?module=merek&aksi=edit" role="form" method="post">
  <div class="form-group">
    <label class="col-sm-4 control-label">ID merek </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" readonly name="id_merek" value="<?= $edit['id_merek']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama merek</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="nama_merek"
        value="<?= $edit['nama_merek']; ?>">
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
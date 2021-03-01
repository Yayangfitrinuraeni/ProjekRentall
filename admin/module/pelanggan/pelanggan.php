<?php
$aksi="module/pelanggan/pelanggan_aksi.php";
switch($_GET['aksi']){
  default:
?>
<div class="box box-solid box-success">
  <div class="box-header">
    <h3 class="btn btn disabled box-title"><i class="fa fa-users"></i> Data Pelanggan</h3>
    <a class="btn btn-default pull-right" href="?module=pelanggan&aksi=tambah">
      <i class="fa fa-plus"></i> Tambah Data</a>
  </div>
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr class="text-blue">
          <th class="col-sm-1">No</th>
          <th>Nama pelanggan</th>
          <th>No Handphone</th>
          <th>Alamat</th>
          <th class="col-sm-1">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $sql = "SELECT * FROM pelanggan";
          $tampil = mysql_query($sql);
          $no=1;
          while ($tampilkan = mysql_fetch_array($tampil)) { 
          $kode = $tampilkan['id_pelanggan'];
        ?>
        <tr>
          <td><?php echo $no++; ?></td>
          <td><?php echo $tampilkan['nama_pelanggan']; ?></td>
          <td><?php echo $tampilkan['no_hp']; ?></td>
          <td><?php echo $tampilkan['alamat']; ?></td>
          <td align="center">
            <a class="btn btn-xs btn-warning"
              href="?module=pelanggan&aksi=edit&id_pelanggan=<?php echo $tampilkan['id_pelanggan'];?>" alt="Edit Data">
              <i class="glyphicon glyphicon-pencil"></i></a>
            <a class="btn btn-xs btn-danger"
              href="<?php echo $aksi ?>?module=pelanggan&aksi=hapus&id_pelanggan=<?php echo $tampilkan['id_pelanggan'];?>"
              alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?php echo $kode;?> ?')"> 
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
  $sql ="SELECT max(id_pelanggan) as terakhir from pelanggan";
  $hasil = mysql_query($sql);
  $data = mysql_fetch_array($hasil);
  $lastID = $data['terakhir'];
  $lastNoUrut = substr($lastID, 3, 9);
  $nextNoUrut = $lastNoUrut + 1;
  $nextID = "PLG".sprintf("%03s",$nextNoUrut);
?>
<h3 class="box-title margin text-center">Tambah Data Pelanggan</h3>
<hr />
<form class="form-horizontal" action="<?php echo $aksi?>?module=pelanggan&aksi=tambah" role="form" method="post">
  <div class="form-group">
    <label class="col-sm-4 control-label">ID pelanggan </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="id_pelanggan" value="<?php echo  $nextID; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama pelanggan</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="nama_pelanggan" placeholder="Nama pelanggan">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">No Handphone</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="no_hp" placeholder="No Handphone">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Alamat</label>
    <div class="col-sm-5">
      <textarea class="form-control" required="required" name="alamat" placeholder="Alamat"></textarea>
    </div>
  </div>
  <div class="form-group">
  <label class="col-sm-4 control-label"></label>
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
  $data=mysql_query("select * from pelanggan where id_pelanggan='$_GET[id_pelanggan]'");
  $edit=mysql_fetch_array($data);
?>
<h3 class="box-title margin text-center">Edit Data Pelanggan</h3>
<br />
<form class="form-horizontal" action="<?php echo $aksi?>?module=pelanggan&aksi=edit" role="form" method="post">
  <div class="form-group">
    <label class="col-sm-4 control-label">ID pelanggan </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" readonly name="id_pelanggan" value="<?php echo $edit['id_pelanggan']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama pelanggan</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="nama_pelanggan"
        value="<?php echo $edit['nama_pelanggan']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">No Handphone</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="no_hp"
        value="<?php echo $edit['no_hp']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Alamat</label>
    <div class="col-sm-5">
      <textarea class="form-control" required="required" name="alamat"><?php echo $edit['alamat']; ?></textarea>
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
<?php
$aksi="module/sopir/sopir_aksi.php";
switch($_GET['aksi']){
  default:
?>
<div class="box box-solid box-success">
  <div class="box-header">
    <h3 class="btn btn disabled box-title"><i class="fa fa-user"></i> Data Sopir</h3>
    <a class="btn btn-default pull-right" href="?module=sopir&aksi=tambah"><i class="fa fa-plus"></i> Tambah Data</a>
  </div>
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr class="text-blue">
          <th class="col-sm-1">No</th>
          <th>Nama Sopir</th>
          <th>No Handphone</th>
          <th>Alamat</th>
          <th>Status</th>
          <th class="col-sm-1">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $sql = "SELECT * FROM sopir";
          $tampil = mysql_query($sql);
          $no=1;
          while ($tampilkan = mysql_fetch_array($tampil)) { 
          $kode = $tampilkan['id_sopir'];
        ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $tampilkan['nama_sopir']; ?></td>
          <td><?= $tampilkan['no_hp']; ?></td>
          <td><?= $tampilkan['alamat']; ?></td>
          <td>
            <?php
             $class = 'green';
             $status = 'Tersedia';
              if($tampilkan['status'] == '0'){
                $class = 'red';
                $status = 'Tidak Tersedia';
              }
              echo '<span class="badge bg-'.$class.'">'.$status.'</span>'?></td>
          <td align="center">
            <a class="btn btn-xs btn-warning"
              href="?module=sopir&aksi=edit&id_sopir=<?= $tampilkan['id_sopir'];?>" alt="Edit Data">
              <i class="glyphicon glyphicon-pencil"></i></a>
            <a class="btn btn-xs btn-danger"
              href="<?= $aksi ?>?module=sopir&aksi=hapus&id_sopir=<?= $tampilkan['id_sopir'];?>"
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
  $sql ="SELECT max(id_sopir) as terakhir from sopir";
  $hasil = mysql_query($sql);
  $data = mysql_fetch_array($hasil);
  $lastID = $data['terakhir'];
  $lastNoUrut = substr($lastID, 3, 9);
  $nextNoUrut = $lastNoUrut + 1;
  $nextID = "SPR".sprintf("%03s",$nextNoUrut);
?>
<h3 class="box-title margin text-center">Tambah Data Sopir</h3>
<hr />
<form class="form-horizontal" action="<?= $aksi?>?module=sopir&aksi=tambah" role="form" method="post">
  <div class="form-group">
    <label class="col-sm-4 control-label">ID sopir </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required name="id_sopir" value="<?=  $nextID; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama sopir</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required name="nama_sopir" placeholder="Nama sopir">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">No Handphone</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required name="no_hp" placeholder="No Handphone">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Alamat</label>
    <div class="col-sm-5">
      <textarea class="form-control" required name="alamat" placeholder="Alamat"></textarea>
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
  $data=mysql_query("select * from sopir where id_sopir='$_GET[id_sopir]'");
  $edit=mysql_fetch_array($data);
?>
<h3 class="box-title margin text-center">Edit Data Sopir</h3>
<br />
<form class="form-horizontal" action="<?= $aksi?>?module=sopir&aksi=edit" role="form" method="post">
  <div class="form-group">
    <label class="col-sm-4 control-label">ID sopir </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" readonly name="id_sopir" value="<?= $edit['id_sopir']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama sopir</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required name="nama_sopir" value="<?= $edit['nama_sopir']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">No Handphone</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required name="no_hp" value="<?= $edit['no_hp']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Alamat</label>
    <div class="col-sm-5">
      <textarea class="form-control" required name="alamat"><?= $edit['alamat']; ?></textarea>
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
<?php
$aksi="module/mobil/mobil_aksi.php";
switch($_GET['aksi']){
  default:
?>
<div class="box box-solid box-success">
  <div class="box-header">
    <h3 class="btn btn disabled box-title"><i class="fa fa-car"></i> Data Mobil</h3>
    <a class="btn btn-default pull-right" href="?module=mobil&aksi=tambah"><i class="fa fa-plus"></i> Tambah Data</a>
  </div>
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr class="text-blue">
          <th class="col-sm-1">No</th>
          <th>Merek</th>
          <th>Nama Mobil</th>
          <th>Jumlah Kursi</th>
          <th>Warna</th>
          <th>Plat Nomor</th>
          <th>Harga Perhari</th>
          <th>Status</th>
          <th class="col-sm-1">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $sql = "SELECT a.*, b.nama_merek FROM mobil a JOIN merek b ON a.id_merek = b.id_merek";
          $tampil = mysql_query($sql);
          $no=1;
          while ($tampilkan = mysql_fetch_array($tampil)) { 
        ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $tampilkan['nama_merek']; ?></td>
          <td><?= $tampilkan['nama_mobil']; ?></td>
          <td><?= $tampilkan['jumlah_kursi']; ?></td>
          <td><?= $tampilkan['warna']; ?></td>
          <td><?= $tampilkan['plat_nomor']; ?></td>
          <td><?= 'Rp. '. number_format($tampilkan['harga_perhari'],2,',','.') ?></td>
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
              href="?module=mobil&aksi=edit&id_mobil=<?= $tampilkan['id_mobil'];?>" alt="Edit Data">
              <i class="glyphicon glyphicon-pencil"></i></a>
            <a class="btn btn-xs btn-danger"
              href="<?= $aksi ?>?module=mobil&aksi=hapus&id_mobil=<?= $tampilkan['id_mobil'];?>"alt="Delete Data" 
              onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?= $tampilkan['nama_merek'].' '.$tampilkan['nama_mobil'].' ('.$tampilkan['plat_nomor'].')';?> ?')"> 
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
  $sql ="SELECT max(id_mobil) as terakhir from mobil";
  $hasil = mysql_query($sql);
  $data = mysql_fetch_array($hasil);
  $lastID = $data['terakhir'];
  $lastNoUrut = substr($lastID, 3, 9);
  $nextNoUrut = $lastNoUrut + 1;
  $nextID = "MOB".sprintf("%03s",$nextNoUrut);
?>
<h3 class="box-title margin text-center">Tambah Data Mobil</h3>
<hr />
<form class="form-horizontal" action="<?= $aksi?>?module=mobil&aksi=tambah" role="form" method="post">
  <div class="form-group">
    <label class="col-sm-4 control-label">ID Mobil </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required name="id_mobil" value="<?=  $nextID; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Merek Mobil</label>
    <div class="col-sm-5">
      <select name="id_merek" class="form-control select2" required>
        <option value=""> -- Pilih Merek Mobil-- </option>
          <?php $q = mysql_query ("select * from merek");
            while ($k = mysql_fetch_array($q)){ ?>
            <option value="<?= $k['id_merek']; ?>" 
          <?php (@$h['id_merek']==$k['id_merek'])?print(" "):print(""); ?>  > <?= $k['nama_merek']; ?>
        </option> <?php } ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama mobil</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required name="nama_mobil" placeholder="Nama mobil">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Jumlah Kursi</label>
    <div class="col-sm-5">
      <input type="number" class="form-control" required name="jumlah_kursi" placeholder="Jumlah Kursi" min="2">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Warna</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required name="warna" placeholder="Warna mobil">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Plat Nomor</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required name="plat_nomor" placeholder="Plat Nomor">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Tahun Beli</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required name="tahun_beli" placeholder="Tahun Beli">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Tahun Pajak</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required name="tahun_pajak" placeholder="Tahun Pajak">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Harga Perhari</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required name="harga_perhari" placeholder="Harga Perhari">
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
<!----- ------------------------- END TAMBAH DATA Mobil ------------------------- ----->
<?php	
break;
case "edit" :
  $data=mysql_query("select * from mobil where id_mobil='$_GET[id_mobil]'");
  $edit=mysql_fetch_array($data);
?>
<!----- ------------------------- EDIT DATA Mobil ------------------------- ----->
<h3 class="box-title margin text-center">Edit Data Mobil</h3>
<br />
<form class="form-horizontal" action="<?= $aksi?>?module=mobil&aksi=edit" role="form" method="post">
  <div class="form-group">
    <label class="col-sm-4 control-label">ID mobil </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" readonly name="id_mobil" value="<?= $edit['id_mobil']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Merek Mobil</label>
    <div class="col-sm-5">
      <select name="id_merek" class="form-control select2" required>
        <option value=""> -- Pilih Merek Mobil-- </option>
          <?php $q = mysql_query ("select * from merek");
            while ($k = mysql_fetch_array($q)){ ?>
            <option value="<?= $k['id_merek']; ?>" 
          <?php (@$h['id_merek']==$k['id_merek'])?print(" "):print(""); if($k['id_merek'] == $edit['id_merek']){echo 'selected';} ?>  > <?= $k['nama_merek']; ?>
        </option> <?php } ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama mobil</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required name="nama_mobil" value="<?= $edit['nama_mobil']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Jumlah Kursi</label>
    <div class="col-sm-5">
      <input type="number" class="form-control" required name="jumlah_kursi" placeholder="Jumlah Kursi" min="2" value="<?= $edit['jumlah_kursi']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Warna</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required name="warna" placeholder="Warna mobil" value="<?= $edit['warna']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Plat Nomor</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required name="plat_nomor" placeholder="Plat Nomor" value="<?= $edit['plat_nomor']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Tahun Beli</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required name="tahun_beli" placeholder="Tahun Beli" value="<?= $edit['tahun_beli']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Tahun Pajak</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required name="tahun_pajak" placeholder="Tahun Pajak" value="<?= $edit['tahun_pajak']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Harga Perhari</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required name="harga_perhari" placeholder="Harga Perhari" value="<?= $edit['harga_perhari']; ?>">
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
<!----- ------------------------- END EDIT DATA Mobil ------------------------- ----->
<?php
break;
}
?>
<?php
$aksi="module/transaksi/transaksi_aksi.php";
switch($_GET['aksi']){
  default:
?>
<div class="box box-solid box-success">
  <div class="box-header">
    <h3 class="btn btn disabled box-title"><i class="fa fa-money"></i> Data Transaksi</h3>
    <a class="btn btn-default pull-right" href="?module=transaksi&aksi=tambah"><i class="fa fa-plus"></i> Tambah Data</a>
  </div>
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr class="text-blue">
          <th width="20px">No</th>
          <th>Kode Transaksi</th>
          <th>Mobil</th>
          <th>Tanggal Mulai Sewa</th>
          <th>Tanggal Selesai Sewa</th>
          <th>Total</th>
          <th>Status</th>
          <th width="30px">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $sql = "SELECT a.id_transaksi, a.kode_transaksi, c.nama_merek, b.nama_mobil, b.plat_nomor, d.nama_sopir, 
          e.nama_pelanggan, f.kota_asal, f.kota_tujuan, a.tanggal_sewa, a.tanggal_selesai, a.status, a.total
          FROM transaksi a
          JOIN mobil b ON a.id_mobil = b.id_mobil
          JOIN merek c ON b.id_merek = c.id_merek
          LEFT JOIN sopir d ON a.id_sopir = d.id_sopir
          JOIN pelanggan e ON a.id_pelanggan = e.id_pelanggan
          LEFT JOIN rute f ON a.id_rute = f.id_rute
          ORDER BY id_transaksi DESC";
          $tampil = mysql_query($sql);
          $no=1;
          while ($tampilkan = mysql_fetch_array($tampil)) { 
        ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $tampilkan['kode_transaksi']; ?></td>
          <td><?= $tampilkan['nama_merek'].' '.$tampilkan['nama_mobil'].' ('.$tampilkan['plat_nomor'].')'; ?></td>
          <td><?= $tampilkan['tanggal_sewa']; ?></td>
          <td><?= $tampilkan['tanggal_selesai']; ?></td>
          <td><?= 'Rp. '.number_format($tampilkan['total'],2,',','.') ?></td>
          <td>
            <?php
             $class = 'green';
             $status = 'Sudah Kembali';
              if($tampilkan['status'] == '0'){
                $class = 'red';
                $status = 'Belum Kembali';
              }
              echo '<span class="badge bg-'.$class.'">'.$status.'</span>'?></td>
          <td align="center">
            <!-- <a class="btn btn-xs btn-warning"
              href="?module=transaksi&aksi=edit&id_transaksi=<?= $tampilkan['id_transaksi'];?>" alt="Edit Data">
              <i class="glyphicon glyphicon-pencil"></i></a> -->
            <a class="btn btn-xs btn-danger"
              href="<?= $aksi ?>?module=transaksi&aksi=hapus&id_transaksi=<?= $tampilkan['id_transaksi'];?>"
              alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?= $tampilkan['kode_transaksi'];?> ?')">
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
  $sql ="SELECT max(id_transaksi) as terakhir from transaksi";
  $hasil = mysql_query($sql);
  $data = mysql_fetch_array($hasil);
  $lastID = $data['terakhir'];
  $lastNoUrut = substr($lastID, 3, 9);
  $nextNoUrut = $lastNoUrut + 1;
  $nextID = "TRX".sprintf("%03s",$nextNoUrut);
?>
<h3 class="box-title margin text-center">Tambah Data Transaksi</h3>
<hr />
<form class="form-horizontal" action="<?= $aksi?>?module=transaksi&aksi=tambah" role="form" method="post">
  <div class="form-group">
    <label class="col-sm-4 control-label">ID Transaksi </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required name="id_transaksi" value="<?=  $nextID; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Pelanggan</label>
    <div class="col-sm-5">
      <select name="id_pelanggan" class="form-control select2" required>
        <option value=""> -- Pilih Pelanggan-- </option>
          <?php $q = mysql_query ("SELECT * FROM pelanggan ORDER BY nama_pelanggan");
            while ($k = mysql_fetch_array($q)){ ?>
            <option value="<?= $k['id_pelanggan']; ?>" 
          <?php (@$h['id_pelanggan']==$k['id_pelanggan'])?print(" "):print(""); ?>  > <?= $k['nama_pelanggan']; ?>
        </option> <?php } ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Mobil</label>
    <div class="col-sm-5">
      <select name="id_mobil" class="form-control select2" required>
        <option value=""> -- Pilih Mobil-- </option>
          <?php $q = mysql_query(
            "SELECT a.*, b.nama_merek FROM mobil a 
            JOIN merek b ON a.id_merek = b.id_merek
            WHERE a.status = '1'
            ORDER by b.nama_merek");
            while ($k = mysql_fetch_array($q)){ ?>
            <option value="<?= $k['id_mobil']; ?>" 
          <?php (@$h['id_mobil']==$k['id_mobil'])?print(" "):print(""); ?>  > <?=$k['nama_merek'].' '.$k['nama_mobil'].' ('.$k['plat_nomor'].')'; ?>
        </option> <?php } ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Sopir</label>
    <div class="col-sm-5">
      <select name="id_sopir" class="form-control select2" required>
        <option value=""> -- Pilih Sopir-- </option>
          <?php $q = mysql_query ("SELECT * FROM sopir where status = '1' ORDER BY nama_sopir");
            while ($k = mysql_fetch_array($q)){ ?>
            <option value="<?= $k['id_sopir']; ?>" 
          <?php (@$h['id_sopir']==$k['id_sopir'])?print(" "):print(""); ?>  > <?= $k['nama_sopir']; ?>
        </option> <?php } ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Rute</label>
    <div class="col-sm-5">
      <select name="id_rute" class="form-control select2" required>
        <option value=""> -- Pilih Rute-- </option>
          <?php $q = mysql_query ("SELECT * FROM rute");
            while ($k = mysql_fetch_array($q)){ ?>
            <option value="<?= $k['id_rute']; ?>" 
          <?php (@$h['id_rute']==$k['id_rute'])?print(" "):print(""); ?>  > <?= $k['kota_asal'].' - '.$k['kota_tujuan']; ?>
        </option> <?php } ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Tanggal Sewa</label>
    <div class="col-sm-5">
      <input type="date" class="form-control" required name="tanggal_sewa">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Tanggal Selesai Sewa</label>
    <div class="col-sm-5">
      <input type="date" class="form-control" required name="tanggal_selesai">
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
<!----- ------------------------- END TAMBAH DATA Transaksi ------------------------- ----->
<?php	
break;
case "edit" :
  $data=mysql_query("select * from transaksi where id_transaksi='$_GET[id_transaksi]'");
  $edit=mysql_fetch_array($data);
?>
<!----- ------------------------- EDIT DATA Transaksi ------------------------- ----->
<h3 class="box-title margin text-center">Edit Data Transaksi</h3>
<br />
<form class="form-horizontal" action="<?= $aksi?>?module=transaksi&aksi=edit" role="form" method="post">
  <div class="form-group">
    <label class="col-sm-4 control-label">ID Transaksi </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" readonly name="id_transaksi" value="<?= $edit['id_transaksi']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Pelanggan</label>
    <div class="col-sm-5">
      <select name="id_pelanggan" class="form-control select2" required>
        <option value=""> -- Pilih Pelanggan-- </option>
          <?php $q = mysql_query ("SELECT * FROM pelanggan ORDER BY nama_pelanggan");
            while ($k = mysql_fetch_array($q)){ ?>
            <option value="<?= $k['id_pelanggan']; ?>" 
          <?php (@$h['id_pelanggan']==$k['id_pelanggan'])?print(" "):print(""); if($k['id_pelanggan'] == $edit['id_pelanggan']){echo 'selected';}  ?>  > <?= $k['nama_pelanggan']; ?>
        </option> <?php } ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Mobil</label>
    <div class="col-sm-5">
      <select name="id_mobil" class="form-control select2" required>
        <option value=""> -- Pilih Mobil-- </option>
          <?php $q = mysql_query(
            "SELECT a.*, b.nama_merek FROM mobil a 
            JOIN merek b ON a.id_merek = b.id_merek
            ORDER by b.nama_merek");
            while ($k = mysql_fetch_array($q)){ ?>
            <option value="<?= $k['id_mobil']; ?>" 
          <?php (@$h['id_mobil']==$k['id_mobil'])?print(" "):print(""); if($k['id_mobil'] == $edit['id_mobil']){echo 'selected';} ?>  > <?=$k['nama_merek'].' '.$k['nama_mobil'].' ('.$k['plat_nomor'].')'; ?>
        </option> <?php } ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Sopir</label>
    <div class="col-sm-5">
      <select name="id_sopir" class="form-control select2" required>
        <option value=""> -- Pilih Sopir-- </option>
          <?php $q = mysql_query ("SELECT * FROM sopir ORDER BY nama_sopir");
            while ($k = mysql_fetch_array($q)){ ?>
            <option value="<?= $k['id_sopir']; ?>" 
          <?php (@$h['id_sopir']==$k['id_sopir'])?print(" "):print(""); if($k['id_sopir'] == $edit['id_sopir']){echo 'selected';} ?>  > <?= $k['nama_sopir']; ?>
        </option> <?php } ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Rute</label>
    <div class="col-sm-5">
      <select name="id_rute" class="form-control select2" required>
        <option value=""> -- Pilih Rute-- </option>
          <?php $q = mysql_query ("SELECT * FROM rute");
            while ($k = mysql_fetch_array($q)){ ?>
            <option value="<?= $k['id_rute']; ?>" 
          <?php (@$h['id_rute']==$k['id_rute'])?print(" "):print(""); if($k['id_rute'] == $edit['id_rute']){echo 'selected';} ?>  > <?= $k['kota_asal'].' - '.$k['kota_tujuan']; ?>
        </option> <?php } ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Tanggal Sewa</label>
    <div class="col-sm-5">
      <input type="date" class="form-control" required name="tanggal_sewa" value="<?= $edit['tanggal_sewa']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Tanggal Selesai Sewa</label>
    <div class="col-sm-5">
      <input type="date" class="form-control" required name="tanggal_selesai" value="<?= $edit['tanggal_selesai']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Tanggal Kembali</label>
    <div class="col-sm-5">
      <input type="date" class="form-control" required name="tanggal_kembali" value="<?= $edit['tanggal_kembali']; ?>">
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
<!----- ------------------------- END EDIT DATA Transaksi ------------------------- ----->
<?php
break;
}
?>
<?php
include "../../koneksi.php";

$module=$_GET['module'];
$aksi=$_GET['aksi'];

$id_mobil       = $_POST['id_mobil'];
$id_merek       = $_POST['id_merek'];
$nama_mobil     = $_POST['nama_mobil'];
$jumlah_kursi   = $_POST['jumlah_kursi'];
$warna          = $_POST['warna'];
$plat_nomor     = $_POST['plat_nomor'];
$tahun_beli     = $_POST['tahun_beli'];
$tahun_pajak    = $_POST['tahun_pajak'];
$harga_perhari  = $_POST['harga_perhari'];


if($module=='mobil' AND $aksi=='tambah' ){ 
    $sql = "INSERT INTO mobil (id_mobil, id_merek, nama_mobil, jumlah_kursi, warna, plat_nomor, tahun_beli, tahun_pajak, harga_perhari) 
    VALUES ('$id_mobil', '$id_merek', '$nama_mobil', '$jumlah_kursi', '$warna', '$plat_nomor', '$tahun_beli', '$tahun_pajak', '$harga_perhari')";
    $simpan = mysql_query($sql);
    header('location:../../index.php?module='.$module);
}

else if($module=='mobil' AND $aksi=='edit' ){ 
    mysql_query(
        "UPDATE mobil SET 
        id_merek='$id_merek', 
        nama_mobil='$nama_mobil', 
        jumlah_kursi='$jumlah_kursi',
        warna='$warna',
        plat_nomor='$plat_nomor',
        tahun_beli='$tahun_beli',
        tahun_pajak='$tahun_pajak',
        harga_perhari='$harga_perhari' WHERE id_mobil = '$id_mobil'");
    header('location:../../index.php?module='.$module);
}

else if($module=='mobil' AND $aksi=='hapus' ){ 
    $mySql = "DELETE FROM mobil WHERE id_mobil='".$_GET['id_mobil']."'";
    $myQry = mysql_query($mySql);
    header('location:../../index.php?module='.$module);
}
?>
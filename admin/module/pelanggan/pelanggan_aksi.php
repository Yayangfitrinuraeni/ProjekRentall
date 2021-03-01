<?php
include "../../koneksi.php";

$module = $_GET['module'];
$aksi   = $_GET['aksi'];

$id_pelanggan   = $_POST['id_pelanggan'];
$nama_pelanggan = $_POST['nama_pelanggan'];
$no_hp          = $_POST['no_hp'];
$alamat         = $_POST['alamat'];

if($module=='pelanggan' AND $aksi=='tambah' ){ 
    $sql = "INSERT INTO pelanggan VALUES ('$id_pelanggan', '$nama_pelanggan', '$no_hp', '$alamat')";
    $simpan = mysql_query($sql);
    header('location:../../index.php?module='.$module);
}

else if($module=='pelanggan' AND $aksi=='edit' ){ 
    mysql_query("UPDATE pelanggan SET nama_pelanggan='$nama_pelanggan', no_hp='$no_hp', alamat='$alamat' WHERE id_pelanggan = '$id_pelanggan'");
    header('location:../../index.php?module='.$module);
}

else if($module=='pelanggan' AND $aksi=='hapus' ){ 
    $mySql = "DELETE FROM pelanggan WHERE id_pelanggan='".$_GET['id_pelanggan']."'";
    $myQry = mysql_query($mySql);
    header('location:../../index.php?module='.$module);
}
?>
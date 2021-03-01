<?php
include "../../koneksi.php";

$module = $_GET['module'];
$aksi   = $_GET['aksi'];

$id_sopir   = $_POST['id_sopir'];
$nama_sopir = $_POST['nama_sopir'];
$no_hp      = $_POST['no_hp'];
$alamat     = $_POST['alamat'];

if($module=='sopir' AND $aksi=='tambah' ){ 
    $sql = "INSERT INTO sopir VALUES ('$id_sopir', '$nama_sopir', '$no_hp', '$alamat')";
    $simpan = mysql_query($sql);
    header('location:../../index.php?module='.$module);
}

else if($module=='sopir' AND $aksi=='edit' ){ 
    mysql_query("UPDATE sopir SET nama_sopir='$nama_sopir', no_hp='$no_hp', alamat='$alamat' WHERE id_sopir = '$id_sopir'");
    header('location:../../index.php?module='.$module);
}

else if($module=='sopir' AND $aksi=='hapus' ){ 
    $mySql = "DELETE FROM sopir WHERE id_sopir='".$_GET['id_sopir']."'";
    $myQry = mysql_query($mySql);
    header('location:../../index.php?module='.$module);
}
?>
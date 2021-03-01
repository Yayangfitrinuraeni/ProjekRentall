<?php
include "../../koneksi.php";

$module=$_GET['module'];
$aksi=$_GET['aksi'];

$id_merek = $_POST['id_merek'];
$nama_merek = $_POST['nama_merek'];

if($module=='merek' AND $aksi=='tambah' ){ 
    $sql = "INSERT INTO merek (id_merek, nama_merek) VALUES ('$id_merek', '$nama_merek')";
    $simpan = mysql_query($sql);
    header('location:../../index.php?module='.$module);
}

else if($module=='merek' AND $aksi=='edit' ){ 
    mysql_query("UPDATE merek SET nama_merek='$nama_merek' WHERE id_merek = '$id_merek'");
    header('location:../../index.php?module='.$module);
}

else if($module=='merek' AND $aksi=='hapus' ){ 
    $mySql = "DELETE FROM merek WHERE id_merek='".$_GET['id_merek']."'";
    $myQry = mysql_query($mySql);
    header('location:../../index.php?module='.$module);
}
?>
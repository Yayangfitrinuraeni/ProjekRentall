<?php
include "../../koneksi.php";

$module = $_GET['module'];
$aksi   = $_GET['aksi'];

$id_rute    = $_POST['id_rute'];
$kota_asal  = $_POST['kota_asal'];
$kota_tujuan= $_POST['kota_tujuan'];
$jarak      = $_POST['jarak'];

if($module=='rute' AND $aksi=='tambah' ){ 
    $sql = "INSERT INTO rute VALUES ('$id_rute', '$kota_asal', '$kota_tujuan', '$jarak')";
    $simpan = mysql_query($sql);
    header('location:../../index.php?module='.$module);
}

else if($module=='rute' AND $aksi=='edit' ){ 
    mysql_query("UPDATE rute SET kota_asal='$kota_asal', kota_tujuan='$kota_tujuan', jarak='$jarak' WHERE id_rute = '$id_rute'");
    header('location:../../index.php?module='.$module);
}

else if($module=='rute' AND $aksi=='hapus' ){ 
    $mySql = "DELETE FROM rute WHERE id_rute='".$_GET['id_rute']."'";
    $myQry = mysql_query($mySql);
    header('location:../../index.php?module='.$module);
}
?>
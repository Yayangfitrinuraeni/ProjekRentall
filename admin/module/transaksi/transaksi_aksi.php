<?php
include "../../koneksi.php";

$module =$_GET['module'];
$aksi   =$_GET['aksi'];
$unik   =  uniqid();

$kode_unik      =  strtoupper(substr($unik, -6));
$id_transaksi   = $_POST['id_transaksi'];
$kode_transaksi = 'RENT/'.date("dmY", strtotime($_POST['tanggal_sewa'])).'/'.$kode_unik;
$id_mobil       = $_POST['id_mobil'];
$id_sopir       = $_POST['id_sopir'];
$id_pelanggan   = $_POST['id_pelanggan'];
$id_rute        = $_POST['id_rute'];
$tanggal_sewa   = $_POST['tanggal_sewa'];
$tanggal_selesai= $_POST['tanggal_selesai'];
$tanggal_kembali= '';
$status         = '0';

if(isset($_POST['tanggal_kembali'])){
    $tanggal_kembali= $_POST['tanggal_kembali'];
    $status = '1';
}

$get_harga  = mysql_query("SELECT harga_perhari from mobil WHERE id_mobil = '$id_mobil'");
$mobil      = mysql_fetch_assoc($get_harga);

$startTimeStamp = strtotime($_POST['tanggal_sewa']);
$endTimeStamp   = strtotime($_POST['tanggal_selesai']);

$timeDiff   = abs($endTimeStamp - $startTimeStamp);
$numberDays = $timeDiff/86400; 
$numberDays = (intval($numberDays))+1;

$total = $mobil['harga_perhari'] * $numberDays;


if($module=='transaksi' AND $aksi=='tambah' ){ 
    $sql = "INSERT INTO transaksi (id_transaksi, kode_transaksi, id_mobil, id_sopir, id_pelanggan, id_rute, tanggal_sewa, tanggal_selesai, total)  
    VALUES ('$id_transaksi', '$kode_transaksi', '$id_mobil', '$id_sopir', '$id_pelanggan', '$id_rute', '$tanggal_sewa', '$tanggal_selesai', '$total')";
    $update_mobil = "UPDATE mobil SET status = '0' WHERE id_mobil = '$id_mobil'";
    $update_sopir = "UPDATE sopir SET status = '0' WHERE id_sopir = '$id_sopir'";
    
    $simpan = mysql_query($sql);
    $update_mobil = mysql_query($update_mobil);
    $update_sopir = mysql_query($update_sopir);
    header('location:../../index.php?module='.$module);
}

else if($module=='transaksi' AND $aksi=='edit' ){ 
    $sql = "UPDATE transaksi SET 
            id_mobil='$id_mobil', 
            id_sopir='$id_sopir', 
            id_pelanggan='$id_pelanggan',
            id_rute='$id_rute',
            tanggal_sewa='$tanggal_sewa',
            tanggal_selesai='$tanggal_selesai',
            total = '$total',
            tanggal_kembali='$tanggal_kembali', 
            status='$status'
            WHERE id_transaksi = '$id_transaksi'";
    $update_mobil = "UPDATE mobil SET status = '$status' WHERE id_mobil = '$id_mobil'";
    $update_sopir = "UPDATE sopir SET status = '$status' WHERE id_sopir = '$id_sopir'";        
    $simpan = mysql_query($sql);
    $update_mobil = mysql_query($update_mobil);
    $update_sopir = mysql_query($update_sopir);
    header('location:../../index.php?module='.$module);
}

else if($module=='transaksi' AND $aksi=='hapus' ){ 
    $mySql = "DELETE FROM transaksi WHERE id_transaksi='".$_GET['id_transaksi']."'";
    $myQry = mysql_query($mySql);
    header('location:../../index.php?module='.$module);
}
?>
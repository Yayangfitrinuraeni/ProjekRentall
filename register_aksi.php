<?php
include ("inc/inc.koneksi.php"); 

$id_user = $_POST['id_user'];
$nama = $_POST['nama'];
$user = $_POST['username'];
$pass = md5($_POST['password']);
$no_hp = $_POST['no_hp'];
$level = 'admin';
$blokir = 'N';

    $sql = "INSERT INTO user VALUES ('$id_user', '$user', '$pass', '$nama', '$no_hp', '$level', '$blokir')";
    $simpan = mysql_query($sql);
    header('location:index.php');

?>
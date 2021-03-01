<?php
include "include/koneksi.php";

if ($_GET['module'] == "home") {
	include "module/home.php";
}
else if ($_GET['module'] == "merek") {
	include "module/merek/merek.php";
}
else if ($_GET['module'] == "mobil") {
	include "module/mobil/mobil.php";
}	
else if ($_GET['module'] == "sopir") {
	include "module/sopir/sopir.php";
}
else if ($_GET['module'] == "pelanggan") {
	include "module/pelanggan/pelanggan.php";
}	
else if ($_GET['module'] == "rute") {
	include "module/rute/rute.php";
}	
else if ($_GET['module'] == "transaksi") {
	include "module/transaksi/transaksi.php";
}
else if ($_GET['module'] == "laporan") {
	include "module/laporan/laporan.php";
}	
?>
<?php
$koneksi=mysql_connect("localhost","root","")
or
die("can't connect to database");
$db=mysql_select_db("dbrental",$koneksi);
?>
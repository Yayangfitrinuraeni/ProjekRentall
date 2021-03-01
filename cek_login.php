<?php
include "inc/inc.koneksi.php";
include "inc/fungsi_hdt.php";

function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}
$username= anti_injection($_POST['username']);
$pass	 = anti_injection(md5($_POST['password']));
if (!ctype_alnum($username) OR !ctype_alnum($pass)){
?>
<script>
	alert('Sekarang loginnya tidak bisa di injeksi lho.');
	window.location.href='index.php';
</script>
<?php
}else{
	$login	=mysql_query("SELECT * FROM user WHERE user='$username'");
	$ketemu	=mysql_num_rows($login);
	if ($ketemu>0){
		$r		=mysql_fetch_array($login);
		$pwd	=$r['pass'];
		if ($r['blokir'] == 'Y'){
			salah_blokir($username);
			return false;
		}
		if ($pwd==$pass){
			sukses_masuk($username,$pass);
		}else{
			session_start();
			mysql_query("UPDATE user SET limit_login = limit_login + 1 WHERE user='$username'");
			$ceklog = mysql_fetch_array(mysql_query("SELECT limit_login FROM user WHERE user='$username'"));
				$log=$ceklog['limit_login'];
				if($log > 2){
					mysql_query("UPDATE user SET blokir = 'Y' WHERE user='$username'");

					echo "<script>alert('Username ".$username." Telah di blokir, Silahkan Hubungi Administrator'); window.location = 'index.php'</script>";
				} else {
				    echo "<script>alert('Username atau Password Tidak Benar, Anda Sudah ".$log." Kali Mencoba'); window.location = 'index.php'</script>";
				}
			salah_password();
		}
	}else{
		salah_username($username);
	}
}
?>

<?php
include "config/koneksi.php";

// fungsi untuk menghindari injeksi dari user yang jahil
function anti_injection($data){
  $filter  = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
  return $filter;
}

$username = anti_injection($_POST['username']);
$password = anti_injection(md5($_POST['password']));


  $query  = "SELECT * FROM tb_auth WHERE username='$username' AND password='$password'";
  $login  = mysqli_query($konek, $query);
  $ketemu = mysqli_num_rows($login);
  $r      = mysqli_fetch_array($login);

  // Apabila username dan password ditemukan (benar)
  if ($ketemu > 0){
    session_start();

    // bikin variabel session
    $_SESSION['username']    = $r['username'];
    $_SESSION['passuser']    = $r['password'];
    $_SESSION['level']    = $r['level'];
    $_SESSION['status']   = $r['status'];
	 $_SESSION['auth_code']   = $r['auth_code'];
      
    // bikin id_session yang unik dan mengupdatenya agar slalu berubah 
    // agar user biasa sulit untuk mengganti password Administrator 
    $sid_lama = session_id();
    session_regenerate_id();
    $sid_baru = session_id();

    header("location:site.php?halamane=beranda");
  }
  else{
    echo "<h1>Login Gagal! Username & Password salah.</h1>";
    echo "<p><a href=\"index.php\">Ulangi Lagi</a></p>";  
  }

?>

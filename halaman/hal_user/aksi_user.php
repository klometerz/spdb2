<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<h1>Untuk mengakses halaman, Anda harus login dulu.</h1><p><a href=\"index.php\">LOGIN</a></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  include "../../config/koneksi.php";

  $halamane = $_GET['halamane'];
  $act    = $_GET['act'];

  // Input user
  if ($halamane=='user' AND $act=='input'){
    $id_user   = trim(htmlspecialchars($_POST['id_user']));
    $nama_user = trim(htmlspecialchars($_POST['nama_user']));
    $password  = trim(htmlspecialchars(md5($_POST['password'])));
   // $id_divisi  = trim(htmlspecialchars($_POST['id_divisi']));
    $level  = trim(htmlspecialchars($_POST['level']));
	$time = date("Y-m-d H:i:s");
    $input = "INSERT INTO tb_auth(auth_code, 
                                username, 
                                password,
                                level, 
								last_login) 
	                       VALUES('$id_user', 
                                '$nama_user', 
                                '$password',
                                '$level', 
								'$time')";
    mysqli_query($konek, $input);
    header("location:../../site.php?halamane=".$halamane);
  }

  // Update user
  elseif ($halamane=='user' AND $act=='update'){
    $id_user   = trim(htmlspecialchars($_POST['id_user']));
    $nama_user = trim(htmlspecialchars($_POST['nama_user']));
    $password  = trim(htmlspecialchars($_POST['password']));
    $id_divisi  = trim(htmlspecialchars($_POST['id_divisi']));
     $level  = trim(htmlspecialchars($_POST['level']));
     
      $update = "UPDATE user SET nama_user = '$nama_user',
                                  password = '$password',
                                 id_divisi = '$id_divisi',
                                     level = '$level'
                             WHERE id_user = '$id_user'";
      mysqli_query($konek, $update);
      header("location:../../site.php?halamane=".$halamane);
  }

  elseif ($halamane=='user' AND $act=='hapus'){
      mysqli_query($konek, "DELETE FROM user WHERE id_user='$_GET[id]'"); 
       header("location:../../site.php?halamane=".$halamane);
  }
  
    elseif ($halamane=='user' AND $act=='assign')
	{
      mysqli_query($konek, "update tb_auth set auth_code ='".$_POST[subject]."' where id_auth ='".$_POST[id_auth]."'");
       header("location:../../site.php?halamane=".$halamane);
  }
}
?>

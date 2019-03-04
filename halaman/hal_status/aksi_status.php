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

  // Input status
  if ($halamane=='status' AND $act=='input'){
    $id_status   = trim(htmlspecialchars($_POST['id_status']));
    $nama_status = trim(htmlspecialchars($_POST['nama_status']));

    $input = "INSERT INTO status(id_status, 
                                nama_status) 
                         VALUES('$id_status', 
                                '$nama_status')";
    mysqli_query($konek, $input);
    header("location:../../site.php?halamane=".$halamane);
  }

  // Update status
  elseif ($halamane=='status' AND $act=='update'){
    $id_status   = trim(htmlspecialchars($_POST['id_status']));
    $nama_status = trim(htmlspecialchars($_POST['nama_status']));

     $update = "UPDATE status SET nama_status = '$nama_status' 
                            WHERE id_status = '$id_status'";
      mysqli_query($konek, $update);
      header("location:../../site.php?halamane=".$halamane);
  }

   // hapus status
  elseif ($halamane=='status' AND $act=='hapus'){
      mysqli_query($konek, "DELETE FROM status WHERE id_status='$_GET[id]'"); 
       header("location:../../site.php?halamane=".$halamane);
  }
}
?>

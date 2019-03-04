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

  // Input teknisi
  if ($halamane=='teknisi' AND $act=='input'){
    $id_teknisi   = trim(htmlspecialchars($_POST['id_teknisi']));
    $nama_teknisi = trim(htmlspecialchars($_POST['nama_teknisi']));

    $input = "INSERT INTO teknisi(id_teknisi, 
                                nama_teknisi) 
                         VALUES('$id_teknisi', 
                                '$nama_teknisi')";
    mysqli_query($konek, $input);
    header("location:../../site.php?halamane=".$halamane);
  }

  // Update teknisi
  elseif ($halamane=='teknisi' AND $act=='update'){
    $id_teknisi   = trim(htmlspecialchars($_POST['id_teknisi']));
    $nama_teknisi = trim(htmlspecialchars($_POST['nama_teknisi']));

     $update = "UPDATE teknisi SET nama_teknisi = '$nama_teknisi' 
                            WHERE id_teknisi = '$id_teknisi'";
      mysqli_query($konek, $update);
      header("location:../../site.php?halamane=".$halamane);
  }

   // hapus teknisi
  elseif ($halamane=='teknisi' AND $act=='hapus'){
      mysqli_query($konek, "DELETE FROM teknisi WHERE id_teknisi='$_GET[id]'"); 
       header("location:../../site.php?halamane=".$halamane);
  }
}
?>

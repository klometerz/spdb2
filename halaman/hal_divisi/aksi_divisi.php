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

  // Input divisi
  if ($halamane=='divisi' AND $act=='input'){
    $id_divisi   = trim(htmlspecialchars($_POST['id_divisi']));
    $nama_divisi = trim(htmlspecialchars($_POST['nama_divisi']));

    $input = "INSERT INTO divisi(id_divisi, 
                                nama_divisi) 
                         VALUES('$id_divisi', 
                                '$nama_divisi')";
    mysqli_query($konek, $input);
    header("location:../../site.php?halamane=".$halamane);
  }

  // Update divisi
  elseif ($halamane=='divisi' AND $act=='update'){
    $id_divisi   = trim(htmlspecialchars($_POST['id_divisi']));
    $nama_divisi = trim(htmlspecialchars($_POST['nama_divisi']));

     $update = "UPDATE divisi SET nama_divisi = '$nama_divisi' 
                            WHERE id_divisi = '$id_divisi'";
      mysqli_query($konek, $update);
      header("location:../../site.php?halamane=".$halamane);
  }

   // hapus divisi
  elseif ($halamane=='divisi' AND $act=='hapus'){
      mysqli_query($konek, "DELETE FROM divisi WHERE id_divisi='$_GET[id]'"); 
       header("location:../../site.php?halamane=".$halamane);
  }
}
?>

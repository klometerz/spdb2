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

  // Input vendor
  if ($halamane=='vendor' AND $act=='input'){
    $id_vendor   = trim(htmlspecialchars($_POST['id_vendor']));
    $nama_vendor = trim(htmlspecialchars($_POST['nama_vendor']));

    $input = "INSERT INTO vendor(id_vendor, 
                                nama_vendor) 
                         VALUES('$id_vendor', 
                                '$nama_vendor')";
    mysqli_query($konek, $input);
    header("location:../../site.php?halamane=".$halamane);
  }

  // Update vendor
  elseif ($halamane=='vendor' AND $act=='update'){
    $id_vendor   = trim(htmlspecialchars($_POST['id_vendor']));
    $nama_vendor = trim(htmlspecialchars($_POST['nama_vendor']));

     $update = "UPDATE vendor SET nama_vendor = '$nama_vendor' 
                            WHERE id_vendor = '$id_vendor'";
      mysqli_query($konek, $update);
      header("location:../../site.php?halamane=".$halamane);
  }

   // hapus vendor
  elseif ($halamane=='vendor' AND $act=='hapus'){
      mysqli_query($konek, "DELETE FROM vendor WHERE id_vendor='$_GET[id]'"); 
       header("location:../../site.php?halamane=".$halamane);
  }
}
?>

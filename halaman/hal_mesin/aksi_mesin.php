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

  // Input mesin
  if ($halamane=='mesin' AND $act=='input'){
    $id_mesin   = trim(htmlspecialchars($_POST['id_mesin']));
    $nama_mesin = trim(htmlspecialchars($_POST['nama_mesin']));
    $merk_mesin = trim(htmlspecialchars($_POST['merk_mesin']));
    $kapasitas = trim(htmlspecialchars($_POST['kapasitas']));
    $id_divisi = trim(htmlspecialchars($_POST['id_divisi']));
    $tahun_pembuatan = trim(htmlspecialchars($_POST['tahun_pembuatan']));
    $periode_pakai = trim(htmlspecialchars($_POST['periode_pakai']));

    $input = "INSERT INTO mesin(id_mesin, 
                                nama_mesin,
								merk_mesin,
								kapasitas,
								id_divisi,
								tahun_pembuatan,
								periode_pakai) 
                         VALUES('$id_mesin', 
                                '$nama_mesin',
                                '$merk_mesin',
                                '$kapasitas',
                                '$id_divisi',
                                '$tahun_pembuatan',
                                '$periode_pakai')";
    mysqli_query($konek, $input);
    header("location:../../site.php?halamane=".$halamane);
  }

  // Update mesin
  elseif ($halamane=='mesin' AND $act=='update'){
    $id_mesin   = trim(htmlspecialchars($_POST['id_mesin']));
    $nama_mesin = trim(htmlspecialchars($_POST['nama_mesin']));
	$merk_mesin = trim(htmlspecialchars($_POST['merk_mesin']));
    $kapasitas = trim(htmlspecialchars($_POST['kapasitas']));
    $id_divisi = trim(htmlspecialchars($_POST['id_divisi']));
    $tahun_pembuatan = trim(htmlspecialchars($_POST['tahun_pembuatan']));
    $periode_pakai = trim(htmlspecialchars($_POST['periode_pakai']));

     $update = "UPDATE mesin SET nama_mesin = '$nama_mesin',
								 merk_mesin = '$merk_mesin',
								 kapasitas = '$kapasitas',
								 id_divisi = '$id_divisi',
								 tahun_pembuatan = '$tahun_pembuatan',
								 periode_pakai = '$periode_pakai'
                            WHERE id_mesin = '$id_mesin'";
      mysqli_query($konek, $update);
      header("location:../../site.php?halamane=".$halamane);
  }

   // hapus mesin
  elseif ($halamane=='mesin' AND $act=='hapus'){
      mysqli_query($konek, "DELETE FROM mesin WHERE id_mesin='$_GET[id]'"); 
       header("location:../../site.php?halamane=".$halamane);
  }
}
?>

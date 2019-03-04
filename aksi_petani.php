<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<h1>Untuk mengakses halaman, Anda harus login dulu.</h1><p><a href=\"index.php\">LOGIN</a></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  include "../../config/koneksi.php";
  include "../../config/library.php";

  $halamane = $_GET['halamane'];
  $act    = $_GET['act'];

  // Input petani
  if ($halamane=='petani' AND $act=='input'){
    $kode_petani   = trim(htmlspecialchars($_POST['kode_petani']));
    $nama_petani = trim(htmlspecialchars($_POST['nama_petani']));
    $desa_petani  = trim(htmlspecialchars($_POST['desa_petani']));
    $rtrw_petani  = trim(htmlspecialchars($_POST['rtrw_petani']));
	 $status_lahan  = trim(htmlspecialchars($_POST['status_lahan']));
	  $crop  = trim(htmlspecialchars($_POST['crop']));
	$time = date("Y-m-d H:i:s");
    $input = "INSERT INTO tb_petani(id_petani, 
                                kode_petani, 
                                nama_petani,
                                desa_petani, 
								rtrw_petani,
								status_lahan, 
								crop, 
								tahun_tanam,
								musim_panen, 
								raw_product, 
								jumlah_pohon, 
								luas_area, 
								jum_prod_harian, 
								last_kimia, 
								jenis_kimia, 
								audit_date) 
	                       VALUES('NULL', 
                                '$kode_petani', 
                                '$nama_petani',
                                '$desa_petani', 
								'$rtrw_petani',
								'$status_lahan',
								'$crop',
								'',
								'',
								'',
								'',
								'',
								'',
								'',
								'',
								'')";
    mysqli_query($konek, $input);
    header("location:../../site.php?halamane=".$halamane);
  }

  // Update data PO
  elseif ($halamane=='po' AND $act=='update'){
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
}
?>

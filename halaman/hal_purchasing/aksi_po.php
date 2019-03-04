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
  if ($halamane=='input_po'){
    $no_po   = trim(htmlspecialchars($_POST['no_po']));
    $nama_supplier = trim(htmlspecialchars($_POST['nama_supplier']));
    $nama_item  =$_POST['nama_item'];
	$qty  = $_POST['qty'];
	$uom  = $_POST['uom'];
	$number = count($uom);
	$time = date("Y-m-d H:i:s");
	$admin = $_SESSION['auth_code'];
	if($number > 0)
	{
		 $input = "INSERT INTO tb_po(id_po, 
                                no_po, 
                                id_supplier,
                                supplier_name, 
								created_by, 
								create_date, 
								confirm_date, 
								delivery_date, 
								status) 
	                       VALUES(NULL, 
                                '$no_po', 
                                '',
                                '$nama_supplier', 
								'$admin', 
								'$time', 
								'', 
								'', 
								'1')";
    mysqli_query($konek, $input);
		for ($i=0; $i<$number; $i++)
		{
   
	echo "</br>";
 $input_detail = "INSERT INTO tb_detail_po(id_detail_po, 
                                no_po, 
                                item_name,
                                qty, 
								uom, 
								price, 
								status) 
	                       VALUES(NULL, 
                                '$no_po', 
                                '$nama_item[$i]',
                                '$qty[$i]', 
								'$uom[$i]', 
								'',  
								'1')";
    mysqli_query($konek, $input_detail);
	   header("location:../../site.php?halamane=po");
	}
}else
{
	echo "<script>alert('Data Submit : failed!');window.location = 'site.php?halamane=input_po';</script>";
}
 
  }

  // Update user
  elseif ($halamane=='po' AND $act=='update'){
    $no_po   = trim(htmlspecialchars($_POST['no_po']));
    $nama_supplier = trim(htmlspecialchars($_POST['nama_supplier']));
    $nama_item  = trim(htmlspecialchars($_POST['nama_item']));
	$qty  = trim(htmlspecialchars($_POST['qty']));
	$uom  = trim(htmlspecialchars($_POST['uom']));
	$number = count($uom);
	$time = date("Y-m-d H:i:s");
     
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
   elseif ($halamane=='po' AND $act=='clear'){
      mysqli_query($konek, "update tb_po set status = '4' WHERE id_po='$_GET[id]'"); 
       header("location:../../site.php?halamane=".$halamane);
  }
   elseif ($halamane=='po' AND $act=='cancel'){
      mysqli_query($konek, "update tb_po set status = '5' WHERE id_po='$_GET[id]'"); 
       header("location:../../site.php?halamane=".$halamane);
  }
}
?>

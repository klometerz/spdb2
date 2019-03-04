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


  if ($halamane=='input_detail_po'){
   // $no_trans   = trim(htmlspecialchars($_POST['no_trans']));
   // $nama_supplier = trim(htmlspecialchars($_POST['nama_supplier']));
	// $nama_customer = trim(htmlspecialchars($_POST['nama_customer']));
    $nama_item  =$_POST['item_name'];
	$petani  =$_POST['petani'];
	$id_trans  =$_POST['id_trans'];
	//$no_po  =$_POST['no_po'];
	//$tgl_trans  =$_POST['tgl_trans'];
	$qty  = $_POST['item_quantity'];
	$uom  = $_POST['uom'];
	$number = count($uom);
	//$time = date("Y-m-d H:i:s");
	//$admin = $_SESSION['auth_code'];
	// $id_po =  $_GET['id'];
													// picking sequent num for displaying data ascendingly
						 //   $sql_trans  = "SELECT count(id_trans) as sum FROM `tb_trans` where no_trans='$no_trans'";
							//$tampil_trans = mysqli_query($konek, $sql_trans);
							//$data_trans = mysqli_fetch_array($tampil_trans);
							//$no_urut = $data_trans['sum'] + 1;
							
	if($number > 0)
	{
		// $input = "INSERT INTO tb_trans(id_trans, 
                               // no_trans, 
                              //  tgl_trans,
                              //supplier, 
								//no_po, 
								//no_urut, 
								//status) 
	                      // VALUES(NULL,  
                               // '$no_trans',
                               // '$tgl_trans', 
								//'$nama_customer', 
								//'$nama_supplier', 
								//'$no_po', 
								//'$id_trans',
								//'0')";
   // mysqli_query($konek, $input);
		for ($i=0; $i<$number; $i++)
		{
	// picking id_trans as an only id on the table
  // $sql_status  = "SELECT * FROM `tb_trans` where status='0'";
	//$tampil_status = mysqli_query($konek, $sql_status);
	//$data_status = mysqli_fetch_array($tampil_status);
	//$id_trans_baru= $data_status['id_trans'];
	
 $input_detail = "INSERT INTO tb_detail_trans(id_detail_trans, 
                                id_trans, 
                                nama_item,
                                uom, 
								qty, 
								kode_produksi,
								kode_petani) 
	                       VALUES(NULL, 
                                '$id_trans', 
                                '$nama_item[$i]',
                                '$uom[$i]', 
								'$qty[$i]', 
								'', 
								'$petani[$i]')";
    mysqli_query($konek, $input_detail);
	}
	// $sql_status  = "update `tb_trans` set status = '1' where id_trans='$id_trans_baru'";
	//$tampil_status = mysqli_query($konek, $sql_status);
	echo "<script>alert('Data Submit : SUCCESS!');window.location = '../../site.php?halamane=po';</script>";
	  // header("location:../../site.php?halamane=po");
}else
{
	echo "<script>alert('Data Submit : failed!');window.location = 'site.php?halamane=input_po';</script>";
}
 
  }

  // Update user
  elseif ($halamane=='edit_detail_po' AND $act=='edit'){
   // $no_po   = trim(htmlspecialchars($_POST['no_po']));
    $id_detail_trans = trim(htmlspecialchars($_POST['id_detail_trans']));
    $nama_item  = trim(htmlspecialchars($_POST['nama_item']));
	$qty  = trim(htmlspecialchars($_POST['qty']));
	$uom  = trim(htmlspecialchars($_POST['uom']));
	$petani  = trim(htmlspecialchars($_POST['kode_petani']));
	$number = count($uom);
	$time = date("Y-m-d H:i:s");
	$id_po=$_GET['id_po'];
     
      $update = "UPDATE tb_detail_trans SET nama_item = '$nama_item',
                                  qty = '$qty',
                                 uom = '$uom',
                                     kode_petani = '$petani'
                             WHERE id_detail_trans = '$id_detail_trans'";
      mysqli_query($konek, $update);
      header("location:../../site.php?halamane=po_detail&id=$id_po");
  }
  
   elseif ($halamane=='edit_po' AND $act=='edit'){
   // $no_po   = trim(htmlspecialchars($_POST['no_po']));
    $id_detail_po = trim(htmlspecialchars($_POST['id_detail_po']));
    $nama_item  = trim(htmlspecialchars($_POST['nama_item']));
	$qty  = trim(htmlspecialchars($_POST['qty']));
	$uom  = trim(htmlspecialchars($_POST['uom']));
	$code  = trim(htmlspecialchars($_POST['code']));
	$number = count($uom);
	$time = date("Y-m-d H:i:s");
	$id_po=$_GET['id_po'];
     
      $update = "UPDATE tb_detail_po SET nama_item = '$nama_item',
                                  qty = '$qty',
                                 uom = '$uom',
                                     kode_produksi = '$code'
                             WHERE id_detail_po = '$id_detail_po'";
      mysqli_query($konek, $update);
      header("location:../../site.php?halamane=po_detail&id=$id_po");
  }

  elseif ($halamane=='user' AND $act=='hapus'){
      mysqli_query($konek, "DELETE FROM user WHERE id_user='$_GET[id]'"); 
       header("location:../../site.php?halamane=".$halamane);
  }
}
?>

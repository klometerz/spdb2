 <?php  
 error_reporting(0);
include "../../config/koneksi.php";
date_default_timezone_set('Asia/Jakarta');
 $id_trx_petani_detail=$_POST['id_trx_petani_detail'];
$uniqid_trx=$_POST['uniqid_trx'];

$id_trx=$_POST['id_trx'];
$id_trx_p2=$_POST['id_trx_p2'];
$number = count($id_trx_petani_detail);  
$date = date("Y/m/d");
$time = date("H:i:s");		
 if($number > 0)  
 {  
      for($i=0; $i<$number; $i++)  
      {  
                $sql = "update tb_trx_p_petani_detail set id_trx = '$id_trx_p2' where id_trx_detail='$id_trx_petani_detail[$i]'";  
                mysqli_query($konek, $sql); 

      }  
				$sql1 = "update tb_trx_p_petani set status = '3' where id_trx='$id_trx'";  				
					mysqli_query($konek, $sql1);
				$sql2 = "INSERT INTO tb_trx_log (id_log_trx, id_trx_pembeli, id_trx_penjual, tgl_trx, id_trx, jenis_trx) values (NULL, '$id_trx_p2', '$id_trx', '$date', '$uniqid_trx', 'CPU')";  				
				    mysqli_query($konek, $sql2);
	
	  echo "Success";
header("location:site.php?halamane=trx_p2&id=$id_trx_p2");	  
 }  
 else  
 {  
      echo "failed";  
 }  
 ?> 
   
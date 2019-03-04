<?php
session_start();
  include "../../config/koneksi.php";
  include "../../config/library.php";

// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<h1>Untuk mengakses halaman, Anda harus login dulu.</h1><p><a href=\"index.php\">LOGIN</a></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{

?>
<html>
<head>
<title> :: Report by Purchase Order Number - Traceability</title>
<link href="styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<body>
<h2> Report by Purchase Order Number - Traceability</h2></br>
<h2> PT. Haldin Pacific Semesta</h2>
<text>No. Purchase Order : <?php echo $_POST['no_po']; ?></text>
<?php 
			$query1  = "SELECT * FROM tb_po where no_po = '$_POST[no_po]' ";
            $tampil1 = mysqli_query($konek, $query1);
          $r1=mysqli_fetch_array($tampil1);
		  
		  $query4  = "SELECT * FROM tb_trans where no_po = '$_POST[no_po]' and no_urut='' ";
            $tampil4 = mysqli_query($konek, $query4);
          $r4=mysqli_fetch_array($tampil4);
		  
		   $query5  = "SELECT SUM(pengepul) as total FROM tb_trx_p_petani where uniqid_trx = '$_POST[no_po]'";
            $tampil5 = mysqli_query($konek, $query5);
          $r5=mysqli_fetch_array($tampil5);
		  
		  $query3  = "select * from tb_detail_po where no_po='$_POST[no_po]'";
            $tampil3 = mysqli_query($konek, $query3);
          $r3=mysqli_fetch_array($tampil3);
		  
		  $query2  = "SELECT * FROM tb_petani where kode_petani = '$r1[supplier_name]' ";
            $tampil2 = mysqli_query($konek, $query2);
          $r2=mysqli_fetch_array($tampil2);
		  
		   $query_total_petani  = "select 
tb_trx_p_petani.id_trx, 
tb_trx_p_petani.tgl_trx, 
tb_trx_p_petani.pengepul, 
tb_trx_p_petani.time_create, 
tb_trx_p_petani.raw_material, 
tb_trx_p_petani_detail.petani, 
tb_trx_p_petani_detail.petani,
tb_trx_p_petani_detail.total_qty, 
tb_trx_p_petani_detail.total_bag, 
sum(tb_trx_p_petani_detail.total_qty) as total, 
sum(tb_trx_p_petani_detail.total_bag) as total_bag
from tb_trx_p_petani inner join
tb_trx_p_petani_detail on tb_trx_p_petani.id_trx=tb_trx_p_petani_detail.id_trx
where tb_trx_p_petani.uniqid_trx = '$_POST[no_po]' order by tb_trx_p_petani.id_trx";
							$tampil_total_petani = mysqli_query($konek, $query_total_petani);
							$total_petani=mysqli_fetch_array($tampil_total_petani);	
?>
</br><text>Vendor 			: <?php echo $r2['nama_petani']; ?></text>
<!--</br><text>No. Delivery Order 			: <?php //echo $r4['no_trans']; ?></text>-->
</br><text>PO Qty: <?php echo $r3['qty']; ?> KG</text>
</br><text>Qty Kirim			: <?php echo $r5['total']; ?> KG</text>
</br><text>Susut Produksi			: <?php echo $total_petani['total'] - $r5['total']; ?> KG</text>
<?php
 $query  = "select 
tb_trx_p_petani.id_trx, 
tb_trx_p_petani.tgl_trx, 
tb_trx_p_petani.pengepul, 
tb_trx_p_petani.time_create, 
tb_trx_p_petani.raw_material, 
tb_trx_p_petani_detail.petani, 
tb_trx_p_petani_detail.petani,
tb_trx_p_petani_detail.total_qty, 
tb_trx_p_petani_detail.uniqid_trx, 
tb_trx_p_petani_detail.total_bag 
from tb_trx_p_petani inner join
tb_trx_p_petani_detail on tb_trx_p_petani.id_trx=tb_trx_p_petani_detail.id_trx
where tb_trx_p_petani.uniqid_trx = '$_POST[no_po]'";
        $tampil = mysqli_query($konek, $query);

echo"<table class='table-list' width='100%' border='0' cellspacing='1' cellpadding='2'>
                        <thead>
                          <tr>
                            <td bgcolor='#F5F5F5'>No</td>
                            
                            <td bgcolor='#F5F5F5'>No. Batch</td>
							
							<td bgcolor='#F5F5F5'>Pengepul</td>
                            <td bgcolor='#F5F5F5'>Nama Petani</td>
							
							<td bgcolor='#F5F5F5'>Kode Petani</td>
                            <td bgcolor='#F5F5F5'>Desa Petani</td>
                           
                            
                            <td bgcolor='#F5F5F5'>Raw Material</td>
							<td bgcolor='#F5F5F5'>Tgl Setor PK</td>
							<td bgcolor='#F5F5F5'>Qty</td>
							<td bgcolor='#F5F5F5'>Bag</td>
							
                          </tr>
                        </thead>
                        <tbody>"; 
            
      $no = 1;
      while ($r=mysqli_fetch_array($tampil)){
							// query log
							$query_log  = "select * from tb_trx_log where id_trx_pembeli ='$r[id_trx]'";
							$tampil_log = mysqli_query($konek, $query_log);
							$log=mysqli_fetch_array($tampil_log);	
							//query pengepul
							$query_peng  = "select * from tb_trx_p_petani where id_trx ='$log[id_trx_penjual]'";
							$tampil_peng = mysqli_query($konek, $query_peng);
							$peng=mysqli_fetch_array($tampil_peng);
							//query petani
							$query_petani  = "select * from tb_petani where kode_petani ='$r[petani]'";
							$tampil_petani = mysqli_query($konek, $query_petani);
							$petani=mysqli_fetch_array($tampil_petani);
							//query pengepul
							$query_pengepul  = "select * from tb_petani where kode_petani ='$peng[pengepul]'";
							$tampil_pengepul = mysqli_query($konek, $query_pengepul);
							$pengepul=mysqli_fetch_array($tampil_pengepul);
							//query crop
							$query_crop  = "select * from tb_crop where kode_crop ='$r[raw_material]'";
							$tampil_crop= mysqli_query($konek, $query_crop);
							$crop=mysqli_fetch_array($tampil_crop);
							
								$query_trx_p  = "select * from tb_trx_p_petani where id_trx ='$r[uniqid_trx]'";
							$tampil_trx_p = mysqli_query($konek, $query_trx_p);
							$trx_p=mysqli_fetch_array($tampil_trx_p);	
							
        echo "
                          <tr>
                            <td class='center'>$no</td>
                           
                            <td>$r[tgl_trx] - $peng[pengepul]</td>
							
							 <td>$pengepul[nama_petani]</td>
                            <td>$petani[nama_petani]</td>
							
							 <td>$r[petani]</td>
                            <td>$petani[desa_petani]</td>
                            
                           
                            <td>$crop[nama_crop]</td>
							 <td>$trx_p[tgl_trx]</td>
							  <td>$r[total_qty]</td>
							    <td>$r[total_bag]</td>
								 
                            
                          </tr>";
                          $no++;
						  
                         }
						
                          echo "
						  <tr>
						  
						  <td>
						  </td>
						  
						  <td>
						  </td>
						  
						  <td>
						  </td>
						  
						  <td>
						  </td>
						  
						  <td>
						  </td>
						  
						  <td>
						  </td>
						  
						  <td><b>TOTAL</b>
						  </td>
						  
						  <td><b>
						  $total_petani[total] KG
						</b>  </td>
						  
						  <td><b>
						   $total_petani[total_bag] Bag
						 </b> </td>
						  </tr>
						  
						  </tbody>
                      </table>";
?>
<img src="btn_print.png" width="20" onClick="javascript:window.print()" /></br>
</br>
</br>
<form target="_blank" action="export.php" method="post" name="export"> 
<input type="hidden" name="no_po" value="<?php echo $_POST['no_po'];?>" />
<input type="submit" name="post" value="export Excel" class="btn btn-sm btn-info"/>
</form>
</body>
</html>
<?php
  

}
?>
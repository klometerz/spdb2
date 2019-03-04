<?php
// Apabila user belum login
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
  echo "<h1>Untuk mengakses halaman, Anda harus login dulu.</h1><p><a href=\"index.php\">LOGIN</a></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  $aksi = "halaman/hal_petani/aksi_petani.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : ''; ?>

  
  <?php 
  date_default_timezone_set('Asia/Jakarta');
// $id_trans = $_POST['id_trans'];
$date = date("m/d/Y");
$time = date("H:i:s");
$tgl_trx=$_POST['tanggal'];
$raw_material=$_POST['rm'];
$pengepul=$_POST['pengepul'];
$uniqid=$_POST['uniqid'];
  $input = "INSERT INTO tb_trx_p_petani(id_trx, 
                                tgl_trx, 
                                raw_material,
                                pengepul, 
								date_create, 
								time_create, 
								uniqid_trx, 
								status) 
	                       VALUES(NULL, 
                                '$tgl_trx', 
                                '$raw_material',
                                '$pengepul', 
								'$date', 
								'$time', 
								'$uniqid', 
								'2')";
  mysqli_query($konek, $input);
 
								$query_sup  = "select * from tb_trx_p_petani where uniqid_trx ='$uniqid'";
							$tampil_sup = mysqli_query($konek, $query_sup);
							 $sup=mysqli_fetch_array($tampil_sup);
							  $query_petani  = "select * from tb_petani where kode_petani ='$pengepul'";
							$tampil_petani = mysqli_query($konek, $query_petani);
							 $petani=mysqli_fetch_array($tampil_petani);
							 	// data jenis raw material
							$query_crop  = "select * from tb_crop where kode_crop ='$raw_material'";
							$tampil_crop = mysqli_query($konek, $query_crop);
							 $crop=mysqli_fetch_array($tampil_crop);
  ?>	
  <div class='row'>
    <div class='col-xs-12'>         
		<div class='table-header'>
                  Transaksi Pembelian - <?php echo $crop['nama_crop']; ?> oleh :  
                    </div>
                <div>
  <div class="table-responsive">
  <table id='dynamic-table12' class='table table-striped table-bordered table-hover'>
  <thead>
 <tr> <th>Tanggal</th>
  <th>ID</th>
  <th>Raw Material</th>
  <th>Unique ID</th>
  <th>Pengepul</th>
  <th>Desa</th>
  </tr>
  </thead>
  <tbody><tr>
  <td><?php echo $_POST['tanggal']; ?></td>
  <td><?php echo $sup['id_trx']; ?></td>
  <td><?php echo $crop['nama_crop']; ?></td>
  <td><?php echo $_POST['uniqid']; ?></td>
  <td><?php echo $petani['nama_petani']; ?></td>
    <td><?php echo $petani['desa_petani']; ?></td>
  </tr>
  </tbody>
  </table>
 
                            
                          </div>
                        </div>
                      </div>
					  </div>
                    <!-- /.span -->
    
	
  
  
  
   <br />
  
<div class='row'>
                 
     <div class='col-xs-12'>
	   <div class='clearfix'>
         <div class='pull-right tableTools-container'></div>
   
   <div class='table-header'>
                   Data Stok Pengepul :  - <?php echo $crop['nama_crop']; ?> 
                    </div>
                <div>
  <div class="table-responsive">
    <table id="dynamic-table2" class='table table-striped table-bordered table-hover'>
	
     <thead>
      <tr>
      <th >No</th>
                            <th>Tanggal Transaksi</th>
							<th>Pengumpul</th>
							<th>Raw Material</th>
							
						
                            
                            <th class='hidden-480'>Status</th>
      </tr>
	       </thead>
		   <tbody>
	  <?php 
	  $is = 1;
							$query_sup1  = "select * from tb_trx_p_petani where raw_material ='$_POST[rm]' and status <= '2' and pengepul != '$pengepul'";
							$tampil_sup1 = mysqli_query($konek, $query_sup1);
						while ($sup1=mysqli_fetch_array($tampil_sup1))
						{
							$query_petani  = "select * from tb_petani where kode_petani ='$sup1[pengepul]'";
							$tampil_petani = mysqli_query($konek, $query_petani);
							 $petani=mysqli_fetch_array($tampil_petani);
							  $query_crp  = "select * from tb_crop where kode_crop ='$sup1[raw_material]'";
							$tampil_crp = mysqli_query($konek, $query_crp);
							 $crp=mysqli_fetch_array($tampil_crp);
	  ?>
	  <tr>
	  <td><?php echo $is; ?></td>
	 <td style="cursor:pointer;color:#0014B1;font-weight:bold;" title="klik untuk detail stok kirim" onClick="dspl2('<?php echo $sup1['id_trx']; ?>','<?php echo $sup['id_trx']; ?>')"><?php echo $sup1['tgl_trx']; ?></td>
	 <td><?php echo $petani['nama_petani']; ?></td>
	  <td><?php echo $crp['nama_crop']; ?></td>
	  	  
	  
	  <td><?php echo $sup1['status']; ?></td>
	  
	 
						
	  </tr>
<?php 
						$is++;
						}?>  
	</tbody>
    </table>
	</div>
   </div>
   </div>
   </div>
   </div>

   <br />
     <span id="cat"></span>
            <span id="cat2"></span>  
<?php }    
?>
<script type="text/javascript" language="javascript">
function dspl2(vkode,vakses)
		{
			var data={ id_trx:vkode, uniqid_trx_p2:vakses };
			var fungsi=function(respon){
				$("#cat").html(respon);
			};	
			$("#cat").html('<img src="assets/images/103.gif"/>');
			$("#cat2").html('');
			$.get('halaman/hal_pengepul/detail_pengepul.php',data,fungsi);
		}
</script>
 

 
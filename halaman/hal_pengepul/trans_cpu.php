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
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
 
  <?php 
  date_default_timezone_set('Asia/Jakarta');
// $id_trans = $_POST['id_trans'];
$date = date("m/d/Y");
$time = date("H:i:s");
$tgl_trx=$_POST['tanggal'];
$raw_material=$_POST['rm'];
$qty=$_POST['qty'];
$remarks=$_POST['remarks'];
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
                                '$qty', 
								'$date', 
								'$remarks', 
								'$uniqid', 
								'4')";
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
                      <div class='widget-box'>
                        <div class='widget-header'>
                          <h4 class='widget-title'>Transaksi Pembelian - <?php echo $crop['nama_crop']; ?> oleh :  </h4>

                          <div class='widget-toolbar'>
                            <a href='#' data-action='collapse'>
                              <i class='ace-icon fa fa-chevron-up'></i>
                            </a>
                          </div>
                        </div>

                        <div class='widget-body'>
                          <div class='widget-main'>
                          
  <div class="container1">
  <div class="table-responsive">
  <table id='dynamic-table12' class='table table-striped table-bordered table-hover'>
 <thead><tr> <th>Tanggal</th>
  <th>ID</th>
  <th>Raw Material</th>
  <th>Unique ID</th>
 
  </tr>
  </thead>
  <tbody>
  <tr>
  <td><?php echo $_POST['tanggal']; ?></td>
  <td><?php echo $sup['id_trx']; ?></td>
  <td><?php echo $crop['nama_crop']; ?></td>
  <td><?php echo $_POST['uniqid']; ?></td>
 
	
  </tr>
  </tbody>
  </table>
 <?php 
 
 ?>
 <?php 

 ?>
                             <!-- <label>Tanggal</label>
                              <input required="required" type="text" name="tanggal" class='date-picker form-control'  placeholder='' readonly value='<?php echo $_POST['tanggal']; ?>' >
									
                            <hr />

                             <input name="id_trans" value="1" type="hidden"/>
                              <label>Raw Material</label>
                              <input readonly required="required" type="text" name="rm" class='form-control' id="date-picker" placeholder=''  value='<?php echo $_POST['rm']; ?>' >
								
                            <hr /> 
							 <label>Unique ID</label>
                              <input readonly required="required" type="text" name="rm" class='form-control' id="date-picker" placeholder=''  value='<?php echo $_POST['uniqid']; ?>' >
								
                            <hr /> 
							
                              <label>Pengepul</label>
                              <input readonly required="required" list="supplier" type="text" name="pengepul" class='form-control' placeholder='' value="<?php echo $_POST['pengepul']; ?>" >
							    
                    
                            <hr />-->
					
                        
                            

                 

                            
                          </div>
                        </div>
                      </div>
                    </div><!-- /.span -->
    </div>
	</div>
	</div>
  
  
   <br />
  
<div class='row'>
                 
     <div class='col-xs-12'>
	  
     <div class='widget-box'>
                        <div class='widget-header'>
                          <h4 class='widget-title'>Data Stok Pengepul :  - <?php echo $crop['nama_crop']; ?> </h4>

                          <div class='widget-toolbar'>
                            <a href='#' data-action='collapse'>
                              <i class='ace-icon fa fa-chevron-up'></i>
                            </a>
                          </div>
                        </div>

                        <div class='widget-body'>
                          <div class='widget-main'>

	 <div class="container1">
  <div class="table-responsive">
    <table id="dynamic-table2" class="table table-bordered table-stripe">
	
     <thead>
      <tr>
      <th class='center'>No</th>
                            <th>Tanggal Transaksi</th>
							<th>Pengumpul</th>
							<th>Raw Material</th>
							
						
                            
                            <th class='hidden-480'>Status</th>
      </tr>
	       </thead>
		   <tbody>
	  <?php 
	  $is = 1;
							$query_sup1  = "select * from tb_trx_p_petani where raw_material ='$_POST[rm]' and status <= '2' and pengepul like '%PB%'";
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
	  
	 
						<?php 
						$is++;
						}?>  
	  </tr>

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
			$.get('halaman/hal_pengepul/detail_cpu.php',data,fungsi);
		}
</script>
 

 
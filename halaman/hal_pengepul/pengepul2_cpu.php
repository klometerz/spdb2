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
  <style>
  body
  {
   margin:0;
   padding:0;
   background-color:#f1f1f1;
  }
  .box
  {
   width:1270px;
   padding:20px;
   background-color:#fff;
   border:1px solid #ccc;
   border-radius:5px;
   margin-top:25px;
   box-sizing:border-box;
  }
  </style>
  <?php 
  $id_trans=$_GET['id'];
  // data trx petani
$query_sup  = "select * from tb_trx_p_petani where id_trx ='$id_trans'";
							$tampil_sup = mysqli_query($konek, $query_sup);
							 $sup=mysqli_fetch_array($tampil_sup);
							 
							 
							    $query_log  = "select * from tb_trx_log where id_trx_pembeli ='$id_trans'";
							$tampil_log = mysqli_query($konek, $query_log);
							$log=mysqli_fetch_array($tampil_log);
							 
							  $query_peng  = "select * from tb_trx_p_petani where id_trx ='$log[id_trx_penjual]'";
							$tampil_peng = mysqli_query($konek, $query_peng);
							 $peng=mysqli_fetch_array($tampil_peng);
  // data profile petani
  $query_petani  = "select * from tb_petani where kode_petani ='$peng[pengepul]'";
							$tampil_petani = mysqli_query($konek, $query_petani);
							 $petani=mysqli_fetch_array($tampil_petani);
							 
			// data jenis raw material
			 $query_crop  = "select * from tb_crop where kode_crop ='$sup[raw_material]'";
							$tampil_crop = mysqli_query($konek, $query_crop);
							 $crop=mysqli_fetch_array($tampil_crop);
							 
							 $sql_total = "select sum(total_qty) as total, sum(total_bag) as total_bag from tb_trx_p_petani_detail where id_trx='$id_trans'";
							$query_total = mysqli_query($konek, $sql_total);
							 $total=mysqli_fetch_array($query_total);
							 
  ?>	
  
  <div class='row'>
    <div class='col-xs-12'>
                      <div class='widget-box'>
                        <div class='widget-header'>
                          <h4 class='widget-title'>Hasil Produksi <?php echo $crop['nama_crop']; ?> oleh CPU  </h4>

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
  <table id='dynamic-table2' class='table table-striped table-bordered table-hover'>
 <tr> <th>No. Batch</th>
  <th>Raw Material</th>
  <th>Unique ID</th>
  <th>Qty (KG)</th>
   <th>Penyusutan (KG)</th>
  <th>Keterangan</th>
  </tr>
  <tr>
 <td><?php echo $sup['tgl_trx']; ?> - <?php echo $peng['pengepul']; ?></td>
  <td><?php echo $crop['nama_crop']; ?></td>
  <td><?php echo $sup['uniqid_trx']; ?></td>
  <td><?php echo $sup['pengepul']; ?></td>
  <td><?php echo $total['total'] - $sup['pengepul']; ?></td>
    <td><?php echo $sup['time_create']; ?></td>
  </tr>
  </table>
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
  
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
			
                 Data Stok Pengepul : <font color="#FF0004"><?php echo $petani['nama_petani']; echo " - "; echo $petani['desa_petani']; ?></font><br /> Kode : <font color="#FF0004"><?php echo substr($petani['kode_petani'], 0, 2); echo"-";  echo $peng['tgl_trx'];?></font>
				 <br /> Tanggal : <font color="#FF0004"><?php echo $peng['tgl_trx']; ?></font>
				 
            </div>
            <div class="panel-body">
			
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
							<th size="5%">No</th>
                                <th size="50%">Nama Petani</th>
       <th size="45%">Total Qty</th>
	    <th size="45%">Total Kantong</th>
		<th size="45%">Desa Petani</th>
       
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $sqluser2 = "select * from tb_trx_p_petani_detail where id_trx='$id_trans'";
                            $stmt2 = mysqli_query($konek, $sqluser2);
                            $i2 = 1;
							//echo $sqluser2; echo $sqluser2; 
							$total1 = 0;
							$total2 = 0;
                            while( $row2 = mysqli_fetch_array( $stmt2))
                            {
								 // data profile petani
							$query_petani  = "select * from tb_petani where kode_petani ='$row2[petani]'";
							$tampil_petani = mysqli_query($konek, $query_petani);
							 $petani=mysqli_fetch_array($tampil_petani);
							 
							 $query_trx_p2  = "select * from tb_trx_p_pengepul where uniqid_trx_p2 ='$uniqid_trx_p2'";
							$tampil_trx_p2 = mysqli_query($konek, $query_trx_p2);
							 $trx_p2=mysqli_fetch_array($tampil_trx_p2);
								echo $trx_p2['id_trx_p2'];
                            ?>
							
                            <tr class="odd gradeX">
                            	<td><?php echo $i2; ?></td>
                                <td ><?php echo $petani['nama_petani']; ?></td>
                                <td align="left"><?php echo $row2['total_qty']; ?> KG</td>
                                <td align="left"><?php echo $row2['total_bag']; ?></td>
                               <td align="left">  
							   <?php echo $petani['desa_petani']; ?>
                                <input type="hidden" name="id_trx_p2" value="<?php echo $trx_p2['id_trx_p2']; ?>">
								<input type="hidden" name="id_trx" value="<?php echo $id_trx; ?>">
								</td>
                            </tr>
							
                            <?php $i2++; } 
							
							?>
							
							<tr>
						
                            <td></td>
							<td><b>TOTAL</b></td>
							<td align="center"><b><?php 
							
							 echo $total['total']; 
							?> KG</b></td>
							<td align="center"><b><?php  echo $total['total_bag']; ?></b></td>
							<td></td>
							</tr>
								
                        </tbody>
                    </table>
					
								<!--<a target="_blank"  rel="noopener noreferrer" href="" class="btn btn-info">Submit</a>-->
								
                </div>
            </div>
        </div>
        <!--End Advanced Tables -->
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
			var data={ kd:vkode, prm:vakses };
			var fungsi=function(respon){
				$("#cat").html(respon);
			};	
			$("#cat").html('<img src="assets/images/103.gif"/>');
			$("#cat2").html('');
			$.get('halaman/hal_pengepul/detail_pengepul.php',data,fungsi);
		}
</script>
 
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
  date_default_timezone_set('Asia/Jakarta');
  $id_po=$_GET['id'];
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
  //mysqli_query($konek, $input);
  
							$query_po  = "select * from tb_po where id_po ='$id_po'";
							$tampil_po = mysqli_query($konek, $query_po);
							 $po=mysqli_fetch_array($tampil_po);
							 
							 $query_supplier  = "select * from tb_petani where kode_petani ='$po[supplier_name]'";
							$tampil_supplier = mysqli_query($konek, $query_supplier);
							 $supplier=mysqli_fetch_array($tampil_supplier);
							 
							  $query_detail_po  = "select * from tb_detail_po where no_po ='$po[no_po]'";
							$tampil_detail_po = mysqli_query($konek, $query_detail_po);
							 $detail_po=mysqli_fetch_array($tampil_detail_po);
 
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
                          <h4 class='widget-title'>Purchase Order No. - <?php echo $po['no_po']; ?> </br>Supplier : 
							<?php echo $po['supplier_name']; echo " - "; echo $supplier['nama_petani']; ?>
						  </h4>

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
  <table id='dynamic-table1' class='table table-striped table-bordered table-hover'>
 <tr> 
 <th>No. Purchase Order</th>
 <th>Tanggal</th>
  <th>Raw Material</th>
  <th>Qty (KG)</th>
 
  </tr>
  <tr>
  
<td><?php echo $po['no_po']; ?></td>
<td><?php echo $po['create_date']; ?></td>
  <td><?php echo $detail_po['item_name']; ?></td>
  <td><?php echo $detail_po['qty']; ?></td>
 
	
  </tr>
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
	  
     <form width="550" height="170" target="_blank" rel="noopener noreferrer" action="site.php?halamane=trx_detail_stok_cpu&kd=<?php echo $_GET['id_trx']; ?>&prm=<?php echo $_GET['uniqid_trx_p2']; ?>" method="POST">
							
							
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
           
            <div class="panel-body">
			
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
							<th size="5%">No</th>
							 <th size="50%">No. Batch</th>
                                <th size="50%">Raw Material</th>
								
       <th size="45%">Total Qty</th>
	   <th size="45%">Penyusutan</th>
	    <th size="45%">Remarks</th>
		<th size="45%">Assign</th>
       
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $sqluser2 = "select * from tb_trx_p_petani where status='4'";
                            $stmt2 = mysqli_query($konek, $sqluser2);
                            $i2 = 1;
							//echo $sqluser2; echo $sqluser2; 
							$total1 = 0;
							$total2 = 0;
                            while( $row2 = mysqli_fetch_array( $stmt2))
                            {
								 // data profile petani
							//$query_petani  = "select * from tb_petani where kode_petani ='$row2[petani]'";
							//$tampil_petani = mysqli_query($konek, $query_petani);
							// $petani=mysqli_fetch_array($tampil_petani);
							 $query_crp  = "select * from tb_crop where kode_crop ='$row2[raw_material]'";
							$tampil_crp = mysqli_query($konek, $query_crp);
							 $crp=mysqli_fetch_array($tampil_crp);
							// $query_trx_p2  = "select * from tb_trx_p_pengepul where uniqid_trx_p2 ='$uniqid_trx_p2'";
							//$tampil_trx_p2 = mysqli_query($konek, $query_trx_p2);
							// $trx_p2=mysqli_fetch_array($tampil_trx_p2);
								//echo $trx_p2['id_trx_p2'];
								
								   $query_log  = "select * from tb_trx_log where id_trx_pembeli ='$row2[id_trx]'";
							$tampil_log = mysqli_query($konek, $query_log);
							$log=mysqli_fetch_array($tampil_log);
							
							  $query_po2  = "select * from tb_po where id_po ='$_GET[id]'";
							$tampil_po2 = mysqli_query($konek, $query_po2);
							$po2=mysqli_fetch_array($tampil_po2);
							 
							  $query_peng  = "select * from tb_trx_p_petani where id_trx ='$log[id_trx_penjual]'";
							$tampil_peng = mysqli_query($konek, $query_peng);
							 $peng=mysqli_fetch_array($tampil_peng);
							  $sql_total = "select sum(total_qty) as total, sum(total_bag) as total_bag from tb_trx_p_petani_detail where id_trx='$row2[id_trx]'";
							$query_total = mysqli_query($konek, $sql_total);
							 $total=mysqli_fetch_array($query_total);
                            ?>
							
                            <tr class="odd gradeX">
                            	<td><?php echo $i2; ?></td>
								  <td align="left"><?php echo $row2['tgl_trx']; ?>-<?php echo $peng['pengepul']; ?></td>
                                <td ><?php echo $crp['nama_crop']; ?></td>
                                <td align="left"><?php echo $row2['pengepul']; ?></td>
								 <td><?php echo $total['total'] - $row2['pengepul']; ?></td>
                                <td align="left"><?php echo $row2['time_create']; ?></td>
                               <td align="center">  <input checked type="checkbox" name="id_trx_petani_detail[]" value="<?php echo $row2['id_trx']; ?>"/>
                                
								
								<input type="hidden" name="no_po" value="<?php echo $po2['no_po']; ?>">
								</td>
                            </tr>
							
                            <?php $i2++; } 
							
							?>
							
							
								
                        </tbody>
                    </table>
					<input type="submit" value="submit" name="ok"/>
								<!--<a target="_blank"  rel="noopener noreferrer" href="" class="btn btn-info">Submit</a>-->
								
                </div>
            </div>
        </div>
        <!--End Advanced Tables -->
    </div>
</div>
</form>
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
			$.get('halaman/hal_purchasing/detail_stok_cpu.php',data,fungsi);
		}
</script>
 

 
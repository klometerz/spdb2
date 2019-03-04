<?php
//error_reporting(0);
 ?>

<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
    background-color: default;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
</style>
</head><?php
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<h1>Untuk mengakses halaman, Anda harus login dulu.</h1><p><a href=\"index.php\">LOGIN</a></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{

?>

               <div class="row">
              <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                 <div class="row">
				

                 



<!DOCTYPE html>
<html>
<head>

<body>
<?php 
$id_po_baru=$_GET['id'];
//echo $id_po_baru;
$sql_po="select * from tb_po where id_po='$id_po_baru'";
$query_po=mysqli_query($konek, $sql_po);
$no_purch=mysqli_fetch_array($query_po);
  echo"
                  
                    <div class='clearfix'>
                      <div class='pull-right tableTools-container'></div>";
					  
					  if($_SESSION['level'] == '1')
					  {
						  
							  echo "
                      
                        
                      <button class='btn btn-white btn-info btn-bold' onclick=window.location.href=\"?halamane=trans_po&id=".$_GET['id']."\"><i class='ace-icon glyphicon glyphicon-plus'></i>Input Data Traceability
                        </button>";
					  }
						else {
							$sql_trans  = "SELECT count(id_trans) as sum FROM `tb_trans` where no_po='$no_po'";
													$tampil_trans = mysqli_query($konek, $sql_trans);
													$data_trans = mysqli_fetch_array($tampil_trans);
							if ($data_trans==0)
							{
							  echo "
                      
                        
                      <button class='btn btn-white btn-info btn-bold' onclick=window.location.href=\"?halamane=trans_po&id=".$_GET['id']."\"><i class='ace-icon glyphicon glyphicon-plus'></i>Input Data Traceability
                        </button>";
							}
							else{}
						}
						
						echo "</div>
                    <br/>
                    <div class='table-header'>
                    No Purchase Order :   $no_purch[no_po] --- Created date : $no_purch[create_date]
                    </div>
                    <div>";

        if ($_SESSION['level']=='1'){
        $query  = "select * from tb_detail_po where no_po = '$no_purch[no_po]'";
        $tampil = mysqli_query($konek, $query);
      } else{
        $query  = "SELECT * FROM tb_detail_po WHERE no_po='$no_purch[no_po]'";
        $tampil = mysqli_query($konek, $query);
      }

                      echo"<table id='dynamic-table1' class='table table-striped table-bordered table-hover'>
                        <thead>
                          <tr>
                            <th class='center'>No</th>
                            <th>No PO</th>
							<th>Item Name</th>
                            <th>UOM</th>
                            <th class='hidden-480'>Qty</th>
                            <th class='hidden-480'>Status</th>
                            
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>"; 
            
      $no = 1;
      while ($r=mysqli_fetch_array($tampil)){
        echo "
                          <tr>
                            <td class='center'>$no</td>
                            <td> $r[no_po]</td>
							 <td>$r[item_name]</td>
                            <td>$r[uom]</td>
                            <td class='hidden-480'>$r[qty]</td>
                            <td class='hidden-480'>
							"; if($r['status'] == '1')
							{
								echo '<i color="blue">Open</i>';
							}
							elseif ($r['status'] == '2')
							{
								echo '<i color="yellow">Confirmed</i>';
							}
							elseif ($r['status'] == '3')
							{
								echo '<i color="green">Delivery</i>';
							}
							elseif ($r['status'] == '4')
							{
								echo '<i color="gray">Closed</i>';
							}
							elseif ($r['status'] == '5')
							
							{
								echo '<i color="red">Cancel</i>';
							}
						
							echo "</td>
                            

                            <td>
                              <div class='hidden-sm hidden-xs action-buttons'>
                                
                                <a class='green' href='?halamane=editpo&id=$r[id_detail_po]&id_po=$id_po_baru'>
                                  <i class='ace-icon fa fa-pencil bigger-130'></i>
                                </a>

                               
                              </div>

                              <div class='hidden-md hidden-lg'>
                                <div class='inline pos-rel'>
                                  <button class='btn btn-minier btn-yellow dropdown-toggle' data-toggle='dropdown' data-position='auto'>
                                    <i class='ace-icon fa fa-caret-down icon-only bigger-120'></i>
                                  </button>

                                  <ul class='dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close'>
                                    

                                    <li>
                                      <a href='?halamane=po&act=editpo&id=$r[id_detail_po]' class='tooltip-success' data-rel='tooltip' title='Edit'>
                                        <span class='green'>
                                          <i class='ace-icon fa fa-pencil-square-o bigger-120'></i>
                                        </span>
                                      </a>
                                    </li>

                                    
                                  </ul>
                                </div>
                              </div>
                            </td>
                          </tr>";
                          $no++;
                         }
                          echo "</tbody>
                      </table>
                    </div>
                  
";

?>
</br>
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
		
       
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $sqluser2 = "select * from tb_trx_p_petani where uniqid_trx = '$no_purch[no_po]'";
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
								<td style="cursor:pointer;color:#0014B1;font-weight:bold;" title="klik untuk detail Batch Produksi" onClick="dspl2('<?php echo $row2['id_trx']; ?>','<?php echo $peng['pengepul']; ?>')"><?php echo $row2['tgl_trx']; ?>-<?php echo $peng['pengepul']; ?></td>
								  
                                <td ><?php echo $crp['nama_crop']; ?></td>
                                <td align="left"><?php echo $row2['pengepul']; ?></td>
								 <td><?php echo $total['total'] - $row2['pengepul']; ?></td>
                                <td align="left"><?php echo $row2['time_create']; ?></td>
                               
								
								
								</td>
                            </tr>
							
                            <?php $i2++; } 
							
							?>
							
							
								
                        </tbody>
                    </table>
					
								<!--<a target="_blank"  rel="noopener noreferrer" href="" class="btn btn-info">Submit</a>-->
								
                </div>
            </div>
        </div>
        <!--End Advanced Tables -->
    </div>
</div>
  <script type="text/javascript" language="javascript">
function dspl2(vkode,vakses)
		{
			var data={ id_trx:vkode, uniqid_trx_p2:vakses };
			var fungsi=function(respon){
				$("#cat").html(respon);
			};	
			$("#cat").html('<img src="assets/images/103.gif"/>');
			$("#cat2").html('');
			$.get('halaman/hal_purchasing/detail_batch.php',data,fungsi);
		}
</script>

   <span id="cat"></span>
            <span id="cat2"></span>      
	
 
	 
</body>
</html> 




                                  <!-- Jam Digital --> </span><!-- /.col -->
										</h3>

										
									</div><!-- /.col -->
								</div><!-- /.row -->
                
                <!-- PAGE CONTENT ENDS -->
              </div><!-- /.col -->
            </div><!-- /.row -->
            

<?php
  
}
?>

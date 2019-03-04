<?php
  include "../../config/koneksi.php";
	
	 $id_trx = $_GET['id_trx'];
echo "</br>";
 $uniqid_trx_p2 = $_GET['uniqid_trx_p2'];
							// query trx
							$query_sup1  = "select * from tb_trx_p_petani where status ='$4'";
							$tampil_sup1 = mysqli_query($konek, $query_sup1);
							$sup1=mysqli_fetch_array($tampil_sup1);
							// query petani
							$query_petani  = "select * from tb_petani where kode_petani ='$sup1[pengepul]'";
							$tampil_petani = mysqli_query($konek, $query_petani);
							 $petani=mysqli_fetch_array($tampil_petani);
?>

								<form width="550" height="170" target="_blank" rel="noopener noreferrer" action="site.php?halamane=trx_cpu_detail&kd=<?php echo $_GET['id_trx']; ?>&prm=<?php echo $_GET['uniqid_trx_p2']; ?>" method="POST">
							
							
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
                            ?>
							
                            <tr class="odd gradeX">
                            	<td><?php echo $i2; ?></td>
								  <td align="left"><?php echo $row2['tgl_trx']; ?></td>
                                <td ><?php echo $crp['nama_crop']; ?></td>
                                <td align="left"><?php echo $row2['pengepul']; ?></td>
                                <td align="left"><?php echo $row2['time_create']; ?></td>
                               <td align="center">  <input checked type="checkbox" name="id_trx_petani_detail[]" value="<?php echo $row2['id_trx']; ?>"/>
                                
								<input type="hidden" name="id_trx" value="<?php echo $id_trx; ?>">
								<input type="hidden" name="uniqid_trx" value="<?php echo $row2['uniqid_trx']; ?>">
								</td>
                            </tr>
							
                            <?php $i2++; } 
							
							?>
							
							<tr>
						
                            <td></td>
							<td><b>TOTAL</b></td>
							<td align="center"><b><?php 
							$sql_total = "select sum(total_qty) as total, sum(total_bag) as total_bag from tb_trx_p_petani_detail where id_trx='$id_trx'";
							$query_total = mysqli_query($konek, $sql_total);
							 $total=mysqli_fetch_array($query_total);
							 echo $total['total'];
							?></b></td>
							<td align="center"><b><?php  echo $total['total_bag']; ?></b></td>
							<td></td>
							<td></td>
							</tr>
								
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
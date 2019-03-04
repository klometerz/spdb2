<?php
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<h1>Untuk mengakses halaman, Anda harus login dulu.</h1><p><a href=\"index.php\">LOGIN</a></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{

?>
  
                <div class="row">
                    <div class="col-sm-12">
                      <div class="widget-box">
                        <div class="widget-header">
                          <h4 class="widget-title">REPORT BY PURCHASE ORDER NUMBER <?php echo"".strtoupper($_GET['id']).""; ?> </h4>

                          <span class="widget-toolbar">
                            <a href="#" data-action="collapse">
                              <i class="ace-icon fa fa-chevron-up"></i>
                            </a>
                          </span>
                        </div>

                        <div class="widget-body">
                          <div class="widget-main">
                            <form target="_blank" method="POST" action="halaman/hal_report/report-view.php">
                            <label>PO Number</label>
                            
                            <div class="input-group col-xs-8 col-sm-6">
                                  <input list="po" name='no_po' class="form-control"  type="text"  required='required'/>
                                  <datalist id="po">
								<?php 
								$query  = "SELECT * FROM tb_po ORDER BY id_po";
            $tampil = mysqli_query($konek, $query);
           while($r=mysqli_fetch_array($tampil)){
								?>
								<option value="<?php echo $r['no_po'];?>">
								<?php //echo $r['no_po']; ?>
								</option>
			<?php }?>
							</datalist>
								
                                </div>

                            <hr />

                           <!-- <label for="timepicker1">Sampai</label>
                            <div class="input-group col-xs-8 col-sm-6">
                                  <input name='sampai' class="form-control date-picker" id="id-date-picker-2" type="text" data-date-format="yyyy-mm-dd" readonly='true' required='required'/>
                                  <span class="input-group-addon">
                                    <i class="fa fa-calendar bigger-110"></i>
                                  </span>
                                </div>
                            <hr />-->

                        <div class='clearfix form-actions'>
                        <div class='col-md-offset-4 col-md-6'>
                        <button class='btn btn-info' type='submit'>
                        <i class='ace-icon fa fa-check bigger-110'></i>
                        Submit
                        </button>
						
                        </div>
                        </div>
						
						

                         </form>
                           
                          </div>
                        </div>
                      </div>
                    </div>

                    

                  
                  </div>

            

<?php
  
}
?>

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
                          <h4 class="widget-title">KARTU RIWAYAT MESIN</h4>

                          <span class="widget-toolbar">
                            <a href="#" data-action="collapse">
                              <i class="ace-icon fa fa-chevron-up"></i>
                            </a>
                          </span>
                        </div>

                        <div class="widget-body">
                          <div class="widget-main">
                            <form method="POST" action="halaman/hal_report/report-riwayat-perbaikan.php">
                            <label for="timepicker1">Pilih Nama Mesin</label>
                            
                            <div class="input-group col-xs-8 col-sm-6">
                                 <?php
                                 echo"<select name=\"id_mesin\" class='chosen-select'>
              <option value=\"0\" selected>- Pilih mesin -</option>";
              $query  = "SELECT * FROM mesin ORDER BY nama_mesin";
              $tampil = mysqli_query($konek, $query);
              while($r=mysqli_fetch_array($tampil)){
              echo "<option value=\"$r[id_mesin]\">$r[nama_mesin]</option>";
              }
              echo "</select>";
                                 ?>
                                </div>

                            <hr />

                           
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

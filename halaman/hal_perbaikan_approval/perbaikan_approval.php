<script type="text/javascript" src="halaman/hal_perbaikan/jquery.js"></script>
<script language="javascript">
$(document).ready(function() {
  $('#id_divisi').change(function() { 
    var category = $(this).val();
    $.ajax({
      type: 'GET',
      url: 'halaman/hal_perbaikan/select-for-ajax.php',
      data: 'KoDe_TIPE=' + category, // Untuk data di MySQL dengan menggunakan kata kunci tsb
      dataType: 'html',
      beforeSend: function() {
        $('#id_mesin').html('<tr><td colspan=2>Loading ....</td></tr>');  
      },
      success: function(response) {
        $('#id_mesin').html(response);
      }
    });
    });
});

</script>
<?php
// Apabila perbaikan belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<h1>Untuk mengakses halaman, Anda harus login dulu.</h1><p><a href=\"index.php\">LOGIN</a></p>";  
}
// Apabila perbaikan sudah login dengan benar, maka terbentuklah session
else{
  $aksi = "halaman/hal_perbaikan_approval/aksi_perbaikan_approval.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : ''; 

  switch($act){
    // Tampil perbaikan
    default:
     echo" <div class='row'>
                  <div class='col-xs-12'>
                  
                    <div class='clearfix'>
                      <div class='pull-right tableTools-container'></div>
                    
                    </div>
                    <div class='table-header'>
                      Tabel perbaikan View
                    </div>
                    <div>";
       if ($_SESSION['leveluser']=='user'){
        $query  = "SELECT * FROM perbaikan a
            inner join user b using(id_user)
      inner join mesin c using(id_mesin) WHERE id_user='$_SESSION[username]' ORDER BY id_perbaikan";
        $tampil = mysqli_query($konek, $query);
       }
       else {
        $query  = "SELECT * FROM perbaikan a
            inner join user b using(id_user)
      inner join mesin c using(id_mesin) ORDER BY id_perbaikan";
        $tampil = mysqli_query($konek, $query);
       }
        

                      echo"<table id='dynamic-table1' class='table table-striped table-bordered table-hover'>
                        <thead>
                          <tr>
                            <th class='center'>No</th>
                            <th>ID perbaikan</th>
                            <th>Tanggal</th>
                            <th>Nama user</th>
                            <th>Nama Mesin</th>
                            <th>Judul</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>"; 
            
      $no = 1;
      while ($r=mysqli_fetch_array($tampil)){
        echo "
                          <tr>
                            <td class='center'>$no</td>
                            <td>$r[id_perbaikan]</td>
                            <td>$r[tgl_buat]</td>
                            <td>$r[nama_user]</td>
							              <td>$r[nama_mesin]</td>
                            <td>$r[judul]</td>
                            <td>$r[keterangan]</td>
                            <td>";
          if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='teknisi'){
                            if ($r['status']=='Open'){ 
                            echo"<div class='btn-group'>
                            <button data-toggle='dropdown' class='btn btn-xs btn-danger dropdown-toggle'>
                             Open
                            <i class='ace-icon fa fa-angle-down icon-on-right'></i>
                            </button>
                          <ul class='dropdown-menu dropdown-danger'>
                          <li><a href='$aksi?halamane=perbaikan-approval&act=updatestatus&id=$r[id_perbaikan]&s=Waiting'>Waiting</a></li>
                          <li><a href='$aksi?halamane=perbaikan-approval&act=updatestatus&id=$r[id_perbaikan]&s=Closed'>Closed</a></li>
                         </ul>
                          </div>";
                            }

                             elseif ($r['status']=='Waiting'){ 
                            echo"<div class='btn-group'>
                            <button data-toggle='dropdown' class='btn btn-xs btn-warning dropdown-toggle'>
                            Waiting
                            <i class='ace-icon fa fa-angle-down icon-on-right'></i>
                            </button>
                          <ul class='dropdown-menu dropdown-warning'>
                          <li><a href='$aksi?halamane=perbaikan-approval&act=updatestatus&id=$r[id_perbaikan]&s=Open'>Open</a></li>
                         </ul>
                          </div>";
                            }

                             elseif ($r['status']=='Closed'){ 
                            echo"<div class='btn-group'>
                            <button data-toggle='dropdown' class='btn btn-xs btn-success dropdown-toggle'>
                            Closed
                            <i class='ace-icon fa fa-angle-down icon-on-right'></i>
                            </button>
                         
                          </div>";
                            }
                            
                          } else{
                            echo"$r[status]";
                          }
                          echo"</td>
                          </tr>";
                          $no++;
                         }
                          echo "</tbody>
                      </table>
                    </div>
                  </div>
                </div>
";
    break;
  
    case "tambahperbaikan":
     //GET Kode Otomastis.........
      $query = "select max(id_perbaikan) as maksi from perbaikan";
      $hasil = mysqli_query($konek, $query);
      $data_oto  = mysqli_fetch_array($hasil);
      $kode_user=buatkode($data_oto['maksi'], 'GSS-TC00', 1);

    echo" <div class='row'>
    <div class='col-xs-12'>
                      <div class='widget-box'>
                        <div class='widget-header'>
                          <h4 class='widget-title'>Form Tambah perbaikan</h4>

                          <div class='widget-toolbar'>
                            <a href='#' data-action='collapse'>
                              <i class='ace-icon fa fa-chevron-up'></i>
                            </a>
                          </div>
                        </div>

                        <div class='widget-body'>
                          <div class='widget-main'>
                          <form method=\"POST\" action=\"$aksi?halamane=perbaikan-approval&act=input\">
                            <div>
                              <label>Kode perbaikan</label>
							<div class='row'>
							<div class='col-xs-8 col-sm-2'>
							<div class='input-group'>
                              <input type=\"text\" name=\"id_perbaikan\" class='form-control' placeholder='ID perbaikan' required='required' value='$kode_user' readonly='yes'>
                            <span class='input-group-addon'>
							<i class='fa fa-key bigger-110'></i>
							</span>
							</div>
							</div>
							</div>
                            <hr />
							
							<label for=\"id-date-picker-1\">Tanggal perbaikan</label>
							<div class='row'>
							<div class='col-xs-8 col-sm-6'>
							<div class='input-group'>
							<input class='form-control date-picker' id='id-date-picker-2' type='text' name=\"tgl_buat\" data-date-format='yyyy-mm-dd' required='required'/>
							<span class='input-group-addon'>
							<i class='fa fa-calendar bigger-110'></i>
							</span>
							</div>
							</div>
							</div>
                            <hr />
							
							<div class='row'>
							<div class='col-xs-8 col-sm-6'>
							<div class='form-group'>
							<label for='form-field-select-3'>Pilih Divisi</label>
							<div>
							<select name=\"id_divisi\" id='id_divisi' class='form-control'>
							<option value=\"0\" selected>- Pilih Divisi -</option>";
							$query  = "SELECT * FROM divisi ORDER BY nama_divisi";
							$tampil = mysqli_query($konek, $query);
							while($r=mysqli_fetch_array($tampil)){
							echo "<option value=\"$r[id_divisi]\">$r[nama_divisi]</option>";
							}
							echo "</select>
							</div>
							</div>
							</div>
							</div>
							<hr />
							
							<div class='row'>
							<div class='col-xs-8 col-sm-6'>
							<div class='form-group'>
							<label for='form-field-select-3'>Pilih Mesin</label>
							<div>
							<select name=\"id_mesin\" id='id_mesin' class='form-control'>
							<option value=\"0\" selected>- Pilih mesin -</option>";
							$query  = "SELECT * FROM mesin ORDER BY nama_mesin";
							$tampil = mysqli_query($konek, $query);
							while($r=mysqli_fetch_array($tampil)){
							echo "<option value=\"$r[id_mesin]\">$r[nama_mesin]</option>";
							}
							echo "</select>
							</div>
							</div>
							</div>
							</div>
							<hr />
							
							
							<label for=\"id-date-picker-1\">Judul</label>
							<div class='row'>
							<div class='col-sm-6'>
							<input class='form-control' type='text' name='judul' required='required'/>
							</div>
							</div>
							<hr />
							
							
							
							<label for=\"id-date-picker-1\">Keterangan</label>
							<div class='row'>
							<div class='col-xs-8 col-sm-6'>
							<input class='form-control' type='text' name='keterangan' required='required'/>
							</div>
							</div>
							

                            <div class='clearfix form-actions'>
                        <div class='col-md-offset-3 col-md-9'>
                      <button class='btn btn-info' type='submit'>
                        <i class='ace-icon fa fa-check bigger-110'></i>
                        Submit
                      </button>

                      &nbsp; &nbsp; &nbsp;
                      <button class='btn' type='reset' onclick=\"self.history.back()\">
                        <i class='ace-icon fa fa-undo bigger-110'></i>
                        Reset
                      </button>
                    </div>
                  </div>

                  </form>

                            
                          </div>
                        </div>
                      </div>
                    </div><!-- /.span -->
    </div>";
      
    break;
    
    case "editperbaikan":
      $query = "SELECT * FROM perbaikan WHERE id_perbaikan='$_GET[id]'";
      $hasil = mysqli_query($konek, $query);
      $r     = mysqli_fetch_array($hasil);

      echo" <div class='row'>
    <div class='col-xs-12'>
                      <div class='widget-box'>
                        <div class='widget-header'>
                          <h4 class='widget-title'>Form Ubah perbaikan</h4>

                          <div class='widget-toolbar'>
                            <a href='#' data-action='collapse'>
                              <i class='ace-icon fa fa-chevron-up'></i>
                            </a>
                          </div>
                        </div>

                        <div class='widget-body'>
                          <div class='widget-main'>
                          <form method=\"POST\" action=\"$aksi?halamane=perbaikan-approval&act=update\">
                            <div>
                              <label>Kode perbaikan</label>
							<div class='row'>
							<div class='col-xs-8 col-sm-2'>
							<div class='input-group'>
                              <input type=\"text\" name=\"id_perbaikan\" class='form-control' placeholder='ID perbaikan' required='required' value='$_GET[id]' readonly='yes'>
                            <span class='input-group-addon'>
							<i class='fa fa-key bigger-110'></i>
							</span>
							</div>
							</div>
							</div>
                            <hr />
							
							<label for=\"id-date-picker-1\">Tanggal perbaikan</label>
							<div class='row'>
							<div class='col-xs-8 col-sm-6'>
							<div class='input-group'>
							<input class='form-control date-picker' id='id-date-picker-2' type='text' name=\"tgl_buat\" data-date-format='yyyy-mm-dd' required='required' value='$r[tgl_buat]'/>
							<span class='input-group-addon'>
							<i class='fa fa-calendar bigger-110'></i>
							</span>
							</div>
							</div>
							</div>
                            <hr />
							
							<div class='row'>
              <div class='col-xs-8 col-sm-6'>
              <div class='form-group'>
              <label for='form-field-select-3'>Pilih divisi</label>
              <div>
              <select name=\"id_divisi\" id='id_divisi' class='form-control'>";
               $tampilX=mysqli_query($konek, "SELECT * FROM mesin WHERE id_mesin='$r[id_mesin]'");
               $d=mysqli_fetch_array($tampilX);

              if ($d['id_divisi']==0){
              echo "<option value=\"0\" selected>- Pilih divisi -</option>";
              }   
              $query2 = "SELECT * FROM divisi ORDER BY nama_divisi";
              $tampil = mysqli_query($konek, $query2);
              while($w=mysqli_fetch_array($tampil)){
              if ($d['id_divisi']==$w['id_divisi']){
              echo "<option value=\"$w[id_divisi]\" selected>$w[nama_divisi]</option>";
              }
              else{
              echo "<option value=\"$w[id_divisi]\">$w[nama_divisi]</option>";
              }
              }
              echo "</select>
              </div>
              </div>
              </div>
              </div>
              <hr />
							
							<div class='row'>
							<div class='col-xs-8 col-sm-6'>
							<div class='form-group'>
							<label for='form-field-select-3'>Pilih Mesin</label>
							<div>
							<select name=\"id_mesin\" id='id_mesin' class='form-control'>";
							if ($r['id_mesin']==0){
							echo "<option value=\"0\" selected>- Pilih mesin -</option>";
							}   
							$query2 = "SELECT * FROM mesin ORDER BY nama_mesin";
							$tampil = mysqli_query($konek, $query2);
							while($w=mysqli_fetch_array($tampil)){
							if ($r['id_mesin']==$w['id_mesin']){
							echo "<option value=\"$w[id_mesin]\" selected>$w[nama_mesin]</option>";
							}
							else{
							echo "<option value=\"$w[id_mesin]\">$w[nama_mesin]</option>";
							}
							}
							echo "</select>
							</div>
							</div>
							</div>
							</div>
							<hr />
							
							
							<label for=\"id-date-picker-1\">Judul</label>
							<div class='row'>
							<div class='col-xs-8 col-sm-6'>
							<input class='form-control' type='text' name='judul' required='required' value='$r[judul]'/>
							</div>
							</div>
							<hr />
							
							
							
							<label for=\"id-date-picker-1\">Keterangan</label>
							<div class='row'>
							<div class='col-xs-8 col-sm-6'>
							<input class='form-control' type='text' name='keterangan' required='required' value='$r[keterangan]'/>
							</div>
							</div>
							

                            <div class='clearfix form-actions'>
                        <div class='col-md-offset-3 col-md-9'>
                      <button class='btn btn-info' type='submit'>
                        <i class='ace-icon fa fa-check bigger-110'></i>
                        Submit
                      </button>

                      &nbsp; &nbsp; &nbsp;
                      <button class='btn' type='reset' onclick=\"self.history.back()\">
                        <i class='ace-icon fa fa-undo bigger-110'></i>
                        Reset
                      </button>
                    </div>
                  </div>

                  </form>

                            
                          </div>
                        </div>
                      </div>
                    </div><!-- /.span -->
    </div>";
      
    break;  
  }
}    
?>

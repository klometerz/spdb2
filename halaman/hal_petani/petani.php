<?php
// Apabila user belum login
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
  echo "<h1>Untuk mengakses halaman, Anda harus login dulu.</h1><p><a href=\"index.php\">LOGIN</a></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  $aksi = "halaman/hal_petani/aksi_petani.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : ''; 

  switch($act){
    // Tampil Petani
    default: 
     echo" <div class='row'>
                  <div class='col-xs-12'>
                  
                    <div class='clearfix'>
                      <div class='pull-right tableTools-container'></div>
                      
                      <button class='btn btn-white btn-info btn-bold' onclick=window.location.href=\"?halamane=petani&act=tambahpetani\"><i class='ace-icon glyphicon glyphicon-plus'></i>
                        Add Petani</button>
						
                    </div>
                    <br/>
                    <div class='table-header'>
                      Petani
                    </div>
                    <div>";

        if ($_SESSION['level']=='1'){
        $query  = "select * from tb_petani ORDER BY id_petani";
        $tampil = mysqli_query($konek, $query);
      } else{
        $query  = "SELECT * FROM tb_petani";
        $tampil = mysqli_query($konek, $query);
      }

                      echo"<table id='dynamic-table1' class='table table-striped table-bordered table-hover'>
                        <thead>
                          <tr>
                            <th class='center'>No</th>
                            <th>Kode Petani</th>
							<th>Nama Petani</th>
                            <th>Crop</th>
                            <th class='hidden-480'>Desa Petani</th>
                            
                            
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>"; 
            
      $no = 1;
      while ($r=mysqli_fetch_array($tampil)){
        echo "
                          <tr>
                            <td class='center'>$no</td>
                            <td>$r[kode_petani]</td>
							 <td>$r[nama_petani]</td>
							 
							 ";
							   $crop  = "select * from tb_crop where kode_crop = '$r[crop]'";
        $tampil_crop = mysqli_query($konek, $crop);
		$d_crop=mysqli_fetch_array($tampil_crop);
                            echo "<td>$d_crop[nama_crop]</td>
                            <td class='hidden-480'>$r[desa_petani]</td>
                           
					
                            

                            <td>
                              <div class='hidden-sm hidden-xs action-buttons'>
                                
                                <a class='green' href='?halamane=petani&act=editpo&id=$r[id_petani]'>
                                  <i class='ace-icon fa fa-pencil bigger-130'></i>
                                </a>

                                <a class='red' href='$aksi?halamane=petani&act=hapus&id=$r[id_petani]'>
                                  <i class='ace-icon fa fa-trash-o bigger-130'></i>
                                </a>
                              </div>

                              <div class='hidden-md hidden-lg'>
                                <div class='inline pos-rel'>
                                  <button class='btn btn-minier btn-yellow dropdown-toggle' data-toggle='dropdown' data-position='auto'>
                                    <i class='ace-icon fa fa-caret-down icon-only bigger-120'></i>
                                  </button>

                                  <ul class='dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close'>
                                    

                                    <li>
                                      <a href='?halamane=po&act=editpetani&id=$r[id_petani]' class='tooltip-success' data-rel='tooltip' title='Edit'>
                                        <span class='green'>
                                          <i class='ace-icon fa fa-pencil-square-o bigger-120'></i>
                                        </span> 	  
                                      </a>
                                    </li>

                                    <li>
                                      <a href='$aksi?halamane=po&act=hapus&id=$r[id_petani]' class='tooltip-error' data-rel='tooltip' title='Delete'>
                                        <span class='red'>
                                          <i class='ace-icon fa fa-trash-o bigger-120'></i>	
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
                  </div>
                </div>
";
    break;
  
    case "tambahpetani":
     //GET Kode Otomastis.........
      $query = "select max(kode_petani) as maksi from tb_petani";
      $hasil = mysqli_query($konek, $query);
      $data_oto  = mysqli_fetch_array($hasil);
	  
      $kode_user=buatkode($data_oto['maksi'], 'FARM-PO00', 1);

    echo" <div class='row'>
    <div class='col-xs-12'>
                      <div class='widget-box'>
                        <div class='widget-header'>
                          <h4 class='widget-title'>Form Tambah Subject</h4>

                          <div class='widget-toolbar'>
                            <a href='#' data-action='collapse'>
                              <i class='ace-icon fa fa-chevron-up'></i>
                            </a>
                          </div>
                        </div>

                        <div class='widget-body'>
                          <div class='widget-main'>
                          <form method=\"POST\" action=\"$aksi?halamane=petani&act=input\">
                            <div>
                              <label>Kode Subject</label>
                              <input type=\"text\" name=\"kode_petani\" class='form-control' placeholder='ID User' required='required' value='' >
                            </div>
                            <hr />

                             <div>
                              <label>Nama Subject</label>
                              <input type=\"text\" name=\"nama_petani\" class='form-control' placeholder='Nama Petani' required='required'>
                            </div>
                            <hr />

                             <div>
                              <label>Desa</label>
                              <input type=\"text\" name=\"desa_petani\" class='form-control' placeholder='Desa Petani' required='required'>
                            </div>
                            <hr />
							
							 <div>
                              <label>RT/RW</label>
                              <input type=\"text\" name=\"rtrw_petani\" class='form-control' placeholder='002/004' required='required'>
                            </div>
                            <hr />
							
							<div>
                              <label>Type Subject</label>
                              <select name=\"type\" class='form-control'>
            <option value=\"0\" selected>- Pilih Status -</option>
			<option value=\"Supplier\" selected>Supplier Haldin</option>
			<option value=\"Pengepul\" selected>Pengepul</option>
			<option value=\"Petani\" selected>Petani</option>";
            
      echo "</select>
                            </div>
                            <hr />
							
							
							<div>
                              <label>Status Kepemilikan Lahan</label>
                              <select name=\"status_lahan\" class='form-control'>
            <option value=\"0\" selected>- Pilih Status -</option>
			<option value=\"Pemilik\" selected>Pemilik Lahan</option>
			<option value=\"Penderes\" selected>Penderes</option>";
            
      echo "</select>
                            </div>
                            <hr />
                           
                       

                             <div>
                              <label>Jenis Tanaman</label>
                              <select name=\"crop\" class='form-control'>
            <option value=\"0\" selected>- Pilih Level -</option>";
            $query  = "SELECT * FROM tb_crop ORDER BY id_crop";
            $tampil = mysqli_query($konek, $query);
            while($r=mysqli_fetch_array($tampil)){
              echo "<option value=\"$r[kode_crop]\">$r[nama_crop]</option>";
            }
      echo "</select>
                            </div>
                            <hr />


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
    
    case "edituser":
      $query = "SELECT * FROM user WHERE id_user='$_GET[id]'";
      $hasil = mysqli_query($konek, $query);
      $r     = mysqli_fetch_array($hasil);

      echo" <div class='row'>
    <div class='col-xs-12'>
                      <div class='widget-box'>
                        <div class='widget-header'>
                          <h4 class='widget-title'>Form Ubah User</h4>

                          <div class='widget-toolbar'>
                            <a href='#' data-action='collapse'>
                              <i class='ace-icon fa fa-chevron-up'></i>
                            </a>
                          </div>
                        </div>

                        <div class='widget-body'>
                          <div class='widget-main'>
                          <form method=\"POST\" action=\"$aksi?halamane=user&act=update\">
                            <div>
                              <label for='form-field-8'>ID User</label>
                              <input type=\"text\" name=\"id_user\" class='form-control' placeholder='ID User' required='required' value='$r[id_user]' readonly='yes'>
                            </div>
                            <hr />

                             <div>
                              <label for='form-field-8'>Nama User</label>
                              <input type=\"text\" name=\"nama_user\" class='form-control' placeholder='Nama User' required='required' value='$r[nama_user]'>
                            </div>
                            <hr />

                             <div>
                              <label for='form-field-8'>Password</label>
                              <input type=\"password\" name=\"password\" class='form-control' placeholder='Password' required='required' value='$r[password]'>
                            </div>
                            <hr />

                            <div>
                              <label for='form-field-8'>Pilih Divisi</label>
                              <select name=\"id_divisi\" class='form-control'>";
           
          if ($r['id_divisi']==0){
            echo "<option value=\"0\" selected>- Pilih divisi -</option>";
          }   

          $query2 = "SELECT * FROM divisi ORDER BY nama_divisi";
          $tampil = mysqli_query($konek, $query2);

          while($w=mysqli_fetch_array($tampil)){
            if ($r['id_divisi']==$w['id_divisi']){
              echo "<option value=\"$w[id_divisi]\" selected>$w[nama_divisi]</option>";
            }
            else{
              echo "<option value=\"$w[id_divisi]\">$w[nama_divisi]</option>";
            }
          }

      echo "</select>
                            </div>
                            <hr />


                            <div>
                              <label for='form-field-8'>Pilih Level</label>
                              <select name=\"level\" class='form-control'>";
           
          if ($r['level']==0){
            echo "<option value=\"0\" selected>- Pilih Level -</option>";
          }   

          $query2 = "SELECT * FROM level ORDER BY level";
          $tampil = mysqli_query($konek, $query2);

          while($w=mysqli_fetch_array($tampil)){
            if ($r['level']==$w['level']){
              echo "<option value=\"$w[level]\" selected>$w[level]</option>";
            }
            else{
              echo "<option value=\"$w[level]\">$w[level]</option>";
            }
          }

      echo "</select>
                            </div>
                            <hr />


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

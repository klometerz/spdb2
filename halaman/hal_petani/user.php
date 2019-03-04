<?php
// Apabila user belum login
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
  echo "<h1>Untuk mengakses halaman, Anda harus login dulu.</h1><p><a href=\"index.php\">LOGIN</a></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  $aksi = "halaman/hal_user/aksi_user.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : ''; 

  switch($act){
    // Tampil User
    default:
     echo" <div class='row'>
                  <div class='col-xs-12'>
                  
                    <div class='clearfix'>
                      <div class='pull-right tableTools-container'></div>
                      
                      <button class='btn btn-white btn-info btn-bold' onclick=window.location.href=\"?halamane=user&act=tambahuser\"><i class='ace-icon glyphicon glyphicon-plus'></i>
                        Tambah User</button>
                    </div>
                    <br/>
                    <div class='table-header'>
                      Tabel User View
                    </div>
                    <div>";

        if ($_SESSION['level']=='1'){
        $query  = "select * from tb_auth ORDER BY id_auth";
        $tampil = mysqli_query($konek, $query);
      } else{
        $query  = "SELECT * FROM tb_auth WHERE id_auth='$_SESSION[username]'";
        $tampil = mysqli_query($konek, $query);
      }

                      echo"<table id='dynamic-table1' class='table table-striped table-bordered table-hover'>
                        <thead>
                          <tr>
                            <th class='center'>No</th>
                            <th>ID User</th>
							<th>Auth Code</th>
                            <th>Nama User</th>
                            <th class='hidden-480'>Password(hash MD5)</th>
                            <th class='hidden-480'>Level</th>
                            
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>"; 
            
      $no = 1;
      while ($r=mysqli_fetch_array($tampil)){
        echo "
                          <tr>
                            <td class='center'>$no</td>
                            <td>$r[id_auth]</td>
							 <td>$r[auth_code]</td>
                            <td>$r[username]</td>
                            <td class='hidden-480'>$r[password]</td>
                            <td class='hidden-480'>
							"; if($r['level'] == '1')
							{
								echo "Adminstrator";
							}
							elseif ($r['level'] == '2')
							{
								echo "Staff Haldin";
							}
							else "Supplier";
							echo "</td>
                            

                            <td>
                              <div class='hidden-sm hidden-xs action-buttons'>
                                
                                <a class='green' href='?halamane=user&act=edituser&id=$r[id_auth]'>
                                  <i class='ace-icon fa fa-pencil bigger-130'></i>
                                </a>

                                <a class='red' href='$aksi?halamane=user&act=hapus&id=$r[id_auth]'>
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
                                      <a href='?halamane=user&act=edituser&id=$r[id_auth]' class='tooltip-success' data-rel='tooltip' title='Edit'>
                                        <span class='green'>
                                          <i class='ace-icon fa fa-pencil-square-o bigger-120'></i>
                                        </span>
                                      </a>
                                    </li>

                                    <li>
                                      <a href='$aksi?halamane=user&act=hapus&id=$r[id_auth]' class='tooltip-error' data-rel='tooltip' title='Delete'>
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
  
    case "tambahuser":
     //GET Kode Otomastis.........
      $query = "select max(auth_code) as maksi from tb_auth";
      $hasil = mysqli_query($konek, $query);
      $data_oto  = mysqli_fetch_array($hasil);
      $kode_user=buatkode($data_oto['maksi'], 'TRC-US00', 1);

    echo" <div class='row'>
    <div class='col-xs-12'>
                      <div class='widget-box'>
                        <div class='widget-header'>
                          <h4 class='widget-title'>Form Tambah User</h4>

                          <div class='widget-toolbar'>
                            <a href='#' data-action='collapse'>
                              <i class='ace-icon fa fa-chevron-up'></i>
                            </a>
                          </div>
                        </div>

                        <div class='widget-body'>
                          <div class='widget-main'>
                          <form method=\"POST\" action=\"$aksi?halamane=user&act=input\">
                            <div>
                              <label>ID User</label>
                              <input type=\"text\" name=\"id_user\" class='form-control' placeholder='ID User' required='required' value='$kode_user' readonly='yes'>
                            </div>
                            <hr />

                             <div>
                              <label>Username</label>
                              <input type=\"text\" name=\"nama_user\" class='form-control' placeholder='Username' required='required'>
                            </div>
                            <hr />

                             <div>
                              <label>Password</label>
                              <input type=\"password\" name=\"password\" class='form-control' placeholder='Password' required='required'>
                            </div>
                            <hr />

                           
                       

                             <div>
                              <label>Pilih Level</label>
                              <select name=\"level\" class='form-control'>
            <option value=\"0\" selected>- Pilih Level -</option>";
            $query  = "SELECT * FROM tbl_level ORDER BY level";
            $tampil = mysqli_query($konek, $query);
            while($r=mysqli_fetch_array($tampil)){
              echo "<option value=\"$r[level]\">$r[status]</option>";
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

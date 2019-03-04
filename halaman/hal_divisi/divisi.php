<?php
// Apabila divisi belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<h1>Untuk mengakses halaman, Anda harus login dulu.</h1><p><a href=\"index.php\">LOGIN</a></p>";  
}
// Apabila divisi sudah login dengan benar, maka terbentuklah session
else{
  $aksi = "halaman/hal_divisi/aksi_divisi.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : ''; 

  switch($act){
    // Tampil divisi
    default:
     echo" <div class='row'>
                  <div class='col-xs-12'>
                  
                    <div class='clearfix'>
                      <div class='pull-right tableTools-container'></div>
                      
                      <button class='btn btn-white btn-info btn-bold' onclick=window.location.href=\"?halamane=divisi&act=tambahdivisi\"><i class='ace-icon glyphicon glyphicon-plus'></i>
                        Tambah divisi</button>
                    </div>
                    <br/>
                    <div class='table-header'>
                      Tabel divisi View
                    </div>
                    <div>";

        $query  = "SELECT * FROM divisi ORDER BY id_divisi";
        $tampil = mysqli_query($konek, $query);

                      echo"<table id='dynamic-table1' class='table table-striped table-bordered table-hover'>
                        <thead>
                          <tr>
                            <th class='center'>No</th>
                            <th>ID Divisi</th>
                            <th>Nama Divisi</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>"; 
            
      $no = 1;
      while ($r=mysqli_fetch_array($tampil)){
        echo "
                          <tr>
                            <td class='center'>$no</td>
                            <td>$r[id_divisi]</td>
                            <td>$r[nama_divisi]</td>
                            <td>
                              <div class='hidden-sm hidden-xs action-buttons'>
                                
                                <a class='green' href='?halamane=divisi&act=editdivisi&id=$r[id_divisi]'>
                                  <i class='ace-icon fa fa-pencil bigger-130'></i>
                                </a>

                                <a class='red' href='$aksi?halamane=divisi&act=hapus&id=$r[id_divisi]'>
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
                                      <a href='?halamane=divisi&act=editdivisi&id=$r[id_divisi]' class='tooltip-success' data-rel='tooltip' title='Edit'>
                                        <span class='green'>
                                          <i class='ace-icon fa fa-pencil-square-o bigger-120'></i>
                                        </span>
                                      </a>
                                    </li>

                                    <li>
                                      <a href='$aksi?halamane=divisi&act=hapus&id=$r[id_divisi]' class='tooltip-error' data-rel='tooltip' title='Delete'>
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
  
    case "tambahdivisi":
     //GET Kode Otomastis.........
      $query = "select max(id_divisi) as maksi from divisi";
      $hasil = mysqli_query($konek, $query);
      $data_oto  = mysqli_fetch_array($hasil);
      $kode_user=buatkode($data_oto['maksi'], 'BSI-DV00', 1);

    echo" <div class='row'>
    <div class='col-xs-12'>
                      <div class='widget-box'>
                        <div class='widget-header'>
                          <h4 class='widget-title'>Form Tambah divisi</h4>

                          <div class='widget-toolbar'>
                            <a href='#' data-action='collapse'>
                              <i class='ace-icon fa fa-chevron-up'></i>
                            </a>
                          </div>
                        </div>

                        <div class='widget-body'>
                          <div class='widget-main'>
                          <form method=\"POST\" action=\"$aksi?halamane=divisi&act=input\">
                            <div>
                              <label>ID divisi</label>
                              <input type=\"text\" name=\"id_divisi\" class='form-control' placeholder='ID divisi' required='required' value='$kode_user' readonly='yes'>
                            </div>
                            <hr />

                             <div>
                              <label>Nama Divisi</label>
                              <input type=\"text\" name=\"nama_divisi\" class='form-control' placeholder='Nama divisi' required='required'>
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
    
    case "editdivisi":
      $query = "SELECT * FROM divisi WHERE id_divisi='$_GET[id]'";
      $hasil = mysqli_query($konek, $query);
      $r     = mysqli_fetch_array($hasil);

      echo" <div class='row'>
    <div class='col-xs-12'>
                      <div class='widget-box'>
                        <div class='widget-header'>
                          <h4 class='widget-title'>Form Ubah divisi</h4>

                          <div class='widget-toolbar'>
                            <a href='#' data-action='collapse'>
                              <i class='ace-icon fa fa-chevron-up'></i>
                            </a>
                          </div>
                        </div>

                        <div class='widget-body'>
                          <div class='widget-main'>
                          <form method=\"POST\" action=\"$aksi?halamane=divisi&act=update\">
                            <div>
                              <label for='form-field-8'>ID divisi</label>
                              <input type=\"text\" name=\"id_divisi\" class='form-control' placeholder='ID divisi' required='required' value='$r[id_divisi]' readonly='yes'>
                            </div>
                            <hr />

                             <div>
                              <label for='form-field-8'>Nama divisi</label>
                              <input type=\"text\" name=\"nama_divisi\" class='form-control' placeholder='Nama divisi' required='required' value='$r[nama_divisi]'>
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

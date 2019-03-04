
<script>
$(document).ready(function() {
    var max_fields      = 10;
    var wrapper         = $(".container1"); 
    var add_button      = $(".add_form_field"); 
    
    var x = 1; 
    $(add_button).click(function(e){ 
        e.preventDefault();
        if(x < max_fields){ 
            x++; 
            $(wrapper).append('<label><b>Data 1</b></label><div><label>Nama Item</label> <input type=\"text\" name=\"nama_item[]\" class="form-control" placeholder="Coconut Sugar/Honey/Oil" required="required"></div><hr /><div><label>Quantity</label><input type=\"text\" name=\"qty[]\" class="form-control"  required="required"></div><hr /><div><label>Unit of Measurement (UOM) </label><input type=\"text\" name=\"uom[]\" class="form-control" placeholder="KG/Ton/Liter" required="required"></div> <hr />'); //add input box
        }
		else
		{
		alert('You Reached the limits')
		}
    });
    
    $(wrapper).on("click",".delete", function(e){ 
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script><?php
// Apabila user belum login
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
  echo "<h1>Untuk mengakses halaman, Anda harus login dulu.</h1><p><a href=\"index.php\">LOGIN</a></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  $aksi = "halaman/hal_pengepul/aksi_pengepul.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : ''; 

  switch($act){
    // Tampil User
    default:
     echo" <div class='row'>
                  <div class='col-xs-12'>
                  
                    <div class='clearfix'>
                      <div class='pull-right tableTools-container'></div>
                      
                      <button class='btn btn-white btn-info btn-bold' onclick=window.location.href=\"?halamane=input_transaksi_p2\"><i class='ace-icon glyphicon glyphicon-plus'></i>
                        Pembelian Baru</button>
                    </div>
                    <br/>
                    <div class='table-header'>
                      Pembelian Barang Pengepul
                    </div>
                    <div>";

        if ($_SESSION['level']=='1'){
        $query  = "select * from tb_trx_p_petani where status ='2' or pengepul like '%PB%' and pengepul like '%PK%'";
        $tampil = mysqli_query($konek, $query);
      } else{
		  $status = $_SESSION['auth_code'];
        $query  = "SELECT * FROM tb_trx_p_petani where pengepul = '$status' ";
        $tampil = mysqli_query($konek, $query);
      }

                      echo"<table id='dynamic-table1' class='table table-striped table-bordered table-hover'>
                        <thead>
                          <tr>
                            <th class='center'>No</th>
                            <th>Tanggal Transaksi</th>
							<th>Raw Material</th>
							<th>Pengumpul Besar</th>
							<th>Desa</th>
                            <th>Unique ID</th>
                            <th class='hidden-480'>Create Date</th>
                            <th class='hidden-480'>Status</th>
                            
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>"; 
            
      $no = 1;
      while ($r=mysqli_fetch_array($tampil)){
		  $sql_total = "select sum(total_qty) as total, sum(total_bag) as total_bag from tb_trx_p_petani_detail where id_trx='$r[id_trx]'";
							$query_total = mysqli_query($konek, $sql_total);
							 $total=mysqli_fetch_array($query_total);
							
       $query_crop  = "select * from tb_crop where kode_crop ='$r[raw_material]'";
							$tampil_crop = mysqli_query($konek, $query_crop);
							 $crop=mysqli_fetch_array($tampil_crop);


	   echo "
                          <tr>
                            <td class='center'>$no</td>
                            <td><a class='green' href='?halamane=trx_p2&id=$r[id_trx]'> $r[tgl_trx]</a></td>
							 <td class='hidden-480'>$crop[nama_crop]</td>";
							
								$query_sup  = "select * from tb_petani where kode_petani ='$r[pengepul]'";
							$tampil_sup = mysqli_query($konek, $query_sup);
							 $sup=mysqli_fetch_array($tampil_sup);
							
							 echo "<td>$sup[kode_petani] - $sup[nama_petani]</td>
<td>$sup[desa_petani]</td>							 ";
							 
							
                           echo " <td>$r[uniqid_trx]</td>
                           <td class='hidden-480'>$r[date_create]</td>
                            <td class='hidden-480'>
							"; if($r['status'] == '2')
							{
								echo '<i color="blue">Tersedia - '; echo $total['total']; echo  ' KG</i>';
							}
							elseif ($r['status'] == '3')
							{
								echo '<i color="yellow">Habis</i>';
							}
							elseif ($r['status'] == '4')
							{
								echo '<i color="green">Delivery</i>';
							}
							elseif ($r['status'] == '5')
							{
								echo '<i color="gray">Closed</i>';
							}
							elseif ($r['status'] == '6')
							
							{
								echo '<i color="red">Cancel</i>';
							}
								elseif ($r['status'] == '1')
							
							{
								echo '<i color="red">First Hand - '; echo $total['total']; echo  ' KG</i>';
							}
						
							echo "</td>
                            

                            <td>
                              <div class='hidden-sm hidden-xs action-buttons'>
                                ";
								if($_SESSION['level'] == '1')
								{ 
									if ($r['status'] == '4' or $r['status'] == '5')
									{
							
							echo "
                               

                                <a class='red' href='$aksi?halamane=del_peng&act=cancel&id=$r[id_trx]'>
                                  <i class='ace-icon fa fa-times bigger-130'></i>
                                </a>";
								}
								else {
									echo "
                              

                                <a class='red' href='$aksi?halamane=del_peng&act=cancel&id=$r[id_trx]'>
                                  <i class='ace-icon fa fa-times bigger-130'></i>
                                </a>";
									
								}
								
								}
								else {}
								echo "
                              </div>

                              <div class='hidden-md hidden-lg'>
                                <div class='inline pos-rel'>
                                  <button class='btn btn-minier btn-yellow dropdown-toggle' data-toggle='dropdown' data-position='auto'>
                                    <i class='ace-icon fa fa-caret-down icon-only bigger-120'></i>
                                  </button>
 ";
								if($_SESSION['level'] != '1')
								{ 
							
									if ($r['status'] != '4')
									{
							
							echo "
                                  <ul class='dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close'>
                                    
									
                                    <li>
                                      <a href='$aksi?halamane=po&act=clear&id=$r[id_po]' class='tooltip-success' data-rel='tooltip' title='Edit'>
                                        <span class='green'>
                                          <i class='ace-icon fa fa-pencil-square-o bigger-120'></i>
                                        </span>
                                      </a>
                                    </li>

                                    <li>
                                      <a href='$aksi?halamane=po&act=cancel&id=$r[id_po]' class='tooltip-error' data-rel='tooltip' title='Delete'>
                                        <span class='red'>
                                          <i class='ace-icon fa fa-times bigger-120'></i>	
                                        </span>
                                      </a>
                                    </li>
                                  </ul>
								  ";
									}
									else {
									
								}
								}
								
								else {}
								echo "
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
  
    case "tambahpo":
     //GET Kode Otomastis.........
      $query = "select max(no_po) as maksi from tb_po";
      $hasil = mysqli_query($konek, $query);
      $data_oto  = mysqli_fetch_array($hasil);
      $kode_user=buatkode($data_oto['maksi'], 'PURC-PO00', 1);

    echo" <div class='row'>
    <div class='col-xs-12'>
                      <div class='widget-box'>
                        <div class='widget-header'>
                          <h4 class='widget-title'>Form Tambah PO</h4>

                          <div class='widget-toolbar'>
                            <a href='#' data-action='collapse'>
                              <i class='ace-icon fa fa-chevron-up'></i>
                            </a>
                          </div>
                        </div>

                        <div class='widget-body'>
                          <div class='widget-main'>
                          <form method=\"POST\" action=\"\">
                            <div>
                              <label>Nomor PO</label>
                              <input type=\"text\" name=\"no_po\" class='form-control' placeholder=''  value='' >
                            </div>
                            <hr />

                             <div>
                              <label>Supplier</label>
                              <input type=\"text\" name=\"nama_supplier\" class='form-control' placeholder='' >
							    
                            </div>
                            <hr />
						<div class=\"container1\">
                             <div>
                              <label>Nama Item</label>
                              <input type=\"text\" name=\"nama_item[]\" class='form-control' placeholder='Coconut Sugar/Honey/Oil' >
                            </div>
                            <hr />

                            <div>
                              <label>Quantity</label>
                              <input type=\"text\" name=\"qty[]\" class='form-control' placeholder='' >
                            </div>
                            <hr />
							 <div>
                              <label>Unit of Measurement (UOM) </label>
                              <input type=\"text\" name=\"uom[]\" class='form-control' placeholder='KG/Ton/Liter'>
                            </div>
                            <hr />
                       <button class=\"add_form_field\">Add New Field &nbsp; <span style=\"font-size:16px; font-weight:bold;\">+ </span></button> <button class='btn btn-info' type='button' id='btn-reset-form'>
                        <i class='ace-icon fa fa-minus bigger-110'></i>
                      </button>
					  <hr />
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
    </div>"; ?>
     
   <?php break;
    
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


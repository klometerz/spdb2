<?php  
//error_reporting(0);
//export.php  
$konek = mysqli_connect("localhost", "root", "", "crm");
 // include "../../config/koneksi.php";
$output = '';

 $query = "SELECT t_mst_employee.nik, t_mst_employee.nama, t_mst_employee.desc, t_mst_employee.email, t_mst_employee.tglmsk, t_username.username 
From t_mst_employee inner join t_username on t_mst_employee.nik = t_username.nik";
 $result = mysqli_query($konek, $query);

  $output .= '
   <table class="table" bordered="1">  
                    <tr>
                            <td bgcolor="#F5F5F5">No</td>
                            <td bgcolor="#F5F5F5">NIK</td>
                            <td bgcolor="#F5F5F5">Nama</td>
							<td bgcolor="#F5F5F5">Job Desc</td>
                            <td bgcolor="#F5F5F5">Email</td>
							<td bgcolor="#F5F5F5">Join Date</td>
							<td bgcolor="#F5F5F5">Username</td>
                            
							
                          </tr>
  ';
    $no = 1;
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
   <tr>
                            <td class="center">'.$no.'</td>
                            <td>'.$row['nik'].'</td>
                            <td>'.$row['nama'].'</td>
							 <td>'.$row['desc'].'</td>
                            <td>'.$row['email'].'</td>
                            <td>'.$row['tglmsk'].'</td>
                            <td>'.$row['username'].'</td>
                           
								 
                            
                          </tr>
   ';
    $no++;
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=hrd.xls');
  echo $output;
 

?>

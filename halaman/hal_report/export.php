<?php  
//export.php  
//$connect = mysqli_connect("localhost", "root", "", "testing");
  include "../../config/koneksi.php";
$output = '';
if(isset($_POST["post"]))
{
 $query = "SELECT 
tb_trans.no_trans,
tb_trans.tgl_trans,
a.nama_petani as nama_supplier, 
a.desa_petani as desa_supplier, 
a.rtrw_petani as rtrw_petani,
a.kode_petani as kode_petani,
a.type_petani as type_petani,
b.nama_petani as nama_customer, 
tb_detail_trans.nama_item,
tb_detail_trans.uom,
tb_detail_trans.qty, 
tb_detail_trans.kode_produksi 
from tb_detail_trans inner JOIN
tb_trans on tb_detail_trans.id_trans = tb_trans.id_trans
inner join tb_po on tb_po.no_po = tb_trans.no_po 
inner join tb_petani as a on tb_trans.supplier = a.kode_petani
inner join tb_petani as b on tb_trans.customer = b.kode_petani
where tb_trans.no_po = '$_POST[no_po]' and tb_trans.no_urut != ''  order by desa_supplier";
 $result = mysqli_query($konek, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>
                            <td bgcolor="#F5F5F5">No</td>
                            <td bgcolor="#F5F5F5">No. Transaction</td>
                            <td bgcolor="#F5F5F5">Transaction Date</td>
							<td bgcolor="#F5F5F5">Buyer</td>
                            <td bgcolor="#F5F5F5">Supplier Name</td>
							<td bgcolor="#F5F5F5">Supplier Type</td>
							<td bgcolor="#F5F5F5">Supplier Code</td>
                            <td bgcolor="#F5F5F5">Desa</td>
                            <td bgcolor="#F5F5F5">RT/RW</td>
                            <td bgcolor="#F5F5F5">Code Number</td>
                            <td bgcolor="#F5F5F5">Raw Material</td>
							<td bgcolor="#F5F5F5">UOM</td>
							<td bgcolor="#F5F5F5">Qty</td>
							
                          </tr>
  ';
    $no = 1;
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
   <tr>
                            <td class="center">'.$no.'</td>
                            <td>'.$row['no_trans'].'</td>
                            <td>'.$row['tgl_trans'].'</td>
							 <td>'.$row['nama_customer'].'</td>
                            <td>'.$row['nama_supplier'].'</td>
                            <td>'.$row['desa_supplier'].'</td>
                            <td>'.$row['rtrw_petani'].'</td>
                            <td>'.$row['kode_produksi'].'</td>
                            <td>'.$row['nama_item'].'</td>
							  <td>'.$row['uom'].'</td>
							    <td>'.$row['qty'].'</td>
								 
                            
                          </tr>
   ';
    $no++;
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename='.$_POST['no_po'].'.xls');
  echo $output;
 }
}
?>

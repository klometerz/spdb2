<?php
require_once "../../config/koneksi.php";

$tampil=mysqli_query($konek, "SELECT * FROM mesin WHERE id_divisi='$_GET[KoDe_TIPE]'");

$jml=mysqli_num_rows($tampil);
if($jml > 0){
    echo"<select name='id_mesin'>
     <option value='0' selected>- Pilih mesin -</option>";
     while($r=mysqli_fetch_array($tampil)){
         echo "<option value=$r[id_mesin]>$r[nama_mesin]</option>";
     }
     echo "</select>";
}else{
    echo "<select name='id_mesin'>
     <option value=0 selected>- Data Tidak Ada, Pilih Yang Lain -</option>
     </select>";
}

?>
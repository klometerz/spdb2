<?php
session_start();
  include "../../config/koneksi.php";
  include "../../config/library.php";

// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<h1>Untuk mengakses halaman, Anda harus login dulu.</h1><p><a href=\"index.php\">LOGIN</a></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{

?>
<html>
<head>
<title> :: LAPORAN DATA PERAWATAN</title>
<link href="styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<body>
<center>
<h2> LAPORAN DATA PERAWATAN </h2>
<p><?php echo"Range Date : $_POST[dari] s/d $_POST[sampai]";?></p>
</center>
<?php
if($_POST['dari'] !=='' && $_POST['sampai'] !==''){
 $query  = "SELECT * FROM perawatan a
            inner join divisi b using(id_divisi)
      inner join mesin c using(id_mesin) WHERE tgl BETWEEN  '$_POST[dari]' AND '$_POST[sampai]' ORDER BY id_jadwal";
        $tampil = mysqli_query($konek, $query);
}
else {
$query  = "SELECT * FROM perawatan a
            inner join divisi b using(id_divisi)
      inner join mesin c using(id_mesin) ORDER BY id_jadwal";
        $tampil = mysqli_query($konek, $query);
}
echo"<table class='table-list' width='100%' border='0' cellspacing='1' cellpadding='2'>
                        <thead>
                          <tr>
                            <td bgcolor='#F5F5F5'>No</td>
                            <td bgcolor='#F5F5F5'>ID jadwal</td>
                            <td bgcolor='#F5F5F5'>Tanggal</td>
                            <td bgcolor='#F5F5F5'>Nama Divisi</td>
                            <td bgcolor='#F5F5F5'>Nama Mesin</td>
                            <td bgcolor='#F5F5F5'>Point Check</td>
                            <td bgcolor='#F5F5F5'>Tanggal Jadwal</td>
                            <td bgcolor='#F5F5F5'>Status</td>
                          </tr>
                        </thead>
                        <tbody>"; 
            
      $no = 1;
      while ($r=mysqli_fetch_array($tampil)){
        echo "
                          <tr>
                            <td class='center'>$no</td>
                            <td>$r[id_jadwal]</td>
                            <td>$r[tgl]</td>
                            <td>$r[nama_divisi]</td>
                            <td>$r[nama_mesin]</td>
                            <td>$r[point_chek]</td>
                            <td>$r[tgl_jadwal]</td>
                            <td>$r[status]</td>
                            
                          </tr>";
                          $no++;
                         }
                          echo "</tbody>
                      </table>";
?>
<img src="btn_print.png" width="20" onClick="javascript:window.print()" />
</body>
</html>
<?php
  
}
?>
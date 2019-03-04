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
<title> :: KARTU RIWAYAT MESIN</title>
<link href="styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<body>
<center>
<h2> KARTU RIWAYAT MESIN </h2>
<p><?php 
$x=mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM mesin WHERE id_mesin='$_POST[id_mesin]'"));
echo"Nama : $x[nama_mesin]";?></p>
</center>
<?php
$query  = "SELECT * FROM perbaikan a
      inner join mesin b using(id_mesin)
      inner join divisi c using(id_divisi) WHERE id_mesin='$_POST[id_mesin]' ORDER BY nama_mesin";
        $tampil = mysqli_query($konek, $query);

echo"<table class='table-list' width='100%' border='0' cellspacing='1' cellpadding='2'>
                        <thead>
                          <tr>
                            <td bgcolor='#F5F5F5'>No</td>
                            <td bgcolor='#F5F5F5'>Nama Mesin</td>
                            <td bgcolor='#F5F5F5'>Tanggal</td>
                            <td bgcolor='#F5F5F5'>Nama Divisi</td>
                            <td bgcolor='#F5F5F5'>Type Maintenance</td>
                            <td bgcolor='#F5F5F5'>Analisa</td>
                            <td bgcolor='#F5F5F5'>Deskripsi</td>
                            <td bgcolor='#F5F5F5'>Status</td>
                          </tr>
                        </thead>
                        <tbody>"; 
            
      $no = 1;
      while ($r=mysqli_fetch_array($tampil)){
        echo "
                          <tr>
                            <td class='center'>$no</td>
                            <td>$r[nama_mesin]</td>
                            <td>$r[tgl_buat]</td>
                            <td>$r[nama_divisi]</td>
                            <td>Corrective</td>
                            <td>$r[judul]</td>
                            <td>$r[keterangan]</td>
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
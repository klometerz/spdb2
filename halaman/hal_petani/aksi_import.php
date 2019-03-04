	<?php
// menggunakan class phpExcelReader
//error_reporting(0);
include "excel_reader2.php";

// koneksi ke mysql
 include "../../config/koneksi.php";

// membaca file excel yang diupload
$data = new Spreadsheet_Excel_Reader($_FILES['fileexcel']['tmp_name']);

// membaca jumlah baris dari data excel
$baris = $data->rowcount($sheet_index=0);

// nilai awal counter untuk jumlah data yang sukses dan yang gagal diimport
$sukses = 0;
$gagal = 0;

// import data excel mulai baris ke-2 (karena baris pertama adalah nama kolom)
for ($i=2; $i<=$baris; $i++)
{
  // membaca data nim (kolom ke-1)
  $username = $data->val($i, 1);
  // membaca data nama (kolom ke-2)
  $password = ($data->val($i, 2));
  // membaca data alamat (kolom ke-3)
  $name = $data->val($i, 3);
  $position = $data->val($i, 4);
  
  // membaca data nama (kolom ke-2)
  $departement = $data->val($i, 5);
   // membaca data nama (kolom ke-2)
  $level = $data->val($i, 6);
  // membaca data alamat (kolom ke-3)
  $section = $data->val($i, 7);
  $section1 = $data->val($i, 8);
  $section2 = $data->val($i, 9);
  $section3 = $data->val($i, 10);
  $section4 = $data->val($i, 11);
  $section5 = $data->val($i, 12);
  $section6 = $data->val($i, 13);
  $section7 = $data->val($i, 14);
  $section8 = $data->val($i, 15);
  $section9 = $data->val($i, 16);
 

  // setelah data dibaca, sisipkan ke dalam tabel mhs
  $query = "INSERT INTO tb_petani VALUES (NULL, '$username', '$password', '$name', '$position', '$departement', '$level', '$section', '$section1','$section2','$section3','$section4','$section5','$section6','$section7','$section8', '$section9')";
   $hasil = mysqli_query($konek, $query);
    echo mysqli_error($konek);
//echo $query;
  // jika proses insert data sukses, maka counter $sukses bertambah
  // jika gagal, maka counter $gagal yang bertambah
  if ($hasil) $sukses++;
  else $gagal++;
}

// tampilan status sukses dan gagal
//echo $query;
echo "<h3>Proses import data selesai.</h3>";
echo "<p>Jumlah data yang sukses diimport : ".$sukses."<br>";
echo "Jumlah data yang gagal diimport : ".$gagal."</p>";
echo "<a href='../../site.php?halamane=petani'>klik disini untuk kembali</a>";
//echo $query;
?>
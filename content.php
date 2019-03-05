<?php
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<h1>Untuk mengakses halaman, Anda harus login dulu.</h1><p><a href=\"index.php\">LOGIN</a></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session

else{
  include "config/koneksi.php";
  include "config/library.php";

  // Home (Beranda)
  if ($_GET['halamane']=='beranda'){               
    if ($_SESSION['level']=='1' OR $_SESSION['level']=='1' OR $_SESSION['level']=='1'){
      include "halaman/hal_beranda/beranda.php";
    }  
  }
// masih didalam yang ada disana, ngga bakalan tau caranya gimana. 
  // User
  elseif ($_GET['halamane']=='user'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_user/user.php";
    }
  }
   elseif ($_GET['halamane']=='trx_p'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_pengepul/pengepul2.php";
    }
  }
  elseif ($_GET['halamane']=='trx_plantation'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_plantation/plantation2.php";
    }
  }
  elseif ($_GET['halamane']=='trx_p_detail'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_pengepul/aksidetailpengepul.php";
    }
  }
   elseif ($_GET['halamane']=='trx_cpu_detail'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_pengepul/aksidetailcpu.php";
    }
  }
  elseif ($_GET['halamane']=='delete_trans'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_pengepul/aksi_pengepul.php";
    }
  }
     elseif ($_GET['halamane']=='trx_detail_stok_cpu'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_purchasing/aksidetailstokcpu.php";
    }
  }
   elseif ($_GET['halamane']=='trx_p2'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_pengepul/pengepul2_p2.php";
    }
  }
  elseif ($_GET['halamane']=='trx_cpu2'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_pengepul/pengepul2_cpu.php";
    }
  }
   elseif ($_GET['halamane']=='trans_pengepul_petani'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_pengepul/pengepul.php";
    }
  }
  elseif ($_GET['halamane']=='trans_plantation'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_plantation/plantation.php";
    }
  }
    elseif ($_GET['halamane']=='input_transaksi_cpu'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_pengepul/input_transaksi_cpu.php";
    }
  }
   elseif ($_GET['halamane']=='trans_pengepul_pengepul'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_pengepul/pengepul_p2.php";
    }
  }
   elseif ($_GET['halamane']=='trans_po'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_purchasing/trans_po.php";
    }
  }
   elseif ($_GET['halamane']=='transaksi_cpu'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_pengepul/cpu.php";
    }
  }
  elseif ($_GET['halamane']=='transaksi_farm'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_pengepul/transaksi.php";
    }
  }
  elseif ($_GET['halamane']=='order-plantation'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_plantation/transaksi.php";
    }
  }
  elseif ($_GET['halamane']=='transaksi_p2'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_pengepul/transaksi_p2.php";
    }
  }
  elseif ($_GET['halamane']=='trans_cpu'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_pengepul/trans_cpu.php";
    }
  }
  elseif ($_GET['halamane']=='input_transaksi_farm'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_pengepul/input_transaksi_farm.php";
    }
  }
  elseif ($_GET['halamane']=='input_transaksi_plantation'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_plantation/input_transaksi_plantation.php";
    }
  }
    elseif ($_GET['halamane']=='input_transaksi_p2'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_pengepul/input_transaksi_p2.php";
    }
  }
  elseif ($_GET['halamane']=='pengepul'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_pengepul/pengepul.php";
    }
  }
  elseif ($_GET['halamane']=='import'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_petani/import.php";
    }
  }
    elseif ($_GET['halamane']=='forbiden'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_forbiden/index.html";
    }
  }
    elseif ($_GET['halamane']=='po_detail'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_purchasing/po_detail.php";
    }
  }elseif ($_GET['halamane']=='report'){
    if ($_SESSION['level']=='1'){
      include "halaman/hal_report/report.php";
    }
  }
  elseif ($_GET['halamane']=='edit_detail_trans'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_purchasing/edit_detail_trans.php";
    }
  }
  elseif ($_GET['halamane']=='editpo'){
    if ($_SESSION['level']=='1' ){
      include "halaman/hal_purchasing/edit_po.php";
    }
  }
   elseif ($_GET['halamane']=='debug'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_debug/debug.php";
    }
  }
  // Upload Data Petani
  elseif ($_GET['halamane']=='petani'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_petani/petani.php";
    }
  }
    // crop
  elseif ($_GET['halamane']=='crop'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2'){
      include "halaman/hal_crop/crop.php";
    }
  }
      // crop
  elseif ($_GET['halamane']=='input_po'){
    if ($_SESSION['level']=='1'or $_SESSION['level']=='2' ){
      include "halaman/hal_purchasing/input_po.php";
    }
  }
  
   elseif ($_GET['halamane']=='input_detail_po'){
    if ($_SESSION['level']=='1'or $_SESSION['level']=='2' ){
      include "halaman/hal_purchasing/input_detail_po.php";
    }
  }
  elseif ($_GET['halamane']=='input_detail_po_add'){
    if ($_SESSION['level']=='1'or $_SESSION['level']=='2' ){
      include "halaman/hal_purchasing/input_detail_po_add.php";
    }
  }
   elseif ($_GET['halamane']=='input_detail_po1'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2'){
      include "halaman/hal_purchasing/input_detail_po1.php";
    }
  }
     // crop
  elseif ($_GET['halamane']=='transaksi'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_transaksi/transaksi.php";
    }
  }
   elseif ($_GET['halamane']=='prod_kode'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_prod_kode/prod_kode.php";
    }
  }
  // Purchase Order
  elseif ($_GET['halamane']=='po'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2' ){
      include "halaman/hal_purchasing/po.php";
    }
  }

// Divisi
  elseif ($_GET['halamane']=='divisi'){
    if ($_SESSION['level']=='1'){
      include "halaman/hal_divisi/divisi.php";
    }
  }
  
  
  // Vendor
  elseif ($_GET['halamane']=='vendor'){
    if ($_SESSION['level']=='1' or $_SESSION['level']=='2'){
      include "halaman/hal_vendor/vendor.php";
    }
  }
  



  // Apabila halaman tidak ditemukan
  else{
   include "halaman/hal_forbiden/404.html";
  }
}
?>

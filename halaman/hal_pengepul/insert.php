<?php
$connect = mysqli_connect("localhost", "root", "", "spdb");
if(isset($_POST["first_name"], $_POST["last_name"]))
{
$id_trans=$_GET['id'];
 $first_name = mysqli_real_escape_string($connect, $_POST["first_name"]);
 $last_name = mysqli_real_escape_string($connect, $_POST["last_name"]);
 $total = mysqli_real_escape_string($connect, $_POST["total"]);
 $query = "INSERT INTO tb_trx_p_petani_detail(petani, total_qty, total_bag, id_trx, uniqid_trx) VALUES('$first_name', '$last_name','$total','$id_trans', '$id_trans')";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Inserted';
 }
}
?>
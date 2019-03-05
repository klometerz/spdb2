<?php
$connect = mysqli_connect("localhost", "root", "", "spdb");
if(isset($_POST["id"]))
{
 $query = "DELETE FROM tb_trx_p_plantation_detail WHERE id_trx_detail = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Deleted';
 }
}
?>
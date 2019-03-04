<?php
$connect = mysqli_connect("localhost", "root", "", "spdb");
if(isset($_POST["id"]))
{
 $value = mysqli_real_escape_string($connect, $_POST["value"]);
 $query = "UPDATE tb_trx_p_petani_detail SET ".$_POST["column_name"]."='".$value."' WHERE id_trx_detail = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Updated';
 }
 else {
	 echo "Data Failed to updated";
 }
}
?>
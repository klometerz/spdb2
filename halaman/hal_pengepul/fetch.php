<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "spdb");
$columns = array('first_name', 'last_name', 'total');
$id_trans=$_GET['id'];
$query = "SELECT * FROM tb_trx_p_petani_detail where id_trx='".$id_trans."' ";



if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY id_trx_detail DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
	$query_petani = "SELECT * FROM tb_petani where kode_petani='".$row['petani']."'";
 $result_petani = mysqli_query($connect, $query_petani);
 $petani=mysqli_fetch_array($result_petani);
	
 $sub_array = array();
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id_trx_detail"].'" data-column="petani">' . $petani["nama_petani"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id_trx_detail"].'" data-column="total_qty">' . $row["total_qty"] . '</div>';
  $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id_trx_detail"].'" data-column="total_bag">' . $row["total_bag"] . '</div>';
 $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id_trx_detail"].'">Delete</button>';
 $data[] = $sub_array;
}

function get_all_data($connect)
{
	$id_trans=$_GET['id'];
 $query = "SELECT * FROM tb_trx_p_petani_detail where id_trx='".$id_trans."'";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>
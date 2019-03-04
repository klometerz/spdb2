<?php
// Apabila user belum login
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
  echo "<h1>Untuk mengakses halaman, Anda harus login dulu.</h1><p><a href=\"index.php\">LOGIN</a></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  $aksi = "halaman/hal_petani/aksi_petani.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : ''; ?>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
  <style>
  body
  {
   margin:0;
   padding:0;
   background-color:#f1f1f1;
  }
  .box
  {
   width:1270px;
   padding:20px;
   background-color:#fff;
   border:1px solid #ccc;
   border-radius:5px;
   margin-top:25px;
   box-sizing:border-box;
  }
  </style>
  <?php 
  $id_trans=$_GET['id'];
  // data trx petani
$query_sup  = "select * from tb_trx_p_petani where id_trx ='$id_trans'";
							$tampil_sup = mysqli_query($konek, $query_sup);
							 $sup=mysqli_fetch_array($tampil_sup);
							 
  // data profile petani
  $query_petani  = "select * from tb_petani where kode_petani ='$sup[pengepul]'";
							$tampil_petani = mysqli_query($konek, $query_petani);
							 $petani=mysqli_fetch_array($tampil_petani);
							 
			// data jenis raw material
			 $query_crop  = "select * from tb_crop where kode_crop ='$sup[raw_material]'";
							$tampil_crop = mysqli_query($konek, $query_crop);
							 $crop=mysqli_fetch_array($tampil_crop);
  ?>	
  
  <div class='row'>
    <div class='col-xs-12'>
                      <div class='widget-box'>
                        <div class='widget-header'>
                          <h4 class='widget-title'>Nota Pembelian - <?php  echo $crop['nama_crop']; ?> </h4>

                          <div class='widget-toolbar'>
                            <a href='#' data-action='collapse'>
                              <i class='ace-icon fa fa-chevron-up'></i>
                            </a>
                          </div>
                        </div>

                        <div class='widget-body'>
                          <div class='widget-main'>
                          
  <div class="container1">
  <div class="table-responsive">
  <table class="table table-bordered table-stripe">
 <tr> <th>Tanggal</th>
  <th>Raw Material</th>
  <th>Unique ID</th>
  <th>Pengepul</th>
  <th>Desa</th>
  </tr>
  <tr>
  <td><?php echo $sup['tgl_trx']; ?></td>
  <td><?php echo $crop['nama_crop']; ?></td>
  <td><?php echo $sup['uniqid_trx']; ?></td>
  <td><?php echo $petani['nama_petani']; ?></td>
    <td><?php echo $petani['desa_petani']; ?></td>
  </tr>
  </table>
                             <!-- <label>Tanggal</label>
                              <input required="required" type="text" name="tanggal" class='date-picker form-control'  placeholder='' readonly value='<?php echo $_POST['tanggal']; ?>' >
								
                            <hr />

                             <input name="id_trans" value="1" type="hidden"/>
                              <label>Raw Material</label>
                              <input readonly required="required" type="text" name="rm" class='form-control' id="date-picker" placeholder=''  value='<?php echo $_POST['rm']; ?>' >
								
                            <hr /> 
							 <label>Unique ID</label>
                              <input readonly required="required" type="text" name="rm" class='form-control' id="date-picker" placeholder=''  value='<?php echo $_POST['uniqid']; ?>' >
								
                            <hr /> 
							
                              <label>Pengepul</label>
                              <input readonly required="required" list="supplier" type="text" name="pengepul" class='form-control' placeholder='' value="<?php echo $_POST['pengepul']; ?>" >
							    
                    
                            <hr />-->
					
                        
                            

                 

                            
                          </div>
                        </div>
                      </div>
                    </div><!-- /.span -->
    </div>
	</div>
	</div>
  
  
   <br />
  
<div class='row'>
                 
     <div class='col-xs-12'>
	  
    <div align="right">
     <button type="button" name="add" id="add" class="btn btn-info">Add</button>
    </div>
   
    <div id="alert_message"></div>
	<div class="table-responsive">
    <table id="user_data" class="table table-bordered table-stripe">
	
     <thead>
      <tr>
       <th size="50%">Nama Petani</th>
       <th size="45%">Total Qty</th>
	    <th size="45%">Total Kantong</th>
       <th size="5%"></th>
      </tr>
     </thead>
	
    </table>
	</div>
   </div>
   </div>
 
<?php }    
?>

  <?php 
$konek = new PDO("mysql:host=localhost;dbname=spdb", "root", "");
function fill_unit_select_box($konek)
{ 
 $output = '';
 $query = "SELECT * FROM tb_petani where type_petani = 'Petani' ORDER BY id_petani ASC";
 $statement = $konek->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["kode_petani"].'">'.$row["nama_petani"].'</option>';
 }
 return $output;
}
?>
  <script type="text/javascript" language="javascript" >
 $(document).ready(function(){
  
  fetch_data();

  function fetch_data()
  {
   var dataTable = $('#user_data').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
     url:"halaman/hal_pengepul/fetch.php?id=<?php echo $id_trans; ?>",
     type:"POST"
    }
   });
  }
  
  function update_data(id, column_name, value)
  {
   $.ajax({
    url:"halaman/hal_pengepul/update.php",
    method:"POST",
    data:{id:id, column_name:column_name, value:value},
    success:function(data)
    {
     $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
     $('#user_data').DataTable().destroy();
     fetch_data();
    }
   });
   setInterval(function(){
    $('#alert_message').html('');
   }, 5000);
  }

  $(document).on('blur', '.update', function(){
   var id = $(this).data("id");
   var column_name = $(this).data("column");
   var value = $(this).text();
   update_data(id, column_name, value);
  });
  
  $('#add').click(function(){
   var html = '<tr>';
   html += '<td><span><input id="data1" class="form-control" type="text" list="petani"><datalist id="petani"><?php  echo fill_unit_select_box($konek); ?></datalist></span></td>';
   html += '<td contenteditable id="data2"></td>';
    html += '<td contenteditable id="data3"></td>';
   html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
   html += '</tr>';
   $('#user_data tbody').prepend(html);
  });
  
  $(document).on('click', '#insert', function(){
   var first_name = $('#data1').val();
   var last_name = $('#data2').text();
   var total = $('#data3').text();
   if(first_name != '' && last_name != '' && total != '')
   {
    $.ajax({
     url:"halaman/hal_pengepul/insert.php?id=<?php echo $id_trans; ?>",
     method:"POST",
     data:{first_name:first_name, last_name:last_name, total:total},
     success:function(data)
     {
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
   else
   {
    alert("Both Fields is required");
   }
  });
  
  $(document).on('click', '.delete', function(){
   var id = $(this).attr("id");
   if(confirm("Are you sure you want to remove this?"))
   {
    $.ajax({
     url:"halaman/hal_pengepul/delete.php",
     method:"POST",
     data:{id:id},
     success:function(data){
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
  });
 });
 
</script>
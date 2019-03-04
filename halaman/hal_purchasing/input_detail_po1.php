<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<?php 
$connect = new PDO("mysql:host=localhost;dbname=spdb", "root", "");
function fill_unit_select_box($connect)
{ 
 $output = '';
 $query = "SELECT * FROM tb_petani where kode_petani != 'FARM-PO003' ORDER BY id_petani ASC";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["kode_petani"].'">'.$row["nama_petani"].'</option>';
 }
 return $output;
}

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

 <div class='row'>
    <div class='col-xs-12'>
                      <div class='widget-box'>
                        <div class='widget-header'>
                          <h4 class='widget-title'>Form Input Transaction- <?php echo $_GET['id']; ?></h4>

                          <div class='widget-toolbar'>
                            <a href='#' data-action='collapse'>
                              <i class='ace-icon fa fa-chevron-up'></i>
                            </a>
                          </div>
                        </div>

                        <div class='widget-body'>
                          <div class='widget-main'>
                          <form method="POST" action="halaman/hal_purchasing/aksi_detail_po1.php?halamane=input_detail_po">
  <div class="container1">
  <div>
                              <label>Nomor Transaksi</label>
                              <input  type="text" name="no_trans" class='form-control' placeholder=''  value='' >
								
                            <hr />
							<label>Tanggal Transaksi</label>
                              <input  type="date" name="tgl_trans" class='form-control' placeholder=''  value='' >
							   <?php 
							  $id_po =  $_GET['id_po'];
							  	$sql_po  = "SELECT * FROM tb_po where id_po='$id_po'";
            $tampil_po = mysqli_query($konek, $sql_po);
			$data_po = mysqli_fetch_array($tampil_po);
							  ?>
							   <input  type="hidden" name="no_po" class='form-control' placeholder=''  value='<?php echo $data_po['no_po']; ?>' >
							    <input  type="hidden" name="id_trans" class='form-control' placeholder=''  value='<?php echo $_GET['id_trans']; ?>' >
								
                            <hr />

                             
                              <label>Supplier</label>
                              <input list="supplier" type="text" name="nama_supplier" class='form-control' placeholder='' >
							    <datalist id="supplier">
								<?php 
								$query  = "SELECT * FROM tb_petani where kode_petani != 'FARM-PO003' ORDER BY id_petani";
            $tampil = mysqli_query($konek, $query);
            while($r=mysqli_fetch_array($tampil)){
								?>
								<option value="<?php echo $r['kode_petani'];?>">
								<?php echo $r['nama_petani'];  ?> 
								</option>
			<?php }?>
							</datalist>
                      <input  type="hidden" name="nama_customer" class='form-control' placeholder='' value="<?php echo $_GET['id']; ?>">
                            <hr />
						
                            <div class="table-repsonsive">
     <span id="error"></span>
     <table class="table table-bordered" id="item_table">
      <tr>
       <th>Enter Raw Material</th>
       <th>Enter Qty</th>
       <th>UOM</th>
	    <th>Nama Petani</th>
       <th><button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button></th>
      </tr>
     </table>
     <div align="center">
     
     </div>
    </div>
					
                             
                    
	

                            <div class='clearfix form-actions'>
                        <div class='col-md-offset-3 col-md-9'>
                      <input type="submit" name="submit" class="btn btn-info" value="Insert" />

                
                      <button class='btn' type='reset' onclick="self.history.back()">
                        <i class='ace-icon fa fa-undo bigger-110'></i>
                        Reset
                      </button>
                    </div>
                  </div>

                  </form>

                            
                          </div>
                        </div>
                      </div>
                    </div><!-- /.span -->
    </div>
	
	<script>
$(document).ready(function(){
 
 $(document).on('click', '.add', function(){
  var html = '';
  html += '<tr>';
  html += '<td><input type="text" name="item_name[]" class="form-control item_name" /></td>';
  html += '<td><input type="text" name="item_quantity[]" class="form-control item_quantity" /></td>';
  html += '<td><input type="text" name="uom[]" class="form-control uom" /></td>';
  html += '<td><input type="text" list="petani" name="petani[]" class="form-control petani"/><datalist id="petani"><?php echo fill_unit_select_box($connect); ?></datalist></td>';
  html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
  $('#item_table').append(html);
 });
 
 $(document).on('click', '.remove', function(){
  $(this).closest('tr').remove();
 });
 
 $('#insert_form').on('submit', function(event){
  event.preventDefault();
  var error = '';
  $('.item_name').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Enter Item Name at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });
  
  $('.item_quantity').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Enter Item Quantity at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });
  
  $('.uom').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Enter UOM at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });
  $('.petani').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Enter Petani at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });
  var form_data = $(this).serialize();
  if(error == '')
  {
   $.ajax({
    url:"insert.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     if(data == 'ok')
     {
      $('#item_table').find("tr:gt(0)").remove();
      $('#error').html('<div class="alert alert-success">Item Details Saved</div>');
     }
    }
   });
  }
  else
  {
   $('#error').html('<div class="alert alert-danger">'+error+'</div>');
  }
 });
 
});
</script>
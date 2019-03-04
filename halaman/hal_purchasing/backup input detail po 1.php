<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
    var max_fields      = 10;
    var wrapper         = $(".container1"); 
    var add_button      = $(".add_form_field"); 
    
    var x = 1; 
    $(add_button).click(function(e){ 
        e.preventDefault();
        if(x < max_fields){ 
            x++; 
            $(wrapper).append('<div><label><b>Data '+ x + '</b></label></br><label>Nama Item</label> <input type="text" name="nama_item[]" class="form-control" placeholder="Coconut Sugar/Honey/Oil" required="required"><hr /><label>Production Code</label> <input type="text" name="code[]" class="form-control" placeholder="XXXX" required="required"><hr /><label>Quantity</label><input type="text" name="qty[]" class="form-control"  required="required"><hr /><label>Unit of Measurement (UOM) </label><input type="text" name="uom[]" class="form-control" placeholder="KG/Ton/Liter" required="required"> <hr /> <button class="delete" type="button" id="btn-reset-form"><i class="ace-icon fa fa-minus bigger-110"></i></button></div>'); //add input box
        }
		else
		{
		alert('You Reached the limits')
		}
    });
    
    $(wrapper).on("click",".delete", function(e){ 
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script> <div class='row'>
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
                    
                            <hr />
						
                              <input  type="hidden" name="nama_customer" class='form-control' placeholder='' value="<?php echo $_GET['id']; ?>">
							  
					
                         <label><b>Data 1</b></label></br>
                              <label>Nama Item</label>
                              <input type="text" name="nama_item[]" class='form-control' placeholder='Coconut Sugar/Honey/Oil' >
                        
                            <hr />

                      
                              <label>Production Code</label>
                              <input type="text" name="code[]" class='form-control' placeholder='XXXX' >
                          
                            <hr />
							
							 <label>Quantity</label>
                              <input type="text" name="qty[]" class='form-control' placeholder='' >
                          
                            <hr />
						
                              <label>Unit of Measurement (UOM) </label>
                              <input type="text" name="uom[]" class='form-control' placeholder='KG/Ton/Liter'>
                            
                            <hr />
							 <label>Petani</label>
                              <input list="supplier" type="text" name="kode_petani" class='form-control' placeholder='' >
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
                    
                            <hr />
								</div>
                       <button class="add_form_field" type="button">Add New Field &nbsp; <span style="font-size:16px; font-weight:bold;">+ </span></button>
					  <hr />
					
					  </div>	
					
                             
                    
	

                            <div class='clearfix form-actions'>
                        <div class='col-md-offset-3 col-md-9'>
                      <button class='btn btn-info' type='submit'>
                        <i class='ace-icon fa fa-check bigger-110'></i>
                        Submit
                      </button>

                
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
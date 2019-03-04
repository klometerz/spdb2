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
                          <h4 class='widget-title'>Edit Item Purchase Order- <?php echo $_GET['id']; ?></h4>

                          <div class='widget-toolbar'>
                            <a href='#' data-action='collapse'>
                              <i class='ace-icon fa fa-chevron-up'></i>
                            </a>
                          </div>
                        </div>

                        <div class='widget-body'>
                          <div class='widget-main'>
                          <form method="POST" action="halaman/hal_purchasing/aksi_po_detail_add.php?halamane=edit_po&act=edit">
  <div class="container1">
  <div>
                             <?php
							 $id_detail_po = $_GET['id'];
							$sql_trans="select * from tb_detail_po where id_detail_po='$id_detail_po'";
							$query_trans=mysqli_query($konek, $sql_trans);
							$data=mysqli_fetch_array($query_trans);
							 ?>
							 
						
                              <input  type="hidden" name="id_detail_po" class='form-control' placeholder='' value="<?php echo $_GET['id']; ?>">
							  <input  type="hidden" name="id_po" class='form-control' placeholder='' value="<?php echo $_GET['id_po']; ?>">
							  
					
                    
                              <label>Nama Item</label>
                              <input type="text" name="nama_item" class='form-control' placeholder='Coconut Sugar/Honey/Oil' value="<?php  echo $data['nama_item'];?>">
                        
                            <hr />

                      
                              <label>Production Code</label>
                              <input type="text" name="code" class='form-control' placeholder='XXXX' value="<?php echo $data['kode_produksi']; ?>" >
                          
                            <hr />
							
							 <label>Quantity</label>
                              <input type="text" name="qty" class='form-control' placeholder='' value="<?php echo $data['qty']; ?>">
                          
                            <hr />
						
                              <label>Unit of Measurement (UOM) </label>
                              <input type="text" name="uom" class='form-control' placeholder='KG/Ton/Liter' value="<?php echo $data['uom']; ?>">
                            
                            <hr />
								</div>
                       
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
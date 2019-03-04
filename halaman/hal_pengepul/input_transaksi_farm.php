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
            $(wrapper).append('<div><label><b>Data '+ x + '</b></label></br><label>Nama Item</label> <input type="text" name="nama_item[]" class="form-control" placeholder="Coconut Sugar/Honey/Oil" required="required"><hr /><label>Quantity</label><input type="text" name="qty[]" class="form-control"  required="required"><hr /><label>Unit of Measurement (UOM) </label><input type="text" name="uom[]" class="form-control" placeholder="KG/Ton/Liter" required="required"> <hr /> <button class="delete" type="button" id="btn-reset-form"><i class="ace-icon fa fa-minus bigger-110"></i></button></div>'); //add input box
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
</script> 
<div class='row'>
    <div class='col-xs-12'>
                      <div class='widget-box'>
                        <div class='widget-header'>
                          <h4 class='widget-title'>Nota Pembelian Barang Petani</h4>

                          <div class='widget-toolbar'>
                            <a href='#' data-action='collapse'>
                              <i class='ace-icon fa fa-chevron-up'></i>
                            </a>
                          </div>
                        </div>

                        <div class='widget-body'>
                          <div class='widget-main'>
                          <form method="POST" action="?halamane=trans_pengepul_petani">
  <div class="container1">
  <div>
                              <label>Tanggal</label>
                              <input required="required" type="text" name="tanggal" class='date-picker form-control' id="date-picker" placeholder='' value='' >
								
                            <hr />

                             
                              <label>Raw Material</label>
							  <select class ="form-control" name="rm" required>
							  <?php 
							  
								$query_crop  = "select * from tb_crop ";
							$tampil_crop = mysqli_query($konek, $query_crop);
							while($crop=mysqli_fetch_array($tampil_crop))
							{
								echo "<option value='$crop[kode_crop]'>$crop[nama_crop]</option>";
							}
							  
							  ?>
							  </select>
                             
								
                            <hr /> 
							
							
                             <input name="id_trans" value="1" type="hidden"/>
                              <label>Unique ID</label>
                              <input readonly required="required" type="text" name="uniqid" class='form-control' id="date-picker" placeholder=''  value='<?php echo uniqid(); ?>' >
								
                            <hr /> 
							
                              <label>Pengepul</label>
                              <input required="required" list="supplier" type="text" name="pengepul" class='form-control' placeholder='' >
							    <datalist id="supplier">
								<?php 
								$query  = "SELECT * FROM tb_petani where type_petani= 'Pengepul' ORDER BY id_petani";
            $tampil = mysqli_query($konek, $query);
            while($r=mysqli_fetch_array($tampil)){
								?>
								<option value="<?php echo $r['kode_petani'];?>">
								<?php echo $r['nama_petani']; ?>
								</option>
			<?php }?>
							</datalist>
                    
                            <hr />
					
                        
                            <div class='clearfix form-actions'>
                        <div class='col-md-offset-3 col-md-9'>
                      <button class='btn btn-success' type='submit'>
                        <i class='ace-icon fa fa-check bigger-110'></i>
                        Isi Rekap Perolehan
                      </button>

                
                      <button class='btn btn-danger' type='reset' onclick="self.history.back()">
                        <i class='ace-icon fa fa-undo bigger-110'></i>
                        Kembali
                      </button>
                    </div>
                  </div>

                  </form>

                            
                          </div>
                        </div>
                      </div>
                    </div><!-- /.span -->
    </div>
	</div>
	</div>
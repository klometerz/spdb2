<?php
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<h1>Untuk mengakses halaman, Anda harus login dulu.</h1><p><a href=\"index.php\">LOGIN</a></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{

?>

  <div class="row">  
<div class="col-sm-12">  
 <!-- <center><h2>PT. Haldin Pacific Semesta Traceability</h2></center>-->
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="assets/images/gallery/gmb8.jpg" alt="Los Angeles" style="width:100%;">
		 <div class="carousel-caption d-none d-md-block">
    <h4>Lorem Ipsum</h4>
    <p>Dolor Sit Amet</p>
  </div>
      </div>

      <div class="item">
        <img src="assets/images/gallery/gmb9.jpg" alt="Chicago" style="width:100%;">
		  <div class="carousel-caption d-none d-md-block">
    <h4>Lorem Ipsum</h4>
    <p>Dolor Sit Amet</p>
  </div>
      </div>
    
      <div class="item">
        <img src="assets/images/gallery/gmb10.png" alt="New york" style="width:100%;">
		  <div class="carousel-caption d-none d-md-block">
    <h4>Lorem Ipsum</h4>
    <p>Dolor Sit Amet</p>
  </div>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
   </div>     
	</div>		
<div class="row">





									<div class="col-sm-12">
										<h3 class="row header smaller lighter blue">
											<span class="col-xs-6">  <!-- Jam Digital -->
                                 <div id="clockDisplay" class="clockStyle"></div>
<script type="text/javascript" language="javascript">
function renderTime(){
 var currentTime = new Date();
 var h = currentTime.getHours();
 var m = currentTime.getMinutes();
 var s = currentTime.getSeconds();
 if (h == 0){
  h = 24;
   }
   if (h < 10){
    h = "0" + h;
    }
    if (m < 10){
    m = "0" + m;
    }
    if (s < 10){
    s = "0" + s;
    }
 var myClock = document.getElementById('clockDisplay');
 myClock.textContent = h + ":" + m + ":" + s + "";    
 setTimeout ('renderTime()',1000);
 }
 renderTime();
</script>
                                  <!-- Jam Digital --> </span><!-- /.col -->
										</h3>

										<div id="accordion" class="accordion-style1 panel-group">
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">
														<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
															<i class="ace-icon fa fa-angle-down bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
															&nbsp;Introduction
														</a>
													</h4>
												</div>

												<div class="panel-collapse collapse in" id="collapseOne">
													<div class="panel-body">
													<p><b>Traceability</b> adalah suatu kemampuan untuk memverifikasi suatu histori, lokasi ataupun aplikasi sesuatu hal sebagai kesatuan proses utuh yang mengacu ke suatu dokumen rekaman awal.
	
													<br/></p>
													<p>Dalam hal pengukuran, sering dikenal dengan suatu rantai pembuktian keabsahan nilai pembacaan suatu alat ukur dibandigkan dengan suatu nilai standar awal (known standard)
													</p></div>
												</div>
											</div>

											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">
														<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
															<i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
															&nbsp;About Application
														</a>
													</h4>
												</div>

												<div class="panel-collapse collapse" id="collapseTwo">
													<div class="panel-body">
														
														 </div>
												</div>
											</div>

											<!--<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">
														<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
															<i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
															&nbsp;Pricing Application
														</a>
													</h4>
												</div>

												<div class="panel-collapse collapse" id="collapseThree">
													<div class="panel-body">
														We believe you should only have to pay for what you need. For this reason, The Survey System is sold in three editions and a series of optional modules. See the product information pages for detailed descriptions.
														</div>
												</div>
											</div>-->
										</div>
									</div><!-- /.col -->
								</div><!-- /.row -->
                
                <!-- PAGE CONTENT ENDS -->
              </div><!-- /.col -->
            </div><!-- /.row -->
            

<?php
  
}
?>

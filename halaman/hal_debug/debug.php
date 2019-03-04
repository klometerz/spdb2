<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
    background-color: default;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
</style>
</head><?php
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<h1>Untuk mengakses halaman, Anda harus login dulu.</h1><p><a href=\"index.php\">LOGIN</a></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{

?>

               <div class="row">
              <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                 <div class="row">
				 <div class="width-30 label label-info label-xlg arrowed-in arrowed-in-right">
													<div class="inline position-relative">
														<a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
															
															<span class="white">             <script language=JavaScript>var d = new Date();
            var h = d.getHours();
            if (h < 11) { document.write('Selamat pagi, <?php echo $_SESSION['username']; ?>...'); }
            else { if (h < 15) { document.write('Selamat siang, <?php echo $_SESSION['username']; ?>...'); }
            else { if (h < 19) { document.write('Selamat sore, <?php echo $_SESSION['username']; ?>...'); }
            else { if (h <= 23) { document.write('Selamat malam, <?php echo $_SESSION['username']; ?>...'); }
            }}}</script></span>
														</a>

														
													</div>
												</div>
                  <div class="space-6"></div>
				<?php
				$user=mysqli_fetch_array(mysqli_query($konek,"SELECT COUNT(*) as data FROM information_schema.tables WHERE table_schema = 'spdb'"));
				$user1=mysqli_fetch_array(mysqli_query($konek,"SELECT table_schema as DB, 
				ROUND(SUM(data_length + index_length) / 1024 / 1024, 1) 'MB' 
FROM information_schema.tables where table_schema ='spdb' 
GROUP BY table_schema"));
				//$user2=mysqli_num_rows(mysqli_query($konek,"SELECT * FROM user WHERE level='teknisi'"));
				//$mesin=mysqli_num_rows(mysqli_query($konek,"SELECT * FROM mesin"));
				//$divisi=mysqli_num_rows(mysqli_query($konek,"SELECT * FROM divisi"));
				//$perbaikan=mysqli_num_rows(mysqli_query($konek,"SELECT * FROM perbaikan"));
				//$perawatan=mysqli_num_rows(mysqli_query($konek,"SELECT * FROM perawatan"));
				?>
				<div class="tabbable">



<!DOCTYPE html>
<html>
<head>

<body>



<div class="tab">
<?php 

$sql="select * from tb_po";
$query=mysqli_query($konek, $sql);
while ($data=mysqli_fetch_array($query))
{

?>
  <button class="tablinks" onclick="openCity(event, '<?php echo $data['id_po']; ?>')"><?php echo $data['no_po'];?></button>

<?php } ?>
</div>
<?php 

$sql="select * from tb_po";
$query=mysqli_query($konek, $sql);
while ($data=mysqli_fetch_array($query))
{

?>
<div id="<?php echo $data['id_po']; ?>" class="tabcontent">
<a data-toggle="popover" data-container="body" data-placement="bottom" type="button" data-html="true" href="#" id="<?php echo $data['id_po']; ?>"><span class="btn"><?php echo $data['no_po']; ?></span></a>
  <h3><?php echo $data['supplier_name']; ?></h3>
  <p><?php echo $data['id_supplier']; ?> -  <?php echo $data['create_date']; ?></p>
  
</div>

<div id="popover-content-<?php echo $data['id_po']; ?>" class="hide">
      <table class="form-control">
	  <thead>
	  <th> Hi, i am <?php echo strtoupper($data['no_po']); ?> 
	  </th>
	  </thead>
	  </table>
 </div>

<?php } ?>
     
	
 
	 
</body>
</html> 


</div>
                
                 
                </div><!-- /.row -->

                <div class="hr hr32 hr-dotted"></div>
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
<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

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
														 Sistem Informasi Manajemen (SIM) yang menerapkan teknologi informasi sebagai alat bantu mengelola data dan informasi kondisi mesin-mesin yang ada. Sistem Informasi Preventive Maintenance (SIPM) menggabungkan teori preventive maintenance dan sistem database. Proses perancangan software menggunakan metode System Development Life Cycle (SDLC) yang meliputi: plan, analyze, design, implement dan test. SIPM dapat mengelola data dan informasi tentang: mesin, kondisi mesin, teknisi, spare part dan jadwal perawatan dengan mudah, cepat, akurat dan relevan.
														 </div>
												</div>
											</div>

											<div class="panel panel-default">
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
											</div>
										</div>
									</div><!-- /.col -->
								</div><!-- /.row -->
                
                <!-- PAGE CONTENT ENDS -->
              </div><!-- /.col -->
            </div><!-- /.row -->
            

<?php
  
}
?>

<?php
error_reporting(0);
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  include "halaman/hal_forbiden/index.html";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
   $act = isset($_GET['act']) ? $_GET['act'] : ''; 
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title> Traceability</title>
		<meta name="description" content="Static &amp; Dynamic Tables" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="assets/css/chosen.min.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-datepicker3.min.css" />
		<!-- text fonts -->
		<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />
		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<!--[if lte IE 9]>
		<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
		<!--[if lte IE 9]>
		<link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
		<!-- inline styles related to this page -->
		<!-- ace settings handler -->
		<script src="assets/js/ace-extra.min.js"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default          ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class="navbar-header pull-left">
					<a href="?halamane=beranda" class="navbar-brand">
						<small>
							<i class="fa fa-globe"></i>
            Traceability
            
						</small>
					</a>
				</div>
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<?php
            include "config/koneksi.php";

        if ($_SESSION['level']=='1' OR $_SESSION['level']=='2'){
			$user=$_SESSION['auth_code'];
          $jum=mysqli_num_rows(mysqli_query($konek,"SELECT * FROM tb_po WHERE supplier_name='$user' and status ='1'"));
		  $fan=mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM tb_po WHERE supplier_name='$user' and status='1'"));
          if($jum>0){
            $icon="animated";
            $Notifications="$jum Notifications"; }
            else {
              $icon="";
              $Notifications="0 Notifications"; 
            }

          ?>
						<li class="purple dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="?halamane=po_detail&id=<?php echo $fan['id_po']; ?>">
								<i class="ace-icon fa fa-bell icon-
									<?php echo"$icon"; ?>-bell">
								</i>
								<span class="badge badge-important">
									<?php echo"$jum"; ?>
								</span>
							</a>
							<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-exclamation-triangle"></i>
									<?php echo"$Notifications";?>
								</li>
								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar navbar-pink">
										<?php
										
                    $queryX  = "SELECT * FROM tb_po WHERE supplier_name='$user'";
                    $tampilX = mysqli_query($konek, $queryX);
                    while ($r=mysqli_fetch_array($tampilX)){
                    echo" 
										<li>
											<a href='?halamane=po_detail&id=".$r['id_po']."'>
												<div class='clearfix'>
													<span class='pull-left'>
														<i class='btn btn-xs no-hover btn-pink fa fa-comment'></i>
                            $r[no_po]
                          
													</span>
												</div>
											</a>
										</li>";
                    }
                   ?>
									</ul>
								</li>
								<li class="dropdown-footer">
									<a href="?halamane=po">
                    Lihat Semua Purchase Order
                    
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>
						<?php
            include "config/koneksi.php";
          $jumX=mysqli_num_rows(mysqli_query($konek,"SELECT * FROM tb_po WHERE supplier_name='$user' and status='1'"));
          if($jumX>0){
            $NotificationsX="$jum Notifications"; }
            else {
              $NotificationsX="0 Notifications"; 
            }

          ?>
						<li class="green dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-edit"></i>
								<span class="badge badge-green">
									<?php echo"$jumX"; ?>
								</span>
							</a>
							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-check"></i>
									<?php echo"$NotificationsX";?>
								</li>
								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
										<?php
                    $queryX  = "SELECT * FROM tb_po WHERE supplier_name='$user'";
                    $tampilX = mysqli_query($konek, $queryX);
                    while ($r=mysqli_fetch_array($tampilX)){
                    echo" 
										<li>
											<a href='#'>
												<div class='clearfix'>
													<span class='pull-left'>
														<i class='btn btn-xs no-hover btn-purple fa fa-check-square-o'></i>
								$r[no_po]
                          
													</span>
												</div>
											</a>
										</li>";
                    }
                   ?>
									</ul>
								</li>
								<li class="dropdown-footer">
									<a href="?halamane=po">
                    Lihat Semua Transaksi
                    
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>
						<?php } ?>
						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="assets/images/avatars/avatar2.png" alt="<?php echo"$_SESSION[username]"; ?>" />
								<span class="user-info">
									<small>Welcome,</small>
									<?php echo"$_SESSION[username]"; ?>
								</span>
								<i class="ace-icon fa fa-caret-down"></i>
							</a>
							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="#">
										<i class="ace-icon fa fa-user"></i>Profile
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="logout.php">
										<i class="ace-icon fa fa-power-off"></i>Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
			<!-- /.navbar-container -->
		</div>
		<!-- start .nav-list -->
		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
        try{ace.settings.loadState('main-container')}catch(e){}
      </script>
			<div id="sidebar" class="sidebar responsive ace-save-state">
				<script type="text/javascript">
          try{ace.settings.loadState('sidebar')}catch(e){}
        </script>
				<ul class="nav nav-list">
					<li class="">
						<a href="?halamane=beranda">
							<i class="menu-icon fa fa-home"></i>
							<span class="menu-text"> Dashboard </span>
						</a>
						<b class="arrow"></b>
					</li>
					<?php 
					//Admin
					if ($_SESSION['level']=='1'){ ?>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-database"></i>
							<span class="menu-text"> Master </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<li class="">
								<a href="?halamane=user">
									<i class="menu-icon fa fa-caret-right"></i>User
								</a>
								<b class="arrow"></b>
							</li>
							<!-- <li class=""><a href="?halamane=mesin"><i class="menu-icon fa fa-caret-right"></i>Mesin</a><b class="arrow"></b></li> -->
							<!--<li class=""><a href="?halamane=teknisi"><i class="menu-icon fa fa-caret-right"></i>Teknisi</a><b class="arrow"></b></li>-->
							<!--<li class=""><a href="?halamane=status"><i class="menu-icon fa fa-caret-right"></i>Status</a><b class="arrow"></b></li>-->
							<li class="">
								<a href="?halamane=crop">
									<i class="menu-icon fa fa-caret-right"></i>Crop
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="?halamane=petani">
									<i class="menu-icon fa fa-caret-right"></i>Subjects
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="?halamane=import">
									<i class="menu-icon fa fa-caret-right"></i>Import Data Subject
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Traceability </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<li class="">
								<a href="?halamane=po">
									<i class="menu-icon fa fa-caret-right"></i>Purchase Order
								</a>
								<b class="arrow"></b>
							</li>
							<!-- <li class=""><a href="?halamane=transaksi"><i class="menu-icon fa fa-caret-right"></i>Transaction</a><b class="arrow"></b></li> 
							<li class=""><a href="?halamane=prod_kode"><i class="menu-icon fa fa-caret-right"></i>Production Code</a><b class="arrow"></b></li>
							<li class=""><a href="?halamane=pengepul"><i class="menu-icon fa fa-caret-right"></i>Test Pengepul</a><b class="arrow"></b></li>-->
							<!--<li class=""><a href="?halamane=status"><i class="menu-icon fa fa-caret-right"></i>Status</a><b class="arrow"></b></li>-->
							<!-- <li class=""><a href="?halamane=divisi"><i class="menu-icon fa fa-caret-right"></i>Divisi</a><b class="arrow"></b></li>-->
							<!-- <li class=""><a href="?halamane=sparepart"><i class="menu-icon fa fa-caret-right"></i>Sparepart</a><b class="arrow"></b></li>-->
							<!--<li class=""><a href="?halamane=vendor"><i class="menu-icon fa fa-caret-right"></i>Vendor</a><b class="arrow"></b></li>-->
						</ul>
					</li>
					
					
					
					
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-shopping-cart"></i>
							<span class="menu-text"> Transaksi </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<!--<li class="">
								<a href="?halamane=po">
									<i class="menu-icon fa fa-caret-right"></i>PO Report
								</a>
								<b class="arrow"></b>
							</li>-->
							 <li class=""><a href="?halamane=transaksi_farm"><i class="menu-icon fa fa-caret-right"></i>Pembelian Barang PETANI</a><b class="arrow"></b></li> 
							  <li class=""><a href="?halamane=transaksi_p2"><i class="menu-icon fa fa-caret-right"></i>Pembelian Barang PENGEPUL</a><b class="arrow"></b></li>
							  <li class=""><a href="?halamane=transaksi_cpu"><i class="menu-icon fa fa-caret-right"></i>Stok Raw Material CPU</a><b class="arrow"></b></li>
							<!--<li class=""><a href="?halamane=prod_kode"><i class="menu-icon fa fa-caret-right"></i>Production Code</a><b class="arrow"></b></li>-->
							<!--<li class=""><a href="?halamane=status"><i class="menu-icon fa fa-caret-right"></i>Status</a><b class="arrow"></b></li>-->
							<!-- <li class=""><a href="?halamane=divisi"><i class="menu-icon fa fa-caret-right"></i>Divisi</a><b class="arrow"></b></li>-->
							<!-- <li class=""><a href="?halamane=sparepart"><i class="menu-icon fa fa-caret-right"></i>Sparepart</a><b class="arrow"></b></li>-->
							<!--<li class=""><a href="?halamane=vendor"><i class="menu-icon fa fa-caret-right"></i>Vendor</a><b class="arrow"></b></li>-->
						</ul>
					</li>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-file"></i>
							<span class="menu-text"> Report </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<!--<li class="">
								<a href="?halamane=po">
									<i class="menu-icon fa fa-caret-right"></i>PO Report
								</a>
								<b class="arrow"></b>
							</li>-->
							 <li class=""><a href="?halamane=report"><i class="menu-icon fa fa-caret-right"></i>Report By Purchase Order</a><b class="arrow"></b></li> 
							<!--<li class=""><a href="?halamane=prod_kode"><i class="menu-icon fa fa-caret-right"></i>Production Code</a><b class="arrow"></b></li>-->
							<!--<li class=""><a href="?halamane=status"><i class="menu-icon fa fa-caret-right"></i>Status</a><b class="arrow"></b></li>-->
							<!-- <li class=""><a href="?halamane=divisi"><i class="menu-icon fa fa-caret-right"></i>Divisi</a><b class="arrow"></b></li>-->
							<!-- <li class=""><a href="?halamane=sparepart"><i class="menu-icon fa fa-caret-right"></i>Sparepart</a><b class="arrow"></b></li>-->
							<!--<li class=""><a href="?halamane=vendor"><i class="menu-icon fa fa-caret-right"></i>Vendor</a><b class="arrow"></b></li>-->
						</ul>
					</li>
					
					<?php  } ?>
					<?php 
					//CPU
					if ($_SESSION['level']=='2'){ ?>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-database"></i>
							<span class="menu-text"> Master </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<!--<li class="">
								<a href="?halamane=user">
									<i class="menu-icon fa fa-caret-right"></i>User
								</a>
								<b class="arrow"></b>
							</li>-->
							<!-- <li class=""><a href="?halamane=mesin"><i class="menu-icon fa fa-caret-right"></i>Mesin</a><b class="arrow"></b></li> -->
							<!--<li class=""><a href="?halamane=teknisi"><i class="menu-icon fa fa-caret-right"></i>Teknisi</a><b class="arrow"></b></li>-->
							<!--<li class=""><a href="?halamane=status"><i class="menu-icon fa fa-caret-right"></i>Status</a><b class="arrow"></b></li>-->
							<!--<li class="">
								<a href="?halamane=crop">
									<i class="menu-icon fa fa-caret-right"></i>Crop
								</a>
								<b class="arrow"></b>
							</li>-->
							<li class="">
								<a href="?halamane=petani">
									<i class="menu-icon fa fa-caret-right"></i>Subjects
								</a>
								<b class="arrow"></b>
							</li>
							<!--<li class="">
								<a href="?halamane=vendor">
									<i class="menu-icon fa fa-caret-right"></i>Vendor
								</a>
								<b class="arrow"></b>
							</li>-->
						</ul>
					</li>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Traceability </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<li class="">
								<a href="?halamane=po">
									<i class="menu-icon fa fa-caret-right"></i>Purchase Order
								</a>
								<b class="arrow"></b>
							</li>
							 <!--<li class=""><a href="?halamane=transaksi"><i class="menu-icon fa fa-caret-right"></i>Transaction</a><b class="arrow"></b></li> -->
							<!--<li class=""><a href="?halamane=prod_kode"><i class="menu-icon fa fa-caret-right"></i>Production Code</a><b class="arrow"></b></li> -->
							<!--<li class=""><a href="?halamane=status"><i class="menu-icon fa fa-caret-right"></i>Status</a><b class="arrow"></b></li>-->
							<!-- <li class=""><a href="?halamane=divisi"><i class="menu-icon fa fa-caret-right"></i>Divisi</a><b class="arrow"></b></li>-->
							<!-- <li class=""><a href="?halamane=sparepart"><i class="menu-icon fa fa-caret-right"></i>Sparepart</a><b class="arrow"></b></li>-->
							<!--<li class=""><a href="?halamane=vendor"><i class="menu-icon fa fa-caret-right"></i>Vendor</a><b class="arrow"></b></li>-->
						</ul>
					</li>
					<?php  } ?>
					<b class="arrow"></b>
				</li>
			</ul>
		</li>
	</ul>
	<!-- /.nav-list -->
	<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
		<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
	</div>
</div>
<!--isi dari halaman conten -->
<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>
				<li>
					<a href="#">
						<?php echo"".strtoupper($_GET['halamane'])."";?>
					</a>
				</li>
				<li class="active">
					<?php 

              if ($act==''){
                echo"View Data";
              }

              else{
                echo"$act";
              }


              ?>
				</li>
			</ul>
			<!-- /.breadcrumb -->
			<!--<div class="nav-search" id="nav-search"><form class="form-search"><span class="input-icon"><input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" /><i class="ace-icon fa fa-search nav-search-icon"></i></span></form></div>
			<!-- /.nav-search -->
		</div>
		<div class="page-content">
			
			<!-- /.ace-settings-container -->
			
			<!-- /.page-header -->
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<?php include "content.php"; ?>
					<!-- PAGE CONTENT ENDS -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.page-content -->
	</div>
</div>
<!-- /.main-content -->
<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
	<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
</a></div><!-- /.main-container --><!-- basic scripts --><!--[if !IE]> -->
<script src="assets/js/jquery-2.1.4.min.js"></script><!-- undefined<![endif]--><!--[if IE]>undefined<script src="assets/js/jquery-1.11.3.min.js"></script>undefined<![endif]--><script type="text/javascript">
      if('ontouchstart' in document.documentElement) document.write("
<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
    
</script>
<script src="assets/js/bootstrap.min.js"></script>
<!-- page specific plugin scripts -->
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="assets/js/dataTables.buttons.min.js"></script>
<script src="assets/js/buttons.flash.min.js"></script>
<script src="assets/js/buttons.html5.min.js"></script>
<script src="assets/js/buttons.print.min.js"></script>
<script src="assets/js/buttons.colVis.min.js"></script>
<script src="assets/js/dataTables.select.min.js"></script>
<!-- ace scripts -->
<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>
<script src="assets/js/jquery-ui.custom.min.js"></script>
<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="assets/js/chosen.jquery.min.js"></script>
<script src="assets/js/bootstrap-datepicker.min.js"></script>
<script src="assets/js/spinbox.min.js"></script>
<script src="assets/js/bootstrap-timepicker.min.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/daterangepicker.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/js/bootstrap-colorpicker.min.js"></script>
<script src="assets/js/jquery.knob.min.js"></script>
<script src="assets/js/autosize.min.js"></script>
<script src="assets/js/jquery.inputlimiter.min.js"></script>
<script src="assets/js/jquery.maskedinput.min.js"></script>
<script src="assets/js/bootstrap-tag.min.js"></script>
<script>
  $(function () {
    $("#dynamic-table1").DataTable();
  });

  //datepicker plugin
        //link
        $('.date-picker').datepicker({
          autoclose: true,
          todayHighlight: true
        })
        //show datepicker when clicking on the icon
        .next().on(ace.click_event, function(){
          $(this).prev().focus();
        });

  if(!ace.vars['touch']) {
          $('.chosen-select').chosen({allow_single_deselect:true}); 
          //resize the chosen on window resize
      
          $(window)
          .off('resize.chosen')
          .on('resize.chosen', function() {
            $('.chosen-select').each(function() {
               var $this = $(this);
               $this.next().css({'width': $this.parent().width()});
            })
          }).trigger('resize.chosen');
          //resize chosen on sidebar collapse/expand
          $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
            if(event_name != 'sidebar_collapsed') return;
            $('.chosen-select').each(function() {
               var $this = $(this);
               $this.next().css({'width': $this.parent().width()});
            })
          });
      
      
          $('#chosen-multiple-style .btn').on('click', function(e){
            var target = $(this).find('input[type=radio]');
            var which = parseInt(target.val());
            if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
             else $('#form-field-select-4').removeClass('tag-input-style');
          });
        }
</script>
<script>
  $(function () {
    $("#dynamic-table2").DataTable();
  });

  //datepicker plugin
        //link
        $('.date-picker').datepicker({
          autoclose: true,
          todayHighlight: true
        })
        //show datepicker when clicking on the icon
        .next().on(ace.click_event, function(){
          $(this).prev().focus();
        });

  if(!ace.vars['touch']) {
          $('.chosen-select').chosen({allow_single_deselect:true}); 
          //resize the chosen on window resize
      
          $(window)
          .off('resize.chosen')
          .on('resize.chosen', function() {
            $('.chosen-select').each(function() {
               var $this = $(this);
               $this.next().css({'width': $this.parent().width()});
            })
          }).trigger('resize.chosen');
          //resize chosen on sidebar collapse/expand
          $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
            if(event_name != 'sidebar_collapsed') return;
            $('.chosen-select').each(function() {
               var $this = $(this);
               $this.next().css({'width': $this.parent().width()});
            })
          });
      
      
          $('#chosen-multiple-style .btn').on('click', function(e){
            var target = $(this).find('input[type=radio]');
            var which = parseInt(target.val());
            if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
             else $('#form-field-select-4').removeClass('tag-input-style');
          });
        }
</script>
<script>
  $(function () {
    $("#dynamic-table3").DataTable();
  });

  //datepicker plugin
        //link
        $('.date-picker').datepicker({
          autoclose: true,
          todayHighlight: true
        })
        //show datepicker when clicking on the icon
        .next().on(ace.click_event, function(){
          $(this).prev().focus();
        });

  if(!ace.vars['touch']) {
          $('.chosen-select').chosen({allow_single_deselect:true}); 
          //resize the chosen on window resize
      
          $(window)
          .off('resize.chosen')
          .on('resize.chosen', function() {
            $('.chosen-select').each(function() {
               var $this = $(this);
               $this.next().css({'width': $this.parent().width()});
            })
          }).trigger('resize.chosen');
          //resize chosen on sidebar collapse/expand
          $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
            if(event_name != 'sidebar_collapsed') return;
            $('.chosen-select').each(function() {
               var $this = $(this);
               $this.next().css({'width': $this.parent().width()});
            })
          });
      
      
          $('#chosen-multiple-style .btn').on('click', function(e){
            var target = $(this).find('input[type=radio]');
            var which = parseInt(target.val());
            if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
             else $('#form-field-select-4').removeClass('tag-input-style');
          });
        }
</script>
<script>
  $(function () {
    $("#dynamic-table4").DataTable();
  });

  //datepicker plugin
        //link
        $('.date-picker').datepicker({
          autoclose: true,
          todayHighlight: true
        })
        //show datepicker when clicking on the icon
        .next().on(ace.click_event, function(){
          $(this).prev().focus();
        });

  if(!ace.vars['touch']) {
          $('.chosen-select').chosen({allow_single_deselect:true}); 
          //resize the chosen on window resize
      
          $(window)
          .off('resize.chosen')
          .on('resize.chosen', function() {
            $('.chosen-select').each(function() {
               var $this = $(this);
               $this.next().css({'width': $this.parent().width()});
            })
          }).trigger('resize.chosen');
          //resize chosen on sidebar collapse/expand
          $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
            if(event_name != 'sidebar_collapsed') return;
            $('.chosen-select').each(function() {
               var $this = $(this);
               $this.next().css({'width': $this.parent().width()});
            })
          });
      
      
          $('#chosen-multiple-style .btn').on('click', function(e){
            var target = $(this).find('input[type=radio]');
            var which = parseInt(target.val());
            if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
             else $('#form-field-select-4').removeClass('tag-input-style');
          });
        }
</script>
<script>
  $(function () {
    $("#dynamic-table5").DataTable();
  });

  //datepicker plugin
        //link
        $('.date-picker').datepicker({
          autoclose: true,
          todayHighlight: true
        })
        //show datepicker when clicking on the icon
        .next().on(ace.click_event, function(){
          $(this).prev().focus();
        });

  if(!ace.vars['touch']) {
          $('.chosen-select').chosen({allow_single_deselect:true}); 
          //resize the chosen on window resize
      
          $(window)
          .off('resize.chosen')
          .on('resize.chosen', function() {
            $('.chosen-select').each(function() {
               var $this = $(this);
               $this.next().css({'width': $this.parent().width()});
            })
          }).trigger('resize.chosen');
          //resize chosen on sidebar collapse/expand
          $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
            if(event_name != 'sidebar_collapsed') return;
            $('.chosen-select').each(function() {
               var $this = $(this);
               $this.next().css({'width': $this.parent().width()});
            })
          });
      
      
          $('#chosen-multiple-style .btn').on('click', function(e){
            var target = $(this).find('input[type=radio]');
            var which = parseInt(target.val());
            if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
             else $('#form-field-select-4').removeClass('tag-input-style');
          });
        }
</script>
<script>
  $(function () {
    $("#dynamic-table6").DataTable();
  });

  //datepicker plugin
        //link
        $('.date-picker').datepicker({
          autoclose: true,
          todayHighlight: true
        })
        //show datepicker when clicking on the icon
        .next().on(ace.click_event, function(){
          $(this).prev().focus();
        });

  if(!ace.vars['touch']) {
          $('.chosen-select').chosen({allow_single_deselect:true}); 
          //resize the chosen on window resize
      
          $(window)
          .off('resize.chosen')
          .on('resize.chosen', function() {
            $('.chosen-select').each(function() {
               var $this = $(this);
               $this.next().css({'width': $this.parent().width()});
            })
          }).trigger('resize.chosen');
          //resize chosen on sidebar collapse/expand
          $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
            if(event_name != 'sidebar_collapsed') return;
            $('.chosen-select').each(function() {
               var $this = $(this);
               $this.next().css({'width': $this.parent().width()});
            })
          });
      
      
          $('#chosen-multiple-style .btn').on('click', function(e){
            var target = $(this).find('input[type=radio]');
            var which = parseInt(target.val());
            if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
             else $('#form-field-select-4').removeClass('tag-input-style');
          });
        }
</script>
<script>
  $(function () {
    $("#dynamic-table7").DataTable();
  });

  //datepicker plugin
        //link
        $('.date-picker').datepicker({
          autoclose: true,
          todayHighlight: true
        })
        //show datepicker when clicking on the icon
        .next().on(ace.click_event, function(){
          $(this).prev().focus();
        });

  if(!ace.vars['touch']) {
          $('.chosen-select').chosen({allow_single_deselect:true}); 
          //resize the chosen on window resize
      
          $(window)
          .off('resize.chosen')
          .on('resize.chosen', function() {
            $('.chosen-select').each(function() {
               var $this = $(this);
               $this.next().css({'width': $this.parent().width()});
            })
          }).trigger('resize.chosen');
          //resize chosen on sidebar collapse/expand
          $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
            if(event_name != 'sidebar_collapsed') return;
            $('.chosen-select').each(function() {
               var $this = $(this);
               $this.next().css({'width': $this.parent().width()});
            })
          });
      
      
          $('#chosen-multiple-style .btn').on('click', function(e){
            var target = $(this).find('input[type=radio]');
            var which = parseInt(target.val());
            if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
             else $('#form-field-select-4').removeClass('tag-input-style');
          });
        }
</script>
<script>
  $(function () {
    $("#dynamic-table8").DataTable();
  });

  //datepicker plugin
        //link
        $('.date-picker').datepicker({
          autoclose: true,
          todayHighlight: true
        })
        //show datepicker when clicking on the icon
        .next().on(ace.click_event, function(){
          $(this).prev().focus();
        });

  if(!ace.vars['touch']) {
          $('.chosen-select').chosen({allow_single_deselect:true}); 
          //resize the chosen on window resize
      
          $(window)
          .off('resize.chosen')
          .on('resize.chosen', function() {
            $('.chosen-select').each(function() {
               var $this = $(this);
               $this.next().css({'width': $this.parent().width()});
            })
          }).trigger('resize.chosen');
          //resize chosen on sidebar collapse/expand
          $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
            if(event_name != 'sidebar_collapsed') return;
            $('.chosen-select').each(function() {
               var $this = $(this);
               $this.next().css({'width': $this.parent().width()});
            })
          });
      
      
          $('#chosen-multiple-style .btn').on('click', function(e){
            var target = $(this).find('input[type=radio]');
            var which = parseInt(target.val());
            if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
             else $('#form-field-select-4').removeClass('tag-input-style');
          });
        }
</script>
<script>
  $(function () {
    $("#dynamic-table9").DataTable();
  });

  //datepicker plugin
        //link
        $('.date-picker').datepicker({
          autoclose: true,
          todayHighlight: true
        })
        //show datepicker when clicking on the icon
        .next().on(ace.click_event, function(){
          $(this).prev().focus();
        });

  if(!ace.vars['touch']) {
          $('.chosen-select').chosen({allow_single_deselect:true}); 
          //resize the chosen on window resize
      
          $(window)
          .off('resize.chosen')
          .on('resize.chosen', function() {
            $('.chosen-select').each(function() {
               var $this = $(this);
               $this.next().css({'width': $this.parent().width()});
            })
          }).trigger('resize.chosen');
          //resize chosen on sidebar collapse/expand
          $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
            if(event_name != 'sidebar_collapsed') return;
            $('.chosen-select').each(function() {
               var $this = $(this);
               $this.next().css({'width': $this.parent().width()});
            })
          });
      
      
          $('#chosen-multiple-style .btn').on('click', function(e){
            var target = $(this).find('input[type=radio]');
            var which = parseInt(target.val());
            if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
             else $('#form-field-select-4').removeClass('tag-input-style');
          });
        }
</script>
<script>
  $(function () {
    $("#dynamic-table10").DataTable();
  });

  //datepicker plugin
        //link
        $('.date-picker').datepicker({
          autoclose: true,
          todayHighlight: true
        })
        //show datepicker when clicking on the icon
        .next().on(ace.click_event, function(){
          $(this).prev().focus();
        });

  if(!ace.vars['touch']) {
          $('.chosen-select').chosen({allow_single_deselect:true}); 
          //resize the chosen on window resize
      
          $(window)
          .off('resize.chosen')
          .on('resize.chosen', function() {
            $('.chosen-select').each(function() {
               var $this = $(this);
               $this.next().css({'width': $this.parent().width()});
            })
          }).trigger('resize.chosen');
          //resize chosen on sidebar collapse/expand
          $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
            if(event_name != 'sidebar_collapsed') return;
            $('.chosen-select').each(function() {
               var $this = $(this);
               $this.next().css({'width': $this.parent().width()});
            })
          });
      
      
          $('#chosen-multiple-style .btn').on('click', function(e){
            var target = $(this).find('input[type=radio]');
            var which = parseInt(target.val());
            if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
             else $('#form-field-select-4').removeClass('tag-input-style');
          });
        }
</script>
<script>
$("[data-toggle=popover]").each(function(i, obj) {

$(this).popover({
  html: true,
  content: function() {
    var id = $(this).attr('id')
    return $('#popover-content-' + id).html();
  }
});

});
</script>


</body></html><?php } ?>

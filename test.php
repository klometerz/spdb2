<head><link rel="stylesheet" href="assets/css/bootstrap.min.css" />
<style> 
.container {padding:20px;}
.form-control {width:120px;}
.popover {max-width:400px;}

#popover-content-logout > * {
  background-color:#ff0000 !important;
}
<style>
</head>
<body>
<div class="container">
  <h3>Bootstrap 3 Popover HTML Example</h3>
<a data-toggle="popover" data-container="body" data-placement="right" type="button" data-html="true" href="#" id="login"><span class="glyphicon glyphicon-list" style="margin:3px 0 0 0"></span></a>
  
<a data-toggle="popover" data-container="body" data-placement="right" type="button" data-html="true" href="#" id="logout"><span class="glyphicon glyphicon-search" style="margin:3px 0 0 0"></span></a>
  
  <div id="popover-content-logout" class="hide">
      <form class="form-inline" role="form">
        <div class="form-group"> 
          <input class="headerSearch search-query" id="str" name="str" type="text" placeholder="Search..." />
          <span class="glyphicon glyphicon-search" style="margin:3px 8px 0 -20px;"></span>
          <input class="btn btn-primary btn-xs" id="phSearchButton" type="submit" value="Search" /> 
        </div>
      </form>
    </div>
  
    <div id="popover-content-login" class="hide">
      <ul class="list-group">
  <li class="list-group-item">Cras justo odio</li>
  <li class="list-group-item">Dapibus ac facilisis in</li>
  <li class="list-group-item">Morbi leo risus</li>
  <li class="list-group-item">Porta ac consectetur ac</li>
  <li class="list-group-item">Vestibulum at eros</li>
</ul>
    </div>

</div>
</body>
<script style="text/javascript">
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
<script src="assets/js/jquery-2.1.4.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
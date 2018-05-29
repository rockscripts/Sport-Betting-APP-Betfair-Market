<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>LATINGANA</title>
		<meta name="description" content="description">
		<meta name="author" content="DevOOPS">
		<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="<?=base_url()?>template/devoops/plugins/bootstrap/bootstrap.css" rel="stylesheet">
		<link href="<?=base_url()?>template/devoops/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
		<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
		<link href="<?=base_url()?>template/devoops/plugins/fancybox/jquery.fancybox.css" rel="stylesheet">
		<link href="<?=base_url()?>template/devoops/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
		<link href="<?=base_url()?>template/devoops/plugins/xcharts/xcharts.min.css" rel="stylesheet">
		<link href="<?=base_url()?>template/devoops/plugins/select2/select2.css" rel="stylesheet">
		<link href="<?=base_url()?>template/devoops/css/style_admin.css" rel="stylesheet">
		<link href="<?=base_url()?>template/devoops/plugins/DataTablesPro/media/css/jquery.dataTables.css" rel="stylesheet">
		<script src="<?=base_url()?>template/devoops/plugins/DataTablesPro/media/js/jquery.dataTables.js"></script>
		<script>
		var ajax_url = "<?php echo base_url().'index.php/'?>";
		</script>
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
				<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
<body> 
    <header style="background: black;  height: 100px;text-align: left">
        <img src="<?=base_url()?>/logo.png" style="height: 100%;">
    </header>
  <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" style="position: initial!important;" role="navigation">
        <div class="container" style="margin-left: 0px;">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=base_url()?>administrator/auth">Inicio</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
				     <li>
                        <a href="<?=base_url()?>administrator/bettings"><img src="<?=base_url()?>template/devoops/img/money-cion.png" />&nbsp;&nbsp;Apuestas</a>						
                    </li>
				    <li>
                        <a href="<?=base_url()?>administrator/finance/deposits"><img src="<?=base_url()?>template/devoops/img/withdraw-icon.png" />&nbsp;&nbsp;Depositos</a>						
                    </li>
					<li>
                        <a href="<?=base_url()?>administrator/finance/withdraws"><img src="<?=base_url()?>template/devoops/img/withdraw-icon.png" />&nbsp;&nbsp;Retiradas</a>
                    </li>
                    <li>
                        <a href="<?=base_url()?>administrator/finance/suspect_users"><img src="<?=base_url()?>template/devoops/img/fraud-icon.png" />&nbsp;&nbsp;Usuarios Sospechosos</a>
                    </li>					 
                     <li>
                        <a href="<?=base_url()?>administrator/finance/hacienda_users"><img src="<?=base_url()?>template/devoops/img/icon-dian.png" />&nbsp;&nbsp;DIAN-IVA</a>
                    </li>
			 <li>
                        <a href="<?=base_url()?>administrator/finance/ludopatas_users"><img src="<?=base_url()?>template/devoops/img/ludopata-icon.png" />&nbsp;&nbsp;Ludopatas</a>
                    </li>		
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>  

		<!--Start Content-->
		<div id="content" class="col-xs-12 col-sm-10" style="width: 100%!important;">
			
                    <div id="ajax-content">
                     <?=$contents?>
                    </div>
                         <div style="text-align: center">
                    <b>LatinGana Copyright 2015</b>
    </div>
		</div>
           
		<!--End Content-->

<!--End Container-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--<script src="http://code.jquery.com/jquery.js"></script>-->
<script src="<?=base_url()?>template/devoops/plugins/jquery/jquery-2.1.0.min.js"></script>
<script src="<?=base_url()?>template/devoops/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?=base_url()?>template/devoops/plugins/bootstrap/bootstrap.min.js"></script>
<script src="<?=base_url()?>template/devoops/plugins/justified-gallery/jquery.justifiedgallery.min.js"></script>
<script src="<?=base_url()?>template/devoops/plugins/tinymce/tinymce.min.js"></script>
<script src="<?=base_url()?>template/devoops/plugins/tinymce/jquery.tinymce.min.js"></script>
<!-- All functions for this theme + document.ready processing -->

</body>
</html> 


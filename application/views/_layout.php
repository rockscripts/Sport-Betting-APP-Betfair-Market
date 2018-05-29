<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<title>LATINGANA</title>
		<link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
		<meta name="description" content="description">
		<meta name="author" content="DevOOPS">
		<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="<?=base_url()?>template/devoops/plugins/bootstrap/bootstrap.css" rel="stylesheet">
		<link href="<?=base_url()?>template/devoops/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
	<!--	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">-->
		<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
		<link href="<?=base_url()?>template/devoops/plugins/fancybox/jquery.fancybox.css" rel="stylesheet">
		<link href="<?=base_url()?>template/devoops/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
		<link href="<?=base_url()?>template/devoops/plugins/xcharts/xcharts.min.css" rel="stylesheet">
		<link href="<?=base_url()?>template/devoops/plugins/select2/select2.css" rel="stylesheet">
		<link href="<?=base_url()?>template/devoops/css/style.css" rel="stylesheet">
		<link href="<?=base_url()?>template/devoops/plugins/DataTablesPro/media/css/jquery.dataTables.css" rel="stylesheet">
		<script src="<?=base_url()?>template/devoops/plugins/DataTablesPro/media/js/jquery.dataTables.js"></script>
		<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script src="<?=base_url()?>template/devoops/js/freewall.js"></script> 
		
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

</head>
<body>
<?php
if(isset($id_user))
{
	$style_login_widget = "display:none!important;";
	$style_loggedin_widget = "display:block!important;";
}
else
{
	$style_login_widget = "display:block!important;";
	$style_loggedin_widget = "display:none!important;";
}
?>
<div class="loader-image"></div>

<header class="header-top">
<div>
<div class="left" style=" width: auto;max-width: 100%;">
<a href="<?=base_url()?>"><img src="<?=base_url()?>logo.png" style="height: 100%;width: 100%;"></a>
</div>

<div class="right visible-lg log-in-widget" style="<?=$style_login_widget?>">
<div class="boxing1 login">
<div class="box-heading ">
<img src="<?=base_url()?>template/devoops/img/login-icon.png" />&nbsp;&nbsp;Iniciar sesión
</div>
</div>
<a href="<?=base_url()?>account/register_form">
<div class="boxing1 register">
<div class="box-heading">
<img src="<?=base_url()?>template/devoops/img/user-icon.png" />&nbsp;&nbsp;Registrate
</div>
</div>
</a>

</div>

<!--After Login-->
<div class="right visible-lg visible-md logged-in-widget"  style="<?=$style_loggedin_widget?>">
<div class="boxing1 hello-top">
<div class="box-heading ">
Hola, <span id="user_name"><?php if(isset($user)) echo $user->first_name;?></span>
</div>
</div>
<div class="boxing1 balance-top" style="    margin-top: -3px;">
<div class="box-heading">
<img src="<?=base_url()?>template/devoops/img/money-cion.png" />&nbsp;Creditos: &nbsp;$<span id="balance-top"><?php if(isset($user)) echo $user->credits;?></span>
</div>
</div>
<div class="boxing1 balance-top" style="    margin-top: -3px;">
<div class="box-heading">
<a href="<?=base_url()?>account/logout" style="color:red!important;text-shadow:1px 1px black;">Salir</a>&nbsp;|&nbsp;<a href="javascript:void(0);" class="open-betting-layer">Hoja de Apuestas</a>
</div>
</div>
</div>

</div>

</header>
   <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" style="position: initial!important;" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=base_url()?>account">Mi Cuenta</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
				     <li>
                        <a href="<?=base_url()?>bettings"><img src="<?=base_url()?>template/devoops/img/money-cion.png" />&nbsp;&nbsp;Mis Apuestas</a>						
                    </li>
				    <li>
                        <a href="<?=base_url()?>competitions"><img src="<?=base_url()?>template/devoops/img/icon-trofeo.png" />&nbsp;&nbsp;Competiciones & Ligas</a>						
                    </li>
					<li>
                        <a href="javascript:void(0)" competition_name="Internacional" class="International"><img src="<?=base_url()?>template/devoops/img/international-icon.png" />&nbsp;&nbsp;Internacional</a>
                    </li>
                    <li>
                        <a href="<?=base_url()?>events/today"><img src="<?=base_url()?>template/devoops/img/going-play-icon.png" />&nbsp;&nbsp;Partidos de Hoy</a>
                    </li>					 
                    <li>
                        <a href="#">Contactar</a>
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
					<div class="play-content">
                     <?=$contents?>
					 </div>
					
                    </div>
		</div>
		<footer class="footer">
		<ul class="ssc-flnk">
                    <li class="ssc-lw "><a href="http://www.betfair.es/es/conocenos/#politica" class="sscmw">Política de privacidad</a></li>
                    <li class="ssc-lw "><a href="http://www.betfair.es/es/conocenos/#cookies"  class="sscmw">Política de Cookies</a></li>
                    <li class="ssc-lw "><a href="http://www.betfair.es/es/conocenos/#reglas"  class="sscmw">Reglas y Regulaciones</a></li>
                    <li class="ssc-lw "><a href="http://www.betfair.es/es/conocenos/#terminos"  class="sscmw">Términos y condiciones</a></li>                    
                    <li class="ssc-lw  "><a href="http://content.betfair.es/misc/?product=portal&amp;sWhichKey=gamCare&amp;region=GBR&amp;brand=betfair&amp;entrydomain=betfair.es&amp;locale=es" class="sscmw" >Vigilancia a menores</a></li>
					<li class="ssc-lw last"><a href="http://www.betfair.es/es/juegoresponsable/" style="border:none;"  class="sscmw">El juego puede ser adictivo. Por favor, juega con responsabilidad</a></li>
        </ul>
		<div class="footer-bottom">
		<img src="<?=base_url()?>template/devoops/img/logo-small.png"  title="Copyrigtht"/>
		<img src="<?=base_url()?>template/devoops/img/18+.png" style="border-radius:5px;" title="Solo para mayores de 18 años"/>		
		</div>
		</footer>
           
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
<?php
if(isset($international_competitions))
?>
<div class="international-content">
	   <div class="box-information">
	   <?php
	     foreach($international_competitions as $competition)
		 {
			?>
			<a href="<?=base_url()?>events/?cid=<?=$competition->competition_id?>"><div class="box-row"><?=$competition->name?><img style="margin-top:-1px;" src="<?=base_url()?>template/devoops/img/go-icon.png" class="right"/></div></a>
			<?php			
		 }
	   ?>
	   
	   </div>
	   </div>
	   <div class="login-form" style="display:none;">
	   <div class="message-login-form"></div>
	   <form class="form-horizontal bootstrap-validator-form">
	     <div class="form-group">
			<label class="col-sm-3 control-label">Correo eléctronico:</label>
			<div class="col-sm-5">
			<input name="username" id="username" type="text"/>
			<small id="result-username" ></small>
			</div>
	     </div>
		 <div class="form-group">
			<label class="col-sm-3 control-label">Contraseña:</label>
			<div class="col-sm-5">
			<input name="password" id="password" type="password"/>
			<small id="result-password" ></small>
			</div>
	     </div>
		 <div class="form-group">
			<label class="col-sm-3 control-label">Recordarme</label>
			<div class="col-sm-5">
			<input name="recordar" id="recordar" type="checkbox"/>
			</div>
	     </div>
		 <div class="form-group">
		 &nbsp;&nbsp;&nbsp;&nbsp;<a  href="<?=base_url()?>account/forgot_password" >¿Has olvidado tu contraseña?</a>
		 </div>

		 <div class="form-group">
						<div class="col-sm-9 col-sm-offset-3" style="margin-left:0px;">
							<div class="btn btn-primary submit-login"> Iniciar sesión 
			</div>
			<a class="btn btn-default"   href="<?=base_url()?>account/register_form"> Regístrate
			</a>
		   </div>
		</div>
	   </form>
       </div>
	   
	    
	   
<script>
$(document).ready(function() {
    // Optimalisation: Store the references outside the event handler:
   /* var $window = $(window);
    var $pane = $('body');

    function checkWidth() {
        var windowsize = $window.width();
        if (windowsize < 410) {
             wall.fitWidth();
            
        }
    }
	
    // Execute on load
    checkWidth();
    // Bind event listener
    $(window).resize(checkWidth);*/
	
	$(document).on("click",".International",function()
			{	
			  var competition_name = $(this).attr("competition_name");
			  var content = $(".international-content").html();
			  new Messi(content, {title:competition_name , modal: true});
			});
	$(document).on("click",".login",function()
	{	
	  var content = $(".login-form").html();
	  new Messi(content, {title:"Iniciar Sesión" , modal: true});
	});
});

</script>
<script src="<?=base_url()?>template/devoops/js/interfaz.js"></script>
<script type="text/javascript" src="<?= base_url()?>template/devoops/js/jquery.switchButton.js"></script>
<style>
.messi-content form .col-sm-3
{
	    width: 31%;
}
</style>
</html> 


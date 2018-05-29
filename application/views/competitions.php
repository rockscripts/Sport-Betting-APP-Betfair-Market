<script src="<?=base_url()?>template/devoops/plugins/dialog/messi.min.js"></script>
<link rel="stylesheet" href="<?=base_url()?>template/devoops/plugins/dialog/messi.min.css" />
<div id="freewall" class="competitions-content">
<?php
if(sizeof($competitions_grouped)>0)
{
  foreach($competitions_grouped as $competition)
  {
?>
    <div class="boxing brick" country="<?=$competition["country_name"]?>">
	   <div class="box-heading "><img src="<?=base_url()?>country-flags/<?=$competition["ISO"]?>.png" class="flag-country"/>&nbsp;&nbsp;<?=$competition["country_name"]?>&nbsp;&nbsp;<img style="margin-top: 5px;" src="<?=base_url()?>template/devoops/img/go-icon.png" class="right"/></div>
	   <div class="item">
	   <div class="box-information">
	   <?php
	    $competitions = $competition["competitions"];
	     foreach($competitions as $object)
		 {
			?>
			<a href="<?=base_url()?>events/?cid=<?=$object->competition_id?>"><div class="box-row"><?=$object->name?><img style="margin-top:-1px;" src="<?=base_url()?>template/devoops/img/go-icon.png" class="right"/></div></a>
			<?php			
		 }
	   ?>
	   
	   </div>
	   </div>
	</div>
<?php	
  }  
}
 
?>
</div>

<script>
$( document ).ready(function() {
<?php
if(isset($initLogin))
{
?>
var content = $(".login-form").html();
new Messi(content, {title:"Iniciar Sesión" , modal: true});

<?php
}
?>
   var wall = new Freewall("#freewall");
			wall.reset({
				selector: '.brick',
				animate: true,
				cellW: 150,
				cellH: "auto",
				onResize: function() {
					wall.fitWidth();
				}
			});
			
			$(document).on("click",".boxing",function()
			{	
			  var country = $(this).attr("country");
			  var content = $(this).find(".item").html();
			  new Messi(content, {title: country, modal: true});
			});
});
			
</script>
<style>
#freewall {
    display: inline-block;
}
</style>
<script src="<?=base_url()?>template/devoops/plugins/dialog/messi.min.js"></script>
<link rel="stylesheet" href="<?=base_url()?>template/devoops/plugins/dialog/messi.min.css" />
<div Class="head-page-title">
<h1 style="text-align:center"><?=$page_title?></h1>
</div>
<div class="events-vs">	 
  <div  class="box-heading white-back"><?=$market_name?></div>	
  </div>
<div id="freewall" class="events-vs">	 
<?php
if(sizeof($markets)>0)
{
  $CI = & get_instance();
  
  foreach($markets as $market)
  {
	$runners = $market["runners"];	
     for($j=0;$j<sizeof($runners);$j++)
			 {
				 $runner = $runners[$j];
				
				 ?>
				 
				  <div class="boxing brick custom-brick">
	              <div class="box-heading ">
				 <?php					
					 $runner_information = $CI->get_runner($runner["selectionId"]);
					 
					    if(!isset($runner_information->runnerName))
						{
							$CI->update_market_catalog(array($event_id));
							$CI->refresh_page("/?mid=$market_id&eid=$event_id");
						}

					  ?>
						<div class="market-row">
						<div class="runner-name"><?=$runner_information->runnerName?></div>
						
						<?php
						 if(!empty($runner["ex"]["availableToBack"][0]["price"]))
					      {
						 ?>
						  <div class="runner-availableToBack green-back add_selection" available="yes"  id-event="<?=$event_id?>" id-market="<?=$market_id?>"  id-selection="<?=$runner["selectionId"]?>" sname="<?=$runner_information->runnerName?>" sprice="<?=$runner["ex"]["availableToBack"][0]["price"]?>" cname="<?=$market_name?>" ><?=$runner["ex"]["availableToBack"][0]["price"]?></div>
						<?php
						  }
						  else
						  {
						  ?>
						    <div class="runner-availableToBack green-back add_selection" available="no" id-event="<?=$event_id?>" id-market="<?=$market_id?>"  id-selection="<?=$runner["selectionId"]?>" >N/D</div>
						  <?php
						  }
						?>
						
						<!--<div class="runner-availableToLay"><?php //$runner["ex"]["availableToLay"][0]["price"]?></div>-->
						</div>
					<?php
                     					
					
				 ?>
				 </div>
				 </div>
				 <?php
			 }	
  }  
}
else
{
	?>
	  <div  class="box-heading warning-back">No hay ofertas de mercado. Prueba con otro elemento del catálogo.</div>	 
	<?php
}
?>
</div>
<div class="breack"></div>
<div id="freewall1" class="events-vs">
<div  class="box-heading white-back">Catálogo</div>	 
<?php
 foreach($market_catalog as $catalog)
 {
	 if($catalog->marketName!=$page_title)
	 {
?>
<a href="<?=base_url()?>events/bet_on_market/?mid=<?=$catalog->marketId?>&eid=<?=$event_id?>" class="boxing brick brick1"> 
<div class="box-heading"><?=$catalog->marketName?></div>
</a>
<?php
     }
 }
?>
</div>
<script>
$( document ).ready(function() {
   var wall = new Freewall("#freewall");
			wall.reset({
				selector: '.brick',
				animate: true,
				cellW: 50,
				cellH: "auto",
				onResize: function() {
					wall.fitWidth();
				}
			});
			
			$(document).on("click",".boxing",function()
			{	
			 
			  var event_id = $(this).attr("event_id");
			  var event_name = $(this).attr("event_name");
			  var content = $(this).find(".item").html();
			  //new Messi(content, {title: event_name, modal: true});
			});
			
			$(document).on("click",".boxing",function()
			{	
			  selection = $(this).find(".add_selection");
			  var available = selection.attr("available");
			  var id_event = selection.attr("id-event");
			  var id_market = selection.attr("id-market");
			  var id_selection = selection.attr("id-selection");
			  var sname = selection.attr("sname");
			  var sprice = selection.attr("sprice");
			  var cname = selection.attr("cname");
			  if(available=="yes")
			  {
				$.post(ajax_url+"Betttinglayer/add_selection",
				{   
				  eid:id_event,    
				  mid:id_market,
				  sid:id_selection,
				  sname:sname,
				  sprice:sprice,
				  cname:cname
				  
				},
				function(data, status)
				{
					if(data.type=="error")
					{
						
						new Messi(data.betting_layer_template, {title: "Hoja de apuestas", modal: true});
					}
					else
					{
						new Messi(data.betting_layer_template, {title: "Hoja de apuestas", modal: true});																
					}
					   if(data.switch_betting_type=="Simple")
						{
							$(".bet_stake").each(function()
							{
								update_potential($(this));
							});	
						}
							else { update_potential_mixed($(".mixed_bet_stake")); }		 				    
						
				}, "json");  
			  }
			  else
			  {
				  
			  }
			  
			  //new Messi(content, {title: event_name, modal: true});
			});
			
});
			
</script>
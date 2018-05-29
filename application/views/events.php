<script src="<?=base_url()?>template/devoops/plugins/dialog/messi.min.js"></script>
<link rel="stylesheet" href="<?=base_url()?>template/devoops/plugins/dialog/messi.min.css" />
<div Class="head-page-title">
<h1 style="text-align:center"><?=$page_title?></h1>
</div>

<?php
if(empty($events_NONVS) and empty($events_VS))
{
	?>
	  <div  class="box-heading warning-back">No hay catalogo para este evento. Prueba con otro evento del catalogo.</div>	
<?php
}
?>
<div id="freewall" class="nonVSevents">
<?php
if(sizeof($events_NONVS)>0)
{
  foreach($events_NONVS as $event_and_market_catalog)
  {
	$event = $event_and_market_catalog["event"];	  
?>
    <div class="boxing brick" event_id="<?=$event->event_id?>" event_name="<?=$event->name?>">
	   <div class="box-heading "><?=$event->name?></div>
	   <div class="item">
	   <div class="box-information">
	    <h3>Catalogo</h3>
	   <?php
	    $market_catalog = $event_and_market_catalog["market_catalog"];
	     foreach($market_catalog as $catalog)
		 {
			?>
			<a href="<?=base_url()?>events/bet_on_market/?mid=<?=$catalog->marketId?>&eid=<?=$event->event_id?>"><div class="box-row"><?=$catalog->marketName?></div></a>
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
<div id="freewall1" class="events-vs">
<?php
if(sizeof($events_VS)>0)
{
	
  foreach($events_VS as $key=>$event_markets_by_date)
  {
	  ?>
	  <div  class="box-heading white-back"><?=SpanishDate($key)?></div>	 
	  <?php
	 foreach($event_markets_by_date as $key1=>$event_market)
	 {
	  $event = $event_market["event"];
	  ?>
         
    <div class="boxing brick brick1" event_id="<?=$event->event_id?>" event_name="<?=$event->name?>">
	   <?php
	    $parts = explode(" v ", $event->name);
		$parts_date = explode(" ", $event->openDate);
		$parts_date_final = explode(":", $parts_date[1]);		
	   ?>
	   <div class="box-heading "><img style="margin-top: 2px;" src="<?=base_url()?>template/devoops/img/going-play-icon.png" class="left"/>&nbsp;&nbsp;<?=str_replace(" v "," <b>VS</b> ",$event->name)?>  - <span class="date-event"><?=$parts_date_final[0]?>:<?=$parts_date_final[1]?></span></div>
	   <div class="item">
	   <div class="box-information">
	   <h3>Catalogo</h3>
	   <?php
	   $market_catalog = $event_market["market_catalog"];
	   if(sizeof($market_catalog)>0)
	   {
	     foreach($market_catalog as $catalog)
		 {
			?>
			<a href="<?=base_url()?>events/bet_on_market/?mid=<?=$catalog->marketId?>&eid=<?=$event->event_id?>"><div class="box-row"><?=$catalog->marketName?></div></a>
			<?php			
		 }  
	   }
	    else
		{
			?>
	  <div  class="box-heading warning-back">No hay catalogo para este evento. Prueba con otro evento del catalogo.</div>	 
	<?php
		}
	   ?>	   
	   </div>
	   </div>
	</div>
<?php	
   }
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
				cellW: 150,
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
			  event_name = event_name.replace(" v "," VS ");
			  new Messi(content, {title: event_name, modal: true});
			});
});
			
</script>
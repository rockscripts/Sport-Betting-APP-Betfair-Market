<script src="<?=base_url()?>template/devoops/plugins/dialog/messi.min.js"></script>
<link rel="stylesheet" href="<?=base_url()?>template/devoops/plugins/dialog/messi.min.css" />
<div Class="head-page-title">
<h1><?=$page_title?></h1>
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
		$date = new DateTime($event->openDate,new DateTimeZone('Europe/London'));
		$date->setTimezone(new DateTimeZone("America/Bogota")); // +04
		$ColombiaDateTime = $date->format('Y-m-d H:i:s');
		$parts_date = explode(" ",$ColombiaDateTime);
		$parts_date_final = explode(":", $parts_date[1]);		
	   ?>
	   <div class="box-heading "><img style="margin-top: 2px;" src="<?=base_url()?>template/devoops/img/going-play-icon.png" class="left"/>&nbsp;&nbsp;<?=str_replace(" v "," <b>VS</b> ",$event->name)?>  - <span class="date-event"><?=$parts_date_final[0]?>:<?=$parts_date_final[1]?></span></div>
	   <div class="item">
	   <div class="box-information">
	   <h3>Catalogo</h3>
	   <?php
	    $market_catalog = $event_market["market_catalog"];
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
}
else
{
	?>
	  <div  class="box-heading warning-back">No hay ofertas de mercado. Prueba con otro elemento del catalogo.</div>	 
	<?php
}
?>
</div>
<script>
$( document ).ready(function() {
  
			$(document).on("click",".boxing",function()
			{	
			  var event_id = $(this).attr("event_id");
			  var event_name = $(this).attr("event_name");
			  var content = $(this).find(".item").html();
			  new Messi(content, {title: event_name, modal: true});
			});
});
			
</script>
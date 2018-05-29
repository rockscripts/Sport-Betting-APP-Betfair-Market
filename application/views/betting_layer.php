<div class="betting-layer-container">
<div class="loader-image"></div>
<p id="message" style="display:none;" class=""></p>		
<div class="betting-type">
 <p  class="row-partial">
				<label>Tipo de apuesta</label>    
                 <div class="switch_betting_type_container">
<div class="layer-clik"> 
</div>				 
					<span class="field switch_betting_type switch-checkbox">
					 <input type="checkbox" name="switch_betting_type" id="switch_betting_type" value="">
					</span>       
				</div>                                   
			</p>
</div>		                  
<div class="betting-layer">
<?php
if(sizeof($betting_layer_items)>0)
{
	
 	foreach($betting_layer_items as $item)
	{
		
		?>
		<div class="item-box item-box-<?=$item["event_id"]?> item-box-<?=$item["selection_id"]?>">
                    <div class="event-expired">Caducado</div>
		<div class="item-title"><?=$item["event_name"]?> <small class="s_price up right"><?=$item["selection_price"]?></small></div>
		<div class="item-selection-box">
		<div class="item-selection left"><img class="remove-selection" sid="<?=$item["selection_id"]?>" mid="<?=$item["market_id"]?>" src="<?=base_url()?>template/devoops/img/icon-remove.png" />&nbsp;<?=$item["selection_name"]?></div><div class="right bet-stake"><input type="text" id="bet_stake" class="bet_stake" value="<?=$item["bet_stake"]?>" id-event="<?=$item["event_id"]?>" id-market="<?=$item["market_id"]?>" id-selection="<?=$item["selection_id"]?>" sPrice="<?=$item["selection_price"]?>" bet_stake="<?=$item["bet_stake"]?>"/></div>
		</div>
        <div class="item-selection-box">
		<div class="item-selection left"><small  style="color:#999;"><?=$item["catalog_name"]?></small></div><div class="right potential-box"><small id="potential" class="potential" style="color:green;">$<?=$item["potential"]?></small></div>
		</div> 		
		</div>
		<?php
	  
	}
}
?>
</div>
<div class="mixed-container">
<div class="item-selection-box">
		<div class="item-selection left text-custom" >Combinada: </div><div class="right bet-stake" style="width: 61%;"><small class="mixed_total_price up" >0</small><input type="text" id="mixed_bet_stake" class="mixed_bet_stake" value="<?=$mixed_bet["mixed_bet_stake"]?>" style="width: 64%;"/></div>
		</div>
		<div class="item-selection-box">
		<div class="item-selection left"><small>Ganancia</small></div><div class="right potential-box"><small id="potential-mixed"  style="color: green;font-weight: bold;">$0</small></div>
		</div> 
</div>
<div class="betting-layer-buttons-area">
<div class="btn btn-success init-betting">Apostar</div>
<div class="right"><label>Confirmar </label><input type="checkbox" id="init_betting_confirm" name="init_betting_confirm" value=""/></div>
</div>
</div>
<script>
//setInterval(function() {
    //call $.ajax here
	//alert("in")
//}, 5000); //5 seconds
$(document).ready(function(){
	
	  var mixed_bet_stake_value = "<?php echo $mixed_bet["mixed_bet_stake"];?>";
	 var switch_betting_type = "<?php echo $switch_betting_type;?>";
      $("input#switch_betting_type").switchButton({
	  width: 41,
	  height: 14,
	  button_width: 23,
	  on_label: 'Combinada',
	  off_label: 'Simple'
	});
	
	if(switch_betting_type=="Combinada")
	{
		$(".switch-button-label:eq(1)").click();
		$(".bet_stake").fadeOut();
		$(".potential").fadeOut();
		var total_price = parseFloat(0.0);
		if($(".item-box").length>0)
		{			
			$(".item-box").each(function(index)
			{
			  var sprice = parseFloat($(this).find(".s_price").text());	
			  if(index==0)
			  total_price = total_price + sprice;	
		      else
			  total_price = total_price * sprice;	
			});	
		
		}		
		$(".mixed_total_price").text(total_price.toFixed(2));
		$(".mixed-container").fadeIn(); 
		 
	}
	else{
		$(".switch-button-label:eq(0)").click();
		$(".bet_stake").fadeIn();
		$(".mixed-container").fadeOut(); 
	}
	 
	  
$(document).on("blur",".bet_stake",function()
    {
	 update_potential($(this));
	});
		  
$(document).on("blur",".mixed_bet_stake",function()
    {
		update_potential_mixed($(this));
	});
	
	
	
});
function update_potential(element)
	{
	var bet_stake = element.val();
	 var sPrice = element.attr("sPrice");
	 var default_bet_stake = element.attr("bet_stake");

	 if(is_number(bet_stake))
	 {
		if(bet_stake<1000)
		 {
			 element.val(default_bet_stake); 
			 update_potential(element); 
		 }
		 else{
			var potential = bet_stake * sPrice;
			element.closest('div[class^="item-box"]').find(".potential").html("$"+potential.toFixed(0)); 
			var id_selection = element.attr("id-selection");
			var id_market = element.attr("id-market");
			update_bet_selection(id_selection, id_market, bet_stake,potential.toFixed(0),sPrice,"Simple");
		 }		
	 }
	 else
	 {
		if(is_empty_string(bet_stake))
		{
		 	 element.val(default_bet_stake); 
			 element.closest('div[class^="item-box"]').find(".potential").html("$0"); 
			 update_potential(element);
		}	
		else 
		{
		 	bet_stake = bet_stake.replace(/[^\d]/g, '');	
            element.val(bet_stake);
			var potential = bet_stake * sPrice;
			var id_selection = element.attr("id-selection");
			var id_market = element.attr("id-market");
			element.closest('div[class^="item-box"]').find(".potential").html("$"+potential.toFixed(0)); 
			update_bet_selection(id_selection, id_market, bet_stake,potential.toFixed(0),sPrice,"Simple");
			
		}			  
	 }	
	}
	function update_bet_selection(id_selection, id_market, bet_stake,potential, price, type)
	{
	 
		 $.post(ajax_url+"Betttinglayer/update_bet_selection",
	{   
	  sid:id_selection,
          mid:id_market,
	  bet_stake:bet_stake,
	  potential:potential,
	  price:price,
	  type:type
	  
	},
	function(data, status)
	{
	  if(data.betting_layer_items_size==0)
          {
             $(".mixed-container").fadeOut();
          }
    
	}, "json");
	}
	function update_potential_mixed(element)
	{
	 var mixed_bet_stake_value = "<?php echo $mixed_bet["mixed_bet_stake"];?>";
         var bet_stake = element.val();
	 var mPrice = $(".mixed_total_price").html();
	 if(is_number(bet_stake))
	 {
		if(bet_stake<1000)
			{
			 element.val(mixed_bet_stake_value); 
			 update_potential_mixed(element);
			}
			else
			{
				var potential = bet_stake * mPrice;
				$("#potential-mixed").html("$"+potential.toFixed(0));
				update_bet_selection(-1, -1, bet_stake,potential.toFixed(0),mPrice,"Combinada");
			}
	 }
	 else
	 {
		if(is_empty_string(bet_stake))
		{
		 	 element.val(mixed_bet_stake_value); 
			 update_potential_mixed(element);
		}	
		else 
		{
			
			bet_stake = bet_stake.replace(/[^\d]/g, '');	
            element.val(bet_stake);
			var potential = bet_stake * mPrice;
			$("#potential-mixed").html("$"+potential.toFixed(0));
			
		 	
		}		
	  
	 }
	 return false;
	}
	function is_number(x)
{
    var regex=/^[0-9]+$/;
    if (x.match(regex))
    {
        return true;
    }
	else 
		return false;
}
function is_empty_string(str)
{
	if (str.length == 0) 
	{
		return true;
    }
	else
		return false;
}

</script>
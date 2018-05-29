<?php
$CI = & get_instance();
?>
<script src="<?=base_url()?>template/devoops/plugins/dialog/messi.min.js"></script>
<link rel="stylesheet" href="<?=base_url()?>template/devoops/plugins/dialog/messi.min.css" />
<div class="well">
    <div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="box">
                    <?php
                    if(isset($message)):
                        if($message_type=="error"):
                            ?>
                            <p class="bg-warning"><?=$message?></p>
                            <?php
							else:
							?>
                            <p class="bg-success"><?=$message?></p>
                            <?php
                        endif;
                    endif;
                    ?>
			
			<div class="box-content">
				<h1 class="page-header">Mi Apuestas</h1>
                                <label>Tipo:</label>&nbsp;<select class="betting-type-select">
                                    <option value="simple">Simple</option>
                                    <option value="Combinada">Combinada</option>                                    
                                </select>
                                
                 <table id="example" class="display simple-table" cellspacing="0" width="100%">
    <thead>
        <tr>
           <th>Partido</th>
           <th>Ganancia/Perdida</th>	
           <th>Fecha</th>
           <th>Usuario</th>
        </tr>
    </thead>
 
    <tfoot>
        <tr>
         <th>Partido</th>
           <th>Ganancia/Perdida</th>	
           <th>Fecha</th>
            <th>Usuario</th>
        </tr>
    </tfoot>
 
    <tbody>
	<?php
	if(is_array($bettings_simples )):
	 foreach($bettings_simples as $simple):
	 ?>
	 <tr>
             <td><a href="javascript:void(0);" class="open-all-info-betting" selection="<?=$simple->id_user_betting_selection?>"><?=$simple->event_name?></a>
                 <div class="all-info-betting all-info-<?=$simple->id_user_betting_selection?>" style="display:none">
                     <label>Catalogo:</label>&nbsp;<?=$simple->catalog_name?><br>
                     <label>Selecci&oacute;n:</label>&nbsp;<?=$simple->selection_name?><br>
                     <label>Precio:</label>&nbsp;<?=$simple->selection_price?><br>
                     <label>Apostado:</label>&nbsp;$<?=$simple->bet_stake?><br>
                     <label>Potencial:</label>&nbsp;$<?=$simple->potential?><br>
                     <label>Fecha del partido:</label>&nbsp;<?=$simple->event_openDate?><br>
                     <label>Fecha de apuesta:</label>&nbsp;<?=$simple->date_made?><br>
                 </div>
             </td> 
             <td>
                 <?php
                  if($simple->result=="UNKNOWN")
                  {
                      ?>
                  <img src="<?=base_url()?>template/devoops/img/going-play-icon.png" class="left"/>&nbsp;En espera
                 <?php
                  }
                  if($simple->result=="WINNER")
                  {
                     ?>
                 &nbsp;<b style="color:green;    font-size: 20px;">+</b>&nbsp;$<?=$simple->potential?>
                 <?php  
                  }
                  if($simple->result=="LOSER")
                  {
                     ?>
                 &nbsp;<b style="color:red;    font-size: 20px;">-</b>&nbsp;$<?=$simple->bet_stake?>
                 <?php  
                  }
                 ?>
                
             </td>   
            <td><?=$simple->date_made?></td>    
            <td>
              <?php
              $user =  $CI->Account_model->get_user($simple->id_user);
              ?> 
                <a href="<?=base_url()?>administrator/user/?usr=<?=$simple->id_user?>"><?=$user->first_name?></a>  
            </td>
        </tr>
	 <?php
	 endforeach;
	 endif;
	?>
    </tbody>
</table>
                                
<table id="example1" class="display mixed-table" cellspacing="0" width="100%">
    <thead>
        <tr>
           <th>Partidos</th>
           <th>Ganancia/Perdida</th>	
           <th>Fecha</th>
           <th>Usuario</th>
        </tr>
    </thead>
 
    <tfoot>
        <tr>
         <th>Partido</th>
           <th>Ganancia/Perdida</th>	
           <th>Fecha</th>
           <th>Usuario</th>
        </tr>
    </tfoot>
 
    <tbody>
	<?php
        if(isset($bettings_mixed )):
            
	if(is_array($bettings_mixed )):
	 foreach($bettings_mixed as $mixed):
	 ?>
	 <tr>
             <td>
                 <?php
                 $selections =$mixed["selections"] ;
                 $results = array();
                 foreach($selections as $selection):
                   ?>
                 <div>
                     <a href="javascript:void(0);" class="open-all-info-betting" selection="<?=$selection->id_user_betting_selection?>"><?=$selection->event_name?></a>
                     <div class="all-info-betting all-info-<?=$selection->id_user_betting_selection?>"  style="display:none">
                     <label>Catalogo:</label>&nbsp;<?=$selection->catalog_name?><br>
                     <label>Selecci&oacute;n:</label>&nbsp;<?=$selection->selection_name?><br>
                     <label>Precio:</label>&nbsp;<?=$mixed["mixed_total_price"]?><br>
                     <label>Apostado:</label>&nbsp;$<?=$mixed["mixed_bet_stake"]?><br>
                     <label>Potencial:</label>&nbsp;$<?=$mixed["mixed_potential"]?><br>
                     <label>Fecha del partido:</label>&nbsp;<?=$selection->event_openDate?><br>
                     <label>Fecha de apuesta:</label>&nbsp;<?=$mixed["date_made"]?><br>
                     <?php 
                     $results[] =$selection->result;
                     if($selection->result=="UNKNOWN"):                         
                     ?>
                     <label>Resultado:</label>&nbsp;<img src="<?=base_url()?>template/devoops/img/going-play-icon.png" class="left"/>&nbsp;En espera<br>
                     <?php
                     endif;
                     ?>
                     <?php 
                     if($selection->result=="WINNER"):
                     ?>
                     <label>Resultado:</label>&nbsp;<b style="color:green;">Ganador</b><br>
                     <?php
                     endif;
                     ?>
                       <?php 
                     if($selection->result=="LOSER"):
                     ?>
                     <label>Resultado:</label>&nbsp;<b style="color:red;">Perdedor</b><br>
                     <?php
                     endif;
                     ?>
                     <div class="note-selection">
                      <small>
                         <b>Nota: </b>Al pertenecer esta selección en una apuesta combinada, se muestra los valores para Precio, Apostado y Potencial iguales a todas las selecciones de esta apuesta o fila.
                     </small>   
                     </div>
                     
                     </div>
                 </div>
                 <?php
                 endforeach;
                 ?>
                 
                 
                
                 
                 
             </td> 
             <td>
                 <?php
                 
                 if(in_array("UNKNOWN",$results)):
                     ?>
                  <img src="<?=base_url()?>template/devoops/img/going-play-icon.png" class="left"/>&nbsp;En espera</td>
                 <?php
                 endif;
                 if(in_array("LOSER",$results) and !in_array("UNKNOWN",$results)):
                     ?>
                 &nbsp;<b style="color:red;    font-size: 20px;">-</b>&nbsp;$<?=$mixed["mixed_bet_stake"]?>
                 <?php
                  endif;
                     if(!in_array("LOSER",$results) and !in_array("UNKNOWN",$results)):
                      ?>
                 &nbsp;<b style="color:green;    font-size: 20px;">+</b>&nbsp;$<?=$mixed["mixed_potential"]?>
                 <?php
                 endif;
                 ?>
                 
            <td><?=$simple->date_made?></td> 
            <td>
              <?php
              $user =  $CI->Account_model->get_user($simple->id_user);
              ?> 
                <a href="<?=base_url()?>administrator/user/?usr=<?=$simple->id_user?>"><?=$user->first_name?></a>  
            </td>
        </tr>
	 <?php
	 endforeach;
	 endif;
         endif;
	?>
    </tbody>
</table>                                
			</div>
		</div>
	</div>
</div>
</div> 
<script>
    $('#example').DataTable(
            { "order": [[ 2, "desc" ]]});
    $('#example1').DataTable(
            { "order": [[ 2, "desc" ]]});
    $(document).on("click",".open-all-info-betting",function()
    {	
      var selection = $(this).attr("selection");
      var content = $(".all-info-"+selection).html();
      var title = $(this).text();
      new Messi(content, {title: title, modal: true});
    });	
    $( ".betting-type-select" ).change(function() {
      var type = $(this).val();
      if(type=="Combinada")
      {
       $("#example_wrapper").hide(); 
       $("#example1_wrapper").fadeIn(); 
      }
      else
      {
          $("#example1_wrapper").hide(); 
         $("#example_wrapper").fadeIn();  
      }  
          
    });
</script>
<style>
    #example1_wrapper{display:none;}
    </style>
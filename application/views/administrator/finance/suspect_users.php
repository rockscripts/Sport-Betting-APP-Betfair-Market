<script src="<?=base_url()?>template/devoops/plugins/dialog/messi.min.js"></script>
<link rel="stylesheet" href="<?=base_url()?>template/devoops/plugins/dialog/messi.min.css" />
<?php
$CI = & get_instance();
?>
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
				<h1 class="page-header">Usuarios Sospechosos</h1>
                                
                                <p>
                                    <b>Argumentos:</b><br>
                                    <b>1.</b>&nbsp;Si el porcentaje de diferencia entre Depósitos/Retiradas es menor que 40%. ¿Porque quieren retirar casi todo lo depositado? ¿Quieren legalizar divisa?<br>
                                    <b>2.</b>&nbsp;Con base del argumento 1. Si el porcentaje de diferencia entre Retiradas/Ganancias es mayor que 50%. Los usuarios casi no han apostado ¿Porque retiran el dinero?
                                    <br><br>
                                    Para solucionarlo se debe solicitar Cedula y comprobante de domicilio como un recibo de energía/agua escaneada.
                                    <br>
                                    Si se sigue presentando este tipo de actividades seran denunciados ante la autoridad para una investigación.
                                </p>
                 <table id="example" class="display simple-table" cellspacing="0" width="100%">
    <thead>
        <tr>
             <th>Usuario</th>
            <th>Total Depositos</th>
           <th>Total Retiradas</th>
           <th>Ganancias</th>
           <th>Perdidas</th>
           <th>% de diferencia entre Depositos/Retiradas</th>
            <th>% de diferencia entre Retiradas/Ganancias</th>
        </tr>
    </thead>
 
    <tfoot>
        <tr>
             <th>Usuario</th>
          <th>Total Depositos</th>
           <th>Total Retiradas</th>
           <th>Ganancias</th>
           <th>Perdidas</th>
           <th>% de diferencia entre Depositos/Retiradas</th>
            <th>% de diferencia entre Retiradas/Ganancias</th>
            
        </tr>
    </tfoot>
 
    <tbody>
	<?php
	if(is_array($suspect_users )):
	 foreach($suspect_users as $suspect_users):
	 ?>
	 <tr>
             <td>
              <?php
              $user =  $CI->Account_model->get_user($suspect_users->id_user);
              ?> 
                <a href="<?=base_url()?>administrator/user/?usr=<?=$suspect_users->id_user?>"><?=$user->first_name?></a>  
            </td>
             <td>$<?=$suspect_users->deposits_sum?></td> 
             <td>$<?=$suspect_users->withdraws_sum?></td>   
             <td style="color:green;">$<?=$suspect_users->profits_sum?></td>  
            <td style="color:red;">$<?=$suspect_users->losses_sum?></td>    
            <td><b><?=$suspect_users->deposits_withdraws_percent_difference?>%</b></td>  
            <td><b><?=$suspect_users->withdraws_profits_percent_difference?>%</b></td>  
             
        </tr>
	 <?php
	 endforeach;
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
            { "order": [[ 3, "desc" ]]});
</script>
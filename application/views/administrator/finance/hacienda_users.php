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
				<h1 class="page-header">Declaracion de IVA para apostadores</h1>
                                <div style="padding:10px 0px;">
                                    
                                </div>     
                       <label>De:</label> <input type="text" id="fecha_de" name="fecha_de" place-holder="dd/mm/yyyy">
                       <label>Hasta:</label> <input type="text" id="fecha_hasta" name="fecha_hasta" place-holder="dd/mm/yyyy">
                       <div class="btn btn-defaul">Consultar</div>
                        </div>
                            <table id="example" class="display simple-table" cellspacing="0" width="100%">
    <thead>
        <tr>
           <th>Total Ganancias</th>
           <th>Total Perdidas</th>
           <th>Diferencia Ganancias/Perdidas</th>
           <th>IVA</th>
            <th>Valor a declarar</th>
           <th>Usuario</th>
        </tr>
    </thead>
 
    <tfoot>
        <tr>
           <th>Total Ganancias</th>
           <th>Total Perdidas</th>
           <th>Diferencia Ganancias/Perdidas</th>
           <th>IVA</th>
            <th>Valor a declarar</th>
           <th>Usuario</th>
        </tr>
    </tfoot>
 
    <tbody>
	<?php
	if(is_array($hacienda_users )):
	 foreach($hacienda_users as $hacienda_user):
	 ?>
	 <tr>
             <td style="color:green;">$<?=$hacienda_user->profits_sum?></td> 
             <td style="color:red;">$<?=$hacienda_user->losses_sum?></td>   
             <td><b>$<?=$hacienda_user->difference?></b></td>     
             <td>16%</td>  
             <td><b>$<?=$hacienda_user->difference*0.16?></b>&nbsp;<img src="<?=base_url()?>template/devoops/img/icon-dian.png"  title="Minhacienda"/></td>  
             <td>
              <?php
              $user =  $CI->Account_model->get_user($hacienda_user->id_user);
              ?> 
                <a href="<?=base_url()?>administrator/user/?usr=<?=$hacienda_user->id_user?>"><?=$user->first_name?></a>  
            </td>
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
     $(function() {
    $( "#fecha_de" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  yearRange: '2014:2020',
           dateFormat: 'yy-mm-dd'
    });
  });	
   $(function() {
    $( "#fecha_hasta" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  yearRange: '2014:2020',
           dateFormat: 'yy-mm-dd'
    });
  });	
</script>
<style>
    .ui-datepicker-title select{
        color:black;
    }
    </style>
    
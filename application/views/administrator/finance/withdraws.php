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
				<h1 class="page-header">Retiradas</h1>
                                
                                
                 <table id="example" class="display simple-table" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Método</th>
           <th>Valor</th>
           <th>Costo de envío</th>
           <th>Fecha</th>
           <th>Usuario</th>
        </tr>
    </thead>
 
    <tfoot>
        <tr>
         <th>Método</th>
           <th>Valor</th>
           <th>Costo de envío</th>
           <th>Fecha</th>
           <th>Usuario</th>
        </tr>
    </tfoot>
 
    <tbody>
	<?php
	if(is_array($withdraws )):
	 foreach($withdraws as $withdraw):
	 ?>
	 <tr>
             <td><?=$withdraw->method?></td> 
             <td>$<?=$withdraw->ammount?></td>   
             <td>$<?=$withdraw->shipping_cost?></td>  
            <td><?=$withdraw->date?></td>    
             <td>
              <?php
              $user =  $CI->Account_model->get_user($withdraw->id_user);
              ?> 
                <a href="<?=base_url()?>administrator/user/?usr=<?=$withdraw->id_user?>"><?=$user->first_name?></a>  
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
</script>
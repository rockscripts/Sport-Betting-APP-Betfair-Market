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
				<h1 class="page-header">Depositos</h1>
                                
                                
                 <table id="example" class="display simple-table" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Método</th>
           <th>Valor</th>	
           <th>Fecha</th>
           <th>Usuario</th>
        </tr>
    </thead>
 
    <tfoot>
        <tr>
         <th>Método</th>
           <th>Valor</th>	
           <th>Fecha</th>
           <th>Usuario</th>
        </tr>
    </tfoot>
 
    <tbody>
	<?php
	if(is_array($deposits )):
	 foreach($deposits as $deposit):
	 ?>
	 <tr>
             <td><?=$deposit->method?></td> 
             <td>$<?=$deposit->ammount?></td>   
            <td><?=$deposit->date?></td> 
            <td>
              <?php
              $user =  $CI->Account_model->get_user($deposit->id_user);
              ?> 
                <a href="<?=base_url()?>administrator/user/?usr=<?=$deposit->id_user?>"><?=$user->first_name?></a>  
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
            { "order": [[ 2, "desc" ]]});
    
</script>
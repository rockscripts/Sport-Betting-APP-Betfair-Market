<script src="<?=base_url()?>template/devoops/plugins/dialog/messi.min.js"></script>
<link rel="stylesheet" href="<?=base_url()?>template/devoops/plugins/dialog/messi.min.css" />
<div class="tabs-header">
     <a class="boxing brick " href="<?=base_url()?>account">
         <div class="box-heading "><img src="<?=base_url()?>template/devoops/img/user-icon.png"/>&nbsp;&nbsp;Mi cuenta</div>
     </a>
    <div class="boxing brick active-tab" >  
        <div class="box-heading "><img src="<?=base_url()?>template/devoops/img/money-cion.png"/>&nbsp;&nbsp;Depositos</div>
    </div>
    <a class="boxing brick" href="<?=base_url()?>account/withdraws">  
        <div class="box-heading "><img src="<?=base_url()?>template/devoops/img/withdraw-icon.png"/>&nbsp;&nbsp;Retiradas</div>
    </a>
</div>
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
				<h1 class="page-header">Mis depositos</h1>
                                
                                
                 <table id="example" class="display simple-table" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Método</th>
           <th>Valor</th>	
           <th>Fecha</th>
        </tr>
    </thead>
 
    <tfoot>
        <tr>
         <th>Método</th>
           <th>Valor</th>	
           <th>Fecha</th>
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
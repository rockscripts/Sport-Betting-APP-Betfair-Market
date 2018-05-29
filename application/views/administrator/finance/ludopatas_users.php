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
				<h1 class="page-header">Usuarios Ludopatas</h1>
                                <div style="padding:10px 0px;">
                                    
                                </div>     
                     
                        </div>
                            <table id="example" class="display simple-table" cellspacing="0" width="100%">
    <thead>
        <tr>
           <th>Perdidas</th>
           <th>F. bloqueo</th>
           <th>F. a desbloquear</th>
           <th>Usuario</th>
        </tr>
    </thead>
 
    <tfoot>
        <tr>
           <th>Perdidas</th>
           <th>F. bloqueo</th>
           <th>F. a desbloquear</th>
           <th>Usuario</th>
        </tr>
    </tfoot>
 
    <tbody>
	<?php
	if(is_array($ludopatas_users )):
	 foreach($ludopatas_users as $ludopata_user):
	 ?>
	 <tr>
             <td style="color:red;">$<?=$ludopata_user->losses?></td>   
             <td><?=$ludopata_user->date_bloqued?></td> 
             <td><?=$ludopata_user->date_unblock?></td> 
             <td>
              <?php
              $user =  $CI->Account_model->get_user($ludopata_user->id_user);
              ?> 
                <a href="<?=base_url()?>administrator/user/?usr=<?=$ludopata_user->id_user?>"><?=$user->first_name?></a>  
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
    
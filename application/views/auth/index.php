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
				<h4 class="page-header"><?php echo lang('index_heading');?></h4>
				<div><select id="create">
				<option value="user">Create</option>
				<option value="user">User</option>
				<option value="group">Group</option>
				</select>
				</div>
				<br>
                 <table id="example" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Nombres y Apellidos</th>
            <th>Cédula</th>
            <th>Celular</th>
            <th>C. Eléctronico</th>
            <th>Grupos</th>		
            <th>Estado</th>	
            <th>Acciones</th>
			
        </tr>
    </thead>
 
    <tfoot>
        <tr>
            <th>Nombres y Apellidos</th>
            <th>Cédula</th>
            <th>Celular</th>
            <th>C. Eléctronico</th>
            <th>Grupos</th>		
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </tfoot>
 
    <tbody>
	<?php
	if(is_array($users)):
	 foreach($users as $user):
	 ?>
	 <tr class="row-<?=$user->id?>">
	    <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8')." ".htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($user->cedula,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($user->phone,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
            <td>
                <?php foreach ($user->groups as $group):?>
                <?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
                <?php endforeach?>
            </td>
	    <td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, "Activar") : anchor("auth/activate/". $user->id, "Desactivar");?></td>         	
            <td>
                <a href="<?=base_url()?>administrator/finance/deposits/?usr=<?=$user->id?>">Depositos</a><br>
                <a href="<?=base_url()?>administrator/finance/withdraws/?usr=<?=$user->id?>">Retiradas</a><br>
                <a href="<?=base_url()?>administrator/bettings/?usr=<?=$user->id?>">Apuestas</a><br>
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
    $('#example').DataTable();
</script>

<script src="<?=base_url()?>template/devoops/plugins/dialog/messi.min.js"></script>
<link rel="stylesheet" href="<?=base_url()?>template/devoops/plugins/dialog/messi.min.css" />
<div Class="head-page-title">
</div>
 <div class="register-form">
					 <div class="white-back page-content">
	   <form class="form-horizontal bootstrap-validator-form">
	   <div class="form-group">
			<h3>Datos Personales</h3>
	     </div>
	     <div class="form-group">
			<label class="col-sm-3 control-label">Nombres:</label>
			<div class="col-sm-5">
			<input name="first_name" id="first_name" type="text"/>
			<small id="result-first_name" ></small>
			</div>
	     </div>
		 <div class="form-group">
			<label class="col-sm-3 control-label">Apellidos:</label>
			<div class="col-sm-5">
			<input name="last_name" id="last_name" type="text"/>
			<small id="result-last_name" ></small>
			</div>
	     </div>
		  <div class="form-group">
			<label class="col-sm-3 control-label">Cédula:</label>
			<div class="col-sm-5">
			<input name="cedula" id="cedula" type="text"/>
			<small id="result-cedula" ></small>
			</div>
	     </div>
		 <div class="form-group">
			<label class="col-sm-3 control-label">Fecha de nacimiento:</label>
			<div class="col-sm-5">
			<input type="text" id="fecha_nacimiento" name="fecha_nacimiento" place-holder="dd/mm/yyyy">
			<small id="result-fecha_nacimiento" ></small>
			</div>
	     </div>
		  <div class="form-group">
			<h3>Identificación</h3>
	     </div>
		  <div class="form-group">
			<label class="col-sm-3 control-label">Correo electrónico:</label>
			<div class="col-sm-5">
			<input name="email" id="email" type="text"/>
			<small id="result-email" ></small>
			</div>
	     </div>
		 <div class="form-group">
			<label class="col-sm-3 control-label">Contraseña:</label>
			<div class="col-sm-5">
			<input name="contrasena" id="contrasena" type="password"/>
			<small id="result" ></small>
			</div>
	     </div>
		  <div class="form-group">
			<h3>Domicilio y contacto</h3>
	     </div>
		 <div class="form-group">
			<label class="col-sm-3 control-label">Celular:</label>
			<div class="col-sm-5">
			<input name="phone" id="phone" type="text"/>
			<small id="result-phone" ></small>
			</div>
	     </div>
		 <div class="form-group">
			<label class="col-sm-3 control-label">Departamento:</label>
			<div class="col-sm-5">
			<select id="departamento">
			<option value="select">Seleccione</option>
			<?php
			if(sizeof($departamentos)>0)
			{
				foreach($departamentos as $departamento):
			  ?>
			   <option value="<?=$departamento->id_departamento?>"><?=ucfirst(mb_strtolower($departamento->nombre,"UTF-8"));?></option>
			  <?php
			  endforeach;
			}			
			?>			
			</select>
			<small id="result-departamento" ></small>
			</div>
	     </div>
		 <div class="form-group">
			<label class="col-sm-3 control-label">Municipio:</label>
			<div class="col-sm-5">
			<select id="municipio" style="min-width:158px;">
			<option value="select">Seleccione</option>
			</select>
			<small id="result-municipio" ></small>
			</div>
	     </div>
		 <div class="form-group">
			<label class="col-sm-3 control-label">Ciudad:</label>
			<div class="col-sm-5">
			<input name="ciudad" id="ciudad" type="text"/>
			<small id="result-ciudad" ></small>
			</div>
	     </div>
		 <div class="form-group">
			<label class="col-sm-3 control-label">Dirección:</label>
			<div class="col-sm-5">
			<input name="direccion" id="direccion" type="text"/>
			<small id="result-direccion" ></small>
			</div>
	     </div>
		 <div class="form-group">
			<div class="col-sm-9 col-sm-offset-3" style="margin-left:0px;">
			  <div class="btn btn-primary submit-user"> <img src="<?=base_url()?>template/devoops/img/login-icon.png" /> Aceptar y abrir cuenta 
			</div>
		   </div>
		</div>
	   </form>
	   </div>
       </div>

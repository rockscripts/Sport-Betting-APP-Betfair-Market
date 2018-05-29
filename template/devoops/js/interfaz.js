$( document ).ready(function() 
{
	
	$(document).on("click",".init-betting",function()
    {
		var  confirm_checkbox = $("#init_betting_confirm").is(':checked');
		if(!confirm_checkbox)
		{
			$("#message").html("Por favor, confirma la apuesta.");
			$("#message").removeClass("bg-success");						
			$("#message").addClass("bg-warning");
			$("#message").fadeIn().fadeOut(5000);
			$("#message").focus();
		}
		else
		{
                    $(".messi").find(".loader-image").fadeIn();
			 $.post(ajax_url+"Betttinglayer/place_bet",
				{  
				 
				},
				function(data, status)
				{ 
					  if(data.type=="error")
					  {
                                            $("#message").html(data.message);
                                            $("#message").removeClass("bg-success");						
                                            $("#message").addClass("bg-warning");
                                            $("#message").fadeIn().fadeOut(10000);
                                            $("#message").focus();
                                            if (typeof data.events_expired !== 'undefined')
                                            {
                                               $.each( data.events_expired, function( key, value ) 
                                               {
                                                $(".item-box-"+value).find(".event-expired").fadeIn();
                                                $(".item-box-"+value).fadeOut(9000, function()
                                                {
                                                 $(this).find(".remove-selection").click();
                                                 $("#message").fadeoOut("fast");
                                                });
                                               });
                                            }
                                            if (typeof data.selections_price_updated !== 'undefined')
                                            {
                                              $.each( data.selections_price_updated, function( key, value ) 
                                               {
                                               $(".item-box-"+value.selection_id).find(".s_price").html(value.new_price);
                                               $(".item-box-"+value.selection_id).find(".s_price").css("background",value.style);
                                               $(".item-box-"+value.selection_id).find(".bet_stake").attr("sprice",value.new_price)
                                               update_potential($(".item-box-"+value.selection_id).find(".bet_stake"));
                                               update_potential_mixed_after($(".mixed_bet_stake"));  
                                               });
                                            }
					  }
					  else
					  {
                                            $('.messi-modal').remove();
					    $('.messi').remove();	
					    new Messi(data.message, {title: "Hoja de Apuestas", modal: true,titleClass: 'anim success',});
					  }
                                           $(".messi").find(".loader-image").fadeOut();
				}, "json");  	
		}
	 
	});
		$(document).on("click",".open-betting-layer",function()
    {		
	  $.post(ajax_url+"Betttinglayer/open_betting_layer",
				{  
				
				},
				function(data, status)
				{
						new Messi(data.betting_layer_template, {title: "Hoja de apuestas", modal: true});		
					if(data.switch_betting_type=="Simple")
						{
							$(".bet_stake").each(function()
							{
								update_potential($(this));
							});	
						}
							else { update_potential_mixed($(".mixed_bet_stake")); }		 
				}, "json");  	
	});
	$(document).on("click",".switch_betting_type_container",function()
    {
		var switch_betting_type = jQuery(".switch_betting_type").find(".on").text(); 
		if(switch_betting_type=="Combinada")
		{
		  $(".switch-button-label:eq(0)").click();
		}		
	    else
		{
		  $(".switch-button-label:eq(1)").click();
	    }
		var switch_betting_type = jQuery(".switch_betting_type").find(".on").text(); 
	
		$.post(ajax_url+"Betttinglayer/set_betting_type",
				{   
				  betting_type:switch_betting_type				  
				},
				function(data, status)
				{
				  if(data.betting_type=="Combinada")
					{
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
					update_potential_mixed($(".mixed_bet_stake"));
					$(".mixed-container").fadeIn(); 
					}		
					else
					{
					   $(".bet_stake").fadeIn();
					   $(".potential").fadeIn();
					   $(".mixed-container").fadeOut(); 
					}
				}, "json");  
				
	});
	$(document).on("click",".remove-selection",function()
    {
	 var sid = $(this).attr("sid");
	 var mid = $(this).attr("mid");
	 var icon_delete = $(this);
	 $.post(ajax_url+"Betttinglayer/remove_selection",
				{   
				  sid:sid,
                  mid:mid				  
				},
				function(data, status)
				{
				 	if(data.type=="error")
					{
						$("#message").html(data.message);
						$("#message").removeClass("bg-success");						
						$("#message").addClass("bg-warning");
						$("#message").fadeIn().fadeOut(5000);
						$("#message").focus();
					}
					else 
					{
						icon_delete.closest('div[class^="item-box"]').remove();
						if(data.betting_type=="Combinada")
						{
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
							update_potential_mixed($(".mixed_bet_stake"));
						}
						else
						{
							$(".bet_stake").each(function()
							{
								update_potential($(this));
							});	
						}						
						//alert(data.sizeofitems)
						if(data.sizeofitems==0)
						$(".betting-layer").html("Hoja de apuestas vac&iacute;a. <br>A&ntilde;ade selecciones en las p&aacute;ginas de mercado.");
					
						$("#message").html(data.message);
						$("#message").addClass("bg-success");
						$("#message").removeClass("bg-warning");
						$("#message").fadeIn().fadeOut(2500);	
                                                $("#message").focus();					
					}
					
					return false;
				}, "json");
	});
	
$('#contrasena').keyup(function()
{
	    var result = checkStrength($('#contrasena').val())
        $('#result').html(result);
    }) 
$('input[type=text]').keypress(function()
    {
		var id = $(this).attr("id");
	    $("#result-"+id).html("");
    }) 	
   var wall = new Freewall("#freewall");
			wall.reset({
				selector: '.brick',
				animate: true,
				cellW: 150,
				cellH: "auto",
				onResize: function() {
					wall.fitWidth();
				}
			});
			
			/*$(document).on("click",".boxing",function()
			{	
			  var event_id = $(this).attr("event_id");
			  var event_name = $(this).attr("event_name");
			  var content = $(this).find(".item").html();
			  new Messi(content, {title: event_name, modal: true});
			});*/
			
			
			
			
});
  $(function() {
    $( "#fecha_nacimiento" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  yearRange: '1900:1998',
           dateFormat: 'yy-mm-dd'
    });
  });	
  
  $( "#departamento" ).change(function() 
  {
	 var id_departamento = $(this).val();
   $.post(ajax_url+"account/get_municipios",
	{   
	  id_departamento:id_departamento    
	},
	function(data, status)
	{
		$('#municipio')
        .empty()
        .append('<option selected="selected" value="select">Seleccione</option>');


		$.each(data.municipios, function (i, item) {
    $('#municipio').append($('<option>', { 
        value: item.id_municipio,
        text : item.nombre.toLowerCase().capitalize() 
    }));
});
	}, "json");
  });
  String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}

$(document).on("click",".messi-closebtn",function()
			{
				$('.messi-modal').remove();
						$('.messi').remove();									
			});
/*EVENTS*/
$(document).on("click",".submit-user",function()
			{
			var first_name = $("#first_name").val();
			var last_name = $("#last_name").val();
			var cedula = $("#cedula").val();
			var fecha_nacimiento = $("#fecha_nacimiento").val();
			var email = $("#email").val();
			var contrasena = $("#contrasena").val();
			var phone = $("#phone").val();		
			var departamento = $("#departamento").val();
			var municipio = $("#municipio").val();
			var ciudad = $("#ciudad").val();			  
			var direccion = $("#direccion").val();
			
			var errors = false;
				if(is_empty_string(first_name))
				{
					errors = true;
					$('#result-first_name').html("Campo vac&iacute;o");
					$('#result-first_name').addClass('short') ;
				}
				  else
					  $('#result-first_name').html("");
				  
				if(is_empty_string(last_name))
			    {
					$('#result-last_name').html("Campo vac&iacute;o");
					$('#result-last_name').addClass('short') ;
					errors = true;
				}
				else
					  $('#result-last_name').html("");
				  
				if(is_empty_string(cedula) || !is_number(cedula))
			    {
					errors = true;
					$('#result-cedula').html("Campo vac&iacute;o o no es num&eacute;rico");
					$('#result-cedula').addClass('short') ;
				}
				else
					  $('#result-cedula').html("");
				  
				if(is_empty_string(email) || !is_valid_email(email))
			    {
					errors = true;
					$('#result-email').html("Campo vac&iacute;o o no v&aacute;lido");
					$('#result-email').addClass('short') ;
				}
				else
					  $('#result-email').html("");
				  
				if(is_empty_string(contrasena))
			    {
					errors = true;
					$('#result').html("Campo vac&iacute;o");
					$('#result').addClass('short') 
				}
				else
				{
					var result = checkStrength(contrasena)
					if(result=="Demasiado corto" || result=="Devil")
					{
						$('#result').html(result);
						errors = true;
					}	
					else{
					  $('#result').html("");
					}
				}				
				if(is_empty_string(fecha_nacimiento) )
			    {
					errors = true;
					$('#result-fecha_nacimiento').html("Campo vac&iacute;o o no v&aacute;lido");
					$('#result-fecha_nacimiento').addClass('short') ;
				}
				else
					  $('#result-fecha_nacimiento').html("");
				  
				if(is_empty_string(phone) || valid_phone(phone) || !is_number(phone) || !is_correct_length(phone))
			    {
					errors = true;
					$('#result-phone').html("Campo vac&iacute;o o no v&aacute;lido");
					$('#result-phone').addClass('short') ;
				}
				else
					  $('#result-phone').html("");
				
				if(is_empty_string(departamento) || departamento == "select")
			    {
					errors = true;
					$('#result-departamento').html("Seleccion no v&aacute;lida");
					$('#result-departamento').addClass('short') ;
				}
				else
					  $('#result-departamento').html("");
				  
				if(is_empty_string(municipio) || municipio == "select")
			    {
					errors = true;
					$('#result-municipio').html("Seleccion no v&aacute;lida");
					$('#result-municipio').addClass('short') ;
				}
				else
					  $('#result-municipio').html("");
				  
				if(is_empty_string(ciudad))
			    {
					errors = true;
					$('#result-ciudad').html("Campo vac&iacute;o");
					$('#result-ciudad').addClass('short') 
				}
				else
					  $('#result-ciudad').html("");
				  
				if(is_empty_string(direccion))
			    {
					errors = true;
					$('#result-direccion').html("Campo vac&iacute;o");
					$('#result-direccion').addClass('short') 
				}
                else
					$('#result-direccion').html("");				
				
				/*submit*/
				if(!errors)
				{
					$.post(ajax_url+"account/submit_user",
				{   
				  first_name:first_name,    
				  last_name:last_name,
				  cedula:cedula,
				  fecha_nacimiento:fecha_nacimiento,
				  email:email,
				  contrasena:contrasena,
				  phone:phone,
				  departamento:departamento,
				  municipio:municipio,
				  ciudad:ciudad,
				  direccion:direccion
				},
				function(data, status)
				{
					if(data.response=="error")
					{
						 new Messi("El correo electrónico ya esta usado por otro usuario. Por favor intenta con otro.", {title: "Error", titleClass: 'anim error', modal: true});
						 $('#result-email').html("Correo electrónico en uso");
					     $('#result-email').addClass('short') ;
					}
					else
					{
						window.location = ajax_url+"/?initLogin=true";
					}
				}, "json");
				}
				
			});
                        
$(document).on("click",".update-user",function()
			{
			var first_name = $("#first_name").val();
			var last_name = $("#last_name").val();
			var fecha_nacimiento = $("#fecha_nacimiento").val();		
			var departamento = $("#departamento").val();
			var municipio = $("#municipio").val();
			var ciudad = $("#ciudad").val();			  
			var direccion = $("#direccion").val();
			
			var errors = false;
				if(is_empty_string(first_name))
				{
					errors = true;
					$('#result-first_name').html("Campo vac&iacute;o");
					$('#result-first_name').addClass('short') ;
				}
				  else
					  $('#result-first_name').html("");
				  
				if(is_empty_string(last_name))
			    {
					$('#result-last_name').html("Campo vac&iacute;o");
					$('#result-last_name').addClass('short') ;
					errors = true;
				}
				else
					  $('#result-last_name').html("");
				  
				
				
							
				if(is_empty_string(fecha_nacimiento) )
			       {
					errors = true;
					$('#result-fecha_nacimiento').html("Campo vac&iacute;o o no v&aacute;lido");
					$('#result-fecha_nacimiento').addClass('short') ;
				}
				else
					  $('#result-fecha_nacimiento').html("");
				  
				
				
				if(is_empty_string(departamento) || departamento == "select")
			    {
					errors = true;
					$('#result-departamento').html("Seleccion no v&aacute;lida");
					$('#result-departamento').addClass('short') ;
				}
				else
					  $('#result-departamento').html("");
				  
				if(is_empty_string(municipio) || municipio == "select")
			    {
					errors = true;
					$('#result-municipio').html("Seleccion no v&aacute;lida");
					$('#result-municipio').addClass('short') ;
				}
				else
					  $('#result-municipio').html("");
				  
				if(is_empty_string(ciudad))
			    {
					errors = true;
					$('#result-ciudad').html("Campo vac&iacute;o");
					$('#result-ciudad').addClass('short') 
				}
				else
					  $('#result-ciudad').html("");
				  
				if(is_empty_string(direccion))
			    {
					errors = true;
					$('#result-direccion').html("Campo vac&iacute;o");
					$('#result-direccion').addClass('short') 
				}
                else
					$('#result-direccion').html("");				
				
				/*submit*/
				if(!errors)
				{
					$.post(ajax_url+"account/update_user",
				{   
				  first_name:first_name,    
				  last_name:last_name,
				  fecha_nacimiento:fecha_nacimiento,
				  departamento:departamento,
				  municipio:municipio,
				  ciudad:ciudad,
				  direccion:direccion
				},
				function(data, status)
				{
					if(data.response=="error")
					{
					new Messi(
                                            'Su información no fue actualizada por error del sistema, por favor intenta de nuevo o contáctenos.',
                                            {
                                                title: 'Actualización de datos',
                                                titleClass: 'anim success',
                                                buttons: [ {id: 0, label: 'Close', val: 'X'} ]
                                            });	
					}
					else
					{
					new Messi(
                                            'Su información personal fue actualizada con éxito.',
                                            {
                                                title: 'Actualización de datos',
                                                titleClass: 'anim success',
                                                buttons: [ {id: 0, label: 'Close', val: 'X'} ]
                                            });
					}
				}, "json");
				}
				
			});                        
                        
$(document).on("click",".submit-login",function()
			{	
			  var username = $(".messi-content #username").val();
			  var password = $(".messi-content #password").val();
			  var recordar = $('.messi-content #recordar').is(':checked');
			  var errors = false;
			  if(is_empty_string(username) || !is_valid_email(username))
			    {
					errors = true;
					$('.messi-content #result-username').html("Campo vac&iacute;o o no v&aacute;lido");
					$('.messi-content #result-username').addClass('short') ;
				}
				else
					  $('.messi-content #result-username').html("");
				  
				if(is_empty_string(password))
			    {
					errors = true;
					$('.messi-content #result-password').html("Campo vac&iacute;o");
					$('.messi-content #result-password').addClass('short') 
				}
				else
					  $('.messi-content #result-password').html("");
				  
		     if(!errors)
			 {
				 $.post(ajax_url+"account/login",
				{   
				  username:username,    
				  password:password,
				  recordar:recordar
				},
				function(data, status)
				{
					if(data.response=="error")
					{
						$(".message-login-form").html("El correo el&eacute;ctronico o contrase&ntilde;a no son validos");
						$(".message-login-form").addClass("bg-warning");
						$(".message-login-form").focus();
					}
					else
					{
						$("#user_name").html(data.username);
						$("#balance-top").html(data.balance);
						$(".log-in-widget").removeAttr( 'style' );
						$(".log-in-widget").addClass("hide-important");
						$(".logged-in-widget").fadeIn();
						$('.messi,.messi-modal').remove();
					//	window.location = ajax_url+"/?initLogin=true"
					}
				}, "json");
			 }
			});
function update_potential_mixed_after(element)
	{ 
	 var mixed_bet_stake_value = element.val();
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
function valid_phone(phone)
{
var expresion = /^3[\d]{10}$/;
if (isNaN(phone) || !expresion.test(phone)){
        return false;
	
}	else
		return true;
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
function is_correct_length(str)
{
	if(str.length==10)
	{
		return true;
	}
	else
	{
		return false;
	}
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
function is_valid_email(str)
{
var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
if (filter.test(str))
return true;
else{
return false;
}
} 
function checkStrength(password){  
var strength = 0;
  if (password.length < 6) { 
  $('#result').removeClass() 
	  $('#result').addClass('short') 
	  return 'Demasiado corto' 
	  }  
	  if (password.length > 7) 
		  strength += 1 
	  if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) 
		  strength += 1  
	  if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1  
	  if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) 
		  strength += 1  
	  if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,",%,&,@,#,$,^,*,?,_,~])/)) 
		  strength += 1   
	  if (strength < 2 ) 
	  { $('#result').removeClass() 
  $('#result').addClass('weak') 
  return 'Devil' 
  } 
  else if (strength == 2 ) 
  { 
$('#result').removeClass()
 $('#result').addClass('good') 
 return 'Bien' 
 } 
 else 
 { 
$('#result').removeClass() 
$('#result').addClass('strong') 
return 'Fuerte' 
} 
}
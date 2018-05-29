<?php
function init_API()
{
    $credentials = array();
    $credentials["appKey"] = "625s46b1GNKx4SMn";
    $credentials["username"] = "rockscripts"; 
    $credentials["pwd"] = "Rock!123";
    return $credentials;
}
function SpanishDate($FechaStamp)
{
   $ano = date('Y',strtotime($FechaStamp));
   $mes = date('n',strtotime($FechaStamp));
   $dia = date('d',strtotime($FechaStamp));
   $diasemana = date('w',strtotime($FechaStamp));
   $diassemanaN = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
   $mesesN = array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
   return $diassemanaN[$diasemana].", $dia de ". $mesesN[$mes] ." de $ano";
} 
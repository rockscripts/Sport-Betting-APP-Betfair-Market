<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'API/vendor/autoload.php';
require 'API/dispatcher/SearchMarketBook.php';

class Betttinglayer extends CI_Controller 
{
	public function __construct()
	{
	   parent::__construct();
	   $this->load->helper('general'); 
	   $this->load->model('Betfair');
	   $this->load->model('Account_model');
	  // $this->load->model('Ion_auth_model');
	   $this->load->library(array('ion_auth'));
	   
	   if(!$this->session->userdata('betting_layer'))
	   {
		   $betting_layer = array("items"=>array(),"betting_type"=>"Simple","mixed"=>array("mixed_bet_stake"=>1000,"mixed_total_price"=>0,"mixed_potential"=>0));
		   $this->session->set_userdata('betting_layer',$betting_layer); 
		   
	   }
	}
	public function place_bet()
	{
		
		if(!$this->session->userdata("user_id"))
		{
                    
                  $data["type"] = "error";
                  $data["message"] = "Es necesario <b classs=\"open-betting-layer\">iniciar sesi&oacute;n</b> para hacer apuestas.";
                  echo json_encode($data); 
		}	
		else
		{
                  $betting_type = $this->get_betting_type();
                  $betting_items = $this->get_betting_items();
                  $events_expired = array();
                  $selections_price_updated = array();
                  $index = 0;
                  /*if($betting_type=="Simple")
                  {*/
                      foreach($betting_items as $item_selection): 
                       $event = $this->Betfair->get_events_by(array("event_id"=>$item_selection["event_id"]),"row-only");
                       if($this->event_has_been_expired($event->openDate) or !$event):                         
                           $events_expired[] = $item_selection["event_id"];
                       else:
                           $markets = $this->get_markets_with_best_offer(array($item_selection["market_id"]));                           
                           if(!empty($markets)):
                               
                                $market = $markets[0];
                                $runners = $market["runners"];
                                for($j=0;$j<sizeof($runners);$j++):
                                    $runner = $runners[$j];
                                    if($runner["selectionId"]==$item_selection["selection_id"]):
                                       if(isset($runner["ex"]["availableToBack"][0]["price"])):
                                         $price = $runner["ex"]["availableToBack"][0]["price"];
                                        if($price!=$item_selection["selection_price"]):
                                            $selections_price_updated[$index]["selection_id"] = $item_selection["selection_id"];
                                            $selections_price_updated[$index]["event_id"] = $item_selection["event_id"];
                                            $selections_price_updated[$index]["new_price"] = $price;
                                        if($price>$item_selection["selection_price"]):
                                           $selections_price_updated[$index]["style"] = "green" ;
                                        endif;
                                        if($price<$item_selection["selection_price"]):
                                            $selections_price_updated[$index]["style"] = "red";
                                        endif;
                                    endif;   
                                       endif;                                       
                                    endif;                                                                            
                                endfor;
                             else:
                                 /**/
                                 echo "error ocurred";
                           endif;
                           
                           
                       endif;
                       
                      endforeach;
                      if(sizeof($events_expired)>0):
                         $data["type"] = "error";
                         $data["message"] = "Algunos eventos/partidos han caducado y no es posible apostar sobre ellos.";
                         $data["events_expired"] = $events_expired;
                         
                        if(sizeof($selections_price_updated)>0):
                          $data["selections_price_updated"] = $selections_price_updated;
                        endif;
                        echo json_encode($data); 
                        else:
                           if(sizeof($selections_price_updated)>0):
                            $data["type"] = "error";
                            $data["message"] = "Algunos precios han cambiado. Vuelve a revisar antes de realizar la apuesta.";
                            $data["selections_price_updated"] = $selections_price_updated;
                            else:
                               if($this->add_user_betting($betting_type))
                               {
                                $this->reset_betting_layer();
                                $data["type"] = "success";
                               $data["message"] = "La apuesta se ha realizado con exito y puede seguirlas en la secci&oacute;n <a href='#'>'Mis Apuestas'</a>";   
                               }                               
                               else
                               {
                                $data["type"] = "success";
                                $data["message"] = "Error ocurrido en el sistema. Por favor actualiza la p&aacute;gina.";
                               }                            
                               /*ADD TO BETTING LIST HISTORIAL*/
                            endif;
                        echo json_encode($data);  
                      endif;
                      
                               }
	}
        public function add_user_betting($betting_type)
        {
          $items = $this->get_betting_items();
          $id_user_betting = $this->Account_model->add_user_betting($betting_type,$this->session->userdata("user_id"));
          if($betting_type=="Combinada")
          {
              $mixed_bet = $this->get_mixed_bet();
              $data = array("mixed_bet_stake"=>$mixed_bet ["mixed_bet_stake"],"mixed_total_price"=>$mixed_bet ["mixed_total_price"],"mixed_potential"=>$mixed_bet ["mixed_potential"]);
              $this->Account_model->update_user_betting($id_user_betting, $data);
          }
             if($id_user_betting>0):
                foreach($items as $item_selection):
                 $event = $this->Betfair->get_events_by(array("event_id"=>$item_selection["event_id"]),true);
                $data = array
                          ( 
                           "market_id"=> $item_selection["market_id"],
                           "catalog_name" => $item_selection["catalog_name"],
                           "selection_id"=> $item_selection["selection_id"],
                           "selection_price"=> $item_selection["selection_price"], 
                           "selection_name"=> $item_selection["selection_name"],
                           "bet_stake"=> $item_selection["bet_stake"],
                           "potential"=> $item_selection["potential"],
                           "event_name"=> $item_selection["event_name"],
                           "event_openDate"=> $event->openDate,                           
                           "id_user_betting"=>$id_user_betting
                          );
             $this->Account_model->add_user_betting_selection($data); 
             endforeach; 
             return true;
             endif;
        }
	public function open_betting_layer() 
	{
		$data["switch_betting_type"] = $this->get_betting_type();
		$data["betting_layer_items"] = $items = (array) $this->get_betting_items();
		$data["mixed_bet"] = $this->get_mixed_bet();
		$data["betting_layer_template"] = $this->template->ajax_load_view('betting_layer',$data, true);
		echo json_encode($data);
	}
	public function add_selection()
	{
		
		$data = array();
		$data["event_id"]  = $this->input->post("eid");
		$data["market_id"] = $this->input->post("mid");		
		$data["selection_id"]  = $this->input->post("sid");
		$data["selection_name"]  = $this->input->post("sname");
		$data["selection_price"]  = $this->input->post("sprice");
		$event = $this->Betfair->get_events_by(array("event_id"=>$data["event_id"]),true);
		$data["event_name"]  = $event->name; 
		$data["catalog_name"]  = $this->input->post("cname");
		
		$data["bet_stake"]  = 1000;
		$data["potential"]  = 1000 * $data["selection_price"];
		
		
		if(!$this->exist_selection($data["selection_id"],$data["market_id"]))
		{
			 $items = (array) $this->get_betting_items();
   		    
			 $items[] = $data;
			 
			 $this->session->userdata['betting_layer']['items'] = $items;
			 $data["type"] = "success";
			 $data["message"] = "La selecci&oacute;n fue agregada.";
		}
		else
		{
			$data["type"] = "error";
			$data["message"] = "La selecci&oacute;n ya existe en la hoja de apuestas.";
		}
		//echo $this->session->userdata['betting_layer']['betting_type'];	
		$data["switch_betting_type"] = $this->get_betting_type();
		$data["betting_layer_items"] = $items = (array) $this->get_betting_items();
		$data["mixed_bet"] = $this->get_mixed_bet();
		$data["betting_layer_template"] = $this->template->ajax_load_view('betting_layer',$data, true);
		echo json_encode($data);
	}   
	public function exist_selection($id_selection, $id_market)
	{
		$items =  $this->get_betting_items();
		if(sizeof($items)>0)
		{
			foreach($items as $item)
			{
				if($item["selection_id"]==$id_selection and $item["market_id"]==$id_market)
					return true;
			}
		}
		return false;
	}
	public function t()
	{
		echo "<pre>";
		//$this->session->sess_destroy();
	//echo $this->session->userdata['betting_layer']['betting_type'];	
	//print_r($this->session->userdata('betting_layer')); 
	print_r($this->session->userdata());   
	}
	public function set_betting_type($type=null)
	{
		if($this->input->post("betting_type"))
		$type = $this->input->post("betting_type");	
	
		$this->session->userdata['betting_layer']['betting_type'] = $type; 
		
		if($this->input->post("betting_type"))
        echo json_encode(array("betting_type"=>$this->get_betting_type()))		;
	}
	public function get_betting_type()
	{
		return $this->session->userdata['betting_layer']['betting_type'];		
	}
	public function get_betting_items()
	{	
		return $this->session->userdata['betting_layer']['items'];		
	}
	
	public function remove_selection()
	{
	  $id_selection = $this->input->post("sid");
	  $id_market = $this->input->post("mid");
	  $index = $this->get_item_index($id_selection, $id_market);
	 /* echo $index."****";*/
	  if($index>=0)
	  {
		$items = $this->get_betting_items();
		unset($items[$index]);
		$this->session->userdata['betting_layer']['items'] = $items;
		$data["sizeofitems"] = sizeof($this->get_betting_items());
                if($data["sizeofitems"]==0)
                {
                 $this->reset_betting_layer();    
                }
		$data["type"] = "success";	
                $data["message"] = "La selecci&oacute;n fue eliminada.";		
	  }	  
         else
	  {
	    $data["type"] = "error";
            $data["message"] = "La selecci&oacute;n no existe. por favor actualiza la p&aacute;gina.";		
         }
         
	  $data["betting_type"] = $this->get_betting_type();
          echo json_encode($data);	   
	}
	public function get_mixed_bet()
	{
		return $this->session->userdata['betting_layer']['mixed'];		
	}
        public function reset_betting_layer()
        {
            $betting_layer = array("items"=>array(),"betting_type"=>"Simple","mixed"=>array("mixed_bet_stake"=>1000,"mixed_total_price"=>0,"mixed_potential"=>0));
	    $this->session->set_userdata('betting_layer',$betting_layer); 
        }
	public function update_bet_selection()
	{
	  $id_selection = $this->input->post("sid");
	  $id_market = $this->input->post("mid");
	  $bet_stake = $this->input->post("bet_stake");
	  $potential = $this->input->post("potential");
	  $price = $this->input->post("price");
	  $type = $this->input->post("type");
	  if($type=="Simple")
	  {
		  $index = $this->get_item_index($id_selection, $id_market);
		  if($index>=0)
		  {
			$items = $this->get_betting_items();
			$items[$index]["selection_price"] = $price;
			$items[$index]["bet_stake"] = $bet_stake;
			$items[$index]["potential"] = $potential;
			$this->session->userdata['betting_layer']['items'] = $items;	
		  }	  		  	  
	  }
	  else
	  {
		$mixed_bet = $this->get_mixed_bet();  
		$mixed_bet ["mixed_bet_stake"] = $bet_stake;
		$mixed_bet ["mixed_total_price"] = $price;
		$mixed_bet ["mixed_potential"] = $potential;
//		die("********");
		$this->session->userdata['betting_layer']['mixed'] = (array)$mixed_bet;
	  }
              $data["betting_layer_items_size"] = sizeof($this->get_betting_items());
              echo json_encode($data);
	}
	public function get_item_index($id_selection, $id_market)
	{
	 	$items =  $this->get_betting_items();
		if(sizeof($items)>0)
		{
			$i=0;
			foreach($items as $key=>$item)
			{
				if($item["selection_id"]==$id_selection and $item["market_id"]==$id_market)
					return $key;
				$i++; 
			}
		}
		return -1;
	}
        function event_has_been_expired($open_date)
	{
		$date = new DateTime(date('Y-m-d H:i:s'));
		$date->setTimezone(new DateTimeZone('Europe/London')); // +04
		$currentLondonDateTime =  $date->format('Y-m-d H:i:s');
		if($currentLondonDateTime >= $open_date)
			return true;
		else
			return false;
	}
        function get_markets_with_best_offer($markets_ID)
	{
		$credentials = init_API();
		$SearchMarketBook = new SearchMarketBook();
		$result = $SearchMarketBook->searchWithExBestOffer($credentials["appKey"], $credentials["username"], $credentials["pwd"], $markets_ID);
		return $result;
	}
}


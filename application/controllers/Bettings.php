<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'API/vendor/autoload.php';
require 'API/dispatcher/SearchMarketBook.php';

class Bettings extends CI_Controller 
{
	public function __construct()
	{
	   parent::__construct();
           if(!$this->session->userdata("user_id"))
            {
             redirect('/?initLogin=true');
            }
	   $this->load->helper('general'); 
	   $this->load->model('Betfair');
	   $this->load->model('Account_model');
	  // $this->load->model('Ion_auth_model');
	   $this->load->library(array('ion_auth'));
	}
	public function index()
	{
            
          $data = array();
          if($this->session->userdata("user_id"))
		{
	    $data["id_user"] = $this->session->userdata("user_id");
		$data["user"] = $this->Account_model->get_user($data["id_user"]);
		}	
          $data["bettings_simples"] = $this->Account_model->get_user_bettings($this->session->userdata("user_id"),"Simple");
         
          $bettings_combinadas = $this->Account_model->get_user_bettings($this->session->userdata("user_id"),"Combinada");
          $i = 0;
           foreach($bettings_combinadas as $mixed):
               $data["bettings_mixed"][$i]["id_user_betting"] = $mixed->id_user_betting;
               $data["bettings_mixed"][$i]["type"] = $mixed->type;
               $data["bettings_mixed"][$i]["mixed_bet_stake"] = $mixed->mixed_bet_stake;
               $data["bettings_mixed"][$i]["mixed_total_price"] = $mixed->mixed_total_price;
               $data["bettings_mixed"][$i]["mixed_potential"] = $mixed->mixed_potential;
               $data["bettings_mixed"][$i]["date_made"] = $mixed->date_made;
               $data["bettings_mixed"][$i]["selections"] = $this->Account_model->get_user_betting_selections($mixed->id_user_betting);
           $i++;
          endforeach;
           /*echo "<pre>";
          print_r($data["bettings_mixed"]);
         die;*/
          $this->template->load('bettings/index',$data);  
	}
}


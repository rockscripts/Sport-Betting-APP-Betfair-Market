<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bettings extends CI_Controller 
{
	public function __construct()
	{
	   parent::__construct();
           if(!$this->session->userdata("user_id"))
            {
             redirect('/?initLogin=true');
            }
            $this->template->layout="_layout_admin";
	   $this->load->helper('general'); 
	   $this->load->model('Betfair');
	   $this->load->model('Account_model');
	  // $this->load->model('Ion_auth_model');
	   $this->load->library(array('ion_auth'));
	}
	public function index()
	{
            
          $data = array();
          if($this->input->get("usr"))
            {
                $data["id_user"] = $this->input->get("usr");
                $data["user"] = $this->Account_model->get_user($data["id_user"]);
                $data["bettings_simples"] = $this->Account_model->get_user_bettings($data["id_user"],"Simple");         
          $bettings_combinadas = $this->Account_model->get_user_bettings($data["id_user"],"Combinada");
            }
            else
            {
              $data["bettings_simples"] = $this->Account_model->get_user_bettings(false,"Simple");         
          $bettings_combinadas = $this->Account_model->get_user_bettings(false,"Combinada");  
            }
          
          $i = 0;
           foreach($bettings_combinadas as $mixed):
               $data["bettings_mixed"][$i]["id_user_betting"] = $mixed->id_user_betting;
               $data["bettings_mixed"][$i]["type"] = $mixed->type;
               $data["bettings_mixed"][$i]["id_user"] = $mixed->id_user;
               $data["bettings_mixed"][$i]["mixed_bet_stake"] = $mixed->mixed_bet_stake;
               $data["bettings_mixed"][$i]["mixed_total_price"] = $mixed->mixed_total_price;
               $data["bettings_mixed"][$i]["mixed_potential"] = $mixed->mixed_potential;
               $data["bettings_mixed"][$i]["date_made"] = $mixed->date_made;
               $data["bettings_mixed"][$i]["selections"] = $this->Account_model->get_user_betting_selections($mixed->id_user_betting);
           $i++;
          endforeach;
          $this->template->load('administrator/bettings/index',$data);  
	}
}


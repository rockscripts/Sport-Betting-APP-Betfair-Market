<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance extends CI_Controller 
{
	public function __construct()
	{
	   parent::__construct();
           $this->template->layout="_layout_admin";
	   $this->load->helper('general'); 
	   $this->load->model('Betfair');
	   $this->load->model('Account_model');
	  // $this->load->model('Ion_auth_model');
	   $this->load->library(array('ion_auth'));
           
	}
        public function deposits()
        {
             $data = array();
          if($this->input->get("usr"))
            {
                $data["id_user"] = $this->input->get("usr");
                $data["user"] = $this->Account_model->get_user($data["id_user"]);
                $data["deposits"] = $this->Account_model->get_deposits($data["id_user"]); 
            }
           else {
              $data["deposits"] = $this->Account_model->get_deposits(false);  
           }
            
            $data["page_title"] = "Depositos";
            $this->template->load('administrator/finance/deposits',$data); 
        }
        public function withdraws()
        {
          $data = array();
          if($this->input->get("usr"))
            {
                $data["id_user"] = $this->input->get("usr");
                $data["user"] = $this->Account_model->get_user($data["id_user"]);
                $data["withdraws"] = $this->Account_model->get_withdraws($data["id_user"]);
            }	
            else {
                $data["withdraws"] = $this->Account_model->get_withdraws(false);
            }             
            $data["page_title"] = "Retiradas";
            $this->template->load('administrator/finance/withdraws',$data);   
        }
        public function suspect_users()
        {
           $data = array();
          if($this->input->get("usr"))
            {
                $data["id_user"] = $this->input->get("usr");
                $data["user"] = $this->Account_model->get_user($data["id_user"]);
                $data["suspect_users"] = $this->Account_model->get_suspect_users($data["id_user"]);
            }	
            else {
                $data["suspect_users"] = $this->Account_model->get_suspect_users(false);
            }             
            $data["page_title"] = "Usuarios Sospechosos";
            $this->template->load('administrator/finance/suspect_users',$data);    
        }
        public function hacienda_users()
        {
           $data = array();
          if($this->input->get("usr"))
            {
                $data["id_user"] = $this->input->get("usr");
                $data["user"] = $this->Account_model->get_user($data["id_user"]);
                $data["hacienda_users"] = $this->Account_model->get_hacienda_users($data["id_user"]);
            }	
            else 
            {
                $data["hacienda_users"] = $this->Account_model->get_hacienda_users(false);
            }             
            $data["page_title"] = "Pago de IVA";
            $this->template->load('administrator/finance/hacienda_users',$data);    
        }
		 public function ludopatas_users()
        {
           $data = array();
          if($this->input->get("usr"))
            {
                $data["id_user"] = $this->input->get("usr");
                $data["user"] = $this->Account_model->get_user($data["id_user"]);
                $data["ludopatas_users"] = $this->Account_model->get_ludopatas_users($data["id_user"]);
            }	
            else 
            {
                $data["ludopatas_users"] = $this->Account_model->get_ludopatas_users(false);
            }             
            $data["page_title"] = "Usuarios Ludopatas";
            $this->template->load('administrator/finance/ludopatas_users',$data);    
        }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Competitions extends CI_Controller 
{
	public function __construct()
        {
           parent::__construct();
           $this->load->model('Betfair');
		   $this->load->model('Account_model');
        }
	public function index()
	{		
		$data = array();
		if($this->session->userdata("user_id"))
		{
	    $data["id_user"] = $this->session->userdata("user_id");
		$data["user"] = $this->Account_model->get_user($data["id_user"]);
		}		
		if($this->input->get("initLogin"))
		{
			$data["initLogin"]  = true;
		}
		$competitions_grouped = array();		
		$betfair_countries_information = $this->Betfair->get_countries_information();
		foreach($betfair_countries_information as $country)
		{
		  $competitions_by_iso3 = $this->Betfair->get_competitions_by(array("competitionRegion"=>$country->iso3));
		  if($competitions_by_iso3)
		  {
			 $competitions_grouped[] = array("ISO"=>$country->iso2,"country_name"=>$country->spanish_name,"competitions"=>$competitions_by_iso3);
		  }		  
		}
		$data["international_competitions"] = $this->Betfair->get_international_competitions();
		$data["competitions_grouped"] = $competitions_grouped;
		$this->template->load('competitions',$data);
	}
}

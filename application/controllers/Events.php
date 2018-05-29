<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'API/vendor/autoload.php';
require 'API/dispatcher/SearchMarketBook.php';
require 'API/dispatcher/MarketCatalog.php';

class Events extends CI_Controller 
{
	public function __construct()
	{
	   parent::__construct();
	   $this->load->model('Account_model');
	   $this->load->model('Betfair');
	   $this->load->helper('general'); 
	   $this->load->helper("url");
	}
	public function index()
	{
		$data = array();
		if($this->session->userdata("user_id"))
		{
	    $data["id_user"] = $this->session->userdata("user_id");
		$data["user"] = $this->Account_model->get_user($data["id_user"]);
		}
		$events_NONVS= array();
        $events_VS = array();
		$competition_ID = $this->input->get("cid");
		$competition = $this->Betfair->get_competitions_by(array("competition_id"=>$competition_ID),"row-only");
		$data["page_title"] = $competition->name;
		$events = $this->Betfair->get_events_by(array("competition_id"=>$competition_ID));
		if($events)
		{
			foreach($events as $event)
		{
		  	if(!strpos($event->name, " v "))
			{
				if($competition->name!=$event->name)
			  {	
			    $events_NONVS[$event->event_id]["event"] = $event;
				$events_NONVS[$event->event_id]["market_catalog"] = $this->get_market_catalog($event->event_id);	
              }			  
			}				
			else
			{		
               if(!$this->event_has_been_expired($event->openDate)) 
			   {
				$date = substr($event->openDate, 0, 10);   
				$events_VS[$date][$event->event_id]["event"] = $event;			  
				$events_VS[$date][$event->event_id]["market_catalog"] = $this->get_market_catalog($event->event_id);	
			   }
			}
		}
		}
		
		$data["events_NONVS"] = $events_NONVS;
		$data["international_competitions"] = $this->Betfair->get_international_competitions();
		$data["events_VS"] = $events_VS;
		$this->template->load('events',$data);
	}	
	
	public function today()
	{		
		$data = array();
		if($this->session->userdata("user_id"))
		{
	    $data["id_user"] = $this->session->userdata("user_id");
		$data["user"] = $this->Account_model->get_user($data["id_user"]);
		}
		$data["page_title"] = "Partidos de hoy";
		$events = $this->Betfair->get_today_events();
		$events_VS = array();
		if(is_array($events))
		{
		foreach($events as $event)
		{
		  	if(!strpos($event->name, " v "))
			{}				
			else
			{			
               if(!$this->event_has_been_expired($event->openDate)) 
			   {
				   $date = substr($event->openDate, 0, 10);   
				   $events_VS[$date][$event->event_id]["event"] = $event;			  
			       $events_VS[$date][$event->event_id]["market_catalog"] = $this->get_market_catalog($event->event_id);	
			   }
				
			}
		}	
		}
		
		$data["international_competitions"] = $this->Betfair->get_international_competitions();
		$data["events_VS"] = $events_VS;
		$this->template->load('events_today',$data);
	}
	public function bet_on_market()
	{
		$data = array();
		if($this->session->userdata("user_id"))
		{
	    $data["id_user"] = $this->session->userdata("user_id");
		$data["user"] = $this->Account_model->get_user($data["id_user"]);
		}
		$data["market_id"] = $this->input->get("mid");
		$data["event_id"] = $this->input->get("eid");
		$market = $this->Betfair->get_market_catalog_by(array("marketId"=>$data["market_id"]),"row-only");
		$event = $this->Betfair->get_events_by(array("event_id"=>$data["event_id"] ),"row-only");
		$data["page_title"] = str_replace(" v "," <b>VS</b> ",$event->name);
		$data["market_name"] = $market->marketName;
		$markets = $this->get_markets_with_best_offer(array($data["market_id"]));
		$data["markets"] = $markets;
		$data["market_catalog"] = $this->get_market_catalog($data["event_id"]);	
		$data["international_competitions"] = $this->Betfair->get_international_competitions();
		$this->template->load('markets',$data);			
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
	public function get_market_catalog($event_id)
	{
	  $market_catalog = $this->Betfair->get_market_catalog_by(array("event_id"=>$event_id));
	  if(!$market_catalog)
		  return array();
	  
	  return $market_catalog;
	}
	public function get_runner($selectionId)
	{
	 return $this->Betfair->get_runners_by(array("selectionId"=>$selectionId),"row-only");
	}
	
	function get_markets_with_best_offer($markets_ID)
	{
		$credentials = init_API();
		$SearchMarketBook = new SearchMarketBook();
		$result = $SearchMarketBook->searchWithExBestOffer($credentials["appKey"], $credentials["username"], $credentials["pwd"], $markets_ID);
		return $result;
	}
	function date_convert_times($dateTime, $fromTimeZone = "Europe/London", $toTimeZone = 'America/Bogota')
   {
	$date = new DateTime($dateTime,new DateTimeZone($fromTimeZone ));
	$date->setTimezone(new DateTimeZone($toTimeZone)); // +04
	return $date->format('Y-m-d H:i:s'); // 2012-07-15 05:00:00 
   }
   
   
   public function  update_market_catalog($eventIds)
   {
	   $credentials = init_API();
	   $MarketCatalog = new MarketCatalog();
       $markets_catalog = $MarketCatalog->listMarketCatalogByEventID($credentials["appKey"], $credentials["username"], $credentials["pwd"], $eventIds);
	     for($i=0;$i<sizeof($markets_catalog);$i++):
        $data = Array (
                   "marketId" => $markets_catalog[$i]["marketId"],
                   "marketName" => $markets_catalog[$i]["marketName"],
                   "totalMatched" => $markets_catalog[$i]["totalMatched"],
                   "event_id" => $eventIds[0]
                  );
		$this->Betfair->import_market_catalog($data);		
	    for($z=0;$z<sizeof($markets_catalog[$i]["runners"]);$z++):	   
			$data = Array (
						   "selectionId" => $markets_catalog[$i]["runners"][$z]["selectionId"],
						   "handicap" => $markets_catalog[$i]["runners"][$z]["handicap"],
						   "sortPriority" => $markets_catalog[$i]["runners"][$z]["sortPriority"],
						   "runnerName" => $markets_catalog[$i]["runners"][$z]["runnerName"],
						   "runnerId" => @$markets_catalog[$i]["runners"][$z]["metadata"]["runnerId"]               
						 );
				$this->Betfair->import_runners($data);		
		    endfor;  	   	   
    endfor;
   }  
   
   public function refresh_page($params)
   {
	   redirect($this->uri->uri_string().$params);
   }
}

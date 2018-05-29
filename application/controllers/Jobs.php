<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'API/vendor/autoload.php';
require 'API/dispatcher/SearchCompetitios.php';
require 'API/dispatcher/SearchEvents.php';
require 'API/dispatcher/SearchMarketBook.php';
require 'API/dispatcher/MarketCatalog.php';

class Jobs extends CI_Controller 
{
	public function __construct()
        {
           parent::__construct();
           $this->load->model('Betfair');
           $this->load->model('Account_model');
		    $this->load->helper('general'); 
        }
		/*Run every two days before events*/
	public function import_competitions()
	{
	 	   $credentials = init_API();
		   $SearchCompetitions = new SearchCompetitions();
           $competitions = $SearchCompetitions->listCompetitions($credentials["appKey"], $credentials["username"], $credentials["pwd"]);
		    for($i=0;$i<sizeof($competitions);$i++):
		  $data = Array (
						   "competition_id" => $competitions[$i]["competition"]["id"],
						   "name" => $competitions[$i]["competition"]["name"],
						   "marketCount" => $competitions[$i]["marketCount"],
						   "competitionRegion" => $competitions[$i]["competitionRegion"]
						  );
		  $this->Betfair->import_competition($data);	
		  endfor;
	}
	/*Run every two days*/
public function import_events()
	{
	 	  $credentials = init_API();
          $SearchEvents = new SearchEvents();
		  /*$events = $SearchEvents->getAllEventsFilteredByCompetitionId($credentials["appKey"], $credentials["username"], $credentials["pwd"], array(67387));
		  echo "<pre>";
		  print_r($events);
		  die("***");*/
		  $competitions = $this->Betfair->get_competitions_by(array());
		  foreach($competitions as $competition):  
		   $events = $SearchEvents->getAllEventsFilteredByCompetitionId($credentials["appKey"], $credentials["username"], $credentials["pwd"], array($competition->competition_id));
		  for($j=0;$j<sizeof($events);$j++):
			$event_name = str_replace(" - "," v ",$events[$j]["event"]["name"]);
		     $data = Array (
						   "event_id" => $events[$j]["event"]["id"],
						   "name" => $event_name,
						   "countryCode" => @$events[$j]["event"]["countryCode"],
						   "timezone" => $events[$j]["event"]["timezone"],
						   "openDate" => $events[$j]["event"]["openDate"],
						   "marketCount" => $events[$j]["marketCount"],
						   "competition_id" =>$competition->competition_id
						  );						 
		$this->Betfair->import_events($data);	
		  endfor; 
         endforeach; 
	}
/*run every morning at 4am*/
 public function  import_market_catalog()
   {
	   
	   $credentials = init_API();
	   $MarketCatalog = new MarketCatalog();
	   $events = $this->Betfair->get_events_by(array("openDate >="=>"2015-12-14 09:45:2"));
	   /*echo "<pre>";
	   print_r($events );die;*/
	   foreach($events as $event)
	   {
		$markets_catalog = $MarketCatalog->listMarketCatalogByEventID($credentials["appKey"], $credentials["username"], $credentials["pwd"], array($event->event_id));
	     for($i=0;$i<sizeof($markets_catalog);$i++):
        $data = Array (
                   "marketId" => $markets_catalog[$i]["marketId"],
                   "marketName" => $markets_catalog[$i]["marketName"],
                   "totalMatched" => $markets_catalog[$i]["totalMatched"],
                   "event_id" => $event->event_id
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
   }  
   /*Run This Job every 5 seconds*/
    public function  remove_events_VS_expired()
   {
	   $events = $this->Betfair->get_events_by(array());
	   foreach($events as $event)
	   {
		 	if(!strpos($event->name, " v "))
			{				
			}				
			else
			{		               
				/* vs*/	
				if($this->event_has_been_expired($event->openDate)) 
			   {
				  $this->Betfair->remove_event($event->event_id); 
			   }	
			}
	   }
   } 
   /*Run this job each week*/
    public function  remove_events_NONVS_expired()
   {
	   /*non vs*/		 
       $events = $this->Betfair->get_events_by(array());         
	   foreach($events as $event)
	   {
		 	if(!strpos($event->name, " v "))
			{	
              $credentials = init_API();
		        $SearchEvents = new SearchEvents();	
				$events_live = $SearchEvents->getAllEventsFilteredByEventId($credentials["appKey"], $credentials["username"], $credentials["pwd"], array($event->event_id));
				if(sizeof($events_live )==0)
				{
					  $this->Betfair->remove_event($event->event_id); 
				}
			}				
			else
			{
			}
	   }
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
        function update_betting_results()
        {
            $credentials = init_API();
            $SearchMarketBook = new SearchMarketBook();
            $all_bettings_selections = $this->Account_model->get_betting_selections();
            
            $array_markets_id = array();
            if($all_bettings_selections):
              foreach( $all_bettings_selections as $selection):
                if(!in_array($selection->market_id, $array_markets_id))
                {
                   $array_markets_id[]=$selection->market_id; 
                }                   
              endforeach;  
              $results = $SearchMarketBook->searchResults($credentials["appKey"], $credentials["username"], $credentials["pwd"], $array_markets_id);                         
           /*   echo "<pre>";
              print_r($results);*/
             foreach( $results as $result):
               $runners=$result["runners"];
             foreach($runners as $runner):
                 if($runner["status"]=="WINNER" or $runner["status"]=="LOSER"):
                     $this->Account_model->update_result($runner["selectionId"],$runner["status"]);
                 
                 endif;
             endforeach;
             endforeach;
            endif; 
           
        }
        public function update_f_profits_losses()
        {
          $users = $this->Account_model->get_users(); 
          if($users)
          {
              foreach($users as $user)
              {
                 $bettings_simples = $this->Account_model->get_user_bettings($user->id,"Simple");
                 $bettings_combinadas = $this->Account_model->get_user_bettings($user->id,"Combinada");
                 $i = 0;
                foreach($bettings_combinadas as $mixed):
                    $data["bettings_mixed"][$i]["id_user_betting"] = $mixed->id_user_betting;
                    $data["bettings_mixed"][$i]["type"] = $mixed->type;
                    $data["bettings_mixed"][$i]["mixed_bet_stake"] = $mixed->mixed_bet_stake;
                    $data["bettings_mixed"][$i]["mixed_total_price"] = $mixed->mixed_total_price;
                    $data["bettings_mixed"][$i]["mixed_potential"] = $mixed->mixed_potential;
                    $data["bettings_mixed"][$i]["date_made"] = $mixed->date_made;
                    $data["bettings_mixed"][$i]["id_user"] = $mixed->id_user;
                    $data["bettings_mixed"][$i]["selections"] = $this->Account_model->get_user_betting_selections($mixed->id_user_betting);
                $i++;
               endforeach;
               
               if(is_array($bettings_simples)):
                foreach($bettings_simples as $simple):
                 $data1 = array("type"=>$simple->result,"ammount"=>($simple->potential-$simple->bet_stake),"date_last_event"=>$simple->event_openDate,"id_user_betting"=>$simple->id_user_betting,"id_user"=>$simple->id_user);
                 $this->Account_model->add_f_profits_losses($data1);
                endforeach;
               endif;
               /*$profits_sum = 0;
               $losses_sum = 0;*/
               if(isset($data["bettings_mixed"] )):            
                if(is_array($data["bettings_mixed"] )):
                 foreach($data["bettings_mixed"] as $mixed):
                    $selections =$mixed["selections"] ;
                 $results = array();
                 foreach($selections as $selection):
                     $results[] =$selection->result;                     
                 endforeach;
                 if(in_array("LOSER",$results) and !in_array("UNKNOWN",$results)):
                 $data1 = array("type"=>"LOSER","ammount"=>($mixed["mixed_bet_stake"]),"date_last_event"=>$selections[sizeof($selections)-1]->event_openDate,"id_user_betting"=>$mixed["id_user_betting"],"id_user"=>$mixed["id_user"]);
                 $this->Account_model->add_f_profits_losses($data1);                 
                 endif;
                 if(!in_array("LOSER",$results) and !in_array("UNKNOWN",$results)):
                  $data1 = array("type"=>"WINNER","ammount"=>($mixed["mixed_potential"]-$mixed["mixed_bet_stake"]),"date_last_event"=>$selections[sizeof($selections)-1]->event_openDate,"id_user_betting"=>$mixed["id_user_betting"],"id_user"=>$mixed["id_user"]);
                 $this->Account_model->add_f_profits_losses($data1);
                 endif;                  
                 endforeach;
                endif;
                endif;
               
               
                                            
              }
          }
        }
        public function report_ilegal_activities()
        {
             $users = $this->Account_model->get_users(); 
             $profits_sum = 0;
               $losses_sum = 0;
          if($users)
          {
              foreach($users as $user)
              {
               $deposits_sum = $this->Account_model->get_deposits_sum($user->id,"month");
               if($deposits_sum>0)
               {
                 $withdraws_sum = $this->Account_model->get_withdraws_sum($user->id,"month");
                 $profits_sum = $this->Account_model->get_profits_sum($user->id);
                 $losses_sum = $this->Account_model->get_losses_sum($user->id);
                  echo $deposits_sum."-".$withdraws_sum."<br>";
                echo $profits_sum."-".$losses_sum."<br>";
                $deposits_withdraws_percent_difference = round((($deposits_sum-$withdraws_sum)/$deposits_sum)*100);
                if($withdraws_sum>0)
                {
                $withdraws_profits_percent_difference = round((($withdraws_sum-$profits_sum)/$withdraws_sum)*100);
                if($deposits_withdraws_percent_difference<=40 and $withdraws_profits_percent_difference>=50)
                {
                  ECHO $deposits_withdraws_percent_difference."%<br>";
                  ECHO $withdraws_profits_percent_difference."%<br>"; 
                  $data = array("id_user"=>$user->id,"deposits_sum"=>$deposits_sum,"withdraws_sum"=>$withdraws_sum,"profits_sum"=>$profits_sum,"losses_sum"=>$losses_sum,"deposits_withdraws_percent_difference"=>$deposits_withdraws_percent_difference,"withdraws_profits_percent_difference"=>$withdraws_profits_percent_difference);
                  $this->Account_model->add_suspect_user($data);
                }                
                }                
               }
              }
          }
           
        }
}
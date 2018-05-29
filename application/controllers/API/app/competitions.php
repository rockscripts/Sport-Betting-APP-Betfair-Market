<?php

function get_competitions()
{
	
    $credentials = init_API();
    $SearchCompetitions = new SearchCompetitions();
    $result = $SearchCompetitions->listCompetitions($credentials["appKey"], $credentials["username"], $credentials["pwd"]);
    return $result;
}
function get_events_by_competition_ids_db($competition_ID)
{

   global $db;
   $db->where("competition_id",$competition_ID);	
   $betfair_events =$db->get("betfair_events");
   return $betfair_events;
}
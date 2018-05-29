<?php

//add_marketplace_PC_GAMES_subcategory(15,"Handball");
//get_events_types();

function get_events($eventType)
{
    $credentials = init_API();
    $SearchEvents = new SearchEvents();
    $result = $SearchEvents->getAllEventFilteredByEventTypeIds($credentials["appKey"], $credentials["username"], $credentials["pwd"], $eventType);
    return $result;
}
function import_events_types()
{    
    $credentials = init_API();
    $SearchEvents = new SearchEvents();
    $result = $SearchEvents->listEvents($credentials["appKey"], $credentials["username"], $credentials["pwd"]); 
    for($i=0;$i<sizeof($result);$i++):
       add_to_marketplace_subcategory(15, $result[$i]["eventType"]["id"], $result[$i]["eventType"]["name"], $result[$i]["marketCount"]);
    endfor;        
}
/*
  Add sports 
  ID
  Name
  MarketCount
 * */
function add_to_marketplace_subcategory($cat_id, $subcat_id, $name,$market_count=0)
{
    global $db; 
    $data = Array (
                   "id" => $subcat_id,
                   "cat_id" => $cat_id,
                   "name" => $name,
                   "tags" => $name,
                   "descr" => $name,
                   "marketcount" => $market_count
                  );
    $id = $db->insert('subcat', $data);
    if($id)
        return $data;
    else
        return false;
}

function get_events_by_competition_ids($competitionIDs)
{
    $credentials = init_API();
    $SearchEvents = new SearchEvents();
    $result = $SearchEvents->getAllEventsFilteredByCompetitionId($credentials["appKey"], $credentials["username"], $credentials["pwd"], $competitionIDs);
    return $result;
}
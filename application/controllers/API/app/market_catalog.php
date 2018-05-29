<?php
function list_Market_catalog_by_eventID($eventIds)
{
    $credentials = init_API();
    $MarketCatalog = new MarketCatalog();
    $result = $MarketCatalog->listMarketCatalogByEventID($credentials["appKey"], $credentials["username"], $credentials["pwd"], $eventIds);
    return $result;
}
function list_Market_catalog_by_eventID_db($eventId, $marketName=null)
{
    global $db;
    $db->where("event_id",$eventId);	
    if($marketName!=null):
        $db->where("marketName",$marketName);
    endif;
    $betfair_market_catalog =$db->get("betfair_market_catalog");
    return $betfair_market_catalog;
}
?>
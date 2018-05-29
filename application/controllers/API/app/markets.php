<?php

function get_markets_with_best_offer($marketIDs)
{
    $credentials = init_API();
    $SearchMarketBook = new SearchMarketBook();
    $result = $SearchMarketBook->searchWithExBestOffer($credentials["appKey"], $credentials["username"], $credentials["pwd"], $marketIDs);
    return $result;
}
function get_runners_with_competition_IDs($competitionIDs)
{
	$credentials = init_API();
    $SearchMarketBook = new SearchMarketBook();
    $result = $SearchMarketBook->getRunnersByCompetitionID($credentials["appKey"], $credentials["username"], $credentials["pwd"], $competitionIDs);
    return $result;
}
function find_specific_runner_name($runners, $market_id, $selection_id)
	{
		for($i=0;$i<sizeof($runners);$i++)
		{			
		 if($runners[$i]["marketId"]==$market_id)
		 {
			for($j=0;$j<sizeof($runners[$i]["runners"]);$j++)
			{
				if($runners[$i]["runners"][$j]["selectionId"]==$selection_id)
					return $runners[$i]["runners"][$j]["runnerName"];
			}
		 }
		}
		return false;
	}
	function find_specific_market_id($market_name, $market_catalog)
	{
		for($i=0;$i<sizeof($market_catalog);$i++)
		{			
		 if($market_catalog[$i]["marketName"]==$market_name)
		 {
			return $market_catalog[$i]["marketId"];
		 }
		}
		return false;
	}
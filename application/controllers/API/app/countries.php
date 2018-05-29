<?php
/*database class*/



function get_all_countries()
{
    $credentials = init_API();
    $betfair = new Country();
    $countries = $betfair->listCountries($credentials["appKey"], $credentials["username"], $credentials["pwd"]);
    return $countries;
}
function get_country_details_by_ISO($iso)
{
    global $db;
    $db->where ('iso2', $iso);
    $results = $db->get ('country_t');
    return $results;
}
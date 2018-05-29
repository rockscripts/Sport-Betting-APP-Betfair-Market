<?php
/*database class*/

require_once ('MysqliDb.php');
$db = new MysqliDb ('localhost', 'root', 'root', 'latingana_main');

//add_marketplace_PC_GAMES_subcategory(15,"Handball");
//get_events_types();

function get_account_details()
{
   $credentials = init_API();
    $AccountDetails = new AccountDetails();
    $result = $AccountDetails->getAccountDetails($credentials["appKey"], $credentials["username"], $credentials["pwd"], $eventType);
    echo "<pre>";
    print_r($result);
}
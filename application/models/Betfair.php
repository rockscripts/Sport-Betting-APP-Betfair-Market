<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Betfair extends CI_Model
{	
  public function get_countries_information()
  {
	$this->db->order_by("spanish_name", "asc");
    $query = $this->db->get('betfair_countries_information');  
	return $query->result();
  }
  public function get_competitions_by($data,$row_only=false)
  {	 
    $this->db->order_by("marketCount", "desc");
    $query = $this->db->get_where('betfair_competitions',$data);  
	if($query->num_rows()>0)
	{
		if($row_only)
		return $query->row();
			else
		return $query->result();
	}	 
    else
	 return false;
  }
  public function get_international_competitions()
  {
	$this->db->order_by("marketCount", "desc");
	$data = array("competitionRegion"=>"International");
    $query1 = $this->db->get_where('betfair_competitions',$data);  
	return $query1->result();
	 
  }
  public function get_events_by($data,$row_only=false)
  {
	$this->db->order_by("openDate", "asc");
    $query = $this->db->get_where('betfair_events',$data);
//echo $this->db->last_query();	
	if($query->num_rows()>0)
	{
		if($row_only)
		return $query->row();
			else
		return $query->result();
	}	 
    else
	 return false;
  }
  public function get_today_events($row_only=false)
  {
    $query = $this->db->query("SELECT * FROM betfair_events WHERE DATE(openDate) = CURDATE() ORDER BY openDate ASC");  
	if($query->num_rows()>0)
	{
		if($row_only)
		return $query->row();
			else
		return $query->result();
	}	 
    else
	 return false;
  }
  public function remove_event($id_event)
  {
	  $this->db->delete("betfair_events",array("event_id"=>$id_event));
  }
  public function get_market_catalog_by($data,$row_only=false)
  { 
	$this->db->order_by("totalMatched", "desc");
    $query = $this->db->get_where('betfair_market_catalog',$data);  
	if($query->num_rows()>0)
	{
		if($row_only)
		return $query->row();
			else
		return $query->result();
	}	 
    else
	 return false; 
  }
  
  public function get_runners_by($data,$row_only=false)
  {
    $query = $this->db->get_where('betfair_runners',$data);  
	if($query->num_rows()>0)
	{
		if($row_only)
		return $query->row();
			else
		return $query->result();
	}	 
    else
	 return false;   
  }
  
  
  
  /**IMPORTS*/
  public function import_market_catalog($data)
  {
	  if($this->exist_on_database("betfair_market_catalog", array('marketId'=>$data['marketId'])))
	  {
		$this->db->where("marketId", $data["marketId"]);
        $this->db->update('betfair_market_catalog', $data); 
	  }
	  else
	  {
		$this->db->insert('betfair_market_catalog', $data);   
	  }
  }
  public function import_runners($data)
  {
	  if($this->exist_on_database("betfair_runners", array("selectionId"=>$data["selectionId"])))
	  {
		$this->db->where("selectionId", $data["selectionId"]);
        $this->db->update('betfair_runners', $data); 
	  }
	  else
	  {
		$this->db->insert('betfair_runners', $data);   
	  }
  }
   public function import_competition($data)
  {
	  if(!$this->exist_on_database("betfair_competitions", array("competition_id"=>$data["competition_id"])))
	  {
		$this->db->insert('betfair_competitions', $data);   
	  }
	
  }
     public function import_events($data)
  {
	  if(!$this->exist_on_database("betfair_events", array("event_id"=>$data["event_id"])))
	  {
		$this->db->insert('betfair_events', $data);   
	  }
	  else
	  {
	    $this->db->where("event_id", $data["event_id"]);
        $this->db->update('betfair_events', $data);  
	  }
	
  }
public function exist_on_database($table_name, $data)
{
  $query = $this->db->get_where($table_name, $data);  	
  if($query->num_rows()>0)
	{
	return true;
	}	 
    else
	 return false;   
}
}

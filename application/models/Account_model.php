<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Account_model extends CI_Model
{	
  public function get_user($id_user)
  {
    $query = $this->db->get_where('users',array("id"=>$id_user));  
	return $query->row();
  }
  public function get_users()
  {
    $query = $this->db->get('users');  
	return $query->result();
  }
  public function get_domicilio_departamento()
  {
	$this->db->order_by("nombre", "asc");
    $query = $this->db->get('domicilio_departamento');  
	return $query->result();
  }
  public function get_domicilio_municipio($id_departamento)
  {
	$this->db->order_by("nombre", "asc");
        $query = $this->db->get_where('domicilio_municipio',array("id_departamento"=>$id_departamento));  
	return $query->result();
  }
  
  public function add_user_betting($betting_type, $id_user)
  {
        $data = array("type"=>$betting_type,"id_user"=>$id_user,"date_made"=>  date('Y-m-d H:i:s') );
	$this->db->insert('user_bettings', $data);   
        return $this->db->insert_id();
  }
  public function add_user_betting_selection($data)
  {
   $this->db->insert('user_bettings_selections', $data);    
  }
    public function update_user_betting($id_user_betting,$data)
  {
    $this->db->where("id_user_betting", $id_user_betting);
    $this->db->update('user_bettings',$data);   
  }
  public function get_user_bettings($id_user,$type)
  {
     if($type=="Simple")
     {
      $this->db->select('*');
      $this->db->from('user_bettings');
      if(!$id_user)
          $data = array('type'=>$type);
      else
          $data = array('id_user'=>$id_user,'type'=>$type);
      
      $this->db->where($data);
      $this->db->join('user_bettings_selections', 'user_bettings.id_user_betting = user_bettings_selections.id_user_betting');
      $query = $this->db->get();
      return $query->result();  
     }
     else 
     {
        $this->db->order_by("date_made", "asc");
          if(!$id_user)
          $data = array('type'=>$type);
      else
          $data = array('id_user'=>$id_user,'type'=>$type);
      
        $query = $this->db->get_where('user_bettings',$data);  
        return $query->result();    
     }
    
  }
  public function get_user_betting_selections($id_user_betting)
  {
    $this->db->order_by("event_openDate", "asc");
    $query = $this->db->get_where('user_bettings_selections',array("id_user_betting"=>$id_user_betting));  
    return $query->result();   
  }
  public function get_betting_selections()
  {
    $query = $this->db->query("select market_id from user_bettings_selections where result = 'UNKNOWN'");  
    return $query->result();   
  }
  public function update_result($id_selection,$result)
  {
    $this->db->where("selection_id", $id_selection);
    $this->db->update('user_bettings_selections', array("result"=>$result));   
  }
    public function get_deposits($id_user)
  {
	$this->db->order_by("date", "asc");
        if(!$id_user)
            $data = array();
            else
            $data = array('id_user'=>$id_user);
        $query = $this->db->get_where('f_deposits',$data);  
	return $query->result();
  }
    public function get_withdraws($id_user)
  {
	$this->db->order_by("date", "asc");
        if(!$id_user)
            $data = array();
            else
            $data = array('id_user'=>$id_user);
        $query = $this->db->get_where('f_withdraws',$data);  
	return $query->result();
  }
  public function get_deposits_sum($id_user, $period="month")
  {
      $this->db->select('SUM(ammount) as total_deposits_sum');
      $this->db->where('id_user', $id_user);
      $query = $this->db->get('f_deposits');
      return $query->row()->total_deposits_sum; 
  }
  public function get_withdraws_sum($id_user, $period="month")
  {
      $this->db->select('SUM(ammount) as total_withdraws_sum');
      $this->db->where('id_user', $id_user);
      $query = $this->db->get('f_withdraws');
      return $query->row()->total_withdraws_sum;
  }
  public function get_losses_sum($id_user, $period="month")
  {
    $this->db->select('SUM(ammount) as total_losses_sum');
      $this->db->where(array('id_user'=> $id_user,"type"=>"LOSER"));
      $query = $this->db->get('f_profits_losses');
      return $query->row()->total_losses_sum;    
  }
  public function get_profits_sum($id_user, $period="month")
  {
    $this->db->select('SUM(ammount) as total_profits_sum');
      $this->db->where(array('id_user'=> $id_user,"type"=>"WINNER"));
      $query = $this->db->get('f_profits_losses');
      return $query->row()->total_profits_sum;  
  }
  public function add_f_profits_losses($data)
  {
    if(!$this->exist_f_profits_losses($data["id_user_betting"]))
    {
      $this->db->insert('f_profits_losses', $data);    
    }
  }
  public function exist_f_profits_losses($id_user_betting)
  {
      
   $query = $this->db->get_where("f_profits_losses", array("id_user_betting"=>$id_user_betting));  	
  if($query->num_rows()>0)
	{
	return true;
	}	 
    else
	 return false;   
}
public function add_suspect_user($data)
{
   if(!$this->exist_suspect_user($data["id_user"]))
    {
      $this->db->insert('user_suspect', $data);    
    } 
    else
    {
     $this->db->where("id_user", $data["id_user"]);
     $this->db->update('user_suspect',$data);  
    }
}
public function exist_suspect_user($id_user)
  {
      
   $query = $this->db->get_where("user_suspect", array("id_user"=>$id_user));  	
  if($query->num_rows()>0)
	{
	return true;
	}	 
    else
	 return false;   
}
public function get_suspect_users($id_user)
  {
    if(!$id_user)
            $data = array();
            else
            $data = array('id_user'=>$id_user);   
   $query = $this->db->get_where("user_suspect", $data);  	
  if($query->num_rows()>0)
	{
	return $query->result();
	}	 
    else
	 return false;   
}
public function get_hacienda_users($id_user)
  {
    if(!$id_user)
            $data = array();
            else
            $data = array('id_user'=>$id_user);   
   $query = $this->db->get_where("users_hacienda", $data);  	
  if($query->num_rows()>0)
	{
	return $query->result();
	}	 
    else
	 return false;   
}
public function get_ludopatas_users($id_user)
  {
    if(!$id_user)
            $data = array();
            else
            $data = array('id_user'=>$id_user);   
   $query = $this->db->get_where("users_ludopatas", $data);  	
  if($query->num_rows()>0)
	{
	return $query->result();
	}	 
    else
	 return false;   
}
}

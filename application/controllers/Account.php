<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller 
{
	public function __construct()
	{
	   parent::__construct();
	   $this->load->helper('general'); 
	   $this->load->model('Betfair');
	   $this->load->model('Account_model');
	  // $this->load->model('Ion_auth_model');
	   $this->load->library('Ion_auth');
           
	}
	public function index() 
	{
	    $data = array();
            if($this->session->userdata("user_id"))
            {
             $data["id_user"] = $this->session->userdata("user_id");
            }
            else
            {
                redirect('/?initLogin=true');
            }
            $data["user"] = $this->Account_model->get_user($data["id_user"]);
            $data["departamentos"] = $this->Account_model->get_domicilio_departamento();
            $data["municipios"] =  $this->Account_model->get_domicilio_municipio($data["user"]->departamento);
            $data["page_title"] = "Mi Cuenta";
            $this->template->load('account/index',$data);   
	}
        public function deposits()
        {
             $data = array();
          if($this->session->userdata("user_id"))
            {
            $data["id_user"] = $this->session->userdata("user_id");
            $data["user"] = $this->Account_model->get_user($data["id_user"]);
            }
            else
            {
                redirect('/?initLogin=true');
            }
            $data["deposits"] = $this->Account_model->get_deposits($data["id_user"]); 
            $data["page_title"] = "Depositos";
            $this->template->load('account/deposits',$data); 
        }
        public function withdraws()
        {
          $data = array();
          if($this->session->userdata("user_id"))
            {
                $data["id_user"] = $this->session->userdata("user_id");
                $data["user"] = $this->Account_model->get_user($data["id_user"]);
            }
            else
            {
                redirect('/?initLogin=true');
            }
            $data["withdraws"] = $this->Account_model->get_withdraws($data["id_user"]); 
            $data["page_title"] = "Retiradas";
            $this->template->load('account/withdraws',$data);   
        }
        public function add_funds()
        {
             $data = array();
          if($this->session->userdata("user_id"))
		{
	        $data["id_user"] = $this->session->userdata("user_id");
		$data["user"] = $this->Account_model->get_user($data["id_user"]);
		}
                else
            {
                redirect('/?initLogin=true');
            }
            $data["page_title"] = "Agregar fondos";
            $this->template->load('account/add_funds',$data);  
        }
		 public function add_withdraw()
        {
             $data = array();
          if($this->session->userdata("user_id"))
		{
	        $data["id_user"] = $this->session->userdata("user_id");
		$data["user"] = $this->Account_model->get_user($data["id_user"]);
		}
                else
            {
                redirect('/?initLogin=true');
            }
            $data["page_title"] = "Retirar";
            $this->template->load('account/withdraw',$data);  
        }
	public function login()
	{
		$data = array();
	  	$email = $this->input->post('username');
		$contrasena = $this->input->post('password');
		$recordar = $this->input->post('recordar');
		$id = $this->ion_auth->login($email, $contrasena, $recordar);
		if($id)
		{
		    $user = $this->Account_model->get_user($id);
			$data["username"] = $user->first_name;
			$data["balance"] = $user->credits;
			$data["response"] = "success";
		}
		else
		{
			$data["response"] = "error";
		}
		echo json_encode($data);
	}
	function logout()
	{
	  $logout = $this->ion_auth->logout();
      redirect('', 'refresh');
	}
	public function submit_user()
	{
		$data = array();
		$tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
		$email = strtolower($this->input->post('email'));
        $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
	    $additional_data = array
		(
					 "first_name"=>$this->input->post('first_name'),
					 "last_name"=>$this->input->post('last_name'),
					 "cedula"=>$this->input->post('cedula'),
					 "fecha_nacimiento"=>$this->input->post('fecha_nacimiento'),
					 "departamento"=>$this->input->post('departamento'),
					 "municipio"=>$this->input->post('municipio'),
					 "ciudad"=>$this->input->post('ciudad'),
					 "direccion"=>$this->input->post('direccion'),
					 "phone"=> $this->input->post('phone')
	    );
		$id =  $this->ion_auth->register($identity, $this->input->post('contrasena'), $this->input->post('email'), $additional_data,array(2));
		if($id)
		{
			$data["response"] = "success";
		}
		else
		{
			$data["response"] = "error";
		}		
		echo json_encode($data);
	}
        public function update_user()
	{
            $data = array();
            $data["id_user"] = $this->session->userdata("user_id");
	    $additional_data = array
		(
                    "first_name"=>$this->input->post('first_name'),
                    "last_name"=>$this->input->post('last_name'),
                    "fecha_nacimiento"=>$this->input->post('fecha_nacimiento'),
                    "departamento"=>$this->input->post('departamento'),
                    "municipio"=>$this->input->post('municipio'),
                    "ciudad"=>$this->input->post('ciudad'),
                    "direccion"=>$this->input->post('direccion')
	        );
		$id =  $this->ion_auth->update_user($data["id_user"],$additional_data );
		if($id)
		{
		  $data["response"] = "success";
		}
		else
		{
		  $data["response"] = "error";
		}		
		echo json_encode($data);
	}
	public function register_form()
	{
	 $data["page_title"] = "Formulario de Registro";
	 $data["international_competitions"] = $this->Betfair->get_international_competitions();
	 $data["departamentos"] = $this->Account_model->get_domicilio_departamento();
	 $this->template->load('account/register',$data);
	}
	public function  get_municipios()
	{
		$data["municipios"] = $this->Account_model->get_domicilio_municipio($this->input->post("id_departamento"));
		echo json_encode($data);
	}
}

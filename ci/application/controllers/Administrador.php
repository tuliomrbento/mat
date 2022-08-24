<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador extends CI_Controller {

	private $head = [
		'title' => 'PAT'
		, 'description' => ''
	];
	private $home = [];
	private $foot = [];
 
    function __construct()
    {
        parent::__construct();

        if(!$this->session->adm)
        {
            redirect('/login');
        } 

    }

	public function index()
	{
		$this->head['title'] = 'Gerenciamento';
 
		$this->load->view('administrador/head',$this->head);
		$this->load->view('administrador/index',$this->home);
		$this->load->view('administrador/foot',$this->foot);
	}

	public function empresas($act = '',$id = false)
	{

		$this->head['title'] = 'Gerenciamento';

		switch($act)
		{
			case 'form':

				if(isset($id))
				{
					$this->home['id'] = $id;
				}

				$this->load->view('administrador/head',$this->head);
				$this->load->view('administrador/empresas_form',$this->home);
				$this->load->view('administrador/foot',$this->foot);

				break;			
			case 'login':

				$this->home['id_empresa'] = $id;
	 
				$this->load->view('administrador/head',$this->head);
				$this->load->view('administrador/empresas_login',$this->home);
				$this->load->view('administrador/foot',$this->foot);

				break;
			default:

				$this->load->view('administrador/head',$this->head);
				$this->load->view('administrador/empresas',$this->home);
				$this->load->view('administrador/foot',$this->foot);
				
				break;
		}	
	}

}

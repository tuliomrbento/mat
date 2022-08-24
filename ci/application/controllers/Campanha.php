<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campanha extends CI_Controller {

	private $head = [
		'title' => 'PAT'
		, 'description' => ''
	];
	private $home = [];
	private $foot = [];
 
    function __construct()
    {
        parent::__construct();

        if(!$this->session->campanha)
        {
            redirect('/login');
        } 

    }

	public function index()
	{
		$this->head['title'] = 'Gerenciamento';
 
		$this->load->view('campanha/head',$this->head);
		$this->load->view('campanha/index',$this->home);
		$this->load->view('campanha/foot',$this->foot);
	}

	public function participantes($act = '',$id = false)
	{

		$this->head['title'] = 'Gerenciamento';

		switch($act)
		{
			case 'form':

				if(isset($id))
				{
					$this->home['id'] = $id;
				}

				$this->load->view('campanha/head',$this->head);
				$this->load->view('campanha/participantes_form',$this->home);
				$this->load->view('campanha/foot',$this->foot);

				break;			
			case 'login':

				$this->home['id_empresa'] = $id;
	 
				$this->load->view('campanha/head',$this->head);
				$this->load->view('campanha/participantes_login',$this->home);
				$this->load->view('campanha/foot',$this->foot);

				break;
			default:

				$this->load->view('campanha/head',$this->head);
				$this->load->view('campanha/participantes',$this->home);
				$this->load->view('campanha/foot',$this->foot);
				
				break;
		}	
	}

}

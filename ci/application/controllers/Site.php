<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

	private $head = [
		'title' => 'PAT'
		, 'description' => ''
	];
	private $home = [];
	private $foot = [];
 
	public function sair()
	{
		session_destroy();
		redirect('/');
	}

	public function index()
	{
		$this->head['title'] = 'Sistema Marketing';

		$this->load->view('site/head',$this->head);
		$this->load->view('site/home',$this->home);
		$this->load->view('site/foot',$this->foot);
	}

	public function cliente()
	{
		$this->head['title'] = 'Seja Cliente';
		
		if($this->input->post())
		{

			$dados = $this->input->post('dados');

			$this->load->model('Default_Model','database');

			if($this->database->getRow('SELECT id FROM pat.empresa WHERE cnpj = ? ',[$dados['cnpj']]))
			{
				$this->home['msg'] = '<div class="alert alert-danger">Empresa Já Cadastrada.</div>';
			}else{
				
				$id = $this->database->save('empresa',$dados);

				if($id)
				{
					$this->home['msg'] = '<div class="alert alert-success">Empresa Cadastrada '.$id.'</div>';
				}else{
					$this->home['msg'] = '<div class="alert alert-warning">Empresa Não Cadastrada.</div>';
				}

			}


		}

		$this->load->view('site/head',$this->head);
		$this->load->view('site/cliente',$this->home);
		$this->load->view('site/foot',$this->foot);
	}

	public function login()
	{
		$this->head['title'] = 'Login';

		if($this->input->post())
		{

			$dados = $this->input->post('dados');

			$this->load->model('Default_Model','database');

			$login = $this->database->getRow('SELECT * FROM pat.usuario WHERE usuario = ? ',[$dados['nome']]);

			if($login)
			{ 
				if($login->senha == $dados['senha'])
				{
					$perfil = '';
					switch($login->perfil)
					{
						case 'A':
							$this->session->set_userdata(['adm' => $login]);
							$redirect = '/administrador';
							$perfil = 'Administrador';
							break;
						case 'E':
							$this->session->set_userdata(['job' => $login]);
							$redirect = '/empresa';
							$perfil = 'Empresa';
							break;
						case 'C':
							$this->session->set_userdata(['campanha' => $login]);
							$redirect = '/campanha';
							$perfil = 'Campanha';
							break;
					}

					if($redirect)
					{
						redirect($redirect);
						die();
					}

					$this->home['msg'] = '<div class="alert alert-success">Usuário '.$perfil.'.</div>';
				}else{
					$this->home['msg'] = '<div class="alert alert-warning">Senha inválida.</div>';
				}
				
			}else{
				$this->home['msg'] = '<div class="alert alert-danger">Usuário Não Encontrado.</div>';
			}

		}

		$this->load->view('site/head',$this->head);
		$this->load->view('site/login',$this->home);
		$this->load->view('site/foot',$this->foot);
	}
}

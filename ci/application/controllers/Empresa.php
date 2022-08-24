<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends CI_Controller {

	private $head = [
		'title' => 'PAT'
		, 'description' => ''
	];
	private $home = [];
	private $foot = [];
 
    function __construct()
    {
        parent::__construct();

        if(!$this->session->job)
        {
            redirect('/login');
        } 

    }

	public function index()
	{
		$this->head['title'] = 'Gerenciamento';
 
		$this->load->view('empresa/head',$this->head);
		$this->load->view('empresa/index',$this->home);
		$this->load->view('empresa/foot',$this->foot);
	}

	public function campanha($act = '',$id = false)
	{

		$this->head['title'] = 'Gerenciamento - Campanha';

		switch($act)
		{
			case 'etapas':
 
				$this->home['id_campanha'] = $id;
 
				$this->load->view('empresa/head',$this->head);
				$this->load->view('empresa/etapas_form',$this->home);
				$this->load->view('empresa/foot',$this->foot);

				break;
			case 'form':

				if(isset($id))
				{
					$this->home['id'] = $id;
				}

				$this->load->view('empresa/head',$this->head);
				$this->load->view('empresa/campanha_form',$this->home);
				$this->load->view('empresa/foot',$this->foot);

				break;
			case 'login':
	
				$this->home['id_campanha'] = $id;

				$this->load->view('empresa/head',$this->head);
				$this->load->view('empresa/campanha_senha',$this->home);
				$this->load->view('empresa/foot',$this->foot);

				break;
			case 'participantes':
	
				$this->home['id_campanha'] = $id;
  
				$header = []; 

				$this->load->model('Default_Model','database');
				$itensObj = $this->database->getRows('SELECT * FROM campanha_padrao WHERE exibe = 1 AND id_campanha = ?  ORDER BY ordem ASC',[$id]);
				foreach($itensObj as $a)
				{
					$header[] = utf8_decode($a->nome);
				}

				$this->home['header'] = $header;

				$this->load->view('empresa/head',$this->head);
				$this->load->view('empresa/participantes_form',$this->home);
				$this->load->view('empresa/foot',$this->foot);

				break;
			case 'participantes_exportar':
  
				$this->load->model('Default_Model','database');

				$header = [];
				$itens = [];
				
				$header['STATUS'] = '';
				$itensObj = $this->database->getRows('SELECT * FROM campanha_padrao WHERE id_campanha = ? ORDER  BY ordem ASC, id DESC',[$id]);
				foreach($itensObj as $a)
				{
					$header[utf8_decode($a->nome)] = '';
				}

				$itens[] = $header;

				$objs = $this->database->getRows('SELECT * FROM campanha_participantes WHERE id_campanha = ? AND indice > 0',[$id]);
				foreach($objs as $obj)
				{
					$bdy = [];
					$arrys = unserialize(utf8_decode($obj->line));
					if($arrys)
					{ 
						$bdy[] = $obj->status; 

						foreach($arrys as $arry)
						{
							$bdy[] = $arry; 
						}

						$itens[] = $bdy;
					}
				}

				// Ranking Loja
				header('Content-Type: text/csv');
				header('Content-Disposition: attachment; filename="padrao-'.date('d-m-Y').'.csv"');
				
				$fp = fopen('php://output', 'wb');
				fputcsv($fp, array_keys($itens[0]), ';', '"');
				unset($itens[0]);
				foreach ( $itens as $item ) { 
					fputcsv($fp, $item, ';','"');
				}
				fclose($fp);
				die();

				break;
			case 'participantes_importar':

				$this->home['id_campanha'] = $id;
  
				$this->load->view('empresa/head',$this->head);
				$this->load->view('empresa/participantes_importar',$this->home);
				$this->load->view('empresa/foot',$this->foot);

				break;
			case 'criar_padrao':

				$this->home['id_campanha'] = $id;
  
				$this->load->view('empresa/head',$this->head);
				$this->load->view('empresa/criar_padrao',$this->home);
				$this->load->view('empresa/foot',$this->foot);

				break;
			default:

				$this->load->view('empresa/head',$this->head);
				$this->load->view('empresa/campanha',$this->home);
				$this->load->view('empresa/foot',$this->foot);
				
				break;
		}	
	}

	public function etapas($act = '',$id = false)
	{

		$this->head['title'] = 'Gerenciamento - Campanha';

		switch($act)
		{
			case 'etapas':
 
				$this->home['id_campanha'] = $id;
 
				$this->load->view('empresa/head',$this->head);
				$this->load->view('empresa/etapas_form',$this->home);
				$this->load->view('empresa/foot',$this->foot);
				
				break;
		}

	}


}

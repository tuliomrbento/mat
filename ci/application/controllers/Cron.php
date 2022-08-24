<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {
   
    function __construct()
    {
        parent::__construct(); 
    }

    private function returnJson($data,$code = 200)
    {
        http_response_code($code);

        header('Content-Type: application/json');
        echo json_encode($data);
        die();
    }

	public function index()
	{
		$this->returnJson([
            'message' => 'Schedule P.A.T'
        ]);
	} 

	public function importar()
	{
        $retorno = [];

        $this->load->model('Default_Model','database');

        $import = $this->database->getRow('SELECT * FROM campanha_importacao WHERE status = ? ',['N']);

        if($import)
        {

            $retorno['file'] = $import->arquivo_nome;

            $file = $import->arquivo_url;
            
            $info = pathinfo($file);
  
            $retorno['info'] = [
                'extension' => $info['extension']
                , 'size' => filesize($file)
            ];

            // Update to execution

            $this->database->save('campanha_importacao',[
                'id' => $import->id
                , 'status' => 'E'
            ]);

            // RODANDO 

            try{

                switch($info['extension'])
                {
                    case 'csv':
                        
                        $file = $import->arquivo_url;
                        ini_set('auto_detect_line_endings',TRUE); 
                        if (($handle = fopen($file, "r")) !== FALSE) 
                        { 
                            $dataExport = [];
                                 
                                  
                            $a = 0;

                            while ( ($data = fgetcsv($handle,1000,';') ) !== FALSE ) {
                                   
                                //process
                                $line = utf8_encode(serialize($data));
  
                                if($a){
                                    $this->database->save('campanha_participantes',[
                                        'status' => 1,
                                        'id_campanha' => $import->id_campanha
                                        , 'id_import' => $import->id
                                        , 'indice' => $a
                                        , 'line' => $line
                                    ]);
                                }
                                

                                $a++;

                            } 
                        } 
                        ini_set('auto_detect_line_endings',FALSE);


                        $retorno['success'] = true;
                        $retorno['mensagem'] = 'Importado '.$a.' itens.';

                        $this->database->save('campanha_importacao',[
                            'id' => $import->id
                            , 'status' => 'P'
                        ]);

                        break;
                }


            }catch(Exception $e)
            {
                $retorno['error'] = true;
                $retorno['message'] = $e;
            }

             
        }else{

            $retorno['error'] = true;
            $retorno['message'] = 'Sem Importação.';

        }

		$this->returnJson($retorno);
	} 

}

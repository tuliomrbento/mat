<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");

defined('BASEPATH') OR exit('No direct script access allowed');

class Mycontroller extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        if(!$this->authorize())
        {
            $this->returnJson([
                'message'=>'Requisição não Autorizada'
            ],401);
        }

        $this->load->model('Default_Model','database');
 
    }

    private function authorize()
    {
        $return = false;

        if(isset($_SERVER['HTTP_AUTHORIZATION']) && $_SERVER['HTTP_AUTHORIZATION'] == 'Bearer tumax')
        {
            $return = true;
        }

        return $return;        
    }

    public function returnJson($data,$code = 200)
    {
        http_response_code(200);

        header('Content-Type: application/json');
        echo json_encode($data);
        die();
    }

	public function index($version = 'v1')
	{
        switch($version)
        {
            case 'v1':
 
                $this->returnJson([
                    'message' => 'API PAT, Versão V1'
                ], 405 );

                break;
            default;
                
                $this->returnJson([
                    'message' => 'Versão não informada'
                ], 405 );
                
                break;
        }
	}

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getData()
    { 
        return (isset($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] == 'application/json') ?  json_decode(file_get_contents('php://input'),true) : $_REQUEST;
    }

    public function validateData($str,$data)
    {
        $return = true;
        foreach($str as $k => $v)
        {
            if($v['valid'])
            { 
                if(empty($data[$k]))
                {
                    $return = false;
                }
            }
        }

        return $return;
    }

    public function oauth()
	{
        $data = $this->getData();
        
        $valid = $this->validateData([
            'usuario' => [
                'type'=>'string'
                , 'valid' => true
            ]
            , 'senha' => [
                'type' => 'string'
                , 'valid' => true
            ]
        ],$data);

        if($valid)
        {
            $user = $this->database->getRow('SELECT * FROM usuario WHERE usuario = ? ',[$data['usuario']]);

            if($user)
            {

                if($user->senha == $data['senha'])
                {

                    $this->returnJson([
                        'message' => 'Bem-Vindo'
                        , 'token' => base64_encode('PAT:'.$user->id)
                        , 'perfil' => $user->perfil
                        , 'empresa' => $user->id_empresa
                    ]);

                }else{

                    $this->returnJson([
                        'error' => true
                        , 'message' => 'Senha Inválida, tente novamente.'
                        , 'inputs' => $data
                    ]);

                }

            }else{

                $this->returnJson([
                    'error' => true
                    , 'message' => 'Usuário não encontrado.'
                    , 'inputs' => $data
                ]);   
            }

        }else{

            $this->returnJson([
                'error' => true
                , 'message' => 'Preencha os campos corretamente.'
                , 'inputs' => $data
            ],404);

        }

	}

}

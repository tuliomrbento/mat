<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
defined('BASEPATH') OR exit('No direct script access allowed');

require 'Mycontroller.php';

class Api extends Mycontroller {

    function __construct()
    {
        parent::__construct();

    }

    private function getUser()
    { 
        if(isset($_SERVER['HTTP_USER']))
        {
            $idUser = str_replace('PAT:','',base64_decode($_SERVER['HTTP_USER']));
            $usuario = $this->database->getRow('SELECT * FROM usuario WHERE id = ? ',[$idUser]);
            if($usuario)
            {
                if($usuario)
                {
                    $empresa = $this->database->getRow('SELECT * FROM empresa WHERE id = ? ',[$usuario->id_empresa]);
                }
            }
        }
        return [
            'usuario' => isset($usuario) ? $usuario : []
            , 'empresa' => isset($empresa) ? $empresa : []
        ];
    }

    public function empresas_login()
    {
        $data = $this->getData();

        $user = $this->getUser();
        

        switch($this->getMethod())
        {
            case 'GET':
 
                if(isset($data['id_empresa']))
                    $item = $this->database->getRow('SELECT * FROM usuario WHERE id_empresa = ? ',[$data['id_empresa']]);

                $retorno = [ 
                    'msg' => 'Exibir'
                    , 'item' => isset($item) ? $item : []
                ];

                $this->returnJson($retorno);
            
                break;
            case 'POST':
                
                $id = $this->database->save('usuario',$data);

                $retorno = [
                    'status' => 200
                    , 'message' => 'Inserido com Sucesso.'
                    , 'id' => $id
                    , 'data' => $data
                ];

                $this->returnJson($retorno);

                break;
            case 'PUT':

                $id = $this->database->save('empresa',$data);
  
                $this->returnJson([
                    'status' => 200
                    , 'message' => 'Atualizado com Sucesso.'
                    , 'id' => $id
                    , 'data' => $data
                ]);

                break;
            case 'DELETE':

                break;
        }

    }

    public function empresas()
    { 
        $data = $this->getData();

        $user = $this->getUser();
        

        switch($this->getMethod())
        {
            case 'GET':

                if(isset($data['id']))
                {

                    $item = $this->database->getRow('SELECT * FROM empresa WHERE id = ? ',[$data['id']]);

                    $retorno = [ 
                        'msg' => 'Exibir'
                        , 'item' => $item
                    ];

                    $this->returnJson($retorno);

                }

                $limited = ($data['pg'] * $data['limit']) . ', '. $data['limit'];

                $filter = [];
                $filter[] = 1;
        
                $obj = [];
        
                foreach($data['filter'] as $k => $v)
                {
                    if(!empty($v))
                    {
                        $obj[] = $v;
                        $filter[] = $k . ' = ? ';
                    }
                }
        
                $itens = $this->database->getRows('SELECT * FROM empresa WHERE '.implode(' AND ',$filter).' LIMIT ' . $limited,$obj);
        
                $outputHtml = '';
                foreach($itens as $item)
                {
                    $status = '';
                    $btns = '';
                    switch($item->status)
                    {
                        case 'N': $status = 'Novo'; break;
                        case 'A': $status = 'Aprovado'; break;
                        case 'R': $status = 'Reprovado'; break;
                    }
        
                    $outputHtml .= '<tr>'
                                . '<td>'.$item->razao_social.'</td>'
                                . '<td>'.$item->cnpj.'</td>'
                                . '<td>'.$status.'</td>'
                                . '<td>
                                    <a href="'.base_url('administrador/empresas/form/'.$item->id).'">Editar</a>
                                    <a href="'.base_url('administrador/empresas/login/'.$item->id).'">Login</a>
                                  </td>'
                                . '</tr>';
                }

                $retorno = [ 
                    'msg' => 'Exibir Empresas'
                    , 'parans' => $data 
                    , 'itens' => $itens
                    , 'html' => $outputHtml
                    , 'user' => isset($user) ? $user : []
                ];
                
            
                $this->returnJson($retorno);

                break;
            case 'POST':
   
                $id = $this->database->save('empresa',$data);

                $retorno = [
                    'status' => 200
                    , 'message' => 'Inserido com Sucesso.'
                    , 'id' => $id
                    , 'data' => $data
                ];

                $this->returnJson($retorno);

                break;
            case 'PUT':

                $id = $this->database->save('empresa',$data);
  
                $this->returnJson([
                    'status' => 200
                    , 'message' => 'Atualizado com Sucesso.'
                    , 'id' => $id
                    , 'data' => $data
                ]);

                break;
            case 'DELETE':

                break;
        }

    }

    
    public function campanhas()
    { 
        $data = $this->getData();

        $user = $this->getUser();
        

        switch($this->getMethod())
        {
            case 'GET':

                if(isset($data['id']))
                {

                    $item = $this->database->getRow('SELECT * FROM campanha WHERE id = ? ',[$data['id']]);

                    $retorno = [ 
                        'msg' => 'Exibir'
                        , 'item' => $item
                    ];

                    $this->returnJson($retorno);

                }

                if(isset($data['empresa'])){

                    $item = $this->database->getRow('SELECT * FROM campanha WHERE id_empresa = ? ',[$data['empresa']]);

                    $history_imports = $this->database->getRows('SELECT * FROM pat.campanha_importacao;');

                    $retorno = [ 
                        'msg' => 'Exibir'
                        , 'item' => $item
                        , 'history_imports' => $history_imports
                    ];

                    $this->returnJson($retorno);

                }

                $limited = ($data['pg'] * $data['limit']) . ', '. $data['limit'];

                $filter = [];
                $filter[] = 1;
        
                $obj = [];
        
                foreach($data['filter'] as $k => $v)
                {
                    if(!empty($v))
                    {
                        $obj[] = $v;
                        $filter[] = $k . ' = ? ';
                    }
                }
        
                $itens = $this->database->getRows('SELECT * FROM campanha WHERE '.implode(' AND ',$filter).' LIMIT ' . $limited,$obj);
        
                $outputHtml = '';
                foreach($itens as $item)
                {
                    $status = '';
                    $btns = '';
                    switch($item->status)
                    { 
                        case 'A': $status = 'Ativo'; break;
                        case 'I': $status = 'Inativo'; break;
                    }
        
                    $outputHtml .= '<tr>'
                                . '<td>'.$item->nome.'</td>'
                                . '<td>'.$item->url.'</td>'
                                . '<td>'.$status.'</td>'
                                . '<td>
                                    <a href="'.base_url('empresa/campanha/form/'.$item->id).'">Editar</a>
                                    <a href="'.base_url('empresa/campanha/login/'.$item->id).'">Login</a>
                                    <a href="'.base_url('empresa/campanha/participantes/'.$item->id).'">Participantes</a>
                                    <a href="'.base_url('empresa/campanha/etapas/'.$item->id).'">Etapas</a>
                                  </td>'
                                . '</tr>';
                }

                $retorno = [ 
                    'msg' => 'Exibir Empresas'
                    , 'parans' => $data 
                    , 'itens' => $itens
                    , 'html' => $outputHtml
                    , 'user' => isset($user) ? $user : []
                ];
                
            
                $this->returnJson($retorno);

                break;
            case 'POST':
   
                $post = [
                    'id_empresa' => $this->session->job->id
                    , 'nome' => $data['nome']
                    , 'url' => $data['url']
                    , 'cor1' => $data['cor1']
                    , 'cor2' => $data['cor2']
                    , 'cor3' => $data['cor3']
                    , 'cor4' => $data['cor4']
                    , 'status' => $data['status']
                ];

                if(isset($data['id']))
                {
                    $post['id'] = $data['id'];
                }
                
                if(isset($data['arquivo']['nome']))
                { 
                    $id_file = uniqid();
                    $arquivo = $id_file.'-'.$data['arquivo']['nome'];

                    $arquivoFile = explode('base64,',$data['arquivo']['base64'])[1];

                    file_put_contents('upload/logo/'.$arquivo,base64_decode($arquivoFile));
                    $post['logo'] = $arquivo;
                }

                $id = $this->database->save('campanha',$post);

                $retorno = [
                    'status' => 200
                    , 'message' => 'Inserido com Sucesso.'
                    , 'id' => $id
                    , 'data' => $data
                ];

                $this->returnJson($retorno);

                break;
            case 'PUT':

                $id = $this->database->save('campanha',$data);
  
                $this->returnJson([
                    'status' => 200
                    , 'message' => 'Atualizado com Sucesso.'
                    , 'id' => $id
                    , 'data' => $data
                ]);

                break;
            case 'DELETE':

                break;
        }

    }
 
    public function campanhas_login()
    {

        $data = $this->getData();

        $user = $this->getUser();
        

        switch($this->getMethod())
        {
            case 'GET':
 
                if(isset($data['id_campanha']))
                    $item = $this->database->getRow('SELECT * FROM usuario WHERE id_campanha = ? ',[$data['id_campanha']]);

                $retorno = [ 
                    'msg' => 'Exibir'
                    , 'item' => isset($item) ? $item : []
                ];

                $this->returnJson($retorno);
            
                break;
            case 'POST':
                
                $id = $this->database->save('usuario',$data);

                $retorno = [
                    'status' => 200
                    , 'message' => 'Inserido com Sucesso.'
                    , 'id' => $id
                    , 'data' => $data
                ];

                $this->returnJson($retorno);

                break;
            case 'PUT':

                $id = $this->database->save('empresa',$data);
  
                $this->returnJson([
                    'status' => 200
                    , 'message' => 'Atualizado com Sucesso.'
                    , 'id' => $id
                    , 'data' => $data
                ]);

                break;
            case 'DELETE':

                break;
        }

    }

    public function participantes($act = 'default')
    { 
        switch($act)
        {
            case 'save':

                $data = $this->getData();
    
                $user = $this->getUser();

                $obj = [];

                $this->returnJson([ 
                    'msg' => 'Salvar'
                    , 'parans' => $data 
                    , 'itens' => $obj
                    , 'user' => isset($user) ? $user : []
                ]);


                break;

            case 'exibe':
                $data = $this->getData();

                $limited = ($data['pg'] * $data['limit']) . ', '. $data['limit'];

                $head = $this->database->getRow('SELECT line FROM pat.campanha_participantes WHERE id_campanha = '.$data["id_campanha"].' AND indice = 0;');

                $itens = $this->database->getRows('SELECT * FROM pat.campanha_participantes WHERE id_campanha = '.$data["id_campanha"].' LIMIT '.$limited.';');

                $qtd = $this->database->getRow('SELECT count(id) as qtd FROM pat.campanha_participantes WHERE '.$data["id_campanha"].' LIMIT 1,18446744073709551610;');

                $this->returnJson([ 
                    'msg' => 'Exibir Participantes'
                    , 'head' => $head
                    , 'itens' => $itens
                    , 'qtd' => [
                        'pgs' => ceil($qtd / $data['limit'])
                        , 'pg' => $data['pg']
                        , 'qtd' => $qtd
                    ]
                ]);

                break;
            default:

                $data = $this->getData();
    
                $user = $this->getUser();
        
                $limited = ($data['pg'] * $data['limit']) . ', '. $data['limit'];
        
                $filter = [];
                $filter[] = 1;
          
                $obj = [];
         
                $obj[] = $data['id_campanha'];
                $filter[] = 'id_campanha' . ' = ? ';
        
                foreach($data['filter'] as $k => $v)
                {
                    if(!empty($v))
                    {
                        $obj[] = $v;
                        $filter[] = $k . ' = ? ';
                    }
                }
                 
                // SELECT * FROM `campanha_participantes` WHERE line REGEXP '.*."Participante 2".*'

                $qtd = $this->database->getRow('SELECT count(id) as qtd FROM campanha_participantes WHERE '.implode(' AND ',$filter).' ',$obj);

                $html = '';
                $itens = $this->database->getRows('SELECT * FROM campanha_participantes WHERE '.implode(' AND ',$filter).' LIMIT ' . $limited,$obj);

                $heads = []; 
                $heads[] = ['nome' => 'STATUS','id' => 'id_status' ];

                $head = $this->database->getRows('SELECT id, nome FROM pat.campanha_padrao WHERE id_campanha = '.$data["id_campanha"].' AND exibe = 1 ORDER BY ordem ASC;');
                foreach($head as $v)
                {
                    $heads[] = ['nome' => $v->nome,'id' => 'id_' . $v->id];
                }

                $head = $heads;
 
                

                foreach($itens as $item)
                {
                    $column = @unserialize($item->line);
                    
                    if($column)
                    { 
                        $html .= '<tr>';

                        foreach($column as $k => $v)
                        {
                            $html .= '<td>'.$v.'</td>'; 
                            
                            $participant['id_status'] = (int) $item->status;
                            $participant[$head[($k + 1)]['id']] = $v;
                        }
                        $html .= '</td>';
                        
                        $obj[] = $column;

                        $allParticipants[] = $participant;
                        
                    }
                }
                
                $this->returnJson([ 
                    'msg' => 'Exibir Participantes'
                    , 'parans' => $data
                    , 'head' => $head
                    , 'participants' => $allParticipants
                    , 'itens' => $obj
                    , 'html' => $html
                    , 'qtd' => [
                        'pgs' => ceil($qtd->qtd / $data['limit'])
                        , 'pg' => $data['pg']
                        , 'qtd' => $qtd->qtd
                    ]
                ]);
            
                break;
        }
    }

    public function padrao()
    { 
        $data = $this->getData();

        $user = $this->getUser();
        

        switch($this->getMethod())
        {
            case 'GET':

                if(isset($data['id']))
                {

                    $item = $this->database->getRow('SELECT * FROM campanha_padrao WHERE id = ? ',[$data['id']]);

                    $retorno = [ 
                        'msg' => 'Exibir'
                        , 'item' => $item
                    ];

                    $this->returnJson($retorno);

                }

                $limited = ($data['pg'] * $data['limit']) . ', '. $data['limit'];

                $filter = [];
                $filter[] = 1;
        
                $obj = [];
        
                foreach($data['filter'] as $k => $v)
                {
                    if(!empty($v))
                    {
                        $obj[] = $v;
                        $filter[] = $k . ' = ? ';
                    }
                }
        
                $qtd = $this->database->getRow('SELECT count(id) as qtd FROM campanha_padrao WHERE '.implode(' AND ',$filter).' ',$obj);

                $itens = $this->database->getRows('SELECT * FROM campanha_padrao WHERE '.implode(' AND ',$filter).' LIMIT ' . $limited,$obj);
        
                $outputHtml = '';
                foreach($itens as $item)
                {  

                    $outputHtml .= '<tr>'
                                . '<td>'.$item->nome.'</td>'
                                . '<td>'.$item->tipo.'</td>'
                                . '<td>'.$item->ordem.'</td>'
                                . '<td>'.(($item->exibe == 0) ? 'Não' : 'Sim') .'</td>'
                                . '<td>
                                    <a href="javascript:;" onclick="get('.$item->id.')">Editar</a>
                                  </td>'
                                . '</tr>';
                }

                $retorno = [ 
                    'msg' => 'Exibir Empresas'
                    , 'parans' => $data 
                    , 'itens' => $itens
                    , 'html' => $outputHtml
                    , 'user' => isset($user) ? $user : []
                    , 'qtd' => [
                        'pg' => $data['pg']
                        , 'pgs' => ceil($qtd->qtd / $data['limit'])
                        , 'qtd' => $qtd->qtd
                    ]
                ];
                
            
                $this->returnJson($retorno);

                break;
            case 'POST':
   
                $post = [
                    'id_campanha' => $data['filter']['id_campanha']
                    , 'tipo' => $data['tipo']
                    , 'nome' => $data['nome']
                    , 'ordem' => $data['ordem']
                    , 'exibe' => $data['exibe']
                ];

                if(isset($data['id']))
                {
                    $post['id'] = $data['id'];
                }

                $id = $this->database->save('campanha_padrao',$post);

                $retorno = [
                    'status' => 200
                    , 'message' => 'Inserido com Sucesso.'
                    , 'id' => $id
                    , 'data' => $data
                ];

                $this->returnJson($retorno);

                break;
            case 'PUT':

                $id = $this->database->save('campanha_padrao',$data);
  
                $this->returnJson([
                    'status' => 200
                    , 'message' => 'Atualizado com Sucesso.'
                    , 'id' => $id
                    , 'data' => $data
                ]);

                break;
            case 'DELETE':

                break;
        }

    }

    public function participantes_export(){
        $data = $this->getData();
        switch($this->getMethod())
        {
            case 'GET':
                $this->load->model('Default_Model','database');

                $header = [];
                $itens = [];

                $itensObj = $this->database->getRows('SELECT * FROM campanha_padrao WHERE id_campanha = ? ORDER  BY ordem ASC, id DESC',[$data['id']]);
                foreach($itensObj as $a)
                {
                    array_push($header, $a->nome);
                }


                // // Ranking Loja
                // header('Content-Type: text/csv');
                // header('Content-Disposition: attachment; filename="padrao-'.date('d-m-Y').'.csv"');
                
                // $fp = fopen('php://output', 'wb');
                // fputcsv($fp, array_keys($itens[0]), ';', '"');
                // foreach ( $itens as $item ) { 
                //     fputcsv($fp, $item, ';','"');
                // }
                // fclose($fp);
                
                $retorno = [ 
                    'msg' => 'Exibir'
                    , 'item' => $header
                ];

                $this->returnJson($retorno);

                break;
        }
    }

    public function participantes_importar()
    {
        $data = $this->getData();

        $user = $this->getUser();
        

        switch($this->getMethod())
        {
            case 'GET':

                if(isset($data['id']))
                {

                    $item = $this->database->getRow('SELECT * FROM campanha_padrao WHERE id = ? ',[$data['id']]);

                    $retorno = [ 
                        'msg' => 'Exibir'
                        , 'item' => $item
                    ];

                    $this->returnJson($retorno);

                }

                $limited = ($data['pg'] * $data['limit']) . ', '. $data['limit'];

                $filter = [];
                $filter[] = 1;
        
                $obj = [];

                $obj[] = $data['id_campanha'];
                $filter[] = 'id_campanha = ? ';
        
                foreach($data['filter'] as $k => $v)
                {
                    if(!empty($v))
                    {
                        $obj[] = $v;
                        $filter[] = $k . ' = ? ';
                    }
                }
        
                $qtd = $this->database->getRow('SELECT count(id) as qtd FROM campanha_importacao WHERE '.implode(' AND ',$filter).' ',$obj);

                $order = 'ORDER BY id DESC';
                $itens = $this->database->getRows('SELECT * FROM campanha_importacao WHERE '.implode(' AND ',$filter).' '.$order.' LIMIT ' . $limited,$obj);
        
                $outputHtml = '';
                foreach($itens as $item)
                {  
                    $user = $this->database->getRow('SELECT * FROM usuario WHERE id = '.$item->id_usuario);

                    $status = '';
                    $endLine = '';
                    switch($item->status)
                    {
                        case 'N':
                            $status = 'Novo';
                            break;
                        case 'P':
                            $status = 'Importado';
                            $endLine = ' em '.date('d/m/Y H:i',strtotime($item->atualizado_em));
                            break;
                        case 'E':
                            $status = 'Em Execução';
                            break;
                        case 'C':
                            $status = 'Cancelado';
                            break;
                    }


                    $outputHtml .= '<tr>'
                                . '<td>Status <b>'.$status.' '. $endLine.'</b>, Nome do Arquivo: <b><a href="'.base_url($item->arquivo_url).'">'.$item->arquivo_nome.'</a></b>, Criado em: <b>'.date('d/m/Y H:i',strtotime($item->criado_em)).'</b>, Por: <b>'.$user->usuario.'</b></td>' 
                                . '</tr>';
                }

                $retorno = [ 
                    'msg' => 'Exibir Empresas'
                    , 'parans' => $data 
                    , 'itens' => $itens
                    , 'html' => $outputHtml 
                    , 'qtd' => [
                        'pg' => $data['pg']
                        , 'pgs' => ceil($qtd->qtd / $data['limit'])
                        , 'qtd' => $qtd->qtd
                    ]
                ];
                
            
                $this->returnJson($retorno);

                break;
            case 'POST':

                if(isset($data['arquivo']))
                {
                    // Validate Cabeçalho
                    $header = []; 
    
                    $itensObj = $this->database->getRows('SELECT * FROM campanha_padrao WHERE id_campanha = ? ',[$data['id_campanha']]);
                    foreach($itensObj as $a)
                    {
                        $header[] = utf8_decode($a->nome);
                    }
    
                    $headerArr = $header; 

                    $file = $data['arquivo']['base64'];
                    if (($handle = fopen($file, "r")) !== FALSE) 
                    { 
                        $dataExport = [];
                        
                        $error = false;
                        $errors = [];

                        $a = 0;
                        while (($dataFile = fgetcsv($handle, 1000, ";")) !== FALSE) 
                        {
                            // validate header
                            if($a == 0)
                            {
                                if(count($dataFile) <> count($header))
                                {
                                    $errors[] = ' Padrão incorreto, '.count($dataFile).' enviado, '. count($header).' padrão. ';
                                    $error = true;
                                }

                                foreach($dataFile as $k => $v)
                                {
                                    
                                    if(!isset($header[$k]))
                                    {
                                        $errors[] = ' Padrão não informado ['.$k.'] ';
                                        $error = true;
                                    }elseif($header[$k] <> $v)
                                    {
                                        $errors[] = ' Padrão inválido ['.$k.'] ';
                                        $error = true;
                                    }
                                }
                            }  
                            $a++;
                        }

                        if($error)
                        {   
                            $retorno = [
                                'error' => true
                                , 'message' => 'Padrão inválido.'
                                , 'errors' => $errors
                            ];
                            $this->returnJson($retorno); 
                        }
  
                        // Continue
                        $file_ = pathinfo($data['arquivo']['nome']);
                        $fileDirName = 'upload/importacao/'.uniqid().'.'.$file_['extension'];
                        file_put_contents($fileDirName,base64_decode(explode(',',$data['arquivo']['base64'])[1]));

                        $oid = $this->database->save('campanha_importacao',[
                            'id_campanha' => $data['id_campanha']
                            , 'id_usuario' => $data['id_empresa'] ? $data['id_empresa'] : $this->session->job->id
                            , 'arquivo_nome' => $data['arquivo']['nome']
                            , 'arquivo_url' => $fileDirName
                            , 'status' => 'N'
                        ]);

                        $retorno = [ 
                            'message' => 'Padrão correto, importação em processo.'
                            , 'oid' => $oid
                        ];
                        $this->returnJson($retorno); 

                    }
                    echo '3';

                    die();

                }else{ 

                    $retorno = [
                        'error' => true
                        , 'message' => 'Arquivo não informado.'
                    ];

                    $this->returnJson($retorno,400);
                }

                if(isset($data['id']))
                {
                    $post['id'] = $data['id'];
                }

                $id = $this->database->save('campanha_padrao',$post);

                $retorno = [
                    'status' => 200
                    , 'message' => 'Inserido com Sucesso.'
                    , 'id' => $id
                    , 'data' => $data
                ];

                $this->returnJson($retorno);

                break;
            case 'PUT':

                $id = $this->database->save('campanha_padrao',$data);
  
                $this->returnJson([
                    'status' => 200
                    , 'message' => 'Atualizado com Sucesso.'
                    , 'id' => $id
                    , 'data' => $data
                ]);

                break;
            case 'DELETE':

                break;
        }
    }

    public function etapas(){
        $data = $this->getData();

        switch ($this->getMethod()) {
            case 'GET':

                $etapas = $this->database->getRows('SELECT * FROM pat.etapas WHERE id_campanha = '.$data["id_campanha"].';');

                foreach ($etapas as $key => $value) {
                    
                    $obj[$key] = [
                        'id' => $value->id,
                        'idCampain' => $value->id_campanha,
                        'title' => $value->nome,
                        'dateStart' => $value->inicio_em,
                        'dateEnd' => $value->termina_em,
                        'metrics' => empty($value->metricas) ? [] : unserialize($value->metricas) 
                    ];

                }

                $retorno = [ 
                    'status' => 202,
                    'msg' => 'Exibe etapas',
                    'data' => $obj
                ];
                
            
                $this->returnJson($retorno);

                break;
            case 'POST':

                $post = [
                    'id_campanha' => $data['id_campanha']
                    , 'nome' => $data['nome']
                    , 'inicio_em' => $data['inicio_em']
                    , 'termina_em' => $data['termina_em']
                ];

                if(isset($data['id']))
                {
                    $post['id'] = $data['id'];
                }

                //var_dump($post);die();

                $id = $this->database->save('pat.etapas',$post);


                $retorno = [
                    'status' => 202,
                    'message' => 'Inserido com Sucesso.',
                    'id' => $id, 
                    'data' => $data
                ];

                $this->returnJson($retorno);

                break;
            case 'PUT':
                break;
            case 'DELETE':

                $id = $this->database->execute('DELETE FROM pat.etapas WHERE id = '.$data["id"].';');

                $retorno = [
                    'status' => 202,
                    'message' => 'Apagado com Sucesso.',
                    'id' => $id
                ];

                $this->returnJson($retorno);

                break;
            default:
                # code...
                break;
        }
    }

    public function metricas(){
        $data = $this->getData();

        switch ($this->getMethod()) {
            case 'GET':
                break;
            case 'POST':

                break;
            case 'PUT':

                $metricas = serialize($data['kpi']);

                // echo '<pre>';
                // var_dump($metricas,$data);die();

                $put = [
                    'id' => $data['id_etapa'],
                    'metricas' => $metricas
                ];

                $id = $this->database->save('pat.etapas',$put);

                $retorno = [
                    'status' => 202,
                    'message' => 'Inserido com Sucesso.',
                    'id' => $id, 
                    'data' => $data
                ];

                $this->returnJson($retorno);

                break;
            case 'DELETE':
                break;
            default:
                # code...
                break;
        }
    }
 

}


    <style> 
        .msg {position:fixed;width:90%;text-align:center;bottom:0px;left:5%;z-index:9;}

        .form-group label {font-size:12px;}
    </style>

    <div class="container">

        <div class="row"> 
            <div class="col-md-12">
                <div class="msg"></div>
                <div class="float-end">
                    <a href="javascript:history.go(-1);" class="btn btn-secondary">Voltar</a>
                </div>
                <p>Importar Participantes, Formulário</p>
            </div>

            <div class="col-md-4">
                <br/> 
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>Baixar padrão: <b class="arquivo"></b></label>
                        <div class="form-control" style="cursor:pointer;">
                            <a href="<?php echo base_url('empresa/campanha/participantes_exportar/'.$id_campanha) ?>"><i class="fas fa-file-upload"></i> <span class="file_name">Baixar Arquivo</span></a>
                        </div>
                    </div>
                    <div class="col-md-12" class="form-group">
                        <br/>
                        <a href="<?php echo base_url('/empresa/campanha/criar_padrao/'.$id_campanha) ?>" class="btn btn-secondary">Criar Padrão</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <br/>
                <form method="post" action="" onsubmit="return save()">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Importar: <b class="arquivo"></b></label>
                            <div style="display:none;">
                                <input id="file_" type="file" onchange="changeFile(event,'file_')" name="dados[arquivo]" />
                            </div>
                            <div class="form-control" style="cursor:pointer;" onclick="selectFile('file_')">
                                <i class="fas fa-file-upload"></i> <span class="file_nome">Selecionar Aquivo</span>
                            </div>
                        </div>
                        <div class="col-md-12" class="form-group">
                            <br/>
                            <button class="btn btn-block btn-primary" type="submit">Importar</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-12">
                <br/>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Histórico</th>
                        </tr>
                    </thead>
                    <tbody class="tbody_itens">
                        <tr>
                            <td><br/></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

    </div>

    <script type="text/javascript" async >

        window.base_url = '<?php echo base_url() ?>'
   
        window.options = {
            pg: 0
            , limit: 25
            , order_by: {
                label: 'id'
                , type: 'desc'
            }
            , filter: {
                razao: ''
                , cnpj: ''
                , perfil: ''
            }
        }

        <?php echo isset($id_campanha) ? "window.options.id_campanha = ".$id_campanha.";" : '' ?>

        selectFile = (id) => {

            $('#'+id).trigger('click')
        }

        changeFile = (ev,name) => {

            if(ev.srcElement.files[0])
            {
                var file_ = ev.srcElement.files[0]

                $('.' + name + 'nome').html(file_.name)

                window.options.arquivo = {
                    nome: file_.name
                    , base64: ''
                }

                var reader = new FileReader();
                reader.readAsDataURL(file_);
                reader.onload = function () {

                    window.options.arquivo.base64 = reader.result

                };
                reader.onerror = function (error) {
                    console.log('Error: ', error);
                };

            }else{
 
            } 

        }

        get = () => {

            $('.msg').html('<div class="alert alert-info">Carregando Aguarde.</div>')

            $.ajax({
                type: 'GET'
                , headers: {
                    "Authorization": "Bearer tumax"
                }
                , url: window.base_url + 'api/v1/campanhas'
                , data: window.options
                , dataType: 'JSON'
            }).done((e) => {

                if(e.item)
                {
                    if(e.item.logo)
                    {
                        $('.arquivo').html('<a href="' + window.base_url + 'upload/logo/' + e.item.logo + '" target="_blank">'+e.item.logo+'</a>')
                    }

                    $.each(e.item,(e,v) => {
                        console.log(e,v)
                        $('.input_'+e).val(v)
                    })
                }

                $('.msg').html('<div class="alert alert-success">OK.</div>')

                setTimeout(() => {
                    $('.msg').html('');
                },1000)

            }).fail((e) => {
                
                $('.msg').html('<div class="alert alert-info">Carregando Aguarde.</div>')

                setTimeout(() => {
                    $('.msg').html('');
                },1000)
            })

        }

 
        save = () => {

            $('.msg').html('<div class="alert alert-info">Carregando Aguarde.</div>')

            var method_ = 'POST'

            $.ajax({
                type: method_
                , headers: {
                    "Authorization": "Bearer tumax"
                }
                , url: window.base_url + 'api/v1/participantes_importar'
                , data: window.options
                , dataType: 'JSON'
            }).done((e) => {
                
                if(e.error)
                {
                
                    $('.msg').html('<div class="alert alert-danger">' + e.message + '</div>')

                    setTimeout(() => {
                        $('.msg').html('');
                        listagem()
                    },2000)    
                }else{

                    $('.msg').html('<div class="alert alert-danger">' + e.message + '</div>')

                    setTimeout(() => {
                        $('.msg').html('');
                        listagem()
                    },2000) 

                }

            }).fail((e) => {
                
                $('.msg').html('<div class="alert alert-danger">Erro.</div>')

                setTimeout(() => {
                    $('.msg').html('');
                },1000)
            })

            return false;
        }


        listagem = () => {

            $('.msg').html('<div class="alert alert-info">Carregando Aguarde.</div>')

            $.ajax({
                type: 'GET'
                , headers: {
                    "Authorization": "Bearer tumax"
                }
                , url: window.base_url + 'api/v1/participantes_importar'
                , data: window.options
                , dataType: 'JSON'
            }).done((e) => {

                console.log(e)

                if(e.html)
                {
                    $('.tbody_itens').html(e.html)
                }

                $('.msg').html('<div class="alert alert-success">OK.</div>')

                setTimeout(() => {
                    $('.msg').html('');
                },1000)

            }).fail((e) => {
                
                $('.msg').html('<div class="alert alert-info">Carregando Aguarde.</div>')

                setTimeout(() => {
                    $('.msg').html('');
                },1000)
            })

        }

 
        listagem()

 
    </script>
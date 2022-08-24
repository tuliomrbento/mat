
    <style> 
        .msg {position:fixed;width:90%;text-align:center;bottom:0px;left:5%;z-index:9;}

        .form-group label {font-size:12px;}
    </style>

    <div class="container">

        <div class="row"> 
            <div class="col-md-12">
                <div class="msg"></div>
                <div class="float-end">
                </div>
                <p>Etapas da Campanha, Formulário</p>
                <br/>
            </div>
            <div class="col-md-4">
                <form method="post" action="" onsubmit="return save()">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Nome da Etapa:</label>
                            <input type="text" name="dados[nome]" required class="form-control input_nome" autofocus="true" placeholder=""/>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Data Inicial:</label>
                            <input type="text" name="dados[data_inicio]" required class="form-control input_data_inicial mask-data" autofocus="true" placeholder=""/>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Data Final:</label>
                            <input type="text" name="dados[data_final]" required class="form-control input_data_final mask-data" autofocus="true" placeholder=""/>
                        </div>
                        <div class="col-md-12" class="form-group">
                            <br/>
                            <button class="btn btn-primary" type="submit">Salvar</button>
                            <a href="javascript:history.go(-1);" class="btn btn-secondary">Voltar</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Tipo</th>
                            <th>Ordem</th>
                            <th>Exibe</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="tbody_itens">
                        <tr>
                            <td colspan="3" class="text-center">Sem Registro</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-prev"><a onclick="prev()" class="pg_prev" href="javascript:;">Anterior</a></th>
                            <th class="text-center paginacao">1 pg de 1. 0 itens.</th>
                            <th class="text-end"><a onclick="next()" class="pg_next" href="javascript:;">Proximo</a></th>
                        </tr>
                    </tfoot>
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
                , id_campanha: <?php echo $id_campanha ?>
            }
        }

        listagem = () => {

            $('.msg').html('<div class="alert alert-info">Carregando Aguarde.</div>')

            $.ajax({
                type: 'GET'
                , headers: {
                    "Authorization": "Bearer tumax"
                }
                , url: window.base_url + 'api/v1/etapa'
                , data: window.options
                , dataType: 'JSON'
            }).done((e) => {

                console.log(e)

                if(e.html)
                {
                    $('.tbody_itens').html(e.html)
                }

                $('.msg').html('<div class="alert alert-success">OK.</div>')

                $('.paginacao').html( (eval(e.qtd.pg) + 1) + ' pagina de ' + (e.qtd.pgs) + ' pagina. ' + e.qtd.qtd + ' item (ns) .' )
                
                if(e.qtd.pgs > 1 && ((eval(e.qtd.pg) + 1) < e.qtd.pgs))
                {
                    $('.pg_next').show()
                }else{
                    $('.pg_next').hide()
                }

                if(e.qtd.pg > 0)
                {
                    $('.pg_prev').show()
                }else{
                    $('.pg_prev').hide()
                }

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
 
        next = () => {
            window.options.pg++;
            listagem()
        }

        prev = () => {
            window.options.pg--;
            listagem()
        }

        listagem()

        get = (id) => {

            window.options.id = id

            $('.msg').html('<div class="alert alert-info">Carregando Aguarde.</div>')

            $.ajax({
                type: 'GET'
                , headers: {
                    "Authorization": "Bearer tumax"
                }
                , url: window.base_url + 'api/v1/etapa'
                , data: window.options
                , dataType: 'JSON'
            }).done((e) => {

                if(e.item)
                { 
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

            window.options.nome         = $('.input_nome').val()
            window.options.data_inicial  = $('.input_data_inicial').val()
            window.options.data_final   = $('.input_data_final').val()

            var method_ = 'POST'

            $.ajax({
                type: method_
                , headers: {
                    "Authorization": "Bearer tumax"
                }
                , url: window.base_url + 'api/v1/etapa'
                , data: window.options
                , dataType: 'JSON'
            }).done((e) => {
 
                clearForm()
                setTimeout(() => {
                    listagem()
                },500)

            }).fail((e) => {
                
                $('.msg').html('<div class="alert alert-danger">Erro.</div>')

                setTimeout(() => {
                    $('.msg').html('');
                },1000)
            })

            return false;
        }

        clearForm = () => { 

            $('.input_nome').val('')
            $('.input_data_inicial').val('')
            $('.input_data_final').val('')

            delete window.option.id

        }

    </script>
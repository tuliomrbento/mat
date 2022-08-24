
    <style>
        .msg {position:fixed;width:90%;text-align:center;bottom:0px;left:5%;z-index:9;}

        .form-group label {font-size:11px;}
    </style>

    <div class="container">

        <div class="row"> 
            <div class="col-md-12">
                <div class="msg"></div>
                 
                <p>Participantes, Formulário</p>
                <br/>
                <form method="post" action="" onsubmit="return save()">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Nome:</label>
                            <input type="text" name="dados[nome]" class="form-control input_nome" />
                        </div>
                        <div class="col-md-8 form-group">
                            <label>Arquivo:</label>
                            <div class="form-control" style="cursor:pointer;" onclick="javascript:$('.lista').trigger('click');">
                                Selecionar arquivo
                            </div>
                            <div style="display:none;">
                                <input type="file" class="lista" onchange="changeFile(ev,'lista')"/>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <br/>
                            <button class="btn btn-primary" type="submit">Salvar</button> <a href="<?php echo base_url('/administrador/empresas') ?>" class="btn btn-default">Voltar</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>

    <script type="text/javascript" async >

        window.base_url = '<?php echo base_url() ?>'

        window.options = {
            id: <?php echo isset($id) ? $id : '' ?>
        }


        changeFile = (ev,ref) => {
            console.log(ev,ref)
        }

        get = () => {

            $('.msg').html('<div class="alert alert-info">Carregando Aguarde.</div>')

            $.ajax({
                type: 'GET'
                , headers: {
                    "Authorization": "Bearer tumax"
                }
                , url: window.base_url + 'api/v1/participantes'
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

            window.options.nome = $('.input_nome').val()
            window.options.email = $('.input_email').val()
            window.options.telefone = $('.input_telefone').val()
            window.options.cnpj = $('.input_cnpj').val()
            window.options.razao_social = $('.input_razao_social').val()
            window.options.fantasia = $('.input_fantasia').val()
            window.options.status = $('.input_status').val()

            var method_ = 'POST'

            $.ajax({
                type: method_
                , headers: {
                    "Authorization": "Bearer tumax"
                }
                , url: window.base_url + 'api/v1/participantes'
                , data: window.options
                , dataType: 'JSON'
            }).done((e) => {

                if(e.id)
                {
                    window.options.id = e.id
                }

                get()

            }).fail((e) => {
                
                $('.msg').html('<div class="alert alert-info">Carregando Aguarde.</div>')

                setTimeout(() => {
                    $('.msg').html('');
                },1000)
            })

            return false;
        }

        get()

    </script>
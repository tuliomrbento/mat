
    <style>
        .msg {position:fixed;width:90%;text-align:center;bottom:0px;left:5%;z-index:9;}

        .form-group label {font-size:11px;}
    </style>

    <div class="container">

        <div class="row"> 
            <div class="col-md-12">
                <div class="msg"></div>
                 
                <p>Empresas, Login</p>
                <br/>
                <form method="post" action="" onsubmit="return save()">
                    <div class="row">
                        <div class="col-md-4" class="form-group">
                            <label>Usuario:</label>
                            <input type="text" name="dados[usuario]" class="form-control input_usuario" />
                        </div>
                        <div class="col-md-4" class="form-group">
                            <label>Senha:</label>
                            <input type="text" name="dados[senha]" class="form-control input_senha" />
                        </div>
                        <div class="col-md-4" class="form-group">
                            <label>Status:</label>
                            <select name="dados[status]" class="form-control input_status" >
                                <option value=""></option>
                                <option value="A">Aprovado</option>
                                <option value="R">Reprovado</option>
                            </select>
                        </div>
                        <div class="col-md-12" class="form-group">
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
            perfil: 'E'
        }

        <?php echo isset($id_empresa) ? " window.options.id_empresa = " . $id_empresa." ; " : '""' ?>

        get = () => {

            $('.msg').html('<div class="alert alert-info">Carregando Aguarde.</div>')

            $.ajax({
                type: 'GET'
                , headers: {
                    "Authorization": "Bearer tumax"
                }
                , url: window.base_url + 'api/v1/empresas_login'
                , data: window.options
                , dataType: 'JSON'
            }).done((e) => {

                if(e.item)
                {
                    if(e.item.id)
                        window.options.id = e.item.id 

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
 
            window.options.usuario = $('.input_usuario').val()
            window.options.senha = $('.input_senha').val()
            window.options.status = $('.input_status').val()

            var method_ = 'POST'

            $.ajax({
                type: method_
                , headers: {
                    "Authorization": "Bearer tumax"
                }
                , url: window.base_url + 'api/v1/empresas_login'
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
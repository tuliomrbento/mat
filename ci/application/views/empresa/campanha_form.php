
    <style> 
        .msg {position:fixed;width:90%;text-align:center;bottom:0px;left:5%;z-index:9;}

        .form-group label {font-size:12px;}
    </style>

    <div class="container">

        <div class="row"> 
            <div class="col-md-12">
                <div class="msg"></div>
                 
                <p>Campanha, Formulário</p>
                <br/>
                <form method="post" action="" onsubmit="return save()">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Nome da Campanha:</label>
                            <input type="text" name="dados[nome]" class="form-control input_nome" />
                        </div>
                        <div class="col-md-4 form-group">
                            <label>URL da Campanha:</label>
                            <input type="text" name="dados[url]" class="form-control input_url" />
                        </div>
                        <div class="col-md-1 form-group">
                            <label>Cor 1:</label>
                            <input type="color" name="dados[cor1]" class="form-control input_cor1" />
                        </div>
                        <div class="col-md-1 form-group">
                            <label>Cor 2:</label>
                            <input type="color" name="dados[cor2]" class="form-control input_cor2" />
                        </div>
                        <div class="col-md-1 form-group">
                            <label>Cor 3:</label>
                            <input type="color" name="dados[cor3]" class="form-control input_cor3" />
                        </div>
                        <div class="col-md-1 form-group">
                            <label>Cor 4:</label>
                            <input type="color" name="dados[cor4]" class="form-control input_cor4" />
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Arquivo: <b class="arquivo"></b></label>
                            <div style="display:none;">
                                <input id="file_" type="file" onchange="changeFile(event)" name="dados[arquivo]" />
                            </div>
                            <div class="form-control" style="cursor:pointer;" onclick="selectFile()">
                                <i class="fas fa-file-upload"></i> <span class="file_name">Selecionar Aquivo</span>
                            </div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Status:</label>
                            <select name="dados[status]" class="form-control input_status" >
                                <option value=""></option> 
                                <option value="A">Ativo</option>
                                <option value="I">Inativo</option>
                            </select>
                        </div>
                        <div class="col-md-12" class="form-group">
                            <br/>
                            <button class="btn btn-primary" type="submit">Salvar</button> <a href="<?php echo base_url('/empresa/campanha') ?>" class="btn btn-default">Voltar</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>

    <script type="text/javascript" async >

        window.base_url = '<?php echo base_url() ?>'

        window.options = {}

        <?php echo ($id) ? "window.options.id = ".$id.";" : '' ?>

        selectFile = () => {

            $('#file_').trigger('click')
        }

        changeFile = (ev) => {

            if(ev.srcElement.files[0])
            {
                var file_ = ev.srcElement.files[0]

                $('.file_name').html(file_.name)

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

            window.options.nome = $('.input_nome').val()
            window.options.url = $('.input_url').val()
            window.options.cor1 = $('.input_cor1').val()
            window.options.cor2 = $('.input_cor2').val()
            window.options.cor3 = $('.input_cor3').val()
			window.options.cor4 = $('.input_cor4').val()
            window.options.status = $('.input_status').val()

            var method_ = 'POST'

            $.ajax({
                type: method_
                , headers: {
                    "Authorization": "Bearer tumax"
                }
                , url: window.base_url + 'api/v1/campanhas'
                , data: window.options
                , dataType: 'JSON'
            }).done((e) => {

                if(e.id)
                {
                    window.options.id = e.id
                }

                get()

            }).fail((e) => {
                
                $('.msg').html('<div class="alert alert-danger">Erro.</div>')

                setTimeout(() => {
                    $('.msg').html('');
                },1000)
            })

            return false;
        }

        get()

    </script>
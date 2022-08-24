
    <style>
        .msg {position:fixed;width:90%;text-align:center;bottom:0px;left:5%;z-index:9;}
    </style>

    <div class="container">

        <div class="row"> 
            <div class="col-md-12">
                <p class="msg"></p>
                <br/>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Razão Social</th>
                            <th>CNPJ</th>
                            <th>Status</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody class="tbody_itens">
                        <tr>
                            <td align="center" colspan="4">Itens</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th align="center" colspan="2">Exibindo de 2 itens de 40 itens.</th>
                            <th></th>
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
            }
        }

        listagem = () => {

            $('.msg').html('<div class="alert alert-info">Carregando Aguarde.</div>')

            $.ajax({
                type: 'GET'
                , headers: {
                    "Authorization": "Bearer tumax"
                }
                , url: window.base_url + 'api/v1/empresas'
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
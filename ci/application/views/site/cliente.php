
   

    <div class="container">

        <br/><br/>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h2>Seja Nosso Cliente</h2>
                <br/>
                <?php echo isset($msg) ? $msg : '' ?>
                <br/>
                <form method="post">
                    <div class="form-group">
                        <label>Nome:</label>
                        <input type="text" name="dados[nome]" class="form-control" required autofocus/>
                    </div>
                    <div class="form-group">
                        <label>E-mail:</label>
                        <input type="email" name="dados[email]" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label>Telefone:</label>
                        <input type="text" name="dados[telefone]" class="form-control mask-telefone" required/>
                    </div>
                    <div class="form-group">
                        <label>Nome Fantasia:</label>
                        <input type="text" name="dados[fantasia]" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label>Razão Social:</label>
                        <input type="text" name="dados[razao_social]" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label>CNPJ:</label>
                        <input type="text" name="dados[cnpj]" class="form-control mask-cnpj"/>
                    </div>
                    <div class="form-group">
                        <br/>
                        <button class="btn btn-dark" >Novo Cliente</button>
                    </div>
                </form>
            </div>
        </div>

        <br/><br/>

    </div>

   

    <div class="container">

        <br/><br/>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h2>Login</h2>
                <br/>
                <?php echo isset($msg) ? $msg : '' ?>
                <br/>
                <form method="post">
                    <div class="form-group">
                        <label>E-mail:</label>
                        <input type="text" name="dados[nome]" class="form-control" required autofocus/>
                    </div>
                    <div class="form-group">
                        <label>Senha:</label>
                        <input type="password" name="dados[senha]" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <br/>
                        <button class="btn btn-dark" >Acessar Sistema</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
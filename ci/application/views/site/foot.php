
    <div class="container text-center">

      <br/><br/><br/>
      <p>Desenvolvimento <?php echo date('Y') ?> - <b>TM</b> <small>Software House</small>  </p>
      <br/><br/>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url('assets/js/mask.js') ?>"></script>
    <script>

      var SPMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
      },
      spOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(SPMaskBehavior.apply({}, arguments), options);
          }
      };

      $('.mask-telefone').mask(SPMaskBehavior, spOptions)
      
      $('.mask-cnpj').mask('99.999.999/9999-99')

    </script>
    

  </body>
</html>
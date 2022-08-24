<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>

    <title>PAT <?php echo isset($title) ? ' - ' . $title : '' ?></title>

    <style>
        
        .btn {border-radius:30px;padding:7px 20px;}
        .btn-link {font-size:15px;text-decoration:none;color:#000;}
        .btn-link:focus {box-shadow:0 0 0;border-color:transparent;}
        .btn-link:hover {color:#ccc;}

        .form-group {padding-top:10px;}
        .form-group label {font-size:13px;padding-left:13px;}
        .form-control {border-radius:30px;}
        .form-control:focus {box-shadow:0 0 0;border:1px solid #000;}

    </style>
  </head>
  <body>

    <div class="container">
        <br/><br/>
        <div class="float-end">
            <a href="<?php echo base_url('/campanha/participantes') ?>" class="btn btn-link">Participantes</a>
            <a href="<?php echo base_url('/sair') ?>" class="btn btn-link">Sair</a>
        </div>
        <h2>PAT</h2>
        <br/><hr/>
    </div>
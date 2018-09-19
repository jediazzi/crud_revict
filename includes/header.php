<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Sistema Clientes Revict</title>
  </head>
  <body>


  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">
      Sistema Cliente/Divida
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse mr-auto" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Clientes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dividas.php">Dívidas</a>
        </li>
      </ul>
    </div>
  </nav>
  
  <?php 
  if(isset($_GET['success'])) {
   echo "<div class='alert alert-success' role='alert'>
            {$_GET['success']}
         </div>";
  }

  if(isset($_GET['error'])) {
   echo "<div class='alert alert-danger' role='alert'>
            {$_GET['error']}
         </div>";
  }

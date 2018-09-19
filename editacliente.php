<?php
  require_once 'classes/Clientes.php';
  $clientes = new Clientes();

  include_once 'includes/header.php';

  if(isset($_POST['editar'])):

	$id_cliente = $_POST['id'];
	$nome = $_POST['nome'];
	$email = $_POST['email'];

	$clientes->setNome($nome);
	$clientes->setEmail($email);

	if($clientes->update($id_cliente)){
		header("location:index.php?success=".urlencode('Cliente editado com sucesso!'));
	} else {
		header("location:index.php?error=".urlencode('Já existe cliente cadastrado com estes dados!'));
	}

  endif;	

  if(isset($_GET['id'])) {
  	$id_cliente = $_GET['id'];
  	$id_cliente = (int)$_GET['id'];
  	if($clientes->find_clientes($id_cliente)) {
  		$resultado = $clientes->find_clientes($id_cliente);
  	} else {
  		header("location:index.php");
  	}
  } 

?>

<div class="container-fluid" style="margin-top:10px">
    <form class="form-inline" action="#" method="POST">
      <label class="sr-only" for="nome">Nome</label>
        <input type="text" class="form-control mb-2 mr-sm-2" id="nome" name="nome" placeholder="Nome" value="<?php echo $resultado->nome; ?>" required="required">

      <label class="sr-only" for="email">E-mail</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">@</div>
          </div>
          <input type="text" class="form-control" id="email" name="email" placeholder="E-mail" value="<?php echo $resultado->email; ?>" required="required">
        </div>
	  <input type="hidden" name="id" value="<?php echo $resultado->id_cliente; ?>">
      <input type="submit" name="editar" class="btn btn-primary mb-2" value="Editar">
      <button formaction="index.php" class="btn btn-secondary mb-2" style="margin-left:15px;">Voltar</button>
    </form>
  </div>

  <?php include_once 'includes/footer.php'; ?>
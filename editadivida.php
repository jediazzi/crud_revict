<?php
  require_once 'classes/Dividas.php';
  $dividas = new Dividas();

  require_once 'classes/Clientes.php';
  $clientes = new Clientes();

  include_once 'includes/header.php';

  if(isset($_POST['editar'])):

  	$id_divida = $_POST['id_divida'];
  	$id_cliente = $_POST['id_cliente'];
  	$valor = $_POST['valor'];

  	$dividas->setIdCliente($id_cliente);
  	$dividas->setValor($valor);

  	if($dividas->update($id_divida)){
  		header("location:dividas.php?success=".urlencode('Divida editada com sucesso!'));
  	} 

  endif;	

  if(isset($_GET['id'])) {
    $id_divida = $_GET['id'];
    $id_divida = (int)$_GET['id'];
    if($dividas->find_dividas($id_divida)) {
      $resultado = $dividas->find_dividas($id_divida);
    } 
  
  } 

?>

<div class="container-fluid" style="margin-top:10px">
    <form class="form-inline" action="#" method="POST">
      <select class="custom-select my-1 mr-sm-2" name="id_cliente" required="required">
        <option value="<?php echo $resultado->id_cliente; ?>"><?php echo $resultado->nome; ?></option>
        <?php foreach($clientes->findAll_clientes() as $key => $value): ?>
          <option value="<?php echo $value->id_cliente; ?>"><?php echo $value->nome; ?></option>
        <?php endforeach; ?>
      </select>

      <label class="sr-only" for="email">Valor</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">R$</div>
          </div>
          <input type="number" class="form-control" id="valor" name="valor" placeholder="Valor" value="<?php echo $resultado->valor; ?>" required="required">
        </div>
	    <input type="hidden" name="id_divida" value="<?php echo $resultado->id_divida; ?>">
      <input type="submit" name="editar" class="btn btn-primary mb-2" value="Editar">
      <button formaction="index.php" class="btn btn-secondary mb-2" style="margin-left:15px;">Voltar</button>
    </form>
  </div>

  <?php include_once 'includes/footer.php'; ?>
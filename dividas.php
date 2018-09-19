<?php
 
  require_once 'classes/Clientes.php';
  $clientes = new Clientes();

  require_once 'classes/Dividas.php';
  $dividas = new Dividas();

  include_once 'includes/header.php';

  //TRATAMENTO CASO CLICAR NO BOTÃO CADASTRAR

  if(isset($_POST['cadastrar'])):

      $id_cliente  = $_POST['id_cliente'];
      $valor = $_POST['valor'];

      $dividas->setIdCliente($id_cliente);
      $dividas->setValor($valor);

      if($dividas->insert()){
        header("location:dividas.php?success=".urlencode('Dívida inserido com sucesso!'));
      } 

  endif;

  //TRATAMENTO CASO CLICAR NO BOTÃO DELETAR

  if(isset($_GET['acao']) && $_GET['acao'] == 'deletar_divida'):

    $id = (int)$_GET['id'];
    if($dividas->delete_divida($id)){
      header("location:dividas.php?success=".urlencode('Dívida deletada com sucesso!'));
    }

  endif;

  if(isset($_GET['acao']) && $_GET['acao'] == 'baixar_divida'):

    $id = (int)$_GET['id'];
    if($dividas->baixa_divida($id)){
      header("location:dividas.php?success=".urlencode('Dívida baixada com sucesso!'));
    }

  endif;

?>
  <div class="container-fluid" style="margin-top:10px">
    <form class="form-inline" action="" method="POST">
    	<label class="my-1 mr-2" for="id_cliente">Preference</label>
		  <select class="custom-select my-1 mr-sm-2" id="id_cliente" name="id_cliente" required="required">
		    <option selected disabled="disabled">Selecione o Cliente</option>
		    <?php foreach($clientes->findAll_clientes() as $key => $value): ?>
		    <option value="<?php echo $value->id_cliente; ?>"><?php echo $value->nome; ?></option>
			<?php endforeach; ?>
		  </select>
        <label class="sr-only" for="valor">Valor</label>
        <input type="number" class="form-control mb-2 mr-sm-2" id="valor" name="valor" placeholder="Valor" required="required">

      <input type="submit" name="cadastrar" class="btn btn-primary mb-2"  value="Cadastrar">
    </form>

  </div>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Cliente</th>
        <th scope="col">Valor</th>
        <th scope="col" colspan="3">Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php 

      	foreach($dividas->findAll_dividas() as $key => $value): ?>
      	<tr <?php if($value->baixada == 1){echo "class='table-active'";} ?>>
	        <th scope="row"><?php echo $value->id_divida; ?></th>
	        <td><?php echo $value->nome; ?></td>
	        <td>R$ <?php echo number_format($value->valor, 2, ",", "."); ?></td>
	        <td><a href="editadivida.php?id=<?php echo $value->id_divida; ?>">Editar</a></td>
	        <td><a href="dividas.php?acao=deletar_divida&id=<?php echo $value->id_divida; ?>" onclick="return confirm('Tem certeza de que deseja deletar esta dívida?');">Deletar</a></td>
	        <td><a href="dividas.php?acao=baixar_divida&id=<?php echo $value->id_divida; ?>" onclick="return confirm('Tem certeza de que deseja baixar esta dívida?');">Baixar</a></td>
      </tr>
      <?php endforeach;  ?>
    </tbody>
  </table>

  <?php include_once 'includes/footer.php'; ?>

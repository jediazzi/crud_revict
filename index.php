<?php

  require_once 'classes/Clientes.php';
  $clientes = new Clientes();

  include_once 'includes/header.php';

  //TRATAMENTO CASO CLICAR NO BOTÃO CADASTRAR

  if(isset($_POST['cadastrar'])):

      $nome  = $_POST['nome'];
      $email = $_POST['email'];

      $clientes->setNome($nome);
      $clientes->setEmail($email);

      if($clientes->insert()){
        header("location:index.php?success=".urlencode('Cliente inserido com sucesso!'));
      } else {
        header("location:index.php?error=".urlencode('Já existe cliente cadastrado com estes dados!'));
      }

    endif;

    //TRATAMENTO CASO CLICAR NO BOTÃO DELETAR

  if(isset($_GET['acao']) && $_GET['acao'] == 'deletar_cliente'):

    $id = (int)$_GET['id'];
    if($clientes->delete_cliente($id)){
      header("location:index.php?success=".urlencode('Cliente deletado com sucesso!'));
    }

  endif;

?>

  <div class="container-fluid" style="margin-top:10px">
    <form class="form-inline" action="" method="POST">
      <label class="sr-only" for="nome">Nome</label>
        <input type="text" class="form-control mb-2 mr-sm-2" id="nome" name="nome" placeholder="Nome" required="required">

      <label class="sr-only" for="email">E-mail</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text">@</div>
          </div>
          <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" required="required">
        </div>

      <input type="submit" name="cadastrar" class="btn btn-primary mb-2"  value="Cadastrar">
    </form>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nome</th>
        <th scope="col">E-mail</th>
        <th scope="col" colspan="2">Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($clientes->findAll_clientes() as $key => $value): ?>
      <tr>
        <th scope="row"><?php echo $value->id_cliente; ?></th>
        <td><?php echo $value->nome; ?></td>
        <td><?php echo $value->email; ?></td>
        <td><a href="editacliente.php?id=<?php echo $value->id_cliente; ?>">Editar</a></td>
        <td><a href="index.php?acao=deletar_cliente&id=<?php echo $value->id_cliente; ?>" onclick="return confirm('Tem certeza de que deseja deletar o cliente <?php echo $value->nome; ?>?');">Deletar</a></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

<?php include_once 'includes/footer.php'; ?>
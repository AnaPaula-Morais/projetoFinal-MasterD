<?php 
  session_start();
  include "../config.php";
  $base_path = "../";

  
  if (!isset($_SESSION["cliente_id"])) {
      header("location: ./login.php");
  }

  $cliente_id = $_SESSION["cliente_id"];
  $sql = "
  SELECT 
      p.id AS produto_id,
      p.descricao,
      p.nome_produto,
      p.imagem,
      p.categoria,
      p.preco,
      ci.quantidade,
      (p.preco * ci.quantidade) AS subtotal
  FROM carrinhos c
  JOIN carrinho_itens ci ON c.id = ci.carrinho_id
  JOIN produtos p ON ci.produtos_id = p.id
  WHERE c.clientes_id = $cliente_id AND c.status = 'aberto'
  ";
 
  $cliente_id = $_SESSION["cliente_id"];
  $cliente_sql = "SELECT nome, apelido, email FROM clientes WHERE id = $cliente_id";
  $cliente_result = $conn->query($cliente_sql);
  if ($cliente_result && $cliente_result->num_rows > 0) {
    $cliente = $cliente_result->fetch_assoc();
  } else {
    die("Erro ao buscar dados do cliente.");
  }

  $result = $conn->query($sql);
  

  if (!$result) {
      die("Erro na consulta: " . $conn->error);
  }

  
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Pagamento</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!--link font awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
  <?php 
    include "../header.php";
  ?>
  <div class="container py-5">
    <div class="row">
      <div class="col-md-7">
        <h4 class="mb-3">Informações do Cliente</h4>
        <form>
          <div class="row">
            <div class="col-sm-6 mb-3">
              <label for="nome" class="form-label">Nome</label>
              <input type="text" class="form-control" id="nome" value="<?= $cliente['nome'] ?>" required>
            </div>
            <div class="col-sm-6 mb-3">
              <label for="nome" class="form-label">Apelido</label>
              <input type="text" class="form-control" id="nome" value="<?= $cliente['apelido'] ?>" required>
            </div>
            <div class="col-sm-6 mb-3">
              <label for="email" class="form-label">E-mail</label>
              <input type="email" class="form-control" id="email" value="<?= $cliente['email'] ?>" required>
            </div>
          </div>

          <div class="mb-3">
            <label for="endereco" class="form-label">Endereço</label>
            <input type="text" class="form-control" id="endereco" placeholder="Rua Exemplo, 123" required>
          </div>

          <div class="row">
            <div class="col-md-5 mb-3">
              <label for="cidade" class="form-label">Cidade</label>
              <input type="text" class="form-control" id="cidade" required>
            </div>
            
            <div class="col-md-3 mb-3">
              <label for="data_nasc" class="form-label">Data de nascimento</label>
              <input type="date" class="form-control" id="data_nasc" required>
            </div>
          </div>

          <hr class="my-4">

          <button class="btn btn-primary btn-lg btn-block" type="submit">Finalizar Encomenda</button>
        </form>
      </div>

      
      <div class="col-md-5">
        <h4 class="mb-3">Resumo do Pedido</h4>
        <?php if($result->num_rows > 0 ): ?>
            <?php  
                $total = 0;
                while($item = $result->fetch_assoc()):
                $subtotal = $item['quantidade'] * $item['preco'];
                $total += $subtotal;
        ?>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0"><?= $item['nome_produto'] ?></h6>
              <small class="text-muted"><?= $item['descricao'] ?></small>
            </div>
            <span class="text-muted"><?= $item['preco'] ?></span>
          </li>
          <?php endwhile; ?> 
         
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (BRL)</span>
            <strong>R$<?= number_format($total, 2, ',', '.')?> </strong>
          </li>
        </ul>
        
         <?php else: ?>
            <p>Seu carrinho está vazio.</p>
        <?php endif; ?>
      </div>
      
    </div>
  </div>

  <?php 
    include "footer.php";
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

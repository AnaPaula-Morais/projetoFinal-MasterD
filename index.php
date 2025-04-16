<?php
include "header.php";
include "config.php";

$sql = "SELECT produtos.*, categorias.nome AS categoria_nome FROM produtos JOIN categorias ON produtos.categoria_id = categorias.id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cariri Shop</title>
  <!--link bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!--link font awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="p-3 m-0 border-0 bd-example m-0 border-0">
  <div class="container mt-4">
    <h1>Produtos disponíveis</h1>
    <div class="row">
      <?php while ($produto = $result->fetch_assoc()): ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <img src="<?php echo $produto['imagem']; ?>" class="card-img-top" alt="Imagem do Produto" style="height: 300px; object-fit: cover;">
            <div class="card-body">
              <h5 class="card-title"><?php echo $produto['nome_produto']; ?></h5>
              <p class="card-text"><?php echo $produto['descricao']; ?></p>
              <p><strong>Categoria:</strong> <?php echo $produto['categoria_nome']; // depois pode fazer join com a tabela categorias 
              ?></p>
              <p><strong>Preço:</strong> R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
              <p><strong>Estoque:</strong> <?php echo $produto['estoque']; ?></p>
            </div>
            <div class="card-footer d-flex justify-content-between">
              <a href="carrinho.php?add=<?php echo $produto['id']; ?>" class="btn btn-primary">Comprar</a>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
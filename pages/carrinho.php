<?php
session_start();
$base_path = "../";
include "../config.php";

if (!isset($_SESSION["cliente_id"])) {
    header("location: ./login.php");
}

$cliente_id = $_SESSION["cliente_id"];
$sql = "SELECT c.*, p.nome_produto, p.imagem, p.categoria FROM carrinhos c JOIN produtos p ON c.produto_id = p.id WHERE c.clientes_id = $cliente_id";

$result = $conn->query($sql);

if (!$result) {
    die("Erro na consulta: " . $conn->error);
}



?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <?php include "../header.php" ?>
    <div class="container py-5">
        <h2 class="mb-4">Meu Carrinho</h2>
        <?php if($result->num_rows > 0 ): ?>
            <?php  
                $total = 0;
                while($item = $result->fetch_assoc()):
                $subtotal = $item['quantidade'] * $item['preco'];
                $total += $subtotal;
            ?>
        <div class="card mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <img src="<?= $item['imagem'] ?>" class="img-fluid" alt="Produto">
                    </div>
                    <div class="col-md-4">
                        <h5 class="mb-1"><?= $item['nome'] ?></h5>
                        <p class="mb-1">Categoria: <?= $item['categoria'] ?></p>
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control text-center" value="<?= $item['quantidade'] ?>" min="1">
                    </div>
                    <div class="col-md-2">
                        <h6 class="mb-0">R$<?= number_format($item['preco'], 2, ',', '.') ?></h6>
                    </div>
                    <div class="col-md-2 text-end">
                        <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>       
        <div class="text-end">
            <h5>Total: R$ <?= number_format($total, 2, ',', '.') ?></h5>
            <a href="finalizar.php" class="btn btn-success">Finalizar Compra</a>
        </div>
        <?php else: ?>
            <p>Seu carrinho está vazio.</p>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
<?php include "./footer.php" ?>

</html>
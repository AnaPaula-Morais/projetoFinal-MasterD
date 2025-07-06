<?php
session_start();
$base_path = "../";
include "../config.php";

if (!isset($_SESSION["cliente_id"])) {
    header("location: ./login.php");
}



$cliente_id = $_SESSION["cliente_id"];
$sql = "
SELECT 
    p.id AS produto_id,
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
                        <img src="../<?= $item['imagem'] ?>" class="img-fluid" alt="Produto">
                    </div>
                    <div class="col-md-4">
                        <h5 class="mb-1"><?= $item['nome_produto'] ?></h5>
                        <p class="mb-1">Categoria: <?= $item['categoria'] ?></p>
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control text-center quantidade-input" value="<?= $item['quantidade'] ?>" min="1" data-preco="<?= $item['preco'] ?>"onchange="atualizarValores(this)">
                    </div>
                    <div class="col-md-2">
                        <h6 class="mb-0">R$ <span class="subtotal"><?= number_format($item['preco'], 2, ',', '.') ?></span></h6>
                    </div>
                    <div class="col-md-2 text-end">
                        <button type="button" class="btn btn-danger" onclick="removerProduto(<?=$item['produto_id']?>)"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>       
        <div class="text-end">
            <h5>Total: R$ <span id="total-geral"><?= number_format($total, 2, ',', '.') ?></span></h5>
            <a href="./pag-encomenda.php" class="btn btn-success">Finalizar Compra</a>
        </div>
        <?php else: ?>
            <p>Seu carrinho está vazio.</p>
        <?php endif; ?>
    </div>
    <script>

        function removerProduto(idProduto){
            
            if(confirm("Tem certeza que deseja excluir esta compra?")){
                //chamar url para excluir produto 
                fetch("remover-produto.php?id=" + idProduto)
                    .then(response => window.location.reload(true));
            }
        }

        function atualizarValores(input){
            const preco = parseFloat(input.dataset.preco);
            const quantidade = parseInt(input.value);
            const sobtotalElemento = input.closest('.row').querySelector('.subtotal');

            const novosubtotal = (preco * quantidade).toFixed(2);
            sobtotalElemento.innerText = novosubtotal.replace('.', ',');

            let total = 0;
            document.querySelectorAll('.quantidade-input').forEach(inp => {
                const p  = parseFloat(inp.dataset.preco);
                const q = parseInt(inp.value);
                total += p * q;
            })

            document.getElementById("total-geral").innerText = total.toFixed(2).replace('.', ',');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
<?php include "./footer.php" ?>

</html>
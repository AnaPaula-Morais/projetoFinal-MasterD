<?php
session_start();
include "../config.php";
$base_path = "../";


if (!isset($_SESSION["admin_logado"])) {
    header("Location: perfil-admin.php");
    exit;
}


$encomendas_result = $conn->query("SELECT * FROM encomendas");


$produtos_result = $conn->query("SELECT * FROM produtos");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Administração - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <?php  include "../header.php";?>
    <div class="container py-5">
        <h1 class="mb-4 text-center">Painel de Administração</h1>


        <div class="card mb-5">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Encomendas</h5>
            </div>
            <div class="card-body">
                <?php if ($encomendas_result->num_rows > 0): ?>
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nome do Cliente</th>
                                <th>Data Nascimento</th>
                                <th>Morada</th>
                                <th>Preço Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($e = $encomendas_result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $e["id"] ?></td>
                                    <td><?= $e["nome_cliente"] ?></td>
                                    <td><?= $e["data_nascimento"] ?></td>
                                    <td><?= $e["morada"] ?></td>
                                    <td>R$<?= number_format($e["preco_total"], 2, ',', '.') ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Nenhuma encomenda encontrada.</p>
                <?php endif; ?>
            </div>
        </div>


        <div class="card mb-5">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Produtos</h5>
            </div>
            <div class="card-body">
                <?php if ($produtos_result->num_rows > 0): ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Estoque</th>
                                <th>Preço</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($p = $produtos_result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $p["id"] ?></td>
                                    <td><?= $p["nome_produto"] ?></td>
                                    <td><?= $p["estoque"] ?></td>
                                    <td>R$<?= number_format($p["preco"], 2, ',', '.') ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Nenhum produto encontrado.</p>
                <?php endif; ?>
            </div>
        </div>


        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Inserir Novo Produto</h5>
            </div>
            <div class="card-body">
                <form method="post" action="./inserir-produtos.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Nome do Produto</label>
                        <input type="text" name="nome_produto" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descrição</label>
                        <textarea name="descricao" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Preço</label>
                        <input type="number" name="preco" step="0.01" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Imagem</label>
                        <input type="text" name="imagem" class="form-control" placeholder="caminho da imagem" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Categoria</label>
                        <input type="text" name="categoria" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tamanho</label>
                        <select name="tamanho" class="form-select">
                            <option value="P">P</option>
                            <option value="M" selected>M</option>
                            <option value="G">G</option>
                            <option value="GG">GG</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Estoque</label>
                        <input type="number" name="estoque" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success">Salvar Produto</button>
                </form>
            </div>
        </div>

    </div>
    <?php include "./footer.php" ?>
</body>

</html>
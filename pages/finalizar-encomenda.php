<?php
session_start();
include "../config.php";

if (!isset($_SESSION["cliente_id"])) {
    header("Location: login.php");
    exit;
}

$cliente_id = $_SESSION["cliente_id"];


$sqlCliente = "SELECT nome, data_nasc, morada FROM clientes WHERE id = ?";
$stmtCliente = $conn->prepare($sqlCliente);
$stmtCliente->bind_param("i", $cliente_id);
$stmtCliente->execute();
$resultCliente = $stmtCliente->get_result();
$cliente = $resultCliente->fetch_assoc();

$nome_cliente = $cliente['nome'];
$data_nasc = $cliente['data_nasc'];
$morada = $cliente['morada'];
$cidade = $_POST["cidade"];



$dataNascimento = new DateTime($data_nasc);
$hoje = new DateTime();
$idade = $hoje->diff($dataNascimento)->y;
if ($idade < 18) {
    echo "<script>
        alert('Desculpe, apenas maiores de 18 anos podem finalizar a encomenda.');
        window.location.href = 'carrinho.php';
    </script>";
    exit;
}


$sqlCarrinho = "
SELECT c.id AS carrinho_id, p.preco, ci.quantidade
FROM carrinhos c
JOIN carrinho_itens ci ON c.id = ci.carrinho_id
JOIN produtos p ON ci.produtos_id = p.id
WHERE c.clientes_id = ? AND c.status = 'aberto'
";
$stmtCarrinho = $conn->prepare($sqlCarrinho);
$stmtCarrinho->bind_param("i", $cliente_id);
$stmtCarrinho->execute();
$resultCarrinho = $stmtCarrinho->get_result();

$carrinho_id = null;
$total = 0.0;

while ($item = $resultCarrinho->fetch_assoc()) {
    if (!$carrinho_id) {
        $carrinho_id = $item['carrinho_id'];
    }
    $total += $item['preco'] * $item['quantidade'];
}

if (!$carrinho_id) {
    echo "<script>
        alert('Carrinho não encontrado ou já finalizado.');
        window.location.href = 'carrinho.php';
    </script>";
    exit;
}


$sqlInsert = "INSERT INTO encomendas (nome_cliente, morada, cidade, preco_total, data_nascimento)
VALUES (?, ?, ?, ?, ?)";

$stmtInsert = $conn->prepare($sqlInsert);
$stmtInsert->bind_param("sssds", $nome_cliente, $morada, $cidade, $total, $data_nasc);
$stmtInsert->execute();

// inserir itens na tabela encomenda-produtos
//iterara sobre os dados do carrinho-itens
//tenho que copiar o que está no carriho para a tabela encomenda-produtos

$sqlUpdate = "UPDATE carrinhos SET status = 'finalizado' WHERE id = ?";
$stmtUpdate = $conn->prepare($sqlUpdate);
$stmtUpdate->bind_param("i", $carrinho_id);
$stmtUpdate->execute();


echo "<script>
    alert('Encomenda finalizada com sucesso!');
    window.location.href = '../index.php';
</script>";
exit;
?>

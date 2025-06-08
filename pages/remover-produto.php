<?php
session_start();
include "../config.php";

// Verifica se o cliente está logado
if (!isset($_SESSION["cliente_id"])) {
    header("Location: login.php");
    exit;
}

$cliente_id = $_SESSION["cliente_id"];

// Verifica se foi passado o ID do produto
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("ID do produto inválido.");
}

$produto_id = intval($_GET["id"]);

// Busca o carrinho aberto do cliente
$sql = "SELECT id FROM carrinhos WHERE clientes_id = $cliente_id AND status = 'aberto' LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $carrinho_id = $row["id"];

    $sql_remover = "DELETE FROM carrinho_itens WHERE carrinho_id = $carrinho_id AND produtos_id = $produto_id";
    $conn->query($sql_remover);

    // Redireciona de volta ao carrinho
    header("Location: carrinho.php");
    exit;
} else {
    echo "Carrinho não encontrado.";
}
?>
<?php 
session_start();
include "../config.php";


if (!isset($_SESSION["cliente_id"])) {
    header("location: ./login.php");
    exit;
}

$cliente_id = intval($_SESSION["cliente_id"]);
$produto_id = intval($_POST["produto_id"]);
$quantidade = intval($_POST["quantidade"]);

$sql = "SELECT id FROM carrinhos WHERE clientes_id = ? AND status = 'aberto' LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $cliente_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $carrinho_id = $row['id'];
} else {
    $sql = "INSERT INTO carrinhos (clientes_id, status, criado_em, atualizado_em) VALUES (?, 'aberto', NOW(), NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $cliente_id);
    $stmt->execute();
    $carrinho_id = $stmt->insert_id;
}


$sql = "SELECT id, quantidade FROM carrinho_itens WHERE carrinho_id = ? AND produtos_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $carrinho_id, $produto_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
   
    $item = $result->fetch_assoc();
    $nova_quantidade = $item['quantidade'] + $quantidade;

    $sql = "UPDATE carrinho_itens SET quantidade = ?, atualizado_em = NOW() WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $nova_quantidade, $item['id']);
    $stmt->execute();
} else {
    
    $sql = "INSERT INTO carrinho_itens (carrinho_id, clientes_id, produtos_id, quantidade, criado_em, atualizado_em) 
            VALUES (?, ?, ?, ?, NOW(), NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiii", $carrinho_id, $cliente_id, $produto_id, $quantidade);
    $stmt->execute();
}


header("Location: ./carrinho.php");
exit;
?>

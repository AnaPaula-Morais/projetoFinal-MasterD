<?php
include "../config.php";

$nome = $_POST["nome_produto"];
$descricao = $_POST["descricao"];
$preco = $_POST["preco"];
$imagem = $_POST["imagem"];
$categoria_nome = $_POST["categoria"]; 
$tamanho = $_POST["tamanho"];
$estoque = $_POST["estoque"];

$stmt = $conn->prepare("SELECT id FROM categorias WHERE nome = ?");
$stmt->bind_param("s", $categoria_nome);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows > 0) {
    $row = $res->fetch_assoc();
    $categoria_id = $row["id"];
} else {
    $insert_categoria = $conn->prepare("INSERT INTO categorias (nome) VALUES (?)");
    $insert_categoria->bind_param("s", $categoria_nome);
    $insert_categoria->execute();
    $categoria_id = $insert_categoria->insert_id;
}

//Inserir produto
$sql = "INSERT INTO produtos (nome_produto, descricao, preco, imagem, categoria, tamanho, estoque, data_cadastro, categoria_id)
        VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdsssii", $nome, $descricao, $preco, $imagem, $categoria_nome, $tamanho, $estoque, $categoria_id);

if ($stmt->execute()) {
    echo "Produto inserido com sucesso!";
    header("Location: perfil-admin.php");
} else {
    echo "Erro ao inserir: " . $conn->error;
}
?>

<?php 
    session_start();
    include "../config.php";

    if(!isset($_SESSION["cliente_id"])){
        header("location: ./login.php");
        exit;
    }

    $cliente_id = $_SESSION["cliente_id"];
    $produto_id = intval($_POST["produto_id"]);
    $quantidade = intval($_POST["quantidade"]);

    //verificar se exixte um carrinho aberto
    $sql = "SELECT id FROM carrinhos WHERE clientes_id = $cliente_id AND status = 'aberto' LIMIT 1";
    $result = $conn -> query($sql);

    if($result && $result -> num_rows > 0){
        $row = $result -> fetch_assoc();
        $carrinho_id = $row['id'];
    }else{
        //criar carrinho novo
        $conn -> query("INSERT INTO carrinhos(clientes_id, `status`, criado_em, atualizado_em) VALUES ($cliente_id, 'aberto', NOW(), NOW())");

        $carrinho_id = $conn -> insert_id;  
    }

    //verificar se o produto já está no carrinho
    $sql = "SELECT id, quantidade FROM carrinho_itens WHERE carrinho_id = $carrinho_id AND produtos_id = $produto_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $item = $result->fetch_assoc();
        $nova_quantidade = $item['quantidade'] + $quantidade;
        $conn->query("UPDATE carrinho_itens SET quantidade = $nova_quantidade, atualizado_em = NOW() WHERE id = {$item['id']}");
    } else {
        $conn->query("INSERT INTO carrinho_itens (carrinho_id, clientes_id, produtos_id, quantidade, criado_em, atualizado_em) VALUES ($carrinho_id, $cliente_id, $produto_id, $quantidade, NOW(), NOW())");
    }

    header("Location: ./carrinho.php");
    exit;


?>
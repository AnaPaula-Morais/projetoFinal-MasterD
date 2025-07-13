<?php 
    include "../config.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
      $nome_cliente = $_POST["nome"];
      $email = $_POST["email"];
      $morada = $_POST["morada"];
      $cidade = $_POST["cidade"];
      $data_nascimento = $_POST["data_nascimento"];
      $preco_total = $_POST["total"] ?? 0;

       $sql = "INSERT INTO encomendas(nome_cliente, morada, cidade, data_nascimento, preco_total ) VALUES ('$nome_cliente', '$morada', '$cidade', '$data_nascimento', '$preco_total')"; 

       if($conn -> query("$sql") == true){
        echo"Encomenda realizada com sucesso";

        header('Location: ../index.php');

        exit();
       }else{
        echo "Erro encontrado " . $conn -> error;
       }

       $conn -> close();


    }


?>
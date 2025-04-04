<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "loja_online";

    $conn = new mysqli($servername, $username, $password, $database);

    if($conn -> connect_error){
        die("A base de dados não está conectada: " . $conn -> connect_error);
    }


?>
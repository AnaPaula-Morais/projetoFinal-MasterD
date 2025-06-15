<?php
/*$servername = "localhost";
    $username = "root";
    $password = "";
    $database = "loja_online";*/

$servername = getenv('DB_HOST');
$database = getenv('DB_NAME');
$username = getenv('DB_USER');

$password_file_path = getenv('PASSWORD_FILE_PATH');

$password = trim(file_get_contents($password_file_path));
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("A base de dados não está conectada: " . $conn->connect_error);
}

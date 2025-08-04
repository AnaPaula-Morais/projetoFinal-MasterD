<?php
session_start();
include "../config.php";
$base_path = "../";

$msg = "";

//verificar se o formulário foi enviado utilizando o método post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //obter os dados inseridos no formulário
  $email = $_POST["email"];
  $senha = $_POST["senha"];

  //consulta a base de dados para consultar as informações

  $sql = "SELECT * FROM clientes WHERE email = '$email' AND senha = '$senha'";
  //executa o sql passado
  $result = $conn->query($sql);
  //verifica se o número de linhas retornado pela consulta sql é > 0, ou seja se encontrou algum registro
  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    //variável global que armazena o id e o nome do utilizador
    $_SESSION["cliente_id"] = $user["id"];
    $_SESSION["cliente_nome"] = $user["nome"];

    //verificar o tipo de utilizador
    if ($user['user_type'] == 'user') {
      //redireciona para a página do user
      header("location: ../index.php");
      exit();
    } elseif ($user['user_type'] == 'admin') {
      $_SESSION["admin_logado"] = true;
      $_SESSION["admin_email"] = $user["eamil"];
      header("location: perfil-admin.php");
      exit();
    }
  } else {
    echo "As credenciais são inválidas!";
  }
}

//fechar a conexao a base de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <!--link bootstrap-->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />
  <!--link font awesome-->
  <script src="https://kit.fontawesome.com/d9115d1b88.js" crossorigin="anonymous"></script>
  <style>
    .form-login {
      margin: 0 auto;
      padding-top: 3%;
      width: 50%;
    }

    .form-floating {
      padding-top: 10px;
      padding-bottom: 10px;
    }
  </style>
</head>

<body class="p-0 m-0">
  <?php include "../header.php"; ?>

  <div class="form-login">
    <main class="form-signin w-100 m-auto">
      <form method="post">
        <h1 class="h3 mb-3 fw-normal">Login</h1>

        <div class="form-floating">
          <input
            type="email"
            class="form-control"
            id="email"
            name="email"
            placeholder="email" />
          <label for="floatingInput">Email</label>
        </div>
        <div class="form-floating">
          <input
            type="password"
            class="form-control"
            id="senha"
            name="senha"
            placeholder="Password" />
          <label for="floatingPassword">Password</label>
        </div>

        <button class="btn btn-primary w-100 py-2" type="submit">
          Entrar
        </button>
      </form>
      <div id="emailHelp" class="form-text">
        Não tem conta?
      </div>
      <button type="submit" class="btn btn-primary" onclick="window.location.href='registroCliente.php'">Registre-se aqui</button>
    </main>
  </div>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

  <div class="container">
    <?php
    include "footer.php"
    ?>
  </div>

</body>

</html>
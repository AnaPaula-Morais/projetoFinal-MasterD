<?php 
  session_start();
  include "../config.php";
  $base_path = "../";
  //verificar se o formulário foi enviado
 

  if($_SERVER["REQUEST_METHOD"] == "POST"){
      //obter os dados inseridos no formulário
      $email = $_POST["email"];
      $senha = $_POST["senha"];

    //consulta a base de dados para consultar as informações

    $sql = "SELECT * FROM clientes WHERE email = '$email' AND senha = '$senha'";
    $result = $conn -> query($sql);
    if($result ->num_rows > 0){
      $user = $result->fetch_assoc();

      $_SESSION["cliente_id"] = $user["id"];
      $_SESSION["cliente_nome"] = $user["nome"];

      //verificar o tipo de utilizador
      if($user['user_type'] == 'user'){
        //redireciona para a página do user
        header("location: ../index.php");
        exit();

      }elseif($user['user_type'] == 'admin'){
        header("location: perfil-admin.php");
        exit();
      }
    }else{
      echo "As credenciais são inválidas!";
    }
  }
  
  //fechar a conexao a base de dados

  $conn -> close();
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
      crossorigin="anonymous"
    />
    <!--link font awesome-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
  </head>
  <body class="p-0 m-0">
    <?php  include "../header.php";?>

    <div class="form-login">
      <main class="form-signin w-100 m-auto">
        <form method="post">
          <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

          <div class="form-floating">
            <input
              type="email"
              class="form-control"
              id="email"
              name="email"
              placeholder="email"
            />
            <label for="floatingInput">Email</label>
          </div>
          <div class="form-floating">
            <input
              type="password"
              class="form-control"
              id="senha"
              name="senha"
              placeholder="Password"
            />
            <label for="floatingPassword">Password</label>
          </div>

          <div class="form-check text-start my-3">
            <input
              class="form-check-input"
              type="checkbox"
              value="remember-me"
              id="flexCheckDefault"
            />
            <label class="form-check-label" for="flexCheckDefault">
              Continuar conectado
            </label>
            <a href="#">
              <p>Esqueceu-se da password? Clique aqui</p>
            </a>
          </div>
          <button class="btn btn-primary w-100 py-2" type="submit">
          Entrar
        </button>
        </form>
        
        _________________________________________________________________
        <a href="#">
          <p>Entrar com o google</p>
        </a>
        _________________________________________________________________
        <div id="emailHelp" class="form-text">
          Não tem conta?
        </div>
        <button  type="submit" class="btn btn-primary" onclick="window.location.href='registroCliente.php'">Registre-se aqui</button>
      </main>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <?php 
      include "footer.php"
    ?>
  </body>
</html>

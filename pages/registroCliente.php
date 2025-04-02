<?php 
  include "./header.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cariri Shop</title>
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
  <body class="p-3 m-0 border-0 bd-example m-0 border-0">
    
    <div class="form-login">
      <main class="form-signin w-100 m-auto">
        <form>
          <h1 class="h3 mb-3 fw-normal">Registe-se</h1>

          <div class="form-floating">
            <input
              type="text"
              class="form-control"
              id="floatingInput"
              placeholder="nome"
            />
            <label for="floatingInput">Nome</label>
          </div>
          <div class="form-floating">
            <input
              type="text"
              class="form-control"
              id="floatingInput"
              placeholder="apelido"
            />
            <label for="floatingInput">Apelido</label>
          </div>
          <div class="form-floating">
            <input class="form-control" type="tel" id="telefone" name="telefone" placeholder="Digite seu telefone" pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}" required>
            <label for="telefone">Telefone</label>
          </div>
          <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email</label>
          </div>
          <div class="form-floating">
            <input
              type="password"
              class="form-control"
              id="floatingPassword"
              placeholder="Password"
            />
            <label for="floatingPassword">Password</label>
          </div>

          <div class="form-floating">
            <input
              type="password"
              class="form-control"
              id="floatingPassword"
              placeholder="Confirmar Password"
            />
            <label for="floatingPassword">Confirmar password</label>
          </div>

          <div class="form-floating">
            <input
              type="text"
              class="form-control"
              id="floatingInput"
              placeholder="morada"
            />
            <label for="floatingInput">Morada</label>
          </div>
          
          <div class="form-floating">
            <input
              type="date"
              class="form-control"
              id="floatingInput"
              placeholder="data de nascimento"
            />
            <label for="floatingInput">Data de Nascimento</label>
          </div>

         <div class="form-floating">
          <input
            type="text"
            class="form-control"
            id="floatingInput"
            placeholder="NIF"
          />
          <label for="floatingInput">NIF</label>
        </div>
        </form>

        <button class="btn btn-primary w-100 py-2" type="submit">
          Registar
        </button>
        _________________________________________________________________

        <div id="emailHelp" class="form-text">Já tem conta?</div>
        <button type="submit" class="btn btn-primary">Faça login</button>
      </main>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>

<?php 
   if(!isset($base_path)){
    $base_path = "./";
  }

?>
<nav class="navbar bg-primary navbar-expand-lg">

  <div class="container-fluid">

    <a class="navbar-brand" href="<?php echo $base_path; ?>index.php">
      <img src="<?php echo $base_path; ?>assets/images/logo.png" alt="logo" width="70" height="auto">
    </a>

    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse w-100" id="navbarSupportedContent">
      <div class="d-flex w-100  align-items-center">
        <div class="mx-auto">
          <ul class="navbar-nav  mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active text-white" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#" role="button">
                Produtos
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#">Contactos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#">Minha Conta</a>
            </li>
          </ul>
        </div>

        <div class="d-flex">
          <i class="fa fa-search mx-3" style="font-size:20px; color: white; margin-right: 20px;"></i>
          <a href="./pages/login.php">
            <i class="fa fa-user-circle-o mx-3" style="font-size:20px; color: white; margin-right: 20px;"></i>
          </a>
          <i class="fa fa-cart-plus mx-3" style="font-size:20px; color: white; margin-right: 20px;"></i>
        </div>
      </div>
    </div>
  </div>
</nav>

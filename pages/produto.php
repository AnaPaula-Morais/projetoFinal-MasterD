<?php 
    $base_path = "../";
    include "../config.php";

   if(isset($_GET['id']) && is_numeric($_GET['id'])){
        $id = intval($_GET['id']);

        $sql = "SELECT produtos.*, categorias.nome AS categoria_nome
        FROM produtos JOIN categorias ON produtos.categoria_id = categorias.id
        WHERE produtos.id = $id";

        $result = $conn -> query($sql);

        if($result && $result->num_rows > 0){
            $produto = $result->fetch_assoc();

        }else{
            echo "Produto não encontrado";
            exit;
        }
   }else{
    echo "ID do produto inválido";
    exit;
   }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $produto['nome_produto'];?> - Detalhes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--link font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    

</head>
<body>

  <?php 
    include "../header.php";
  ?>

<!-- content -->
<section class="py-5">
  <div class="container">
    <div class="row gx-5">
      <aside class="col-lg-6">
        <div class="border rounded-4 mb-3 d-flex justify-content-center">
          <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image" href="https://mdbcdn.b-cdn.net/img/bootstrap-ecommerce/items/detail1/big.webp">
            <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" src="../<?php echo $produto['imagem']; ?>" />
          </a>
        </div>
        
      </aside>
      <main class="col-lg-6">
        <div class="ps-lg-3">
          <h4 class="title text-dark">
            <?php echo $produto["nome_produto"];?>
          </h4>
          <div class="d-flex flex-row my-3">
           
            <span class="text-muted"><?php echo $produto["estoque"];?></span>
            <span class="text-success ms-2">Em stock</span>
          </div>
          <i class=""></i>
          <div class="mb-3">
            <span class="h5"> <?php echo "R$ ".$produto["preco"] ;?> </span>
          </div>

          <p>
            <?php echo $produto["descricao"];?>
          </p>

          <hr />

          <div class="row mb-4">
            <div class="col-md-4 col-6">
              <label class="mb-2">Tamanho</label>
              <select class="form-select border border-secondary" style="height: 35px;">
                <option disabled>P</option>
                <option>M</option>
                <option disabled>G</option>
              </select>
            </div>
            <!-- col.// -->
            <div class="col-md-4 col-6 mb-3">
              <label class="mb-2 d-block">Quantidade</label>
              <div class="input-group mb-3" style="width: 170px;">
                <button class="btn btn-white border border-secondary px-3" type="button" id="button-addon1" data-mdb-ripple-color="dark" onclick="alterarQuantidade(-1)">
                  <i class="fas fa-minus"></i>
                </button>
                <input id="quantidade" type="text" class="form-control text-center border border-secondary" placeholder="<?php echo $produto['estoque'] ?>" aria-label="Example text with button addon" aria-describedby="button-addon1" />
                <button class="btn btn-white border border-secondary px-3" type="button" id="button-addon2" data-mdb-ripple-color="dark" onclick="alterarQuantidade(1)">
                <i class="fa-solid fa-plus"></i>
                </button>
              </div>
            </div>
          </div>
          <a href="#" class="btn btn-warning shadow-0"> Comprar </a>
          <a href="./carrinho.php" class="btn btn-primary shadow-0"> <i class="me-1 fa fa-shopping-basket"></i> Adicionar ao carrinho </a>
        </div>
      </main>
    </div>
  </div>
</section>

<?php 
    include "./footer.php"

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    const estoque = <?php echo $produto['estoque']; ?>;
    function alterarQuantidade(valor){
      const input = document.getElementById("quantidade");
      //atalho para tratar valores inválidos ou vazios. Ele vai tentar converter o conteúdo do input para número, se não acontecer ele vai usar o número 1
      let atual = parseInt(input.value) || 1;
      atual += valor;
      if(atual < 1) atual =  1;
      if(atual > estoque) atual = estoque;
      input.value = atual;
    }
</script>

</body>
</html>
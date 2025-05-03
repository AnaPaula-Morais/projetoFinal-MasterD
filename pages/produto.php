<?php 
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
</head>
<body>
    <div class="container mt-5">
        <h1></h1>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
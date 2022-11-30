<?php 
include 'conn/connect.php';
$lista = $conn->query("select * from vw_tbprodutos where destaque_produto = 'sim' ");
$row_destaque = $lista->fetch_assoc();
$num_linhas = $lista->num_rows;
// print_r($row_destaque);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Destaques</title>
</head>
<body>
    <h2 class="breadcrumb alert-danger"><strong>Destaques</strong></h2>
    <div class="row">
        <?php do {?> <!-- início da estrutura de repetição-->
                <div class="thumbnail"><!-- Abre thumbnail/card  -->
                    <a href="produto_detalhe.php?id_produto=<?php echo $row_destaque['id_produto']; ?>">
                        <img src="images/<?php echo $row_destaque['imagem_produto']; ?>" alt=""
                        class="img-responsive img-rounded" style="height: 20em;">
                    </a>
                    <div class="caption text-right">
                        <h3 class="text-danger">

                        </h3>
                        <p class="text-warning">

                        </p>
                        <p class="text-left">

                        </p>
                        <p>
                            <button class="btn btn-default disabled">

                            </button>
                            <a href="">
                                <span></span>
                                <span></span>
                            </a>
                        </p>
                    </div>
                </div><!-- Abre thumbnail/card  -->
        <?php }while($row_destaque = $lista->fetch_assoc());?> <!-- final da estrutura de repetição-->
    </div>
</body>
</html>
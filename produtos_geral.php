<?php
include "conn/connect.php";
$listaGeral = $conn->query("select * from tbprodutos order by descri_produto");
$row_geral = $listaGeral->fetch_assoc();
$num_linhas = $listaGeral->num_rows;

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Geral</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilo.css">
</head>

<body class="fundofixo">
    <?php include "menu_publico.php" ?>
    <div class="container">
            <h2 class="breadcrumb alert-danger">
                <a href="javascript:window.history.go(-1)" class="btn btn-danger">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                Todos os Produtos
            </h2>
        <div class="row">
            <?php do { ?>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <a href="produto_detalhe.php?id_produto=<?php echo $row_geral['id_produto'] ?>">
                            <img src="images/<?php echo $row_geral['imagem_produto']; ?>" class="img-responsive img-rounded" style="height:20em">
                        </a>
                        <div class="caption text-right">
                            <h3 class="text-danger">
                                <strong><?php echo $row_geral['descri_produto']; ?></strong>
                            </h3>
                            <p class="text-left">
                                <?php echo mb_strimwidth($row_geral['resumo_produto'], 0, 42, '...'); ?>
                            </p>
                            <p>
                                <button class="btn btn-default disabled" role="button" style="cursor: default;">
                                    <?php echo "R$ " . number_format($row_geral['valor_produto'], 2, ',', '.'); ?>
                                </button>
                                <a href="produto_detalhe.php?id_produto=<?php echo $row_geral['id_produto']; ?>">
                                    <span class="hidden-xs">Saiba mais</span>
                                    <span class="disable-xs glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                </a>
                            </p>
                        </div>
                    </div>
            </div>
        </div>
            <?php } while ($row_geral = $listaGeral->fetch_assoc()); ?>
    </div>
</body>
<footer>
    <?php include 'rodape.php' ?>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="./slick/slick.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    $(document).on('ready', function() {
        $(".regular").slick({
            dots: true,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3
        });
    });
</script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

</html>
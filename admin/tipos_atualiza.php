<?php
// Incluindo o Sistema de autenticação
include("acesso_com.php");

// Incluir o arquivo e fazer a conexão
include("../conn/connect.php");


if($_POST){


    // Receber os dados do formulário
    // Organizar os campos na mesma ordem
    $id_tipo   =   $_POST['id_tipo'];
    $sigla_tipo   =   $_POST['sigla_tipo'];
    $rotulo_tipo    =   $_POST['rotulo_tipo'];

    // Campo do form para filtrar o registro (WHERE)
    $id      = $_POST['id_tipo'] ;

    // Consulta SQL para atualização de dados
    $updateSQL  =   "UPDATE tbtipos
                        SET id_tipo     =   '$id_tipo',
                            destaque_tipo    =   '$destaque_tipo',
                            sigla_tipo      =   '$sigla_tipo',
                            rotulo_tipo      =   '$rotulo_tipo',
                        WHERE id_tipo = $id ";
    $resultado  =   $conn->query($updateSQL);
    if ( $resultado ) {
        header("Location: tipos_lista.php");
    }
    
};

// Consulta para trazer e filtrar os dados
if ($_GET)
$id_form  =   $_GET['id_tipo'];
else
$id_form = 0;
$lista          =   $conn->query("SELECT * FROM tbtipos WHERE id_tipo = $id_form");
$row            =   $lista->fetch_assoc();
$totalRows      =   ($lista)->num_rows;


// Selecionar os dados da chave estrangeira
$tabela_fk      =   "tbtipos";
$ordenar_por    =   "rotulo_tipo ASC";
$consulta_fk    =   "SELECT *
                    FROM ".$tabela_fk."
                    ORDER BY ".$ordenar_por." ";
// Fazer a lista completa dos dados
$lista_fk       =   $conn->query($consulta_fk);
// Separar os dados em linhas(row)
$row_fk         =   $lista_fk->fetch_assoc();
// Contar o total de linhas
$totalRows_fk   =   ($lista_fk)->num_rows;

?>
<!-- html:5 -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Tipos - Atualiza</title>
    <meta charset="UTF-8">
    <!-- Link arquivos Bootstrap CSS -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS específico -->
    <link rel="stylesheet" href="../css/estilo.css" type="text/css">
</head>
<body class="fundofixo">
<?php include "menu_adm.php"; ?>
<main class="container">
    <div class="row"><!-- Abre row -->
        <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4"><!-- Dimensionamento -->
            <h2 class="breadcrumb text-danger">
                <a href="tipos_lista.php">
                    <button class="btn btn-danger">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                Atualizar Tipos
            </h2>
            <!-- Abre thumbnail -->
            <div class="thumbnail">
                <div class="alert alert-danger" role="alert">
                    <form action="tipos_atualiza.php" id="form_tipos_atualiza" name="form_tipos_atualiza" method="post" enctype="multipart/form-data">
                        <!-- Select id_tipo -->
                        <label for="sigla_tipo">Sigla:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span>
                            </span>
                            <input type="text" name="sigla_tipo" id="sigla_tipo" class="form-control" placeholder="Digite a sigla ." maxlength="3" required value="<?php echo $row['sigla_tipo']?>">
                        </div>
                        <br>
                        <!-- Fecha Select id_tipo -->
                        <br>
                        <!-- Fecha Select id_tipo -->

                


                        <!-- textarea rotulo_tipo -->
                        <label for="rotulo_tipo">Rotulo:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                            </span>
                            <textarea name="rotulo_tipo" id="rotulo_tipo" cols="30" rows="8" placeholder="Digite os detalhes do produto." class="form-control"><?php echo $row['rotulo_tipo']; ?></textarea>
                        </div><!-- fecha input-group -->
                        <br>
                        <!-- Fecha textarea rotulo_tipo -->

                        
                        <!-- btn enviar -->
                        <input type="submit" value="Atualizar" name="enviar" id="enviar" class="btn btn-danger btn-block">
                    </form>
                </div><!-- Fecha alert -->
            </div><!-- Fecha thumbnail -->
        </div><!-- Fecha Dimensionamento -->
    </div><!-- Fecha row -->
</main>

<!-- Script para a imagem -->
<script>
document.getElementById("imagem_produto").onchange = function(){
    var reader = new FileReader();
    if(this.files[0].size>528385){
        alert("A imagem deve ter no máximo 500Kb");
        $("#imagem").attr("src","blank");
        $("#imagem").hide();
        $('#imagem_produto').wrap('<form>').closest('form').get(0).reset();
        $('#imagem_produto').unwrap();
        return false;
    };
    if(this.files[0].type.indexOf("image")==-1){
        alert("Formato inválido, escolha uma imagem!");
        $("#imagem").attr("src","blank");
        $("#imagem").hide();
        $('#imagem_produto').wrap('<form>').closest('form').get(0).reset();
        $('#imagem_produto').unwrap();
        return false;
    };
    reader.onload = function (e) {
        // obter dados carregados e renderizar miniatura.
        document.getElementById("imagem").src = e.target.result;
        $("#imagem").show();
    };  
    // leia o arquivo de imagem como um URL de dados.
    reader.readAsDataURL(this.files[0]);
};
</script>

<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
<?php 
    mysqli_free_result($lista_fk);
    mysqli_free_result($lista);
?>
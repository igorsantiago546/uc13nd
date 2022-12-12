<?php
// Incluindo o Sistema de autenticação
include("acesso_com.php");

// Incluir o arquivo e fazer a conexão
include("../conn/connect.php");


if($_POST){


    // Receber os dados do formulário
    // Organizar os campos na mesma ordem
    $id_usuario   =   $_POST['id_usuario'];
    $login_usuario   =   $_POST['login_usuario'];
    $senha_usuario    =   $_POST['senha_usuario'];
    $nivel_usuario    =   $_POST['nivel_usuario'];

    // Campo do form para filtrar o registro (WHERE)
    $id      = $_POST['id_usuario'] ;

    // Consulta SQL para atualização de dados
    $updateSQL  =   "UPDATE tbusuarios
                        SET id_usuario     =   '$id_usuario',
                            login_usuario    =   '$login_usuario',
                            senha_usuario      =   '$senha_usuario',
                            nivel_usuario      =   '$nivel_usuario',
                        WHERE id_usuario = $id ";
    $resultado  =   $conn->query($updateSQL);
    if ( $resultado ) {
        header("Location: usuarios_lista.php");
    }
    
};

// Consulta para trazer e filtrar os dados
if ($_GET)
$id_form  =   $_GET['id_usuario'];
else
$id_form = 0;
$lista          =   $conn->query("SELECT * FROM tbusuarios WHERE id_usuario = $id_form");
$row            =   $lista->fetch_assoc();
$totalRows      =   ($lista)->num_rows;


// Selecionar os dados da chave estrangeira
$tabela_fk      =   "tbusuarios";
$ordenar_por    =   "senha_usuario ASC";
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
    <title>Usuários - Atualiza</title>
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
                <a href="usuarios_lista.php">
                    <button class="btn btn-danger">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                Atualizar Usuário
            </h2>
            <!-- Abre thumbnail -->
            <div class="thumbnail">
                <div class="alert alert-danger" role="alert">
                    <form action="usuarios_atualiza.php" id="form_usuarios_atualiza" name="form_usuarios_atualiza" method="post" enctype="multipart/form-data">
                        <!-- Select id_usuario -->
                        <label for="login_usuario">Login:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            </span>
                            <input type="text" name="login_usuario" id="login_usuario" class="form-control" placeholder="Digite o login" maxlength="10" required value="<?php echo $row['login_usuario']?>">
                        </div>
                        <br>
                        <!-- Fecha Select id_usuario -->
                        
                        <!-- Select id_usuario -->
                        <label for="senha_usuario">Senha:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            </span>
                            <input type="text" name="senha_usuario" id="senha_usuario" class="form-control" placeholder="Digite a senha" maxlength="8" required value="<?php echo $row['senha_usuario']?>">
                        </div>
                        <br>
                        <!-- Fecha Select id_usuario -->
                        <!-- Select id_usuario -->
                        <label for="nivel_usuario">Nivel:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            </span>
                            <input type="text" name="nivel_usuario" id="nivel_usuario" class="form-control" placeholder="Digite o nivel de usuário" maxlength="3" required value="<?php echo $row['nivel_usuario']?>">
                        </div>
                        <br>
                        <!-- Fecha Select id_usuario -->
                        
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
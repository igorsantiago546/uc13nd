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
    
    // Consulta SQL para inserção de dados
    $insertSQL  =   "INSERT INTO tbtipos
                        (id_tipo, sigla_tipo, rotulo_tipo)
                    VALUES
                        ('$id_tipo','$sigla_tipo','$rotulo_tipo')
                    ";
    $resultado  =   $conn->query($insertSQL);

    // Após a ação a página será redirecionada
    if(mysqli_insert_id($conn)){
        header("Location: tipos_lista.php");
    }else{
        header("Location: tipos_lista.php");
    };
};

// Selecionar os dados da chave estrangeira
$consulta_fk    =   "SELECT * FROM tbtipos  ORDER BY sigla_tipo ASC ";
$lista_fk       =   $conn->query($consulta_fk);
$row_fk         =   $lista_fk->fetch_assoc();
$totalRows_fk   =   ($lista_fk)->num_rows;

?>
<!-- html:5 -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Tipos - Insere</title>
    <meta charset="UTF-8">
    <!-- Link arquivos Bootstrap CSS -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
                Inserindo Tipos
            </h2>
            <!-- Abre thumbnail -->
            <div class="thumbnail">
                <div class="alert alert-danger" role="alert">
                    <form action="tipos_insere.php" id="form_tipos_insere" name="form_tipos_insere" method="post" enctype="multipart/form-data">
                        <!-- Select id_tipo -->
                        <label for="id_tipo">Tipo:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>
                            </span>
                            <!-- select>option*2 -->
                            <select name="id_tipo" id="id_tipo" class="form-control" required>
                                <!-- Abre estrutura de repetição -->
                                <?php do { ?>
                                <option value="<?php echo $row_fk['id_tipo']; ?>">
                                    <?php echo $row_fk['sigla_tipo']; ?>
                                </option>
                                <?php } while($row_fk = $lista_fk->fetch_assoc()); 
                                $rows_fk = mysqli_num_rows($lista_fk);
                                if($rows_fk > 0){
                                    mysqli_data_seek($lista_fk,0);
                                    $rows_fk = $lista_fk->fetch_assoc();
                                };
                                ?>
                                <!-- Fecha estrutura de repetição -->
                            </select>
                        </div><!-- fecha input-group -->
                        <br>
                        <!-- Fecha Select id_tipo -->


                        <!-- text rotulo_tipo -->
                        <label for="rotulo_tipo">Rotulo:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span>
                            </span>
                            <input type="text" name="rotulo_tipo" id="rotulo_tipo" class="form-control" placeholder="Digite o rotulo do produto." maxlength="100" required>
                        </div><!-- fecha input-group -->
                        <br>
                        <!-- Fecha text rotulo_tipo -->

                        
                        <!-- btn enviar -->
                        <input type="submit" value="Cadastrar" name="enviar" id="enviar" class="btn btn-danger btn-block">
                    </form>
                </div><!-- Fecha alert -->
            </div><!-- Fecha thumbnail -->
        </div><!-- Fecha Dimensionamento -->
    </div><!-- Fecha row -->
</main>

<!-- Script para a imagem -->
<script>

</script>

<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
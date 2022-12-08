<?php 
include "../conn/connect.php";
include "acesso_com.php";
$lista_tipos = $conn->query("select * from tbtipos");
$linha = $lista_tipos->fetch_assoc();
$numlinhas = $lista_tipos->num_rows;
print_r($linha)
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipos de produtos</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body class="fundofixo">
    <main></main>       
    
</body>
</html>
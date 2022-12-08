<?php 
include "acesso_com.php";
include "../conn/connect.php";
$lista_user = $conn->query("select * from tbusuarios");
$linha = $lista_user->fetch_assoc();
$num_linhas = $lista_user->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body class="fundofixo">
    <?php include "menu_adm.php"?>
    <main class="container">
    <h2 class="breadcrumb alert-danger" >Lista de Usuários </h2>
        <table class="table table-hover table-condensed tb-opacidade">
            <thead>
                <th class="hidden">ID</th>
                <th>NOME</th>
                <th class="hidden">SENHAS</th>
                <th>NIVEL</th>
                <th>
                    <a href="produtos_insere.php" target="_self" class="btn btn-block btn-primary btn-xs" role="button">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        <span class="hidden-xs">ADICIONAR</span>
                    </a>
                </th>
                <th></th>
            </thead>  
            <tbody>
                <?php do{?>
                    <tr>
                        <td class="hidden"><?php echo $linha['id_usuario']?></td>
                        <td><?php echo $linha['login_usuario']?></td>
                        <td class="hidden"><?php echo $linha['senha_usuario']?></td>
                        <td><?php echo $linha['nivel_usuario']?></td>
                        <td>
                                <a href="produtos_atualiza.php?id_priduto=<?php echo $linha['id_usuario']; ?>" class="btn btn-warning btn-block btn-xs">
                                    <span class="hidden-xs">ALTERAR</span>
                                    <span class="glyphicon glyphicon-refresh"></span>
                                </a>
                                <button data-nome="<?php echo $linha['senha_usuario']?>" data-id="<?php echo $linha['nivel_usuario']; ?>" class="delete btn btn-xs btn-block btn-danger">
                                    <span class="hidden-xs">EXCLUIR</span>
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                            </td>
                    </tr>
                <?php }while($linha = $lista_user->fetch_assoc());?>
            </tbody>      
        </table>
    </main>
    <div class="modal fade" id="modalEdit" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" type="button">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    Deseja mesmo excluir o item?
                    <h4><span class="nome text-danger"></span></h4>
                </div>
                <div class="modal-footer">
                    <a href="" type="button" class="btn btn-danger delete-yes">
                        Confirmar
                    </a>
                    <button class="btn btn-success" data-dismiss="modal">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript">
    $('.delete').on('click',function(){
        var nome = $(this).data('nome');// busca o nome com a descrição (data-nome)
        var id = $(this).data('id'); //busca o id (data-id)
        // console.log(id + '- ' + nome); mostra a função sendo executada no console
        $('span.nome').text(nome);//insere o nome do item na confirmação
        $('a.delete-yes').attr('href','produtos_excluir.php?id_produto='+id); //chama o arquivo php para excluir o produto
        $('#modalEdit').modal('show');//chamar o modal

    });
</script>
</html>
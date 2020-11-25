<?php
//inicializando a sessão
session_start();
define('HOME_DIR', 'C:\xampp\htdocs\modelo-fc\src\model');
include_once HOME_DIR . '\config-banco-dados.php';
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" 
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../model/css/style.css" />
    <title>Alterar Médico</title>
   
</head>

<?php
    //se a variavel global existir 
     if(isset($_SESSION['msg'])){
         //exibe a variavel local e destroi
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    //SQL para selecionar o registro
    $result_med = "SELECT * FROM medicos WHERE id=$id";

     //Seleciona os registros
     $resultado_med = $conn->prepare($result_med);
     // Executa a declaração preparada
     $resultado_med->execute();
     // Busca a linha de um conjunto de resultados
     $med = $resultado_med->fetch(PDO::FETCH_ASSOC); 
    ?>
<body">
<nav class="navbar d-flex justify-content-end">
    <a href="cad_med.php" role="button" class="anav rounded m-1" title="Cadastar Médico">Cadastrar médico</a>
    </nav>
<div class=" div1 container col-lg-4 rounded mt-5">
    <h1 class="h1div1 text-center pt-3">Editar de médico</h1>

   
    <form method="POST" action="../controller/medicoController/alteracao_med.php">
    <div class="container divin">
        <!-- input oculto com o id -->
    <input type="hidden" name="id" value="<?php if(isset($med['id'])){ echo $med['id']; } ?>">
    <!-- input oculto que pega a senha -->
    <input type="hidden" name="senhaAnt" value="<?php if(isset($med['senha'])){ echo $med['senha']; } ?>">

        <div class="form-group">
        <label>Nome</label>
        <input  class="form-control i" placeholder="nome" name="nome"  type="text" 
        value="<?php if(isset($med['nome'])){ echo $med['nome']; } ?>">
        </div>
        <div class="form-group">
         <label>Senha antiga</label>
        <input  class="form-control" placeholder="Insira a senha antiga" name="senha"  type="password" 
        value="">
        </div>
        <div class="form-group">
         <label>Nova Senha</label>
        <input  class="form-control" placeholder="Escolha uma nova senha forte e segura" name="novasenha"  type="password" 
        value="">
        </div>
    </div>
        <div class="d-flex justify-content-center mt-5">
            <input class="b btn btn-primary py-2 px-4" type="submit" name="alterar" value="Atualizar Cadastro">
        </div>
        <div class="text-center mt-3 pb-3">
            <a href="index.php" class="voltar" role="button" title="Voltar"><u> Voltar para página Inicial</u></a>
        </div>  
    </form>
</div>

</body>
</html>

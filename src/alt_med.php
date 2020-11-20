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
    <title>Alterar Médico</title>
    <script
	src="https://code.jquery.com/jquery-3.3.1.js"
	integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    crossorigin="anonymous">
    </script>
</head>
<body>
<div class="container bg-light col-lg-8 rounded mt-5">
<div class="row">
    <div class="col-10">
    <h1 class="text-uppercase text-center" style="margin-left: 145px;">Alterar Médico</h1>
    </div>
    <div class="col-2 align-self-center d-flex justify-content-end">
    <a href="../src/index.php" role="button" class="btn btn-primary" title="Voltar">Voltar</a>
    </div>
</div>
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
     $resultado_med->execute();
     $med = $resultado_med->fetch(PDO::FETCH_ASSOC); 
    ?>
    <form method="POST" action="controller/alteracao.php">
    <div class="container col-6">
        <!-- input oculto com o id -->
    <input type="hidden" name="id" value="<?php if(isset($med['id'])){ echo $med['id']; } ?>">
    <!-- input oculto que pega a senha -->
    <input type="hidden" name="senhaAnt" value="<?php if(isset($med['senha'])){ echo $med['senha']; } ?>">

        <div class="form-group">
        <label>Nome</label>
        <input  class="form-control" placeholder="nome" name="nome"  type="text" 
        value="<?php if(isset($med['nome'])){ echo $med['nome']; } ?>">
        </div>
        <div class="form-group">
         <label>Senha</label>
        <input  class="form-control" placeholder="senha" name="senha"  type="password" 
        value="">
        </div>
        <div class="form-group">
         <label>Nova Senha</label>
        <input  class="form-control" placeholder="Nova senha" name="novasenha"  type="password" 
        value="">
        </div>
    </div>
        <div class="d-flex justify-content-center">
        <input class="btn btn-success py-1 px-3 mb-3 text-uppercase" style="font-size: 15px;" type="submit" name="alterar" value="Alterar">
        </div>
    </form>
    </div>

</body>
</html>

<script>
    
</script>
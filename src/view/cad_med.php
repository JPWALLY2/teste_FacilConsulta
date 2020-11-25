<?php
//inicializando a sessão
session_start()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" 
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../model/css/style.css" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Signika" />
    <title>Cadastro de Médicos </title>

</head>
<body">

<nav class="navbar d-flex justify-content-end">
<a href="cad_med.php" role="button" class="anav rounded ml-auto" title="Cadastar Médico">Cadastrar médico</a>
</nav>

<div class=" div1 container col-lg-4 rounded mt-5">
    <h1 class="h1div1 text-center pt-3">Cadastro de médicos</h1>

    <?php
    //se a variavel global existir 
    //  if(isset($_SESSION['msg'])){
    //      //exibe a variavel local e destroi
    //     echo $_SESSION['msg'];
    //     unset($_SESSION['msg']);
    // }
    ?>
    <form method="POST" action="../controller/medicoController/cadastro_med.php">
    <div class="container divin">

        <div class="form-group">
        <label>Nome</label>
        <input  class="form-control" placeholder="Insira o nome do profissional" name="nome" minlength="6" type="text" required>
        </div>
        <div class="form-group">
        <label>Email</label>
        <input  class="form-control" placeholder="exemplo@dominio.com.br" name="email" minlength="6" type="email" required>
        </div>
        <div class="form-group">
         <label>Senha</label>
        <input  class="form-control" placeholder="Escolha uma senha forte e segura" name="senha" minlength="6" type="password" required>
        </div>
    </div>
        <div class="d-flex justify-content-center mt-5">
        <input class="b btn btn-primary py-2 px-4" type="submit" name="cadastrar" value="Realizar Cadastro">
    </div>
    <div class="text-center mt-3 pb-3">
    <a href="index.php" class="voltar" role="button" title="Voltar"><u> Voltar para página Inicial</u></a>
    </div>  
</form>
    </div>

</body>
</html>

<script>
    
</script>
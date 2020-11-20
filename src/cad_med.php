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
    <title>Cadastro de Médicos </title>
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
    <h1 class="text-uppercase text-center" style="margin-left: 145px;">Cadastro de Médicos</h1>
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
    ?>
    <form method="POST" action="controller/cadastro.php">
    <div class="container col-6">

        <div class="form-group">
        <label>Nome</label>
        <input  class="form-control" placeholder="nome" name="nome" minlength="6" type="text" required>
        <!-- <input  class="form-control" placeholder="nome" name="nome" minlength="6" pattern="[A-Z\s][a-z\s]+$"
        oninvalid="setCustomValidity('Somente Letras!')" type="text" required> -->
        </div>
        <div class="form-group">
        <label>Email</label>
        <input  class="form-control" placeholder="email" name="email" minlength="6" type="email" required>
        </div>
        <div class="form-group">
         <label>Senha</label>
        <input  class="form-control" placeholder="senha" name="senha" minlength="6" type="password" required>
        </div>
    </div>
        <div class="d-flex justify-content-center">
        <input class="btn btn-success py-1 px-3 mb-3 text-uppercase" style="font-size: 15px;" type="submit" name="cadastrar" value="Cadastrar">
        </div>
    </form>
    </div>

</body>
</html>

<script>
    
</script>
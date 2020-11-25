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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Cadastro de Horários </title>
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
    <h1 class="text-uppercase text-center" style="margin-left: 145px;">Cadastro de Horários</h1>
    </div>
    <div class="col-2 align-self-center d-flex justify-content-end">
    <a href="index.php" role="button" class="btn btn-primary" title="Voltar">Voltar</a>
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
    //Prepara uma instrução para execução e retorna um objeto de instrução
     $resultado_med = $conn->prepare($result_med);
     // Executa a declaração preparada
     $resultado_med->execute();
     // Busca a linha de um conjunto de resultados
     $med = $resultado_med->fetch(PDO::FETCH_ASSOC); 

     //dados horarios
    //SQL para selecionar os registros
    $result_hor = "SELECT * FROM horarios WHERE id_medicos=$id ORDER BY id ASC";
     $resultado_hor = $conn->prepare($result_hor);
     $resultado_hor->execute();
    ?>
    <!-- <form method="POST" action="#"> -->
    <form method="POST" action="../controller/horarioController/cadastro_hor.php">
    <div class="container col-4">

        <div class="form-group">
        <input type="hidden" name="id" value="<?php if(isset($med['id'])){ echo $med['id']; } ?>">
        <label>Horário</label>
        <input  class="form-control" placeholder="horario" name="horario" type="datetime-local" required>
        </div>
    </div>
        <div class="d-flex justify-content-center">
        <input class="btn btn-success py-1 px-3 mb-3 text-uppercase" style="font-size: 15px;" type="submit" name="cadastrar" value="Cadastrar">
        </div>
    </form>

    <table class="table table-striped">
         <thead>
         <tr>
         <th class="text-center">Horário</th>
         <th></th>
         </tr>
         </thead>
         <tbody>
         <?php
         // Busca a linha de um conjunto de resultados
        while ($hor = $resultado_hor->fetch(PDO::FETCH_ASSOC)) {
                echo ' <tr>';
                //cria um objeto DateTime
                $data = new DateTime($hor['data_horario']);
                echo '<td scope="row" class="text-center">' . $data->format('d-m-yy H:i') . '</td>';
                echo "<td><a href='../controller/horarioController/excluir_hor.php?id=".$hor['id'] . "' 
                role='button' class='btn btn-danger' title='Excluir' name='excluir'><i class='fa fa-trash'></i></a></td>";
                echo '</tr>';
        }
        ?>
        </tbody>
        </table>

</body>
</html>

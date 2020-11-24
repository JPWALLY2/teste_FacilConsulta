<?php
session_start();
define('HOME_DIR', 'C:\xampp\htdocs\modelo-fc\src\model');
include_once HOME_DIR . '\config-banco-dados.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" 
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../model/css/style.css" />
    <title>Lista de Médicos</title>

</head>
<body>
    <div class="container bg-light col-lg-8 rounded mt-5">
    <div class="row">
    <div class="col-10">
    <h1 class="text-uppercase text-center">Lista de Médicos</h1>
    </div>
    <div class="col-2 align-self-center d-flex justify-content-end">
    <a href="cad_med.php" role="button" class="btn btn-primary" title="Cadastar Médico">Cadastrar</a>
    </div>
    </div>
        <?php
        //se a variavel global existir 
     if(isset($_SESSION['msg'])){
        //exibe a variavel local e destroi
       echo $_SESSION['msg'];
       unset($_SESSION['msg']);
        } 
        //SQL para selecionar os registros
        $result_med = "SELECT * FROM medicos ORDER BY id ASC";

        //prepara os registros
        $resultado_med = $conn->prepare($result_med);
        $resultado_med->execute();
        

        $result_hor = "SELECT * FROM horarios WHERE id_medicos";
        //prepara os registros
        $resultado_hor = $conn->prepare($result_hor);
        $resultado_hor->execute();
        ?>

      
         <table class="table table-striped">
         <thead>
         <tr>
         <th scope="col" class="text-center">Nome</th>
         <th class="text-center">Email</th>
         <th class="text-center">Horários</th>
         <th class="text-center"></th>
         </tr>
         </thead>
         <tbody>

         <?php
        while ($med = $resultado_med->fetch(PDO::FETCH_ASSOC)) {
                echo ' <tr>';
                echo '<input type="hidden"  name="id" class="col-1" value="' . $med['id']  .'">';
                echo '<td scope="row" class="text-center">' . $med['nome'] . '</td>';
                echo '<td class="text-center">' . $med['email'] . '</td>';
                echo '<td class="text-center">';
                while ($hor = $resultado_hor->fetch(PDO::FETCH_ASSOC)) {
                    $data = new DateTime($hor['data_horario']);
                    echo '<input type="hidden"  class="col-2" value="' . $hor['id'] . '">';
                    echo "<a href='../controller/horarioController/agendar_hor.php?id=" . $hor['id'] . "'
                    'role='button' title='Agendar Horário' name='agendar' style='text-decoration: none;'>". $data->format('d-m-yy H:i'). "</a>";
                    echo '<br>';
                }
                '</td>';
                echo '<td class="text-center">';
                echo "<a href='cad_hor.php?id=".$med['id'] . "'
                 role='button' class='btn btn-success' title='Adicionar Horário'><i class='fa fa-plus'></i></a>&nbsp;&nbsp";
                echo "<a href='alt_med.php?id=".$med['id'] . "'
                 role='button' class='btn btn-warning' title='Editar'><i class='fa fa-edit'></i></a>&nbsp;&nbsp";
                echo "<a href='../controller/medicoController/excluir_med.php?id=".$med['id'] . "'
                role='button' class='btn btn-danger' title='Excluir' name='excluir'><i class='fa fa-trash'></i></a></td>";
               
                echo '</tr>';
        }
        ?>
        </tbody>
        </table>
    </div>
</body>

<script>

</script>
</html>
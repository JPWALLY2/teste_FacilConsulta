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
<?php
        //se a variavel global existir 
    //  if(isset($_SESSION['msg'])){
    //     //exibe a variavel local e destroi
    //    echo $_SESSION['msg'];
    //    unset($_SESSION['msg']);
    //     } 
        //SQL para selecionar os registros
        $result_med = "SELECT * FROM medicos ORDER BY id ASC";
        //Prepara uma instrução para execução e retorna um objeto de instrução
        $resultado_med = $conn->prepare($result_med);
        // Executa a declaração preparada
        $resultado_med->execute();

        ?>

<body>
    <nav class="navbar d-flex justify-content-end">
    <a href="cad_med.php" role="button" class="anav rounded ml-auto " title="Cadastar Médico">Cadastrar médico</a>
    </nav>
   
    <?php
    while ($med = $resultado_med->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class=" div2 container col-lg-7 col-10 rounded mt-5">';
                echo '<div class="row container d-flex mb-4" style="margin-left:0px">';
                    echo '<h1 class="pt-3 dadoMed mr-auto">'. $med['nome'] .'</h1>';
                            echo "<a href='alt_med.php?id=".$med['id'] . "'
                            role='button' class=' py-0 mt-3  btn btnE' title='Editar cadastro'>Editar cadastro</a>&nbsp&nbsp";
                            echo "<a href='cad_hor.php?id=".$med['id'] . "'
                            role='button' class=' py-0 mt-3  btn btnH' title='Configurar horários'>Configurar horários</a>";
                            //seleciona horarios com o id do médico
                            $r = "SELECT * FROM horarios WHERE id_medicos=$med[id] ORDER BY data_horario > CURRENT_DATE";
                            $res = $conn->prepare($r);
                            $res->execute();
                            // BOTÃO DE EXCLUIR MEDICO DESNECESSÁRIO
                            // echo "<a href='../controller/medicoController/excluir_med.php?id=".$med['id'] . "'
                            // role='button' class='btn btn-danger' title='Excluir' name='excluir'><i class='fa fa-trash'></i></a></td>";
                echo '</div>';
            echo '<div class="d-flex flex-wrap mx-0">';
                // Busca a linha de um conjunto de resultados
                while ($hor = $res->fetch(PDO::FETCH_ASSOC)) {
                    //cria um objeto DateTime
                    $data = new DateTime($hor['data_horario']);
                    echo '<input type="hidden"  class="col-2" value="' . $hor['id'] . '">';
                    if($hor['horario_agendado'] == 0){
                        echo "<a class='data btn mr-2 mb-2 px-4' href='../controller/horarioController/agendar_hor.php?id=" . $hor['id'] . "
                        'role='button' title='Agendar Horário'>". $data->format('d/m/yy á H:i'). "</a>";
                        
                    }else{
                        echo "<a class='datap btn mr-2 mb-2 px-4' href='../controller/horarioController/agendar_hor.php?id=" . $hor['id'] . "
                        'role='button' title='Deixar o horário livre'>". $data->format('d/m/yy á H:i'). "</a>";

                    }

                }
                echo '</div>';
            echo '</div>';
    }
    ?>
    </body>
    </div>
    
    
</html>
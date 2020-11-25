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
    <link rel="stylesheet" type="text/css" href="../model/css/style.css" />
    <title>Cadastro de Horários </title>
</head>
<?php
    // //se a variavel global existir 
    //  if(isset($_SESSION['msg'])){
    //      //exibe a variavel local e destroi
         
    //     echo $_SESSION['msg'];
    //     unset($_SESSION['msg']);
    // }
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
<body>
    <nav class="navbar d-flex justify-content-around">
        <a href="cad_med.php" role="button" class=" ml-auto anav rounded" title="Cadastar Médico">Cadastrar médico</a>
    </nav>
    
<div class="container  d-flex row justify-content-center">
<div class="container bg-light col-lg-4 rounded mt-5 bg1 ">
<h1 class="h1div1 text-center pt-3">Adicionar horários</h1>
    
    <form method="POST" action="../controller/horarioController/cadastro_hor.php">
    <div class="container col-12">

        <div class="form-group">
        <label>Nome:</label>
        <h1 class="h1div1"><?php if(isset($med['nome'])){ echo $med['nome']; } ?></h1>
        </div>
        <div class="form-group">
        <input type="hidden" name="id" value="<?php if(isset($med['id'])){ echo $med['id']; } ?>">
        <label>Data e horário</label>
        <input  class="form-control" name="horario" type="datetime-local" required>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-5">
        <input class="b btn btn-primary py-2 px-4" type="submit" name="cadastrar" value="Realizar Cadastro">
    </div>
    <div class="text-center mt-3 pb-3">
    <a href="index.php" class="voltar" role="button" title="Voltar"><u> Voltar para página Inicial</u></a>
    </div>  
</div>
    </form>
    <div class="container bg-light col-lg-4 rounded mt-5 bg2">
    <h1 class="h1div1 text-center pt-3">Horários configurados</h1>

    <table class="table table-sm">
        
         <tbody>
         <?php
         // Busca a linha de um conjunto de resultados
        while ($hor = $resultado_hor->fetch(PDO::FETCH_ASSOC)) {
                echo ' <div class=" border-bottom d-flex">';
                //input oculta com o horario_agendado
                echo '<input type="hidden"  value="'. $hor['horario_agendado'].'">';
                //cria um objeto DateTime
                $data = new DateTime($hor['data_horario']);
                echo '<div class=" mr-auto data p-0 btn-data">' . $data->format('d/m/yy H:i') . '</div>';
                if($hor['horario_agendado'] == 0){
                    echo "<div class=''>
                    <a href='../controller/horarioController/excluir_hor.php?id=".$hor['id'] . "' 
                    role='button' class='btn btnExc pt-0 mt-0 pb-0' title='Excluir' name='excluir'>Remover</a></div>";

                }
                echo '</div>';
        }
        ?>
        </tbody>
        </table>
    </div>

    </div> 

</body>
</html>


<?php
//inicializando a sessão
session_start();
define('HOME_DIR', 'C:\xampp\htdocs\modelo-fc\src\model');

// incluido o arquivo  de conf do banco
include_once HOME_DIR . '\config-banco-dados.php';
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    //selecionado os horários com o id do horario que está vindo do front
    $i = "SELECT * FROM horarios WHERE id=$id";
    //Prepara uma instrução para execução e retorna um objeto de instrução
    $h = $conn->prepare($i);
    // Executa a declaração preparada
    $h->execute();
    // Busca a linha de um conjunto de resultados
    $rh = $h->fetch(PDO::FETCH_ASSOC);
    $horario = $rh['horario_agendado'];
    $idM = $rh['id_medicos'];

    if($horario == 0 ){
      //variavel global
      $_SESSION['msg'] = "<p class='alert-success py-2 text-center font-weight-bold'>Horário agendado com sucesso!</p>";
      $horario_agendado = 1;
    }else{
      //variavel global
      $_SESSION['msg'] = "<p class='alert-success py-2 text-center font-weight-bold'>Horário liberado para o agendamento</p>";
      $horario_agendado = 0;
    }

    $resultA_hor = "UPDATE horarios SET horario_agendado=:horario_agendado WHERE id=$id";
   
      //prepara para receber os dados
      $update_hor = $conn->prepare($resultA_hor);
      //atribuir ao identificador horario_agendado a variavel horario_agendado
      $update_hor->bindParam(':horario_agendado', $horario_agendado);

      if($update_hor->execute()){
        //redirecionamento
        header("Location: ../../view/index.php");
    } else{
         //redirecionamento
         header("Location: ../../view/index.php");
    }

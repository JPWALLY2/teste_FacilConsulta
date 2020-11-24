<?php
//inicializando a sessão
session_start();
define('HOME_DIR', 'C:\xampp\htdocs\modelo-fc\src\model');

// incluido o arquivo  de conf do banco
include_once HOME_DIR . '\config-banco-dados.php';
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $horario_agendado = 1;
    $resultA_hor = "UPDATE horarios SET horario_agendado=:horario_agendado WHERE id=$id";
    $i = "SELECT id FROM horarios WHERE horario_agendado=1";

    
      //prepara para receber os dados
      $update_hor = $conn->prepare($resultA_hor);
      //atribuir ao identificador nome a variavel nome
      $update_hor->bindParam(':horario_agendado', $horario_agendado);

      if($update_hor->execute()){
        //variavel global
        $_SESSION['msg'] = "<p class='alert-success py-2 text-center font-weight-bold'>Horário agendado com sucesso!</p>";
        //redirecionamento
        header("Location: ../../view/index.php");
    } else{
         //variavel global
         $_SESSION['msg'] = "<p class='alert-danger py-2 text-center font-weight-bold'>Falha ao agendar o horário</p>";
         //redirecionamento
         header("Location: ../../view/index.php");
    }

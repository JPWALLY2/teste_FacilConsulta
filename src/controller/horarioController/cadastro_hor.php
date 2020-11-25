<?php
//inicializando a sessão
session_start();
define('HOME_DIR', 'C:\xampp\htdocs\modelo-fc\src\model');

// incluido o arquivo  de conf do banco
include_once HOME_DIR . '\config-banco-dados.php';

//Verificar se o usuário clicou no botão de cadastro,
//se clicou no botão acessa o IF e tenta cadastrar, 
//caso contrario vai para o ELSE
$cadastrar = filter_input(INPUT_POST, 'cadastrar', FILTER_SANITIZE_STRING);
if($cadastrar){
    //dados do formulário
    $id_medicos = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $data_horario = filter_input(INPUT_POST, 'horario', FILTER_SANITIZE_STRING);


    //variavel que insere no banco de dados
    $result_hor = "INSERT INTO horarios (id_medicos, data_horario, horario_agendado) VALUES (:id_medicos, :data_horario, 0)";
    //prepara para receber os dados
    $insert_hor = $conn->prepare($result_hor);
    //atribuir as variaveis aos identificadores
    $insert_hor->bindParam(':id_medicos', $id_medicos);
    $insert_hor->bindParam(':data_horario', $data_horario);
    
            //se executou com sucesso
            if($insert_hor->execute()){
                //variavel global
                // $_SESSION['msg'] = "<p class='alert-success py-2 text-center font-weight-bold'>Horário do Médico cadastrado com sucesso!</p>";
                //redirecionamento
                header("Location: ../../view/cad_hor.php?id=$id_medicos");
                
                
            }else{
                //variavel global
                // $_SESSION['msg'] = "<p class='alert-danger py-2 text-center font-weight-bold' >Falha ao Cadastrar o Horário do Médico</p>";
                // //redirecionamento
                header("Location: ../../view/cad_hor.php");
            }

}   
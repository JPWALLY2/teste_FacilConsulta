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
$idM = $rh['id_medicos'];


if(!empty($id)){

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

    if($horario == 0){

        $exc = "DELETE FROM horarios WHERE id='$id'";
        $exclusao = $conn->prepare($exc);
    
        if($exclusao->execute()){
            //variavel global
            // $_SESSION['msg'] = "<p class='alert-success py-2 text-center font-weight-bold'>Horario do Médico excluído com sucesso!</p>";
            //redirecionamento
            header("Location: ../../view/cad_hor.php?id=$idM");
        } 
    }else{
        // $_SESSION['msg'] = "<p class='alert-danger py-2 text-center font-weight-bold'>Erro ao excluir, o horário está agendado</p>";
        header("Location: ../../view/cad_hor.php?id=$idM");
    }
    

}else{	
	// $_SESSION['msg'] = "<p class='alert-danger py-2 text-center font-weight-bold'>É necessário selecionar um horário</p>";
	header("Location: ../../view/cad_hor.php?id=$idM");
}
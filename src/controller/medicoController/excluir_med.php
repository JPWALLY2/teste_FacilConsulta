<?php
//inicializando a sessão
session_start();
define('HOME_DIR', 'C:\xampp\htdocs\modelo-fc\src\model');
// incluido o arquivo  de conf do banco
include_once HOME_DIR . '\config-banco-dados.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if(!empty($id)){
	$exc = "DELETE FROM medicos WHERE id='$id'";
    
    $exclusao = $conn->prepare($exc);

    if($exclusao->execute()){
        //variavel global
        $_SESSION['msg'] = "<p class='alert-success py-2 text-center font-weight-bold'>Médico excluído com sucesso!</p>";
        //redirecionamento
        header("Location: ../../view/index.php");
    } 

}else{	
	$_SESSION['msg'] = "<p style='color:red;'>Necessário selecionar um usuário</p>";
	header("Location: ../../view/index.php");
}
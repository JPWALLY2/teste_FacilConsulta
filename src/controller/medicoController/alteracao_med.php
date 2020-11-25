<?php
//inicializando a sessão
session_start();
define('HOME_DIR', 'C:\xampp\htdocs\modelo-fc\src\model');

// incluido o arquivo  de conf do banco
include_once HOME_DIR . '\config-banco-dados.php';
//Verificar se o usuário clicou no botão de alterar,
//se clicou no botão acessa o IF e tenta cadastrar, 
//caso contrario vai para o ELSE
$alterar = filter_input(INPUT_POST, 'alterar', FILTER_SANITIZE_STRING);
if($alterar){
     //dados do formulário
     $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
     $senhaAnt = filter_input(INPUT_POST, 'senhaAnt', FILTER_SANITIZE_STRING);
     $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
     $senhaAntiga = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
     $senha = filter_input(INPUT_POST, 'novasenha', FILTER_SANITIZE_STRING);

     $resultAlt_med = "UPDATE medicos SET nome=:nome, senha=:senha WHERE id=$id";

     //prepara para receber os dados
    $update_med = $conn->prepare($resultAlt_med);
    //atribuir ao identificador nome a variavel nome
    $update_med->bindParam(':nome', $nome);
    $senhamd5 = md5($senha);
    $update_med->bindParam(':senha', $senhamd5);

    //validação
    //contando os caracteres do nome email e senha
    $conNome = strlen($nome);
    $conSenha = strlen($senha);

    if($nome == null || $senha == null){
        //variavel global
    // $_SESSION['msg'] = "<p class='alert-danger py-2 text-center font-weight-bold' >Todos os campos devem ser preenchidos</p>";
    //redirecionamento
    header("Location: ../../view/alt_med.php?id=$id");
    }else{

    if(md5($senhaAntiga) == $senhaAnt){

        if($conNome < 6 || $conSenha < 6){
            //variavel global
            // $_SESSION['msg'] = "<p class='alert-danger py-2 text-center font-weight-bold' >Todos os campos devem ter o mínimo de 6 caracteres</p>";
            //redirecionamento
            header("Location: ../../view/alt_med.php?id=$id");
        }else{
            //se executou com sucesso
          if($update_med->execute()){
              //variavel global
            //   $_SESSION['msg'] = "<p class='alert-success py-2 text-center font-weight-bold'>Médico alterado com sucesso!</p>";
              //redirecionamento
              header("Location: ../../view/index.php");
          } 
        }
       
    }else{

        echo 'Senha Antiga ' . md5($senhaAntiga);
        echo 'Senha antiga informada ' .$senhaAnt;
        //variavel global
        // $_SESSION['msg'] = "<p class='alert-danger py-2 text-center font-weight-bold' >A senha informada não é a mesma senha cadastrada</p>";
        //redirecionamento
        header("Location: ../../view/alt_med.php?id=$id");
    }
}
}else{
     //variavel global
    //  $_SESSION['msg'] = "<p class='alert-danger py-2 text-center font-weight-bold' >Falha ao alterar o Médico</p>";
    //redirecionamento
     header("Location: ../../view/alt_med.php?id=$id");

}
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
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

    //variavel que insere no banco de dados
    $result_med = "INSERT INTO medicos (nome, email, senha) VALUES (:nome, :email, :senha)";
    //prepara para receber os dados
    $insert_med = $conn->prepare($result_med);
    //atribuir ao identificador nome a variavel nome
    $insert_med->bindParam(':nome', $nome);
    $insert_med->bindParam(':email', $email);
    $insert_med->bindParam(':senha', md5($senha));

    //validação
    //contando os caracteres do nome email e senha
    $conNome = strlen($nome);
    $conEmail = strlen($email);
    $conSenha = strlen($senha);

    if($nome == null || $email == null || $senha = null){
        //variavel global
    $_SESSION['msg'] = "<p class='alert-danger py-2 text-center font-weight-bold' >Todos os campos devem ser preenchidos</p>";
    //redirecionamento
    header("Location: ../cad_med.php");
    }else{

        //validando email com filter_var() (filtro nativo do php)
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            
                if($conNome < 6 || $conEmail < 6 || $conSenha < 6){
                     //variavel global
                     $_SESSION['msg'] = "<p class='alert-danger py-2 text-center font-weight-bold' >Todos os campos devem ter o mínimo de 6 caracteres</p>";
                     //redirecionamento
                     header("Location: ../cad_med.php");
                }else{
            
                        //se executou com sucesso
                        if($insert_med->execute()){
                            //variavel global
                            $_SESSION['msg'] = "<p class='alert-success py-2 text-center font-weight-bold'>Médico cadastrado com sucesso!</p>";
                            //redirecionamento
                            header("Location: ../index.php");
                    
                    
                        }else{
                            //variavel global
                            $_SESSION['msg'] = "<p class='alert-danger py-2 text-center font-weight-bold' >Falha ao Cadastrar o Médico</p>";
                            //redirecionamento
                            header("Location: ../cad_med.php");
                    }
                }
        }else{
        //variavel global
        $_SESSION['msg'] = "<p class='alert-danger py-2 text-center font-weight-bold' >O email informado não é um email verdadeiro</p>";
        //redirecionamento
        header("Location: ../cad_med.php");
        }
    }
    
}else{
    //variavel global
    $_SESSION['msg'] = "<p class='alert-danger py-2 text-center font-weight-bold' >Falha ao Cadastrar o Médico</p>";
    //redirecionamento
    header("Location: ../cad_med.php");
}   
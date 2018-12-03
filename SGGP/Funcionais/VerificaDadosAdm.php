<?php

    $login = $_POST['loginADM'];
    $email = $_POST['emailADM'];
    $senha = $_POST['senhaADM'];
    $confirmSenha = $_POST['confsenhaADM'];
    $senhaHash = hash('sha256', $senha);

    date_default_timezone_set('America/Sao_Paulo');
    $data = date('Y-m-d H:i:s');

    include("../BancoDeDados/Conexao.php");

    $conexao = conectar();

    include("ValidaSenhas.php");
    $forcaSenha = vSenha($senha);

    if(strlen($login) > 20){
        header('Location: ../Visuais/CadAdministrador.php?erro=1');    
    }
    else if(strlen($email) > 50){
        header('Location: ../Visuais/CadAdministrador.php?erro=2');
    }
    else if($forcaSenha == 0){
        header('Location: ../Visuais/CadAdministrador.php?erro=3');
    }
    else if($senha == $confirmSenha) {
        
        $inserir = "INSERT INTO `tb_usuarios` (`login`, `email`, `senha`, `data`, `tipo`, `acesso`) VALUES ('$login', '$email', '$senhaHash', '$data', 0, 1);";

        if ($conexao->query($inserir) === TRUE) {
           
            include("ClassUsuario.php");
            
            $adm = new Adm();
            $adm->CriaSessao($login, $email, 1);
            header('Location: ../Visuais/Painel.php');
        }  
    }
    else {     
        header('Location: ../Visuais/CadAdministrador.php?erro=4');
    }    
    $conexao->close();      
?>
<?php

    $login = $_POST['loginADM'];
    $email = $_POST['emailADM'];
    $senha1 = $_POST['senhaADM'];
    $senha2 = $_POST['confsenhaADM'];
    $senhaHash = hash('sha256', $senha1);

    date_default_timezone_set('America/Sao_Paulo');
    $data = date('Y-m-d H:i:s');

    include("../BancoDeDados/Conexao.php");

    $conexao = conectar();

    if($senha1 == $senha2) {
        
        $inserir = "INSERT INTO `tb_usuarios` (`login`, `email`, `senha`, `data`, `tipo`, `acesso`) VALUES ('$login', '$email', '$senhaHash', '$data', 0, 1);";

       if ($conexao->query($inserir) === TRUE) {
           
            $resultado = $conexao->query($busca);
               
               include("ClassUsuario.php");
               
               $adm = new Adm();
               $adm->CriaSessao($login, $email, 0);
                echo "aqui";
               header('Location: ../Visuais/Painel.php');

        }
        
    }

    else {
        
          header('Location: ../Visuais/CadAdministrador.php?erro=1');
        
    }
        
    $conexao->close();
        
?>
            
           
 
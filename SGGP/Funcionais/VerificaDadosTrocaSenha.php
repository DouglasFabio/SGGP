<?php

    if (!isset($_SESSION)) session_start();

    if (!isset($_SESSION['LiderLogin']) && !isset($_SESSION['AdmLogin'])) {

        session_destroy();

        header("Location: ../Visuais/TrocaSenha.php"); exit;
        
    }

    $senha1 = $_POST['senha'];
    $senhaHash = hash("sha256", $senha1);
    $senha2 = $_POST['confsenha'];

    include("../BancoDeDados/Conexao.php");

    $conexao = conectar();

    if($senha1 == $senha2){
        
        if(isset($_SESSION['LiderLogin']))
            $atualiza = "UPDATE `tb_usuarios` SET `senha` = '".$senhaHash."' WHERE `login` = '".$_SESSION['LiderLogin']."'";
        else
            $atualiza = "UPDATE `tb_usuarios` SET `senha` = '".$senhaHash."' WHERE `login` = '".$_SESSION['AdmLogin']."'";

        $resultado = mysqli_query($conexao, $atualiza);
        
        if($resultado)
            
            header('Location: ../Visuais/Painel.php');
        
        else 
            
            header('Location: ../Visuais/TrocaSenha.php?erro=1');

    }
    else{
        
        header('Location: ../Visuais/TrocaSenha.php?erro=2');
        
    }

?>
            
           
 
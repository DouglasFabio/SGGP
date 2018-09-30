<?php

    if (!isset($_SESSION)) session_start();

    if (!isset($_SESSION['LiderLogin']) && !isset($_SESSION['AdmLogin'])) {

        session_destroy();

        header("Location: ../Visuais/TrocaSenha.php"); exit;
        
    }

    $lider_antigo = $_SESSION['LiderLogin'];
    $novo_lider   = $_POST['lider_grupo'];
    $sigla        = $_POST['sigla'];
    $data = date('Y-m-d');
    
    if($novo_lider == "Escolha"){
        header('Location: ../Visuais/TrocaLider.php?erro=1');
    }else{
        include("../BancoDeDados/Conexao.php");

        $conexao = conectar();
        
        $registraLideranca = "INSERT INTO `tb_liderancas` (`lider_antigo`, `lider_novo`, `data_inicio`, `grupo`) 
                                                   VALUES ('$lider_antigo', '$novo_lider', '$data', '$sigla')";
        
        $atualizaLider = "UPDATE `tb_grupospesquisa` SET `lider` = '".$novo_lider."' WHERE `lider` = '".$lider_antigo."' and sigla = '".$sigla."'";
        
        if ($conexao->query($registraLideranca) === TRUE && $conexao->query($atualizaLider) === TRUE) {
            header("Location: ../Visuais/Painel.php?acao=1");
        }else{
            echo "Não trocou";
            echo $lider_antigo;
            echo $novo_lider;
        }
    }

?>
            
           
 
<?php
    
    $sigla = $_POST["sigla"];
    include("../BancoDeDados/Conexao.php");

    $conexao = conectar();
    
    if(isset($_POST["sigla"])){
        
        $excluir = "UPDATE `tb_grupospesquisa` SET `situacao`= 1 WHERE sigla = '$sigla'";    
        $resultado = mysqli_query($conexao, $excluir);
        
        header('Location: ../Visuais/ManutencaoGruposGeral.php?acao=ok');
    }
        else {
             header('Location: ../Visuais/ManutencaoGruposGeral.php?acao=erro');
        }
        
    $conexao->close();
        
?>
            
           
 
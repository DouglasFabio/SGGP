<?php
    
    $nome = $_POST["nome"];
  
    
    if(isset($_POST["nome"])){
        
        $excluir = "DELETE FROM `tb_participantes` WHERE grupo = '$nome'";    
        $resultado = mysqli_query($conexao, $excluir);
        
        header('Location: ../Visuais/GerenciandoTecnicos.php?acao=ok');
    }
        else {
             header('Location: ../Visuais/GerenciandoTecnicos.php?acao=erro');
        }
        
    $conexao->close();
        
?>
            
           
 
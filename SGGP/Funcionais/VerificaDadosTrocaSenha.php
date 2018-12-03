<?php
    include("../Uteis/HeadLogin.php");
?>
<form action="../Visuais/Painel.php" method="post">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Senha atualizada com sucesso!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary">OK</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
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
    include("../Uteis/ScriptsPainel.php");

    include("ValidaSenhas.php");
    $forcaSenha = vSenha($senha1);

    if($forcaSenha == 0){
        header('Location: ../Visuais/TrocaSenha.php?erro=1');
    }
    else if($senha1 == $senha2) {
        
        if(isset($_SESSION['LiderLogin']))
            $atualiza = "UPDATE `tb_usuarios` SET `senha` = '".$senhaHash."' WHERE `login` = '".$_SESSION['LiderLogin']."'";
        else
            $atualiza = "UPDATE `tb_usuarios` SET `senha` = '".$senhaHash."' WHERE `login` = '".$_SESSION['AdmLogin']."'";

        $resultado = mysqli_query($conexao, $atualiza);
        
        if($resultado)
            printf("<script>
                    $(document).ready(function(){
                    $('#myModal').modal('show');
                    });
                    </script>");
        else{
            header('Location: ../Visuais/TrocaSenha.php?erro=3');
        }
    }
    else {     
        header('Location: ../Visuais/TrocaSenha.php?erro=2');
    }    
    $conexao->close();
?>
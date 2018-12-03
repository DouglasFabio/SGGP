<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php

        if (!isset($_SESSION)) session_start();

        if (!isset($_SESSION['LiderLogin'])) {
            
          header("Location: ../Visuais/Painel.php"); exit;

        }


        include("../Uteis/HeadPainel.php");
        
    ?>
    </head>
    <form action="../Visuais/Painel.php" method="post">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Troca realizada com sucesso!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <input name="sigla" value="<?php echo $sigla; ?>" hidden>
              <div class="modal-footer">
                <button type="submit" class="btn btn-secondary">OK</button>
              </div>
            </div>
          </div>
        </div>
    </form>

    <form action="../Visuais/TrocaLider.php" method="post">
        <div class="modal fade" id="erro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Problemas nos dados informados!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <input name="sigla" value="<?php echo $sigla; ?>" hidden>
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
        include("../Uteis/ScriptsPainel.php");
    ?>

<?php

    $lider_antigo = $_SESSION['LiderLogin'];
    $novo_lider   = $_POST['lider_grupo'];
    $sigla        = $_POST['sigla'];
    $date         = $_POST['datatroca'];
    
    if($novo_lider == "Escolha"){
        printf("<script>
                        $(document).ready(function(){
                            $('#erro').modal('show');
                        });
                    </script>");
    }else{
        include("../BancoDeDados/Conexao.php");

        $conexao = conectar();
        
        $registraLideranca = "INSERT INTO `tb_liderancas` (`lider_antigo`, `lider_novo`, `data_inicio`, `grupo`) 
                                                   VALUES ('$lider_antigo', '$novo_lider', '$date', '$sigla')";
        
        $atualizaLider = "UPDATE `tb_grupospesquisa` SET `lider` = '".$novo_lider."' WHERE `lider` = '".$lider_antigo."' and sigla = '".$sigla."'";
        
        if ($conexao->query($registraLideranca) === TRUE && $conexao->query($atualizaLider) === TRUE) {
            printf("<script>
                    $(document).ready(function(){
                    $('#myModal').modal('show');
                    });
                    </script>");
        }else{
            printf("<script>
                        $(document).ready(function(){
                            $('#erro').modal('show');
                        });
                    </script>");
        }
    }

?>

            
           
 
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
    <body>
        <?php


            include("../BancoDeDados/Conexao.php");

            $conexao = conectar();

            $sigla = $_POST['sigla'];
            $id = $_POST['id'];

        ?>

        <form action="../Visuais/VincularLinhaPesquisa.php" method="post">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Vinculo com a linha excluido com sucesso!</h5>
                  </div>
                  <input name="sigla" value="<?php echo $sigla; ?>" hidden>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary">OK</button>
                  </div>
                </div>
              </div>
            </div>
        </form>
        

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <?php
            include("../Uteis/ScriptsPainel.php");
            
            $atualiza = "DELETE FROM tb_linhasgrupos WHERE id ='".$id."'";

            $resultado = mysqli_query($conexao, $atualiza);

            if($resultado){

                printf("<script>
                            $(document).ready(function(){
                                $('#myModal').modal('show');
                            });
                        </script>");

            }else{

                echo "erro";

            }

            $conexao->close();
        ?>

    </body>
</html>



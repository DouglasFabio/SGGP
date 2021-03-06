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

            date_default_timezone_set('America/Sao_Paulo');
            $nome_equipamento = $_POST['nome_equipamento'];
            $desc_equipamento = $_POST['desc_equipamento'];
            $data_inicio = $_POST['datainicio_equip'];
            $sigla = $_POST['sigla'];
           

        ?>

        <form action="../Visuais/Equipamentos.php" method="post">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Equipamento cadastrado com sucesso!</h5>
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
        

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <?php
            include("../Uteis/ScriptsPainel.php");

                $insereEquipamento = "INSERT INTO `tb_equipamentos` (`grupo`, `nome`, `descricao`, `data_inicio`)                                                                                                                   VALUES ('".$sigla."', '".$nome_equipamento."', '".$desc_equipamento."', '".$data_inicio."');";
                
        
            if ($conexao->query($insereEquipamento) === TRUE){
                printf("<script>
                            $(document).ready(function(){
                                $('#myModal').modal('show');
                            });
                        </script>");
            }else{
                printf($insereEquipamento);    
            }

            $conexao->close();
        ?>

    </body>
</html>



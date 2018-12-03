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
            $hoje = date('Y-m-d');
            $sigla = $_POST['sigla'];
            $linha = $_POST['linha_mostra'];
            $data_vinculo = $_POST['datavinculo_grupo'];
            $descricao_linha = $_POST['desclinha_grupo'];

        ?>

        <form action="../Visuais/VincularLinhaPesquisa.php" method="post">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Linha cadastrada com sucesso!</h5>
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
            
            $buscaCodigoLinha = "SELECT nome, codigo FROM tb_subespecialidades WHERE nome = '".$linha."'";
            $resultado = $conexao->query($buscaCodigoLinha);
            // VERIFICAÇÃO 
            if ($resultado->num_rows > 0) {
                $saida = $resultado->fetch_assoc();
                $insereLinha = "INSERT INTO `tb_linhasgrupos` (`grupo`, `inicio_vinculo`, `codigo_capes`, `descricao`, `data_cad`)                                                                                                                   VALUES ('".$sigla."', '".$data_vinculo."', ".$saida['codigo'].", '".$descricao_linha."', '".$hoje."');";

               $conexao->query($insereLinha);

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



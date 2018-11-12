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
            $titulo = $_POST['titulo_projeto'];
            $docente = $_POST['docente_projeto'];   
            $linha_projeto = $_POST['linha_projeto'];    
            $tipo_bolsa = $_POST['tipo_bolsa'];
            if($tipo_bolsa == "Outros"){
                $outra_bolsa = $_POST['outros_bolsa'];
            }
            $data_vinculo = $_POST['datainicio_proj']; 
        
            $buscaCodigoLinha = "SELECT codigo, nome FROM tb_subespecialidades WHERE nome LIKE  '".$linha_projeto."'";
 
            $resultado = $conexao->query($buscaCodigoLinha);
                   
            if ($resultado->num_rows > 0) {

                $saida = $resultado->fetch_assoc();
                
        ?>

        <form action="../Visuais/ProjetosPesquisa.php" method="post">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Projeto de pesquisa cadastrado com sucesso!</h5>
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
                if($tipo_bolsa == "Outros"){
                    $insereProjetoPesquisa = "INSERT INTO `tb_projetospesquisa` (`titulo`, `docente`, `linha`,`grupo`,`tipo`, `data_inicio`) 
                                                                                        VALUES ('$titulo', '$docente', '".$saida['codigo']."','$sigla','".$outra_bolsa."','$data_vinculo');";
                }
                else{
                     $insereProjetoPesquisa = "INSERT INTO `tb_projetospesquisa` (`titulo`, `docente`, `linha`,`grupo`,`tipo`, `data_inicio`) 
                                                                                        VALUES ('$titulo', '$docente', '".$saida['codigo']."','$sigla','".$tipo_bolsa."','$data_vinculo');";
                }

                if ($conexao->query($insereProjetoPesquisa) === TRUE){
                    printf("<script>
                                $(document).ready(function(){
                                    $('#myModal').modal('show');
                                });
                            </script>");
                }else{
                    printf("erro");    
                }
            }
            $conexao->close();
           
        ?>

    </body>
</html>



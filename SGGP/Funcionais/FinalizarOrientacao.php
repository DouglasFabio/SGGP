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
            $aluno = $_POST['aluno'];
            $data_fim = $_POST['data_fim'];

        ?>

        <form action="../Visuais/ProjetosPesquisa.php" method="post">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Orientação finalizada com sucesso!</h5>
                  </div>
                  <input name="sigla" value="<?php echo $sigla; ?>" hidden>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary">OK</button>
                  </div>
                </div>
              </div>
            </div>
        </form>
        

      
        <?php
            include("../Uteis/ScriptsPainel.php");
            
            $atualiza = "UPDATE `tb_alunos` 
                 SET `data_fim` = '".$data_fim."'
                 WHERE `id` = '".$aluno."'";

            $resultado = mysqli_query($conexao, $atualiza);

            if($resultado){
                
                $atualiza2 = "UPDATE `tb_projetospesquisa` 
                 SET `aluno` = NULL
                 WHERE `id` = '".$id."'";
                $resultado2 = mysqli_query($conexao, $atualiza2);
                
                if($resultado2){
                    printf("<script>
                            $(document).ready(function(){
                                $('#myModal').modal('show');
                            });
                        </script>");
                }
                else{

                    echo "erro";

                }

            }else{

                echo "erro";

            }

            $conexao->close();
        ?>

    </body>
</html>


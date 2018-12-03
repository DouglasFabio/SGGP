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
            $id_projeto = $_POST['id'];
            $nome = $_POST['nome_aluno'];
            $curso = $_POST['curso_aluno'];   
            $link = $_POST['link_aluno'];    
            $data_aluno = $_POST['datainicio_aluno'];
                
        ?>

        <form action="../Visuais/ProjetosPesquisa.php" method="post">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Discente cadastrado com sucesso!</h5>
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
        

       
        <?php
        
                include("../Uteis/ScriptsPainel.php");
                
                $insereDiscente = "INSERT INTO `tb_alunos` (`nome`, `curso`, `link`, `data_inicio`) VALUES ('$nome', '$curso', '$link','$data_aluno');";


                if ($conexao->query($insereDiscente) === TRUE){
                    $busca = "SELECT id FROM tb_alunos ORDER BY id DESC LIMIT 1";
                    
                    $resultado = $conexao->query($busca);
                
                    
                    // VERIFICAÇÃO 
                    if ($resultado->num_rows > 0) {

                        $saida = $resultado->fetch_assoc();
                        
                        $atualiza = "UPDATE `tb_projetospesquisa` 
                             SET `aluno` = '".$saida['id']."'
                             WHERE `id` = ".$id_projeto;
                        $resultado2 = mysqli_query($conexao, $atualiza);

                        if($resultado2){
                            printf("<script>
                                        $(document).ready(function(){
                                            $('#myModal').modal('show');
                                        });
                                    </script>");
                        }
                        else{
                            printf("<script>retorna();</script>");
                        }
                    }
                    
                }else{
                    printf("<script>retorna();</script>");    
                }
            $conexao->close();
           
        ?>

    </body>
</html>



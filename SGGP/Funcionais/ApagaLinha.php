<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php

        if (!isset($_SESSION)) session_start();

        if (!isset($_SESSION['AdmLogin'])) {
            
          header("Location: Painel.php"); exit;

        }


        include("../Uteis/HeadPainel.php");
        
    ?>
        
    </head>
    <body>
                <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <?php
            function modal(){
                printf('
                    <form action="MudaLinha.php?get=1" method="post">
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Erro ao deletar: Linha com vinculo ativo.</h5>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-secondary">OK</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    </form>
                    <script>
            $(document).ready(function(){
                $(\'#myModal\').modal(\'show\');
            });
        </script>
                '); 
            }
            function ok(){

                printf('
                    <form action="../Visuais/ManutencaoLinhasGeral.php" method="post">
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Linha deletada com sucesso!</h5>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-secondary">OK</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    </form>
                    <script>
            $(document).ready(function(){
                $(\'#myModal\').modal(\'show\');
            });
        </script>
                ');
            }
            include("../BancoDeDados/Conexao.php");

            $conexao = conectar();

                $linha = $_POST['linha_exclui'];
                
                $busca = "SELECT codigo, nome FROM tb_grandesareas WHERE nome = '".$linha."'";

                $resultado = $conexao->query($busca);

                if ($resultado->num_rows == 0) {
                        $busca2 = "SELECT codigo, nome FROM tb_subareas WHERE nome = '".$linha."'";

                        $resultado2 = $conexao->query($busca2);
                        if ($resultado2->num_rows == 0) {
                            $busca3 = "SELECT codigo, nome FROM tb_especialidades WHERE nome = '".$linha."'";

                            $resultado3 = $conexao->query($busca3);
                            if ($resultado3->num_rows == 0) {
                                $busca4 = "SELECT codigo, nome FROM tb_subespecialidades WHERE nome = '".$linha."'";

                                $resultado4 = $conexao->query($busca4);
                                if ($resultado4->num_rows > 0) {
                                    $saida = $resultado4->fetch_assoc();
                                    
                                    $busca5 = "SELECT fim_vinculo FROM tb_linhasgrupos WHERE codigo_capes = '".$saida['codigo']."'";
                                    
                                    $resultado5 = $conexao->query($busca5);
                                    
                                    if ($resultado5->num_rows > 0) {
                                        $saida2 = $resultado->fetch_assoc();
                                        if($saida2['fim_vinculo'] != ""){
                                            $exclui = "DELETE FROM `tb_subespecialidades` 
                                             WHERE `codigo` = '".$saida['codigo']."'";

                                            $resultado = mysqli_query($conexao, $exclui);
                                            if($resultado){
                                                ok();
                                            }
                                        }
                                        else{
                                            modal();
                                        } 
                                    }
                                    else{
                                        $exclui = "DELETE FROM `tb_subespecialidades` 
                                         WHERE `codigo` = '".$saida['codigo']."'";

                                        $resultado = mysqli_query($conexao, $exclui);
                                        if($resultado){
                                            ok();
                                        }
                                    }
                                }
                                
                                else{
                                    printf('<script>window.alert("Linha não encontrada!");</script>');
                                }
                            }
                            else{
                                $saida = $resultado3->fetch_assoc();
                                    
                                $busca5 = "SELECT fim_vinculo FROM tb_linhasgrupos WHERE codigo_capes = '".$saida['codigo']."'";

                                $resultado5 = $conexao->query($busca5);

                                if ($resultado5->num_rows > 0) {
                                    $saida2 = $resultado->fetch_assoc();
                                    if($saida2['fim_vinculo'] != ""){
                                        $exclui = "DELETE FROM `tb_especialidades` 
                                         WHERE `codigo` = '".$saida['codigo']."'";

                                        $resultado = mysqli_query($conexao, $exclui);
                                        if($resultado){
                                            ok();
                                        }
                                    }
                                    else{
                                        modal();
                                    } 
                                }
                                else{
                                    $exclui = "DELETE FROM `tb_especialidades` 
                                     WHERE `codigo` = '".$saida['codigo']."'";

                                    $resultado = mysqli_query($conexao, $exclui);
                                    if($resultado){
                                        ok();
                                    }
                                }
                            }
                        }
                        else{
                            $saida = $resultado2->fetch_assoc();
                                    
                            $busca5 = "SELECT fim_vinculo FROM tb_linhasgrupos WHERE codigo_capes = '".$saida['codigo']."'";

                            $resultado5 = $conexao->query($busca5);

                            if ($resultado5->num_rows > 0) {
                                $saida2 = $resultado->fetch_assoc();
                                if($saida2['fim_vinculo'] != ""){
                                    $exclui = "DELETE FROM `tb_subareas` 
                                     WHERE `codigo` = '".$saida['codigo']."'";

                                    $resultado = mysqli_query($conexao, $exclui);
                                    if($resultado){
                                        ok();
                                    }
                                }
                                else{
                                    modal();
                                } 
                            }
                            else{
                                $exclui = "DELETE FROM `tb_subareas` 
                                 WHERE `codigo` = '".$saida['codigo']."'";

                                $resultado = mysqli_query($conexao, $exclui);
                                if($resultado){
                                    ok();
                                }
                            }
                        }
                }
                else{
                    $saida = $resultado->fetch_assoc();
                                    
                    $busca5 = "SELECT fim_vinculo FROM tb_linhasgrupos WHERE codigo_capes = '".$saida['codigo']."'";

                    $resultado5 = $conexao->query($busca5);

                    if ($resultado5->num_rows > 0) {
                        $saida2 = $resultado->fetch_assoc();
                        if($saida2['fim_vinculo'] != ""){
                            $exclui = "DELETE FROM `tb_grandesareas` 
                             WHERE `codigo` = '".$saida['codigo']."'";

                            $resultado = mysqli_query($conexao, $exclui);
                            if($resultado){
                                ok();
                            }
                        }
                        else{
                            modal();
                        } 
                    }
                    else{
                        $exclui = "DELETE FROM `tb_grandesareas` 
                         WHERE `codigo` = '".$saida['codigo']."'";

                        $resultado = mysqli_query($conexao, $exclui);
                        if($resultado){
                            ok();
                        }
                    }
                }
        
        ?>

        <?php
        
            include("../Uteis/ScriptsPainel.php");
        
        ?>
    </body>
</html>



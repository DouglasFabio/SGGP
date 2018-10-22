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
            function modal($nome, $codigo){
                printf('
                    <form action="MudaLinha.php?get=1" method="post">
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editando linha selecionada</h5>
                              </div>
                              <input type="number" max="99999999" name="codigo" class="form-control" value="'.$codigo.'">
                              <input type="text" name="nome" class="form-control" value="'.$nome.'">
                              <input name="linha" value="'.$codigo.'" hidden>
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
                                <h5 class="modal-title" id="exampleModalLabel">Linha editada com sucesso!</h5>
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
            
            if(isset($_GET['get'])){
                $codigo = $_POST['codigo'];
                $nome = $_POST['nome'];
                $linha = $_POST['linha'];
                
                $busca = "SELECT codigo, nome FROM tb_grandesareas WHERE codigo = '".$linha."'";

                $resultado = $conexao->query($busca);

                if ($resultado->num_rows == 0) {
                        $busca2 = "SELECT codigo, nome FROM tb_subareas WHERE codigo = '".$linha."'";

                        $resultado2 = $conexao->query($busca2);
                        if ($resultado2->num_rows == 0) {
                            $busca3 = "SELECT codigo, nome FROM tb_especialidades WHERE codigo = '".$linha."'";

                            $resultado3 = $conexao->query($busca3);
                            if ($resultado3->num_rows == 0) {
                                $busca4 = "SELECT codigo, nome FROM tb_subespecialidades WHERE codigo = '".$linha."'";

                                $resultado4 = $conexao->query($busca4);
                                if ($resultado4->num_rows > 0) {
                                    $atualiza = "UPDATE `tb_subespecialidades` 
                                         SET `codigo` = '".$codigo."',
                                         `nome` = '".$nome."'
                                         WHERE `codigo` = '".$linha."'";

                                    $resultado = mysqli_query($conexao, $atualiza);
                                    if($resultado){
                                        ok();
                                    }
                                }
                                else{
                                    printf('<script>window.alert("Linha não encontrada!");</script>');
                                }
                            }
                            else{
                                $atualiza = "UPDATE `tb_especialidades` 
                                         SET `codigo` = '".$codigo."',
                                         `nome` = '".$nome."'
                                         WHERE `codigo` = '".$linha."'";

                                $resultado = mysqli_query($conexao, $atualiza);
                                if($resultado){
                                    ok();
                                }
                            }
                        }
                        else{
                            $atualiza = "UPDATE `tb_subareas` 
                                         SET `codigo` = '".$codigo."',
                                         `nome` = '".$nome."'
                                         WHERE `codigo` = '".$linha."'";

                            $resultado = mysqli_query($conexao, $atualiza);
                            if($resultado){
                                ok();
                            }
                        }
                }
                else{
                    $atualiza = "UPDATE `tb_grandesareas` 
                                         SET `codigo` = '".$codigo."',
                                         `nome` = '".$nome."'
                                         WHERE `codigo` = '".$linha."'";

                    $resultado = mysqli_query($conexao, $atualiza);
                    if($resultado){
                        ok();
                    }
                }
                
            }
            else{
                $linha = $_POST['linha_edita'];

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
                                    $saida = $resultado->fetch_assoc();
                                    modal($saida['nome'], $saida['codigo']);
                                }
                                else{
                                    printf('<script>window.alert("Linha não encontrada!");</script>');
                                }
                            }
                            else{
                                $saida = $resultado->fetch_assoc();
                                modal($saida['nome'], $saida['codigo']);
                            }
                        }
                        else{
                            $saida = $resultado->fetch_assoc();
                            modal($saida['nome'], $saida['codigo']);
                        }
                }
                else{
                    $saida = $resultado->fetch_assoc();
                    modal($saida['nome'], $saida['codigo']);
                }

            }
        
        ?>

        <?php
        
            include("../Uteis/ScriptsPainel.php");
        
        ?>
    </body>
</html>


<html lang="pt-br">
    <head>
        <?php $sigla = $_POST['sigla']; ?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
        
            include("../Uteis/HeadPainel.php");
        
        ?>
        
    </head>
    <body>
        <?php

            include("../BancoDeDados/Conexao.php");

            $conexao = conectar();
            $sigla = $_POST['sigla'];
            $id = $_POST['id'];
            $titulo = $_POST['titulo'];
            $docente = $_POST['docente_projeto'];
            $data_inicioprojeto = $_POST['datainicio_proj'];
            if(isset($_POST['datafim_proj'])){
                $data_fimprojeto = "'".$_POST['datafim_proj']."'";
            }else{
                $data_fimprojeto = "NULL";
            }
            $nome_aluno = $_POST['nome_aluno'];
            $curso_aluno = $_POST['curso_aluno'];
            $link_aluno = $_POST['link_aluno'];
            $data_inicioaluno = $_POST['datainicio_aluno'];
            if(isset($_POST['datafim_aluno'])){
                $data_fimaluno = "'".$_POST['datafim_aluno']."'";
            }
            else{
                $data_fimaluno = "NULL";
            }
            $idaluno = $_POST['id_aluno'];
            $linha_projeto = $_POST['linha_projeto'];    
            $tipo_bolsa = $_POST['tipo_bolsa'];
            if($tipo_bolsa == "Outros"){
                $tipo_bolsa = $_POST['outros_bolsa'];
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
                    <h5 class="modal-title" id="exampleModalLabel">Projeto atualizado com sucesso!</h5>
                  </div>
                  <input name="sigla" value="<?php echo $sigla; ?>" hidden>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary">OK</button>
                  </div>
                </div>
              </div>
            </div>
        </form>
        <form action="../Visuais/ProjetosPesquisa.php" method="post">
            <div class="modal fade" id="myModall" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Erro na atualização do projeto!</h5>
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
                if($data_fimaluno != "NULL" && $data_inicioaluno < $data_fimaluno || $data_fimprojeto != "NULL" && $data_inicioprojeto < $data_fimprojeto ){
                    printf("<script>
                                $(document).ready(function(){
                                    $('#myModall').modal('show');
                                });
                            </script>");
                }else{
                    
                    $atualiza = "UPDATE `tb_projetospesquisa` 
                         SET `titulo` = '".$titulo."',
                         `docente` = '".$docente."',
                         `linha` = '".$saida['codigo']."',
                         `tipo` = '".$tipo_bolsa."',
                         `data_inicio` = '".$data_inicioprojeto."',
                         `data_fim` = ".$data_fimprojeto."
                         WHERE `id` = '".$id."'";

                    $resultado = mysqli_query($conexao, $atualiza);

                    if($resultado){
                        if($idaluno == 1){
                            printf("<script>
                                    $(document).ready(function(){
                                        $('#myModal').modal('show');
                                    });
                                </script>");
                        }
                        else{
                            $atualizaaluno = "UPDATE `tb_alunos` 
                             SET `nome` = '".$nome_aluno."',
                             `curso` = '".$curso_aluno."',
                             `link` = '".$link_aluno."',
                             `data_inicio` = '".$data_inicioaluno."',
                             `data_fim` = ".$data_fimaluno."
                             WHERE `id` = '".$idaluno."'";
                            $resultadoaluno = mysqli_query($conexao, $atualizaaluno);

                            if($resultadoaluno){
                                printf("<script>
                                    $(document).ready(function(){
                                        $('#myModal').modal('show');
                                    });
                                </script>");
                            }
                            else{
                                printf("<script>
                                    $(document).ready(function(){
                                        $('#myModall').modal('show');
                                    });
                                </script>");
                            }
                        }

                    }else{
                        printf("<script>
                                    $(document).ready(function(){
                                        $('#myModall').modal('show');
                                    });
                                </script>");
                    }
                }
            }
            $conexao->close();
        ?>

    </body>
</html>


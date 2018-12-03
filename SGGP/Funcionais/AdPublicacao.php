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
            
             if($_POST['projeto_publicacao'] == ""){
                $projeto = "NULL";
            }else{
                $projeto = $_POST['projeto_publicacao'];
            }
 
            if($_POST['linha_projeto'] == ""){
                $linha = "NULL";
                $buscaCodigo = "SELECT id, linha FROM tb_projetospesquisa WHERE id = '".$projeto."'";

                $resultado = $conexao->query($buscaCodigo);
                // VERIFICAÇÃO 
                if ($resultado->num_rows > 0) {
                    $saida = $resultado->fetch_assoc();
                    $linha = $saida['linha'];
                }
            }else{
                $linha = $_POST['linha_projeto'];
                $buscaCodigo2 = "SELECT codigo, nome FROM tb_subespecialidades WHERE nome = '".$linha."'";

                $resultado = $conexao->query($buscaCodigo2);
                // VERIFICAÇÃO 
                if ($resultado->num_rows > 0) {
                    $saida = $resultado->fetch_assoc();
                    $linha = $saida['codigo'];
                }
            }
            
           
            
            $titulo = $_POST['titulo_publicacao'];
            $tipo = $_POST['tipo_publicacao'];
            
            if($tipo == 1){
                $tipoP = "Livro";
            }
            else if($tipo == 2){
                $tipoP = "Capítulo de Livro";
            }
            else if($tipo == 3){
                $tipoP = "Anais";
            }
            else if($tipo == 4){
                $tipoP = "Periódicos";
            }
            else{
               header("Location: ../Visuais/Publicacoes.php"); 
            }
            $data = $_POST['data_publicacao'];
            $referencia = $_POST['referencia_publicacao'];
            
            if($_POST['docente_projeto'] == ""){
                $docente = "NULL";
                $buscaDocente = "SELECT id, docente, grupo FROM tb_projetospesquisa WHERE id = '".$projeto."'";

                $resultado = $conexao->query($buscaDocente);
                // VERIFICAÇÃO 
                if ($resultado->num_rows > 0) {
                    $saida = $resultado->fetch_assoc();
                    $docente = $saida['docente'];
                }
            }else{
                $docente = $_POST['docente_projeto'];
                
            }   
        ?>

        <form action="../Visuais/Painel.php" method="post">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Publicação cadastrada com sucesso!</h5>
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

                $inserePublicacao = "INSERT INTO `tb_publicacoes` (`grupo`,`projeto`, `titulo`, `tipo`, `data`, `linha`, `docente`, `referencia`)                                                                                                                   VALUES ('".$sigla."',".$projeto.", '".$titulo."', '".$tipoP."', '".$data."', ".$linha.", ".$docente.", '".$referencia."');";
                
        
            if ($conexao->query($inserePublicacao) === TRUE){
                printf("<script>
                            $(document).ready(function(){
                                $('#myModal').modal('show');
                            });
                        </script>");
            }else{
                printf($inserePublicacao);    
            }

            $conexao->close();
        ?>

    </body>
</html>



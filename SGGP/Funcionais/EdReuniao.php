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
        
            $sigla = $_POST['sigla'];
            $data  = $_POST['data_reuniao'];
            $hora  = $_POST['horaprev_reuniao'];
            $pauta = $_POST['pauta_reuniao'];
            date_default_timezone_set('America/Sao_Paulo');
            $hoje = date("Y-m-d");
            $agora = date("H:i:s");
            
        ?>

        <form action="../Visuais/Reunioes.php" method="post">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reunião editada com sucesso!</h5>
                  </div>
                  <input name="sigla" value="<?php echo $sigla; ?>" hidden>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary">OK</button>
                  </div>
                </div>
              </div>
            </div>
        </form>
        <form action="../Visuais/Reunioes.php" method="post">
            <div class="modal fade" id="myModall" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Erro na edição da reunião!</h5>
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
                if($data < $hoje && $hora < $agora ){
                    printf("<script>
                                $(document).ready(function(){
                                    $('#myModall').modal('show');
                                });
                            </script>");
                }else{
                    
                    $atualiza = "UPDATE `tb_reunioes` 
                                     SET `data` = '".$data."',
                                         `inicio_previsao` = '".$hora."',
                                         `pauta` = '".$pauta."'  
                                     WHERE `id` = '".$id."'";

                        $resultado = mysqli_query($conexao, $atualiza);

                    if($resultado){
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
                
            $conexao->close();
        ?>

    </body>
</html>


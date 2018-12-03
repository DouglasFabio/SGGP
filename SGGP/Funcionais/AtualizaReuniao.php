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
            $id = $_POST['id'];
            $inicio_real = $_POST['horareal_reuniao'];
            $ata = $_POST['ata_reuniao'];   
            $participantes = $_POST['participantesReuniao'];
            $sigla = $_POST['sigla'];
            $fim = $_POST['horafim_reuniao'];
            $convidados = $_POST['conv_reuniao'];


            $qtdDocentes = 0;
            // Verificando quantos participantes foram selecionados
            foreach($participantes as $k => $v){ 
                $qtdDocentes++;  
            }

            // atualizando sem linha de pesquisa
            $atualiza = "UPDATE `tb_reunioes` 
                                     SET `situacao` = '2', 
                                         `inicio_real` = '".$inicio_real."',
                                         `ATA` = '".$ata."',
                                         `fim_reuniao` = '".$fim."', 
                                         `convidados` = '".$convidados."' 
                                     WHERE `id` = '".$id."'";

                        $resultado = mysqli_query($conexao, $atualiza);

            ?>

        <form action="../Visuais/Reunioes.php" method="post">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reunião finalizada com sucesso!</h5>
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
                if ($resultado){
                    $i = 0;
                    while($i < $qtdDocentes){
                        $insereLinhasDocentes  = "INSERT INTO `tb_partreunioes` (`reuniao`,`docente`)
                                                       VALUES ('$id', '$participantes[$i]');";

                        $conexao->query($insereLinhasDocentes); 
                        $i++;
                    }    
                    printf("<script>
                                $(document).ready(function(){
                                    $('#myModal').modal('show');
                                });
                            </script>");
                }else{
                    printf("erro");    
                }
            
            $conexao->close();
           
        ?>

    </body>
</html>



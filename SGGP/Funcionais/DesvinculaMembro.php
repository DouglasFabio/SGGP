<html lang="pt-br">
    <head>
        <?php $sigla = $_POST['sigla']; ?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script>
            function retorna()
            {
                var x;
                var r=confirm("Problemas nos dados informados!");
                if (r==true)
                {
                    window.location.href = '../Visuais/MembrosGrupo.php?sigla= <?php echo $sigla;?>';
                }
                else
                {
                     window.location.href = '../Visuais/MembrosGrupo.php?sigla= <?php echo $sigla;?>';
                }
                document.getElementById("demo").innerHTML=x;
            }
        </script>
        <?php
        
            include("../Uteis/HeadPainel.php");
        
        ?>
        
    </head>
    <body>
        <?php

            include("../BancoDeDados/Conexao.php");

            $conexao = conectar();

            
            $id = $_POST['id'];
            $data_desvinculo = $_POST['data_exclusao'];
            $data_inclusao   = $_POST['data_inclusao'];
            if($data_desvinculo < $data_inclusao){
                echo "<script>retorna();</script>";
            }else{
        ?>

        <form action="../Visuais/MembrosGrupo.php" method="post">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Membro desvinculado com sucesso!</h5>
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
            
            $atualiza = "UPDATE `tb_participantes` 
                 SET `data_exclusao` = '".$data_desvinculo."'
                 WHERE `id` = '".$id."'";

            $resultado = mysqli_query($conexao, $atualiza);

            if($resultado){

                printf("<script>
                            $(document).ready(function(){
                                $('#myModal').modal('show');
                            });
                        </script>");

            }else{
                echo "<script>retorna();</script>";
            }
        }
            $conexao->close();
        ?>

    </body>
</html>


<html lang="pt-br">
    <head>
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

        ?>

        <form action="../Visuais/MembrosGrupo.php?sigla=<?php echo $sigla;?>" method="post">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Vinculo do membro com o grupo excluido com sucesso!</h5>
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
            
            $excluiMembro = "DELETE FROM tb_participantes WHERE id ='".$id."'";

            $resultado = mysqli_query($conexao, $excluiMembro);

            if($resultado){
                
                $excluiLinhasDocente = "DELETE FROM tb_linhasdocente WHERE docente ='".$id."'";
                
                printf("<script>
                            $(document).ready(function(){
                                $('#myModal').modal('show');
                            });
                            </script>");
                

            }else{

                echo "erro";

            }

            $conexao->close();
        ?>

    </body>
</html>



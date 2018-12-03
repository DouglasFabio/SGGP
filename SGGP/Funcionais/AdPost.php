<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
            if (!isset($_SESSION)) session_start();
            if (!isset($_SESSION['AdmLogin'])) {
                header("Location: ../Visuais/Painel.php"); exit;
            }
            include("../Uteis/HeadPainel.php");
        ?>
    </head>
        <form action="../Visuais/Painel.php" method="post">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Postado com sucesso!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-secondary">OK</button>
              </div>
            </div>
          </div>
        </div>
    </form>

    <form action="../Visuais/Posts.php" method="post">
        <div class="modal fade" id="erro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Problemas para postar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-secondary">OK</button>
              </div>
            </div>
          </div>
        </div>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
<body>
    <?php
        include("../BancoDeDados/Conexao.php");
        $conexao = conectar();
        
        $post        = $_POST['post'];
    
        include("../Uteis/ScriptsPainel.php");
        

                $insere = "INSERT INTO `tb_posts` (`postagem`) 
                                                    VALUES ('$post');";

                if ($conexao->query($insere) === TRUE) {
                    printf("<script>
                            $(document).ready(function(){
                            $('#myModal').modal('show');
                            });
                            </script>");
                }else{
                    printf("<script>
                        $(document).ready(function(){
                            $('#erro').modal('show');
                        });
                    </script>");    
                }
    ?>